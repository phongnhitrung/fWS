
# Hướng dẫn quản trị hosting cơ bản trên VestaCP

## 1. Tạo User mới và xóa User trong VestaCP
Tạo User mới
Mặc định khi cài xong thì Quý khách sẽ có tài khoản admin để quản trị website và các thiết lập trong VestaCP. Nếu Quý khách cần tạo một tài khoản khác cấp nhỏ hơn chỉ để quản lý website thì có thể tạo bằng cách truy cập vào phần USER và ấn vào nút tạo.

![add_user](https://github.com/octvitasut/fWS/blob/master/common/images/add_user.PNG)

Sau đó, hãy nhập thông tin User cần tạo.

![user_info](https://github.com/octvitasut/fWS/blob/master/common/images/user_info.PNG)

Và tất cả mọi người dùng đều phải đăng nhập qua địa chỉ https://IP:8083 hoặc có thể đăng nhập với giao thức FTP.

#### Xóa User

Di chuyển chuột vào tên User cần xóa, ở bên phải màn hình sẽ hiện ra thanh quản lý tài khoản. Chọn nút “**Delete**”, nó sẽ hỏi Quý khách xác nhận xóa tài khoản hay không. Chọn “**Yes**” để xóa. _**Lưu ý: Tất cả những dữ liệu trên tài khoản sẽ bị xóa vĩnh viễn.**_  

![del_user](https://github.com/octvitasut/fWS/blob/master/common/images/del_user.PNG)

### 2. Tạo và xóa Domain

#### Tạo Domain

Muốn tạo domain, Quý khách hãy vào phần  **WEB**  và nhấn nút tạo.
![add_domain](add_domain.PNG)
Sau đó, Quý khách hãy nhập thông tin domain cần tạo, bao gồm tên domain và địa chỉ IP của server hosting _(Địa chỉ IP này đã được điền sẵn trước)._

![domain_info](https://github.com/octvitasut/fWS/blob/master/common/images/domain_info.PNG)

Trong mục **Advanced Options**, khi nhấn vào đó, nó sẽ cho Quý khách thêm sự lựa chọn để cấu hình cho website của Quý khách:  
**Aliases**: thêm domain, subdomain chạy chung với source trang web này.  
**Web Templates**:  
– **default**: Phù hợp với hầu hết website, không cần cấu hình thêm.  
– **basedir**: Dùng để chống shell trên website bằng cách giới hạn thư mục thực thi PHP với open_basedir. Chỉ dùng khi cần thiết.  
– **hosting**: Giới hạn tài nguyên để thực thi PHP trên mỗi domain, ví dụ như giới hạn bộ nhớ, dung lượng được phép upload,…  
– **phpcgi**: Chạy PHP trong Apache bằng CGI thay vì nhúng vô Apache với mod_php thông thường.  
– **phpfcgid**: Chạy PHP trong Apache bằng FastCGI.


**Proxy Support**: Hỗ trợ phần mở rộng của các file tĩnh. Các mục trong Proxy Template:  
– **default**: NGINX lưu cache cho các dữ liệu tĩnh.  
– **hosting**: Chặn truy cập các đường dẫn tượng trưng (symbolic link).  
– **сaching**: NGINX sẽ lưu cache toàn bộ trang trên website 15 phút một lần. Chỉ nên dùng khi website đang bị quá tải.  
– **php-fpm**: Cho NGINX làm backend và chạy PHP với PHP-FPM.  
**SSL  Support**: Hỗ trợ giao thức HTTPS.

**Web Statistics**: Thống kê website. Web Statistics Vesta tích hợp sẵn hai công cụ miễn phí là Webalizer và Awstats. Quý khách có thể lựa chọn một trong hai hoặc không sử dụng cũng không sao.  
**Statistics Authorization**: Quyền đăng nhập để xem thống kê website.

![web_statistic](web_statistic.PNG)

**Additional FTP**: Cấu hình tài khoản để truyền file, nếu Quý khách muốn chia sẻ web này cho người khác nhưng không muốn chia sẻ quyền admin của Control Panel, Quý khách nên tạo thêm một tài khoản này. Nếu không, Quý khách có thể sử dụng luôn tài khoản của VestaCP.

![ftp](https://github.com/octvitasut/fWS/blob/master/common/images/ftp.PNG)

#### Xóa Domain

Di chuyển chuột vào Website cần xóa, ở bên phải màn hình, sẽ hiện ra thanh quản lý Website. Chọn nút “**Delete**”, nó sẽ hỏi Quý khách xác nhận xóa Website hay không. Chọn “**Yes**” để xóa. _**Lưu ý: Tất cả những dữ liệu trên website sẽ bị xóa vĩnh viễn.**_  

![del_domain](https://github.com/octvitasut/fWS/blob/master/common/images/del_domain.PNG)

### 3. Tạo database và truy cập phpMyAdmin

#### Tạo database

Muốn tạo database, Quý khách hãy vào phần  **DATABASE**  và nhấn nút tạo.

![add_db](https://github.com/octvitasut/fWS/blob/master/common/images/add_db.PNG)

Sau đó, Quý khách nhập thông tin database cần tạo, rồi nhấn nút “**Add**”. Trong đó Charset thường để mặc định là “utf8”.

![db_info](https://github.com/octvitasut/fWS/blob/master/common/images/db_info.PNG)

#### Truy cập vào phpMyAdmin

Để truy cập vào  **phpMyAdmin**, trong phần  **DATABASE**  vừa tạo, Quý khách hãy nhấn vào  **phpMyAdmin**.

![phpmyadmin](https://github.com/octvitasut/fWS/blob/master/common/images/phpmyadmin.PNG)

Sau đó, nó sẽ chuyển sang một tab mới với giao diện đăng nhập **phpMyAdmin**. Quý khách hãy điền thông tin User và Password đã tạo trước đó.

![phpmyadmin_portal](https://github.com/octvitasut/fWS/blob/master/common/images/phpmyadmin_portal.PNG)

### 4. Tính năng Backup trong VestaCP

Một trong những điểm mạnh của VestaCP là tự động backup hàng ngày. Quý khách có thể download, xóa, phục hồi file backup theo nhu cầu của Quý khách.

![backup](https://github.com/octvitasut/fWS/blob/master/common/images/backup.PNG)

Hoặc Quý khách có thể phục hồi từng phần bằng cách chọn **Configure Restore Settings**. Chọn mục cần phục hồi, rồi nhấn vào nút “**Restore**”. Khi hoàn thành việc phục hồi, hệ thống gửi mail thông báo cho Quý khách xác nhận đã phục hồi.

![restore](https://github.com/octvitasut/fWS/blob/master/common/images/restore.PNG)

### 5. Quản lý dữ liệu với File Manager

Khi Quý khách mua bản quyền license, lúc này ở trên thanh quản lý VestaCP, đã xuất hiện tính năng File Manager. Nhấn vào đó, hệ thống sẽ chuyển qua giao diện File Manager gồm 2 cửa sổ. Giao diện này rất dễ quản lý, Quý khách có thể tạo file, folder, download, đổi tên, giải nén, nén file… một cách dễ dàng.

### 6. Tạo Mail và truy cập vào Web Mail

#### Tạo Mail

Khi thêm domain vào, Quý khách nhớ đánh dấu vào mục “**Email Support**” để có thể dùng email riêng theo domain đó. Sau đó Quý khách vào mục “**MAIL**” và bấm “**Add Account**” để thêm một địa chỉ email mới. _**Lưu ý: Mục DKIM Support phải là “Yes”**_.  

![add_mail](https://github.com/octvitasut/fWS/blob/master/common/images/add_mail.PNG)

Sau đó Quý khách nhập mail cần tạo và mật khẩu, rồi nhấn “**Add**”.

![mail_info](https://github.com/octvitasut/fWS/blob/master/common/images/mail_info.PNG)

Trong mục **Advanced Options**:  
**Quota**: Giới hạn dung lượng của mail cần gửi (tính bằng MB). Muốn không giới hạn dung lượng, chọn nút Unlimited ∞.  
**Aliases**: Mail phụ dùng chung với mail chính.  
**Forward to**: Mail được gửi đi sẽ gửi một bản sao tới mail được Forward.  
**Do not store forwarded mail**: Không lưu mail Forward.

![mail_advan](https://github.com/octvitasut/fWS/blob/master/common/images/mail_advan.PNG)

#### Truy cập vào Web Mail

Bây giờ Quý khách đã có một tài khoản email, Quý khách vào trang https://IP/webmail để đăng nhập và quản lý. Hoặc Quý khách có thể truy cập Webmail bằng cách nhấn vào “**Open Webmail**” trong mục “**MAIL**”.









