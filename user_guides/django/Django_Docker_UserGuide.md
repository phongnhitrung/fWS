
# Django With Docker

## 1. Cài đặt  Docker-Engine
```bash
# Get the new GPG key

sudo apt-key adv --keyserver hkp://p80.pool.sks-keyservers.net:80 --recv-keys 58118E89F3A912897C070ADBF76221572C52609D

# Add source list

echo “deb https://apt.dockerproject.org/repo ubuntu-xenial main” >> /etc/apt/sources.list.d/docker.list

# Cài đặt docker

sudo apt-get update –y

sudo apt-get install docker-engine –y

# Start docker

sudo service docker start

# Cài đặt Docker compose
sudo curl -L  "https://github.com/docker/compose/releases/download/1.25.0/docker-compose-$(uname -s)-$(uname -m)"  -o /usr/local/bin/docker-compose

sudo `chmod +x /usr/local/bin/docker-compose`
```

## 2. Tạo một Django Project

- **Tạo Project Folder:**
Yêu cầu thư mục project sẽ phải nằm trong trong thư mục được setting trong config template của VestaCP (hiện tại là /home/ubuntu/server_django/<domain_name>/)

> ```bash
> mkdir -p /home/ubunutu/server_django/django2.com
> cd /home/ubunutu/server_django/django2.com
> ```


- **Tạo file Dockerfile  với nội dung:**

> ```docker
> FROM python:3
> ENV PYTHONUNBUFFERED 1
> RUN mkdir /code
> WORKDIR /code
> COPY requirements.txt /code/
> RUN pip install -r requirements.txt
> COPY . /code/
> ```

- **Tạo file requirements.txt**

>
> Django>=2.0,<3.0
> psycopg2>=2.7,<3.0
> uwsgi>2.0


- **Tạo file docker-compose.yml để chạy docker-compose**

> ```yaml
> version: '3'
> services:
>  db:
>    image: postgres
>  web:
>    build: .
>    # Lệnh chạy server với uwsgi
>    command: uwsgi --ini mysite_uwsgi.ini --uid 0
>    volumes:
>      - .:/code
>    ports:
>      - "8000:8000"
>    depends_on:
>      - db
>```

- **Khởi tạo một project trong docker**

> ```bash
> sudo docker-compose run web django-admin startproject composeexample 
> ```

- **Chỉnh sửa database trong composeexample/settings.py**

> ```python
> DATABASES = {
>     'default': {
>         'ENGINE': 'django.db.backends.postgresql',
>         'NAME': 'postgres',
>         'USER': 'postgres',
>         'HOST': 'db',
>         'PORT': 5432,
>     }
> }
> ```


- **Cấu hình uwsgi để cho docker**

Trong thư mục project django2.com, tạo một file **mysite_uwsgi.ini** để chứa cấu hình cho wsgi gồm:

> ```ini
> # mysite_uwsgi.ini file
> [uwsgi]
>
> # Django application full path
> chdir           = ./composeexample
> # Django's wsgi file
> module          = composeexample.wsgi:application
> uid = root
> # the virtualenv (full path): Chưa rõ là gì
> #home            = /path/to/virtualenv
> 
> # process-related settings
> # master
> master          = true
> # maximum number of worker processes
> processes       = 10
> # unix socket để giao tiếp fws_core
> # unix socker có tên là test.sock và được đặt cố định trong đường dẫn tương tự cấu hình trong template của nginx là: /home/ubuntu/server_django/<domain_name>/
> socket          = ../test.sock
> # set permission cho socket có thể giao tiếp
> chmod-socket    = 666
> # clear environment on exit
> vacuum          = true
> ```


##  3. Tạo Template cho Django-Docker 


> ```nginx
> # File template in folder /usr/local/vesta/templates/nginx/php-fpm/django-docker.tpl (or django-docker.stpl cho ssl port)
> upstream %domain%_%web_port%_django {
>     server unix:///home/ubuntu/server_django/%domain%/test.sock; # for a file socket
>     #server 125.212.203.153:8001; # for a web port socket (we'll use this first)
> }
> 
> 
> server {
>     listen      %web_port%;
>     server_name %domain_idn% %alias_idn%;
>     root        %docroot%;
>     index       index.php index.html index.htm;
>     access_log  /var/log/nginx/domains/%domain%.log combined;
>     access_log  /var/log/nginx/domains/%domain%.bytes bytes;
>     error_log   /var/log/nginx/domains/%domain%.error.log error;
> 
>     location / {
>         #return 404;
>         uwsgi_pass  django;
>         #uwsgi_pass unix:/home/ubuntu/django_web/test.sock;
>         include     /etc/nginx/uwsgi_params; # the uwsgi_params file you installed
>     }
>      # Django media
>     location /media  {
>         alias /home/ubuntu/django_web/media;  # your Django project's media files - amend as required
>     }
> 
>     location /static {
>         alias /home/ubuntu/django_web/media; # your Django project's static files - amend as required
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
>    # location ~* "/\.(htaccess|htpasswd)$" {
>    #     deny    all;
>    #     return  404;
>    # }
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
> 
> ```  

##  4. Thêm domain sử dụng Django template config giúp giao tiếp với Django application


Trên Portal, chọn mục WEB => click vào nút "Add webdomain" để thêm domain

Trong màn hình tiếp theo, điền tên domain => click ADD để lưu lại
![Add Domain 1](https://github.com/octvitasut/fWS/blob/master/common/images/docker_django/add_domain.PNG "Add Domain ")

Lựa chọn website vừa tạo, chọn Edit để chỉnh cấu hình cho website
![Edit domain](https://github.com/octvitasut/fWS/blob/master/common/images/docker_django/edit_domain1.PNG)

Trong mục Web Template: Chọn django-docker để tạo template config 
![Edit template](https://github.com/octvitasut/fWS/blob/master/common/images/docker_django/edit_domain2.PNG)


Trong tab cấu hình website, tick chọn SSL Support => Paste nội dung của SSL certificate, SSL priavte key, SSL Intermediate CA vào các box tương ứng

![SSL add](https://github.com/octvitasut/fWS/blob/master/common/images/docker_django/ssl_add.PNG)



