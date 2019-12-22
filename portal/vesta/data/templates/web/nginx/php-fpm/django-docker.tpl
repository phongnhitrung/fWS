upstream %domain%_%web_port%_django {
    server unix:///home/ubuntu/server_django/%domain%/test.sock; # for a file socket
    #server 125.212.203.153:8001; # for a web port socket (we'll use this first)
}


server {
    listen      %web_port%;
    server_name %domain_idn% %alias_idn%;
    root        %docroot%;
    index       index.php index.html index.htm;
    access_log  /var/log/nginx/domains/%domain%.log combined;
    access_log  /var/log/nginx/domains/%domain%.bytes bytes;
    error_log   /var/log/nginx/domains/%domain%.error.log error;
    
    location / {
        #return 404;
        uwsgi_pass  django;
        #uwsgi_pass unix:/home/ubuntu/django_web/test.sock;
        include     /etc/nginx/uwsgi_params; # the uwsgi_params file you installed
    }
     # Django media
    location /media  {
        alias /home/ubuntu/django_web/media;  # your Django project's media files - amend as required
    }

    location /static {
        alias /home/ubuntu/django_web/media; # your Django project's static files - amend as required
    }

    error_page  403 /error/404.html;
    error_page  404 /error/404.html;
    error_page  500 502 503 504 /error/50x.html;

    location /error/ {
        alias   %home%/%user%/web/%domain%/document_errors/;
    }

   # location ~* "/\.(htaccess|htpasswd)$" {
   #     deny    all;
   #     return  404;
   # }

    location /vstats/ {
        alias   %home%/%user%/web/%domain%/stats/;
        include %home%/%user%/conf/web/%domain%.auth*;
    }

    include     /etc/nginx/conf.d/phpmyadmin.inc*;
    include     /etc/nginx/conf.d/phppgadmin.inc*;
    include     /etc/nginx/conf.d/webmail.inc*;

    include     %home%/%user%/conf/web/nginx.%domain%.conf*;
}
