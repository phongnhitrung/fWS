# VestaCP
VestaCP là một Bảng điều khiển (Control Panel) rất chuyên nghiệp, dễ sử dụng với giao diện trực quan, đặc biệt hỗ trợ tối ưu cho các mã nguồn mở như WordPress. Đây là công cụ quản trị Web Hosting hoàn toàn miễn phí, tương thích trên các hệ điều hành như: RHEL/ CentOS, Ubuntu.

Quá trình cài đặt thực chất bạn chỉ tải và thực thi tập tin kịch bản (script) từ trang chủ VestaCP. Do đó, thao tác thực hiện hoàn toàn giống nhau trên các hệ điều hành như: RHEL/ CentOS, Ubuntu.

Để thực hiện cài đặt VestaCP trên máy chủ Cloud Server, bạn thực hiện như sau:

Đầu tiên, bạn SSH vào server và chạy lần lượt những lệnh sau:

```bash
curl -O http://vestacp.com/pub/vst-install.sh
bash vst-install.sh --force
```

VestaCP sẽ liệt kê các thành phần sẽ được cài đặt, bạn nhập “y” và điền một số thông tin như email và FQDN (hostname của server)
![vestacp_image_install](https://github.com/octvitasut/fWS/blob/master/common/images/install_vestaCP.PNG)

Sau khi nhập các thông tin, quá trình cài đặt diễn ra. Sau khi cài đặt kết thúc, VestaCP sẽ cung cấp thông tin quản lý như hình:

![vesta_install_sucessfully](https://github.com/octvitasut/fWS/blob/master/common/images/vestacp_successful.PNG)

Trong đó, tài khoản admin là tài khoản có quyền cao nhất, bạn sẽ sử dụng nó để quản lý các tài khoản con khác nếu có hoặc có thể thêm website vào.

Bạn cũng có thể sử dụng tài khoản root/ssh để đăng nhập vào vestaCP.

Cuối cùng bạn hãy truy cập vào địa chỉ đăng nhập VestaCP là https://IP-của-bạn:8083 và dùng tài khoản admin đăng nhập vào. Lưu ý, nếu có thông báo cảnh báo HTTPS thì hãy bỏ qua nó.

![Portal_VestaCP](https://github.com/octvitasut/fWS/blob/master/common/images/portal_VestaCP.PNG)

