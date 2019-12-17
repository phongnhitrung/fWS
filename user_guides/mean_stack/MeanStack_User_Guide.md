

# MEAN STACK

## 1. Cài đặt  mean stack
> ```bash
> # Cài đặt các gói independences
> apt-get install build-essential git fontconfig libpng-dev ruby ruby-dev
> gem install sass

> # Cài đặt MongoDB
> apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv 0C49F3730359A14518585931BC711F9BA15703C6
> echo "deb [ arch=amd64,arm64 ] http://repo.mongodb.org/apt/ubuntu xenial/mongodb-org/3.4 multiverse" | tee /etc/apt/sources.list.d/mongodb-org-3.4.list
> sudo apt-get update
> apt-get install mongodb-org
> 
> #Start MongoDB
> systemctl start mongod
> systemctl enable mongod
> 
> ## Cài đặt NodeJS phiên bản 10.x and NPM
> 
> curl -sL https://deb.nodesource.com/setup_10.x | sudo -E bash -
> apt-get install nodejs
> 
> ## Cài đặt Yarn and Gulp
> npm install -g yarn
> npm install -g gulp
> 
> ## Download and Install MEAN from GIT
> git clone https://github.com/meanjs/mean.git
> cd mean
> sudo npm install
> yarn install --allow-root
>
>```

## 2. Tạo config template (Nginx) cho Mean stack (chỉ tạo một lần duy nhất)

> ```nginx
> # File template in folder /usr/local/vesta/templates/nginx/php-fpm/mean_stack.tpl (or mean_stack.stpl cho ssl port)
> server {
>     listen      %web_port%;
>     server_name %domain_idn% %alias_idn%;
>     root        %docroot%;
>     index       index.php index.html index.htm;
>     access_log  /var/log/nginx/domains/%domain%.log combined;
>     access_log  /var/log/nginx/domains/%domain%.bytes bytes;
>     error_log   /var/log/nginx/domains/%domain%.error.log error;
> 
>     proxy_next_upstream error timeout invalid_header http_500 http_502 http_503 http_504;
>     proxy_redirect          off;
> 
>     proxy_set_header X-Forwarded-Host $host;
>     proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
>     proxy_set_header X-Forwarded-Proto $scheme;
>     proxy_set_header X-Real-IP $remote_addr;
> 
>     proxy_connect_timeout   720;
>     proxy_send_timeout      720;
>     proxy_read_timeout      720;
>     send_timeout            720;
> 
>     # Allow "Well-Known URIs" as per RFC 5785
>     location ~* ^/.well-known/ {
>         allow all;
>     }
> 
>     location / {
>         # Địa chỉ listen của Mean stack
>         proxy_pass http://127.0.0.1:4200;
>     }
> 
>     error_page  403 /error/404.html;
>     error_page  404 /error/404.html;
>     error_page  500 502 503 504 /error/50x.html;
> 
>     location /error/ {
>         alias   %home%/%user%/web/%domain%/document_errors/;
>     }
> 
>     location ~* "/\.(htaccess|htpasswd)$" {
>         deny    all;
>         return  404;
>     }
> 
>     location /vstats/ {
>         alias   %home%/%user%/web/%domain%/stats/;
>         include %home%/%user%/conf/web/%domain%.auth*;
>     }
> 
>     include     /etc/nginx/conf.d/phpmyadmin.inc*;
>     include     /etc/nginx/conf.d/phppgadmin.inc*;
>     include     /etc/nginx/conf.d/webmail.inc*;
> 
>     include     %home%/%user%/conf/web/nginx.%domain%.conf*;
> }
> ```


## 3. Thêm Domain using Mean template trên VestaCP

- **Add domain**

Trên Portal, chọn mục WEB => click vào nút "Add webdomain" để thêm domain

Trong màn hình tiếp theo, điền tên domain => click ADD để lưu lại
![Add Domain 1](https://github.com/octvitasut/fWS/blob/master/user_guides/django/common/images/docker_django/add_domain.PNG "Add Domain ")

- **Sửa đổi template cấu hình của domain sang mean_stack template**

Lựa chọn website vừa tạo, chọn Edit để chỉnh cấu hình cho website
![Edit domain](https://github.com/octvitasut/fWS/blob/master/user_guides/django/common/images/docker_django/edit_domain1.PNG)

Trong mục Web Template: Chọn neam_stack để tạo template config 
![Edit template](https://github.com/octvitasut/fWS/blob/master/user_guides/django/common/images/docker_django/edit_domain2.PNG)

Trong tab cấu hình website, tick chọn SSL Support => Paste nội dung của SSL certificate, SSL priavte key, SSL Intermediate CA vào các box tương ứng

![SSL add](https://github.com/octvitasut/fWS/blob/master/user_guides/django/common/images/docker_django/ssl_add.PNG)


## 4. Download source code mean stack

> ```bash
> # Clone Project mean stack
> git clone https://github.com/DavideViolante/Angular-Full-Stack.git
> cd Angular-Full-Stack
> 
> # Build Project 
> 1.  Install Angular CLI:  `npm i -g @angular/cli`
> 2. Install all independes: `npm i`
> 
> # Start server với port 4200 (sử dụng disableHostCheck để tránh lỗi invalid Host)
> ng serve  --port 4200 --host 0.0.0.0 --disableHostCheck true
> 
> 
> ```

