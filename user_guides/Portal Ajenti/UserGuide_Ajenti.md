
# Ajenti Guide with fws

## 1. Install Ajenti

```bash
# Install Ajenti core
wget http://repo.ajenti.org/debian/key -O- | sudo apt-key add -
echo "deb http://repo.ajenti.org/ng/debian main main ubuntu" | sudo tee -a /etc/apt/sources.list
sudo apt-get update && sudo apt-get install ajenti

# Install Ajenti-V Plugin support nginx
apt-get remove apache2
apt-get install ajenti-v ajenti-v-nginx ajenti-v-mysql ajenti-v-php7.0-fpm php7.0-mysql

# Run Ajenti-Panel
ajenti-panel -d

# Portal Ajenti-Panel
http://<IP>:8000
Default account: root/admin
```

## 2. Tạo domain trên Ajenti

Truy cập Portal Ajenti vào mục Web -> Website (chỉ xuất hiện sau khi cài xong plugin Ajenti-V)
![Website](https://github.com/octvitasut/fWS/blob/master/common/ajenti/portal_ajenti.PNG)

Trên giao diện Web của Ajenti, nhập tên domain và ấn create Create để tạo mới domain cho Nginx

![Add_Domain](https://github.com/octvitasut/fWS/blob/master/common/ajenti/add_domain.PNG)

Với mỗi lần tạo một domain, 1 file config của domain cho nginx sẽ được khởi tạo tại đường dẫn `/etc/nginx/conf.d`

Để thay đổi thông số setting config của domain, ấn Manager

![Manager_Domain](https://github.com/octvitasut/fWS/blob/master/common/ajenti/manager_domain.PNG)

- Cấu hình listen ip:port
![IP_Setting](https://github.com/octvitasut/fWS/blob/master/common/ajenti/listen_ip.PNG)

- Cấu hình SSL
![SSL](https://github.com/octvitasut/fWS/blob/master/common/ajenti/ssl_setting.PNG)

- Cấu hình proxy_pass
Vào mục Content, chọn revert_proxy
![Proxy](https://github.com/octvitasut/fWS/blob/master/common/ajenti/proxy.PNG)

- Cấu hình PHP
Vào mục Content, chọn php7.0-FastCGI

![php](https://github.com/octvitasut/fWS/blob/master/common/ajenti/php_setting.PNG)

## 3. Restart command fws_core

```python
# Thực hiện sửa code để thực hiện restart fws_core khi build config
# File /var/lib/ajenti/plugins/vh-nginx/nginx.py
@plugin
class  NGINXRestartable (Restartable):
    def  restart(self):
        s = ServiceMultiplexor.get().get_one('nginx')
        if  not s.running:
            s.start()
        else:
            s.command('reload')
# Restart fws_core
        restart_command = 'pidof fws_core | xargs kill -1'
        check_running_command = 'pidof fws_core'
        run_command = 'fws'
        try:
            result = subprocess.check_output(['pidof', 'fws_core'])
            # Process is running
            os.system(restart_command)
        except subprocess.CalledProcessError as e:
            # No process running => Start process
            os.system(run_command)
```
