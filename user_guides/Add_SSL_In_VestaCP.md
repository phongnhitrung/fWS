# Add SSL vào domain trên VestaCP

Để cài đặt chứng chỉ SSL trên VestaCP,ta thực hiện như sau:

Đầu tiên, ta đăng nhập vào trang quản trị VestaCP bằng user có website cần cài đặt chứng chỉ SSL bởi đường dẫn: https://IP-của-bạn:8083

Tiếp theo, ta nhấp chọn vào mục WEB, chọn tên miền website cần cài đặt và nhấp chon Edit

![Domain_vestacp](https://github.com/octvitasut/fWS/blob/master/common/images/edit_domain.png)

Trong giao diện thiết lập cấu hình, check vào tùy chọn SSL Support, sau đó copy và dán chính xác nội dung file CRT, Private Key và CA lần lượt vào 3 ô trống SSL Certificate / Generate CSR, SSL Key, SSL Certificate Authority / Intermediate tương ứng.

![SSL_VestaCP](https://github.com/octvitasut/fWS/blob/master/common/images/add_ssl.PNG)

