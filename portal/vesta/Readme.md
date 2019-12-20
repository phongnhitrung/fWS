# Install Error

Khi gặp lỗi php-fpm failed to start thì nguyên nhân là không có file /etc/init.d/php-fpm dẫn đến khởi động bị lỗi

Vào script vst-install-ubuntu.sh thực hiện comment được code thực hiện restart php-fpm

```bash
#----------------------------------------------------------#
#                     Configure PHP-FPM                    #
#----------------------------------------------------------#
## Script run php FIXME
#if [ "$phpfpm" = 'yes' ]; then
#    pool=$(find /etc/php* -type d \( -name "pool.d" -o -name "*fpm.d" \))
#    cp -f $vestacp/php-fpm/www.conf $pool/
#    php_fpm=$(ls /etc/init.d/php*-fpm* |cut -f 4 -d /)
#    echo "***************************** php_fpm = $php_fpm"
#    ln -s /etc/init.d/$php_fpm /etc/init.d/php-fpm > /dev/null 2>&1
#    update-rc.d $php_fpm defaults
#    service $php_fpm start
#    check_result $? "php-fpm start failed"
#fi

```

Nếu gặp lỗi thiếu file thư viện sqlite3.so của php thì thực hiện install lib

```bash
sudo apt install php7.2-sqlite3
```