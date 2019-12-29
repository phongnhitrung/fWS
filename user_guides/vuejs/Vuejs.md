# Vuejs App

## 1. Create Vuejs config template for VestaCP (Nginx)
Thực hiện tương tự như đối với meanstack (sử dụng proxy_pass để forward đến Vuejs từ nginx)

```nginx
server {
    listen      %web_port%;
    server_name %domain_idn% %alias_idn%;
    root        %docroot%;
    index       index.php index.html index.htm;
    access_log  /var/log/nginx/domains/%domain%.log combined;
    access_log  /var/log/nginx/domains/%domain%.bytes bytes;
    error_log   /var/log/nginx/domains/%domain%.error.log error;

    proxy_next_upstream error timeout invalid_header http_500 http_502 http_503 http_504;
    proxy_redirect          off;

    proxy_set_header X-Forwarded-Host $host;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-Proto $scheme;
    proxy_set_header X-Real-IP $remote_addr;

    proxy_connect_timeout   720;
    proxy_send_timeout      720;
    proxy_read_timeout      720;
    send_timeout            720;

    # Allow "Well-Known URIs" as per RFC 5785
    location ~* ^/.well-known/ {
        allow all;
    }

    location / {
        proxy_pass http://127.0.0.1:3000;
server {
    listen      %web_port%;
    server_name %domain_idn% %alias_idn%;
    root        %docroot%;
    index       index.php index.html index.htm;
    access_log  /var/log/nginx/domains/%domain%.log combined;
    access_log  /var/log/nginx/domains/%domain%.bytes bytes;
    error_log   /var/log/nginx/domains/%domain%.error.log error;

    proxy_next_upstream error timeout invalid_header http_500 http_502 http_503 http_504;
    proxy_redirect          off;

    proxy_set_header X-Forwarded-Host $host;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-Proto $scheme;
    proxy_set_header X-Real-IP $remote_addr;

    proxy_connect_timeout   720;
    proxy_send_timeout      720;
    proxy_read_timeout      720;
    send_timeout            720;

    # Allow "Well-Known URIs" as per RFC 5785
    location ~* ^/.well-known/ {
        allow all;
    }

    location / {
        # Địa chỉ listen port của Vuejs
        proxy_pass http://127.0.0.1:3000;
    }

    error_page  403 /error/404.html;
    error_page  404 /error/404.html;
    error_page  500 502 503 504 /error/50x.html;

    location /error/ {
        alias   %home%/%user%/web/%domain%/document_errors/;
    }

    location ~* "/\.(htaccess|htpasswd)$" {
        deny    all;
        return  404;
    }

    location /vstats/ {
        alias   %home%/%user%/web/%domain%/stats/;
        include %home%/%user%/conf/web/%domain%.auth*;
    }

    include     /etc/nginx/conf.d/phpmyadmin.inc*;
    include     /etc/nginx/conf.d/phppgadmin.inc*;
    include     /etc/nginx/conf.d/webmail.inc*;

    include     %home%/%user%/conf/web/nginx.%domain%.conf*;
}
```

## 2. Test With Vuejs Project

```bash
#Git clone Vuejs project
git clone https://github.com/instrumentisto/vue-app-example.git
cd vue-app-example

#Build project
make deps
make build
docker-compose build
docker-compose up

# Tạo domain vuejs.com trên VestCP sử dụng vuejs template:
# ADD: <IP> meanserver.com vào hosts file
# Truy cập đến domain meanserver trên trình duyệt
```

## 3. Thêm Domain using Vuejs template trên VestaCP

Thực hiện tương tự như đối với Django hay mean stack
[Meanstack_Guide](https://github.com/octvitasut/fWS/blob/master/user_guides/mean_stack/MeanStack_User_Guide.md)