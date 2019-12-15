<?php

//////////////////////////////////////////////////////////////
//===========================================================
// userindex_theme.php
//===========================================================
// SOFTACULOUS 
// Version : 1.1
// Inspired by the DESIRE to be the BEST OF ALL
// ----------------------------------------------------------
// Started by: Alons
// Date:       10th Jan 2009
// Time:       21:00 hrs
// Site:       http://www.softaculous.com/ (SOFTACULOUS)
// ----------------------------------------------------------
// Please Read the Terms of use at http://www.softaculous.com
// ----------------------------------------------------------
//===========================================================
// (c)Softaculous Inc.
//===========================================================
//////////////////////////////////////////////////////////////

if(!defined('SOFTACULOUS')){

	die('Hacking Attempt');

}

function amppsindex_theme(){

global $a_apps, $ampps_apps_installed, $theme, $globals, $softpanel, $user, $l, $updates_available, $iscripts, $scripts ,$info, $cscripts, $usage;

$BinVer = $softpanel->currentBinary();
//Check Update for AMPPS 
if(PHP_INT_SIZE == '4'){
	$arch = "x86";
}else{
	$arch = "x86_64";
}

$sys = (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN' ? 'win' : (strtoupper(substr(PHP_OS, 0, 3)) == 'DAR' ? 'mac' : 'linux'));
$chkup = get_softaculous_file('http://api.ampps.com/update-'.$sys.'.php?version='.$globals['amp_version'].'?arch='.$arch);	
$update = explode('|', $chkup);

if(strcmp($update['0'],'Your AMPPS is upto date.') == 0){
	$ampps_up_avail = false;
//New changes from 3.8 so allow update only from 3.8
}else if($update['0'] > $globals['amp_version'] && $update['0'] > '3.7'){
	$ampps_up_avail = true;		
	$lates_ver = $update['0'];	
}

//Check Update for AMPPS Apps.
foreach($ampps_apps_installed as $j => $m){
	foreach($a_apps as $k => $v){
		if($m['aid'] == $v['aid'] && $m['version'] < $v['version']){
			$apps_update[$i]['aid'] = $v['aid'];
			$apps_update[$i]['name'] = $v['fullname'];
			$i++;
		}
	}
}

#Ampps User Page
echo '</br>
<div class="row">
	<div class ="col-sm-11 col-xs-10" style="text-align:center;">
		<span class="sai_main_head">'.$l['ampps'].'</span>
	</div>	
	<div class ="col-sm-1 col-xs-2">
		<div class="topscripts">
			<img src="'.$theme['a_images'].'ratings.png" width="30" height="30" class="someclass" title="Top Scripts" style="border:none;"/>&nbsp;&nbsp;								
		</div>	
	</div></br>	
</div><hr>

<div class="bg2" style= "width:78%; background:#F8F8F8;">';
//Ampps update available ?
	if($ampps_up_avail && $lates_ver > $globals['amp_version']){
		echo '<div class="row"><!----#Update---->
			<div class="alert alert-success" >
				<a href = "#" class="close" data-dismiss="alert">&times;</a>
					<center><span class="sai_exp2"><img src="'.$theme['images'].'upgrade_logo.png" height="25" width="25" /> &nbsp
					<a href="'.$globals['ind'].'act=ampps_update" alt="" style="text-decoration:none;"><b><u>'.$l['ampps_up_avail'].'-'.$lates_ver.'&nbsp'.$l['ampps_up_avail2'].'</u></b>&nbsp</a> </span></center>
			</div>
		</div>';
	}
	
//Apps update available ?
	if(!empty($apps_update) && $globals['amp_version'] >= '3.8'){		
	echo '<div class="row"><!----#Update---->
			<div class="alert alert-info" >
				<a href = "#" class="close" data-dismiss="alert">&times;</a>
					<center><span class="sai_exp2"><img src="'.$theme['images'].'upgrade_logo.png" height="25" width="25" /> &nbsp'.$l['ampps_apps_updates_available'];
					foreach($apps_update as $k => $v){
					echo'
					<a href="'.$globals['ind'].'act=a_apps_update&app='.$apps_update[$k]['aid'].'" alt="" style="text-decoration:none;"><b><u>'.$apps_update[$k]['name'].'</u></b>,&nbsp</a>';
					}
			echo' </span></center>
			</div>
		</div>';
	}
//Script update available ?
	if(!empty($updates_available)){	
	echo '
	<div class="row"><!----#Update---->
		<div class="alert alert-warning">
			<a href = "#" class="close" data-dismiss="alert">&times;</a>
			<center><a href="'.$globals['ind'].'act=installations&showupdates=true" alt="" style="text-decoration:none;"><img src="'.$theme['images'].'notice.gif" /> &nbsp; '.lang_vars($l['updates_available'], array($updates_available)).'</a></center>
		</div>
	</div>
	';
	}
	
echo '<div class="top-summary">
		<div class="row">
			<div class="panel" id="configure_div">
				<div class="panel-head gray">
					<h5 class="pull-left">&nbsp&nbsp<i class="sai-settinground"></i>&nbsp'.$l['ampps_config'].'</h5></span>
					<div class="clearfix"></div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<a href="'.$globals['ind'].'act=secure" style="text-decoration:none;" style="margin-top:20px;" >
							<div class="col-sm-2 col-xs-6 pan-button someclass" title="Change Ampps and MySQL Password">
								<img width="36" height="36" src="'.$theme['a_images'].'secure.png" alt="" /><br /><span class="medium">'.$l['ampps_secure'].'</span>
							</div>
						</a>	
						<a href="'.$globals['ind'].'act=security" style="text-decoration:none;">
							<div class="col-sm-2 col-xs-6 pan-button someclass" title="You can change Ampps Password">
								<img width="36" height="36" src="'.$theme['a_images'].'security.png" alt="" /><br /><span class="medium">'.$l['ampps_security'].'</span>
							</div>
						</a>	
						<a href="'.$globals['ind'].'act=status" style="text-decoration:none;">						
							<div class="col-sm-2 col-xs-6 pan-button someclass" title="It will Display Ampps Status">
								<img width="36" height="36" src="'.$theme['a_images'].'status.png" data-placement="right" alt="" /><br /><span class="medium">'.$l['ampps_status'].'</span>
							</div>
						</a>
						<a href="'.$globals['ind'].'act=ampps_domainadd" style="text-decoration:none;">								
							<div class="col-sm-2 col-xs-6 pan-button someclass" title="You can Add Domains for Ampps">
								<img width="36" height="36" src="'.$theme['a_images'].'adddomain.png" alt="" /><br /><span class="medium">'.$l['ampps_adddom'].'</span>
							</div>
						</a>
						<a href="'.$globals['ind'].'act=ampps_domainmanage" style="text-decoration:none;">								
							<div class="col-sm-2 col-xs-6 pan-button someclass" title="You can Manage for Ampps">
								<img width="36" height="36" src="'.$theme['a_images'].'domains.png" alt="" /><br /><span class="medium">'.$l['ampps_mandom'].'</span>
							</div>
						</a>
							'.($globals['amp_version'] >= '3.9' ? '<a href="'.$globals['ind'].'act=domainslog" style="text-decoration:none;">								
							<div class="col-sm-2 col-xs-6 pan-button someclass" title="Check Logs for Domains">
								<img width="36" height="36" src="'.$theme['a_images'].'error_log.png" alt="" /><br /><span class="medium">Domains Log</span>
							</div>
						</a>' : '').'
					</div>			
				</div>			
			</div>
		</div>
	</div>				
		
	<div class="top-summary">
		<div class="row">
			<div class="panel" id="DatabaseTools_div">
				<div class="panel-head gray">
					<h5 class="pull-left">&nbsp&nbsp<i class="sai-dbtools"></i>&nbsp'.$l['ampps_mysql'].'</h5></span>
					<div class="clearfix"></div>
				</div>						
				<div class="row">
					<div class="col-lg-12">
						<a href="http://'.$globals['HTTP_HOST'].'/sqlite" target="_blank" style="text-decoration:none;">
							<div class="col-sm-2 col-xs-6 pan-button someclass" title="Database management system for sqlite databases">
								<img  width="36" height="36" src="'.$theme['a_images'].'sqlite.png" alt="" /><br /><span class="medium">'.$l['ampps_sqlite'].'</span>
							</div>					
						</a>
						<a href="http://'.$globals['HTTP_HOST'].'/phpmyadmin/index.php?server=1&target=server_databases.php" target="_blank" style="text-decoration:none;">						
							<div class="col-sm-2 col-xs-6 pan-button someclass" title="You can Add Database in MySQL">
								<img  width="36" height="36" src="'.$theme['a_images'].'adddb.png" alt="" /><br /><span class="medium">'.$l['ampps_adddb'].'</span>
							</div>							
						</a>	
						<a href="http://'.$globals['HTTP_HOST'].'/phpmyadmin" target="_blank" style="text-decoration:none;">
							<div class="col-sm-2 col-xs-6 pan-button someclass" title="Direct Access to phpMyAdmin">
								<img  width="36" height="36" src="'.$theme['a_images'].'phpmyadmin.png" alt="phpMyAdmin" /><br /><span class="medium">'.$l['ampps_phpmyadmin'].'</span>
							</div>
						</a>
						<a href="'.$globals['ind'].'act=mysqlsettings" style="text-decoration:none;">
							<div class="col-sm-2 col-xs-6 pan-button someclass" title="You can Change MySQL password">
								<img  width="36" height="36" src="'.$theme['a_images'].'mysqlsettings.png" alt="Change Password" /><br /><span class="medium">'.$l['ampps_mysqlsettings'].'</span>
							</div>
						</a>';
						if($BinVer > 15){
						echo '
						<a href="http://'.$globals['HTTP_HOST'].'/rockmongo" target="_blank" style="text-decoration:none;">
							<div class="col-sm-2 col-xs-6 pan-button someclass" title="RockMongo is a MongoDB administration tool">
								<img  width="36" height="36" src="'.$theme['a_images'].'rockmongo.png" alt="RockMongo" /><br /><span class="medium">'.$l['ampps_rockmongo'].'</span>
							</div>
						</a>';
						}echo '	
					</div>	
				</div>			
			</div>
		</div>
	</div>
	
	<div class="top-summary">
		<div class="row">
			<div class="panel" id="Features_div">
				<div class="panel-head gray">
					<h5 class="pull-left">&nbsp&nbsp<i class="sai-fullstar"></i>&nbsp'.$l['ampps_features'].'</span></h5></span>
					<div class="clearfix"></div>
				</div>				
				<div class="row">
					<div class="col-lg-12">	
						';
						if($BinVer > 16){
						echo '
						<a href="'.$globals['ind'].'act=ftpadd" style="text-decoration:none;">		
							<div class="col-sm-2 col-xs-6 pan-button someclass" title="You can Add your FTP account">
								<img  width="36" height="36" src="'.$theme['a_images'].'addftp.png" alt="" /><br /><span class="medium">'.$l['ampps_ftp_account'].'</span>
								
							</div>
						</a>							
						<a href="'.$globals['ind'].'act=ftpmanage" style="text-decoration:none;">
							<div class="col-sm-2 col-xs-6 pan-button someclass" title="You can Manage your all FTP accounts">
								
								<img  width="36" height="36" src="'.$theme['a_images'].'ftp.png" alt="" /><br /><span class="medium">'.$l['ampps_ftp'].'</span>
							</div>
						</a>
						';}
						echo '
						<a href="'.$globals['ind'].'act=alias" style="text-decoration:none;">
							<div class="col-sm-2 col-xs-6 pan-button someclass" title="Add alias name to www directory">
								';
								if($BinVer > 15){
								echo '
								<img  width="36" height="36" src="'.$theme['a_images'].'alias.png" alt="" /><br /><span class="medium">'.$l['ampps_alias'].'</span>
								';} echo'										
							</div>
						</a>
					</div>			
				</div>
			</div>
		</div>
	</div>	

	<div class="top-summary">
		<div class="row">
			<div class="panel" id="configure_div">
				<div class="panel-head gray">
					<h5 class="pull-left">&nbsp&nbsp<i class="sai-info"></i>&nbsp'.$l['ampps_info'].'</span></h5></span>
					<div class="clearfix"></div>
				</div>					
				<div class="row">			
					<div class="col-lg-12">						
						<a href="'.(($BinVer) < 21 ? $globals['ind'].'act=phpinfo' : 'http://'.$globals['HTTP_HOST'].'/cgi-bin/phpinfo.cgi').'" style="text-decoration:none;">
							<div class="col-sm-2 col-xs-6 pan-button someclass" title="Shows PHP version and all info">
								<img  width="36" height="36" src="'.$theme['a_images'].'phpinfo.png" alt="" /><br /><span class="medium">'.$l['ampps_phpinfo'].'</span>
							</div>
						</a>
						'.($globals['amp_version'] >='3.8' && !$ampps_apps_installed['11'] ? '' : '
						<a href="http://'.$globals['HTTP_HOST'].'/cgi-bin/perlinfo.pl" style="text-decoration:none;">
							<div class="col-sm-2 col-xs-6 pan-button someclass" title="Shows Perl version and all info">
								<img  width="36" height="36" src="'.$theme['a_images'].'perlinfo.png" alt="" /><br /><span class="medium">'.$l['ampps_perlinfo'].'</span>
							</div>
						</a>').'
					</div>				
				</div>
			</div>
		</div>
	</div>		
	
	<div class="top-summary">
		<div class="row">
			<div class="panel" id="ServerConfig_div">
				<div class="panel-head gray">
					<h5 class="pull-left">&nbsp&nbsp<i class="sai-wikis"></i>&nbsp'.$l['ampps_quick_conf'].'</span></h5>
					<div class="clearfix"></div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<a href="'.$globals['ind'].'act=apache_conf" style="text-decoration:none;">
							<div class="col-sm-2 col-xs-6 pan-button someclass" title="You can change your Apache Settings">
								<img  width="36" height="36" src="'.$theme['a_images'].'apache_settings.png" alt="" /><br /><span class="medium">'.$l['ampps_apache'].'</span>
							</div>
						</a>
						<a href="'.$globals['ind'].'act=editini" style="text-decoration:none;">
							<div class="col-sm-2 col-xs-6 pan-button someclass" title="You can change your PHP Settings">
								<img  width="36" height="36" src="'.$theme['a_images'].'php_conf.png" alt="" /><br /><span class="medium">'.$l['ampps_php'].'</span>
							</div>
						</a>'.($globals['amp_version'] >= '3.9' ? '<a href="'.$globals['ind'].'act=default_apps" style="text-decoration:none;">								
							<div class="col-sm-2 col-xs-6 pan-button someclass" title="Set Defualt Apps for startup">
								<img width="36" height="36" src="'.$theme['a_images'].'service_manager.png" alt="" /><br /><span class="medium">'.$l['ampps_default'].'</span>
							</div>
						</a>
						<a href="'.$globals['ind'].'act=allconf" style="text-decoration:none;">								
							<div class="col-sm-2 col-xs-6 pan-button someclass" title="Set configuration for Apps">
								<img width="36" height="36" src="'.$theme['a_images'].'app_conf.png" alt="" /><br /><span class="medium">All Configurations</span>
							</div>
						</a>
						<a href="'.$globals['ind'].'act=alllog" style="text-decoration:none;">								
							<div class="col-sm-2 col-xs-6 pan-button someclass" title="Check error log for Apps">
								<img width="36" height="36" src="'.$theme['a_images'].'app_log.png" alt="" /><br /><span class="medium">Error Logs</span>
							</div>
						</a>' : '' ).'			
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="top-summary">		
		<div class="row">
			<div class="panel" id="Scripts_div">
				<div class="panel-head gray">
					<h5 class="pull-left">&nbsp&nbsp<i class="sai-apps"></i>&nbsp'.$l['ampps_scripts'].'</span></h5></span>
					<div class="clearfix"></div>
				</div>				
				<div class="row">
					<div class="col-lg-12">							
						<a href="'.$globals['ind'].'act=demos" style="text-decoration:none;">
							<div class="col-sm-2 col-xs-6 pan-button someclass" title="You can check all script Demos here">
								<img width="36" height="36" src="'.$theme['a_images'].'demos.png" alt="" /><br /><span class="medium">'.$l['ampps_demos'].'</span>
							</div>
						</a>							
						<a href="'.$globals['ind'].'act=ratings" style="text-decoration:none;">
							<div class="col-sm-2 col-xs-6 pan-button someclass" title="You can rate all your favourite scripts here">
								<img width="36" height="36" src="'.$theme['a_images'].'ratings.png" alt="" /><br /><span class="medium">'.$l['ampps_ratings'].'</span>
							</div>
						</a>							
						<a href="'.$globals['ind'].'act=installations" style="text-decoration:none;">
							<div class="col-sm-2 col-xs-6 pan-button  someclass" title="You can check all your Installation here">
								<img width="36" 	height="36" src="'.$theme['a_images'].'installations.png" alt="" /><br /><span class="medium">'.$l['ampps_installations'].'</span>
							</div>
						</a>							
						<a href="'.$globals['ind'].'act=backups" style="text-decoration:none;">
							<div class="col-sm-2 col-xs-6 pan-button someclass" title="You can check all backups">
								<img width="36" height="36" src="'.$theme['a_images'].'backups.png" alt="" /><br /><span class="medium">'.$l['ampps_backups'].'</span>
							</div>
						</a>							
						<a href="'.$globals['ind'].'act=email" style="text-decoration:none;">
							<div class="col-sm-2 col-xs-6 pan-button someclass" title="Change Email settings">
								<img width="36" height="36" src="'.$theme['a_images'].'emails.png" alt="" /><br /><span class="medium">'.$l['ampps_email'].'</span>
							</div>
						</a>	
					</div>			
				</div>
			</div>	
		</div>
	</div>
</div>';

}

?>