---
# __Hướng dẫn sử dụng VESTACP cho webhosting__
---

## __1. Đăng nhập__
Truy nhập vào link https://<địa chỉ IP của webhosting>:8083 để đăng nhập vào Portal VESTACP

Điền user+password được cấp để đăng nhập (user mặc định là admin được tạo tự động khi cài đặt VESTACP)

![Upload sourcecode](login_VTCP.png)

Sau khi login thành công hiện ra màn hình như dưới đây

![Upload sourcecode](login_success.png)

## __2. Thêm domain vào webhosting__
Trên Portal, chọn mục WEB => click vào nút "Add webdomain" để thêm domain

![Upload sourcecode](add_domain.png)

Trong màn hình tiếp theo, điền tên domain => click ADD để lưu lại

![Upload sourcecode](type_domain_name.png)

## __3. Tạo database cho domain__
Trên Portal, chọn mục DB => click vào nút "Add database" để tạo DB cho domain

![Upload sourcecode](add_user_db.png)

Trong màn hình tiếp, điền tên DB, username+password cho DB -> click Add để lưu lại

![Upload sourcecode](add_db.png)

## __4. Thêm chứng thư https cho domain__
Chọn website cần thêm chứng thư https => click Edit

![Upload sourcecode](edit_website.png)

Trong tab cấu hình website, tick chọn SSL Support => Paste nội dung của SSL certificate, SSL priavte key, SSL Intermediate CA vào các box tương ứng

![Upload sourcecode](ssl_config.png)

## __5. Upload source code cho website__
### __5.1. Đăng nhập FTP__
- Sử dụng FileZila Client để đăng nhập FTP

- Trong cửa sổ FileZila điền các thông tin sau:

  Host: sftp://<ip của server webhosting> (ví dụ: sftp://125.212.203.153)

  Username: là username sử dụng khi đăng nhập portal VestaCP (ví dụ: admin)

  Password: là password sử dụng khi đăng nhập portal VestaCP

  Port: 22

- Sau đó click Quickconnect

![Upload sourcecode](filezila_login.png)
### __5.2. Upload source code cho website__
Trong cửa sổ FileZila, upload sourcecode (html, js, images, css, php...) vào thư mục public_html

![Upload sourcecode](upload_sourcode.png)

++__Lưu ý__++: Với bản cài mặc định, VESTACP chỉ hỗ trợ các website có sourcecode PHP. Các website sử dụng sourcecode khác (python, java ...) tuy có thể upload sourcecode lên nhưng không hoạt động do VESTACP không tạo template cấu hình cho các sourcecode này

