
<![endif]-->

# Django With Docker

## Install Docker-Engine
```bash
#Get the new GPG key

sudo apt-key adv --keyserver hkp://p80.pool.sks-keyservers.net:80 --recv-keys 58118E89F3A912897C070ADBF76221572C52609D

# Add source list

echo “deb https://apt.dockerproject.org/repo ubuntu-xenial main” >> /etc/apt/sources.list.d/docker.list

#install docker

sudo apt-get update –y

sudo apt-get install docker-engine –y

# Start docker

sudo service docker start

sudo curl -L  "https://github.com/docker/compose/releases/download/1.25.0/docker-compose-$(uname -s)-$(uname -m)"  -o /usr/local/bin/docker-compose

sudo `chmod +x /usr/local/bin/docker-compose`

## Create Django Project

# Tạo Project Folder:

mkdir <folder_name>

cd <folder_name>
```
## Tạo file Dockerfile  với nội dung:
```docker
FROM python:3
ENV PYTHONUNBUFFERED 1
RUN mkdir /code
WORKDIR /code
COPY requirements.txt /code/
RUN pip install -r requirements.txt
COPY . /code/
```

## Create requirements.txt

```
Django>=2.0,<3.0
psycopg2>=2.7,<3.0
```

## Create docker-compose.yml

```yaml
version: '3'
services:
  db:
    image: postgres
  web:
    build: .
    command: python manage.py runserver 0.0.0.0:8000
    volumes:
      - .:/code
    ports:
      - "8000:8000"
    depends_on:
      - db
```
## Tao Project Django trong Docker

```bash
sudo docker-compose run web django-admin startproject composeexample 
```
## Chỉnh sửa database trong composeexample/settings.py

```python
DATABASES = {
    'default': {
        'ENGINE': 'django.db.backends.postgresql',
        'NAME': 'postgres',
        'USER': 'postgres',
        'HOST': 'db',
        'PORT': 5432,
    }
}
```
##  Nễu lỗi khi khởi động:

```bash
cd composeexample
cp ../Dockerfile .
cp ../requirement.txt .
cp ../docker-compose.yml .
```
## Chạy server:
```bash
docker-compose up
```
## Sử dụng uwsgi để giao tiếp với fWS

Mô hình:

fws_core sẽ thực hiện giao tiếp với Django application thông qua WSGI

###  Thêm domain sử dụng Django template config giúp giao tiếp với Django application


Trên Portal, chọn mục WEB => click vào nút "Add webdomain" để thêm domain

Trong màn hình tiếp theo, điền tên domain => click ADD để lưu lại
![Add Domain 1](https://github.com/octvitasut/fWS/blob/master/common/images/docker_django/add_domain.PNG "Add Domain ")

Lựa chọn website vừa tạo, chọn Edit để chỉnh cấu hình cho website
![Edit domain](https://github.com/octvitasut/fWS/blob/master/common/images/docker_django/edit_domain1.PNG)

Trong mục Web Template: Chọn django-docker để tạo template config 
![Edit template](https://github.com/octvitasut/fWS/blob/master/common/images/docker_django/edit_domain2.PNG)

Trong tab cấu hình website, tick chọn SSL Support => Paste nội dung của SSL certificate, SSL priavte key, SSL Intermediate CA vào các box tương ứng
![SSL add](https://github.com/octvitasut/fWS/blob/master/common/images/docker_django/ssl_add.PNG)

Cấu hình  uwsgi Django-Docker:

Trong thư mục django-docker, tạo một file **mysite_uwsgi.ini** để chứa cấu hình cho wsgi gồm:
```ini
# mysite_uwsgi.ini file
[uwsgi]

# Django application full path
chdir           = /home/ubuntu/server_django/django1.com/composeexample
# Django's wsgi file
module          = composeexample.wsgi
uid = root
# the virtualenv (full path): Chưa rõ là gì
#home            = /path/to/virtualenv

# process-related settings
# master
master          = true
# maximum number of worker processes
processes       = 10
# unix socket để giao tiếp fws_core
socket          =/home/ubuntu/server_django/django1.com/test.sock
# set permission cho socket có thể giao tiếp
chmod-socket    = 666
# clear environment on exit
vacuum          = true
```

Cấu hình **docker-compose.yml** để chạy uwsgi:

```yaml
version: '3'
  
services:
  db:
    image: postgres
  web:
    build: .
    command: uwsgi --ini mysite_uwsgi.ini --uid 0
    volumes:
      - .:/code
    ports:
      - "8000:8000"
    depends_on:
      - db

```
