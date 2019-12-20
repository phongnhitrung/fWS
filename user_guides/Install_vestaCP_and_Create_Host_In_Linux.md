
# Hướng dẫn cài đặt VestaCP để tạo host trên Cloud Server Linux

#### Giới thiệu

Vesta là một hosting control panel nguồn mở miễn phí có lẽ chưa được nhiều người biết tới. Vesta CP là sản phẩm của các lập trình viên đến từ Nga. Các bạn có thể tìm hiểu thêm thông tin về Vesta CP tại:

Trang chủ của Vesta CP: [http://vestacp.com/](http://vestacp.com/)

Diễn đàn người dùng Vesta CP: [http://forum.vestacp.com/](http://forum.vestacp.com/)

Hướng dẫn cài đặt và sử dụng: [http://vestacp.com/docs/](http://vestacp.com/docs/)

Ưu điểm lớn nhất của Vesta control panel là Vesta hỗ trợ cả Apache và Nginx. Nó dùng Apache như một Aplication webserver (xử lý PHP request) còn Nginx là frontend web  server (xử lý các file tĩnh) nhằm giảm tải cho Apache. Đây là mô hình mà nhiều website lớn hiện đang dùng.

Vesta hỗ trợ hầu hết các tính năng thiết yếu của webserver như FTP, Bind DNS, Exim mail, MySQL, phpMyAdmin, các công cụ backup tự động, Upgrade tự động, cronjob, bảo mật (email antivirus, antispam…)

![](https://wiki.matbao.support/wp-content/uploads/2018/06/2018-06-10_105434.png)

### Hướng dẫn cài đặt VestaCP

Để cài đặt VestaCP, bạn chạy lệnh sau:
```bash
curl -O http://vestacp.com/pub/vst-install.sh

bash vst-install.sh
```
VestaCP sẽ liệt kê các thành phần sẽ được cài đặt, bạn nhập “y” và điền một số thông tin như email và FQDN

![](https://github.com/octvitasut/fWS/blob/master/common/images/install_vestaCP.PNG)

Sau khi nhập các thông tin, quá trình cài đặt diễn ra. Sau khi cài đặt kết thúc, VestaCP sẽ cung cấp thông tin quản lý như hình

![](https://github.com/octvitasut/fWS/blob/master/common/images/vestacp_successful.PNG)

Trong đó, tài khoản admin là tài khoản có quyền cao nhất, bạn sẽ sử dụng nó để quản lý các tài khoản con khác nếu có hoặc có thể thêm website vào.

Bây giờ hãy truy cập vào địa chỉ đăng nhập VestaCP là https://IP-của-bạn:8083 và dùng tài khoản admin đăng nhập vào. Lưu ý, nếu có thông báo cảnh báo HTTPS thì hãy bỏ qua nó

### Tạo người dùng mới trong VestaCP

Mặc định khi cài xong thì bạn sẽ có tài khoản admin để quản trị website và các thiết lập trong VestaCP. Nhưng nếu bạn cần tạo một tài khoản khác cấp nhỏ hơn chỉ để quản lý website thì có thể tạo ra. Cách tạo là bạn hãy truy cập vào phần User và ấn vào nút tạo

![add_user](https://github.com/octvitasut/fWS/blob/master/common/images/add_user.PNG)

Nhập thông tin user cần khởi tạo

![](https://github.com/octvitasut/fWS/blob/master/common/images/user_info.PNG)

Và tất cả mọi người dùng đều sẽ đăng nhập qua địa chỉ https://<YOUR-IP>:8083 hoặc có thể đăng nhập vào với giao thức FTP

### Thêm website vào VestaCP

Trước tiên là đăng nhập vào VestaCP với tài khoản mà bạn cần thêm website. Sau đó vào phần Web và ấn nút thêm

![](https://github.com/octvitasut/fWS/blob/master/common/images/add_domain.PNG)

Sau khi nhập domain website, Và sau đó, các bạn trỏ tên miền của website vừa thêm về địa chỉ IP của máy chủ là có thể hoạt động

### Trỏ tên miền về VestaCP

Nếu bạn sử dụng tên miền tại Mắt Bão, bạn có thể đăng nhập vào trang quản trị dịch vụ  [https://id.matbao.net](https://id.matbao.net/)

Chọn thẻ tên miền và chọn tên miền cần trỏ về VestaCP

![](https://wiki.matbao.support/wp-content/uploads/2018/06/Screenshot_73.png)

Tạo bản ghi A và trỏ về địa chỉ IP của máy chủ VestaCP

![](https://wiki.matbao.support/wp-content/uploads/2018/06/Screenshot_74.png)

Sau đó thử kiểm tra lại

![](https://wiki.matbao.support/wp-content/uploads/2018/06/Screenshot_75.png)

### Sử dụng FTP

Khi tạo ra người dùng, thì bạn có thể đăng nhập vào FTP thông qua chính thông tin người dùng đó, cụ thể bạn có thể đăng nhập với thông tin như sau:

-   FTP Hostname: Địa chỉ IP hoặc domain đã trỏ về hoặc hostname
-   FTP Username: tên người dùng
-   Password: mật khẩu người dùng
-   Port: 21

Khi vào đó, bạn truy cập vào thư mục web/ sẽ thấy thư mục của tất cả các domain đã thêm vào người dùng đó.

Ở đây mình sử dụng phần mềm FileZilla để kết nối FTP

![](https://wiki.matbao.support/wp-content/uploads/2018/06/Screenshot_76.png)

### Lời kết

Như vậy chỉ với vài thao tác đơn giản, chúng ta đã có thể cài đặt VestaCP và chia host trên VestaCP. Chúc các bạn thành công