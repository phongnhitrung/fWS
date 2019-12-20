
# Hướng dẫn cài đặt PHP Selector trên VestaCP

Để cài đặt php-selector sử dụng nhiều phiên bản PHP cho VestaCP. bạn cần đăng nhập vào  [server](https://www.matbao.net/cloud-server-linux.html?utm_source=matbao&utm_medium=wiki-post&utm_campaign=mb-wiki "server")  với quyền root

Thực hiện lệnh sau:
```bash 
yum install git
cd /tmp/
git clone https://github.com/Skamasle/sk-php-selector.git
cd sk-php-selector
chmod +x sk-php-selector2.sh
bash sk-php-selector2.sh php55 php56 php70 php71 php72
```
Quá trình cài đặt diễn ra

![](https://wiki.matbao.net/wp-content/uploads/2018/05/2018-06-15_215516-e1530332693596.png)

Sau khi cài đặt hoàn tất, bạn đăng nhập vào VestaCP, chọn WEB

![](https://wiki.matbao.net/wp-content/uploads/2018/05/2018-06-15_215627-e1530332715701.png)

tại phần Web Template HTTPD chọn phiên bản php cần sử dụng

![](https://wiki.matbao.net/wp-content/uploads/2018/05/2018-06-15_215745-e1530332744684.png)

Sau khi điều chỉnh thông số bạn chọn save để lưu cấu hình và kiểm tra lại. Chúc bạn thành công.