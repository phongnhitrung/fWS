<?php

//error_reporting(E_ALL); 
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Content-Type: text/html; charset=UTF-8");
if((@$_GET['act'] == 'backups' || @$_GET['act'] == 'import_export') && !empty($_GET['download']) && substr_count($_GET['download'], './') == 0){
	header('Content-Disposition: attachment; filename="'.$_GET['download'].'"');
}

if(!empty($_REQUEST['act']) && $_REQUEST['act'] == 'cp_api' && !empty($_REQUEST['rootapi'])){
	$rootapi = 1; // We will check authentication later
}

if(empty($rootapi)){
	// Get username and protect resource for unauthorized use
	include_once($_SERVER['DOCUMENT_ROOT'].'/inc/main.php');
}

if(!function_exists('shell_exec')){
	die('shell_exec function is required for Softaculous to work.');
}

/* echo '<pre>';
print_r($_SESSION); */
// Check if we are logged in
if(!$_SESSION['user'] && empty($rootapi)){
	header("Location: ../login");
	exit;
}

$thisuser = $_SESSION['user'];

// Is it admin logged in as a user ?
if($_SESSION['user'] == 'admin' && !empty($_SESSION['look'])){
	$thisuser = $_SESSION['look'];
}

// Create the directory if it does not exist
if(!is_dir('/var/softtmp/')){
	@mkdir('/var/softtmp/');
	@chmod('/var/softtmp/', 0700);
}

// Create a tmp file to write data
$sess = md5(uniqid(microtime()));
$file = "/var/softtmp/".$sess;
	
// Touch the file
touch($file);
chmod($file, 0600);

$fp = fopen($file, "a");

if(empty($fp)){
	die('Could not write SESSION DATA.');
}

$array = array();
$array['SERVER'] = $_SERVER;
$array['POST'] = $_POST;
$array['GET'] = $_GET;
$array['REQUEST'] = $_REQUEST;
$array['COOKIE'] = $_COOKIE;
$array['SESSION'] = $_SESSION;
$array['thisuser'] = $thisuser;

// We need to load this data as the VestaCP API wants the admin user to execute API calls
// Get users data
exec(VESTA_CMD."v-list-user ".escapeshellarg($thisuser)." json", $output, $return_var);
$data = json_decode(implode('', $output), true);

$user_homdir = $data[$thisuser]['HOME'];
$disk_quota = $data[$thisuser]['DISK_QUOTA'];
$disk_used = $data[$thisuser]['U_DISK'];
$user_contact = $data[$thisuser]['CONTACT'];
$db_quota = $data[$thisuser]['DATABASES'];
$db_used = $data[$thisuser]['U_DATABASES'];

// Get user domains
exec(VESTA_CMD."v-list-web-domains ".escapeshellarg($thisuser)." json", $o, $r);
$array['domains'] = json_decode(implode('', $o), true);

if(!empty($array['domains'])){
	foreach ($array['domains'] as $domain => $value) {
		$array['domains'][$domain] = $user_homdir . '/web/' . $domain . '/public_html';
	}
}

$user_domain = array_keys($array['domains']);

// Add the data to $array	
$array['user_data']['user_name'] = $thisuser;
$array['user_data']['email'] = $user_contact;
$array['user_data']['domain'] = $user_domain[0];
$array['user_data']['homedir'] = $user_homdir;
$array['user_data']['disk_quota'] = $disk_quota;
$array['user_data']['disk_used'] = $disk_used;
$array['user_data']['db_quota'] = $db_quota;
$array['user_data']['db_used'] = $db_used;

// VestaCP API requests finished

fwrite($fp, json_encode($array));
fclose($fp);
chmod($file, 0600);

// This is to destroy the session lock
session_write_close();

// echo '/usr/local/vesta/softaculous/bin/soft sess '.$sess; die();
echo passthru('/usr/local/vesta/softaculous/bin/soft sess '.$sess); //shell_exec was exhausted while downloading large backups
@unlink($file); // load.php will also try to delete it!

// Just to ensure that there should not be any files as a security measures.
$d = date('i');
if($d % 2 == 0){
	
	if ($dh = opendir('/var/softtmp/')) {
		
		while (($dfile = readdir($dh)) !== false) {
			if($dfile == '.' || $dfile == '..') continue;
			
			clearstatcache();
			$stime = filemtime('/var/softtmp/'.$dfile);

			// Delete the file if its there for more than 10 seconds
			if($stime < (time() - 10)){
				@unlink('/var/softtmp/'.$dfile);
			}
		}
		
		closedir($dh);
	}
}

