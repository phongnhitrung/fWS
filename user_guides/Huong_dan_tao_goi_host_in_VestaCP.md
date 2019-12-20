# Hướng dẫn tạo gói host trong VestaCP
Trong các control panel làm hosting  [server](https://www.matbao.net/cloud-server-linux.html?utm_source=matbao&utm_medium=wiki-post&utm_campaign=mb-wiki "server")  thì không thể nào không có chức năng tạo ra các gói host, và ở những gói này sẽ được chỉ định khi tạo thêm người dùng (_User_). Ví dụ trong mỗi gói host chúng ta có thể quy định số lượng tên miền mà người dùng được phép thêm vào, số lượng database, số lượng email, dung lượng ổ cứng và dĩ nhiên là dung lượng băng thông có thể sử dụng.

Trong VestaCP, phần gói host này được gọi là Package và ở bài này mình sẽ nói chi tiết về những thiết lập liên quan tới Package

## Những gói host mặc định

Mặc định khi  [cài VestaCP](https://vestacp.com/)  vào, họ đã cho chúng ta 4 gói host khác nhau, và gói mặc định cho tài khoản _admin_ là _default_. Bạn có thể xem danh sách các gói host có sẵn tại menu Packages trong trang quản trị.
Những gói này sẽ mang các thiết lập cho người dùng nào sử dụng gói đó.

Những gói nào không sử dụng bạn nên xóa đi, và hãy tạo ra gói host của riêng mình nhằm dễ quản lý hơn.

## Tạo một gói host mới

Trong phần Packages trên menu, bạn ấn vào nút dấu cộng màu xanh để bắt đầu tạo ra một gói host mới.

![Add_Package](https://github.com/octvitasut/fWS/blob/master/common/images/add_package.png)

Khi tạo gói, chúng ta sẽ có các thiết lập như sau:

![package_option](https://github.com/octvitasut/fWS/blob/master/common/images/package_option.PNG)

Các bạn xem qua giải thích về các thông số trước nhé, ở dưới mình sẽ nói bạn nên chọn các thông số như thế nào.

**Package Name**: Tên gói host cần tạo.

**Web Template**: Template thiết lập Apache. Lưu ý nếu khi tạo lệnh cài đặt bạn chọn là _NGINX + PHP-FPM_ thì nó sẽ có các template khác, mình sẽ nói phần này ở bài khác.

-   **default**: Không chứa các thiết lập tùy chọn.
-   **basedir**: Dùng để chống shell trên website bằng cách giới hạn thư mục thực thi PHP với  _open_dir_. Chỉ dùng khi cần thiết.
-   **hosting**: Giới hạn tài nguyên để thực thi PHP trên mỗi domain, ví dụ như giới hạn bộ nhớ, dung lượng được phép upload,…
-   **phpcgi**: Chạy PHP trong Apache bằng CGI thay vì nhúng vô Apache với  _mod_php_  thông thường.
-   **phpfcgid**: Chạy PHP trong Apache bằng FastCGI.

**Proxy Template**: Template chứa các thiết lập NGINX làm Reverse Proxy cho Apache.

-   **default**: NGINX lưu cache cho các dữ liệu tĩnh.
-   **hosting**: Chặn truy cập các đường dẫn tượng trưng (symbolic link).
-   **caching**: NGINX sẽ lưu cache toàn bộ trang trên website 15 phút một lần. Chỉ nên dùng khi website đang bị quá tải.
-   **php-fpm**: Cho NGINX làm backend và chạy PHP với PHP-FPM.

**DNS**: Các template thiết lập DNS của user.

-   **default**: Thiết lập DNS thông thường.
-   **gmail**: Thiết lập chứa các bản ghi để sử dụng Google App Business. Tuy nhiên không nên chọn cái này vì chúng ta có thể thêm các bản ghi của Google App vào sau cơ mà.
-   **child-ns**: Thiết lập bản ghi sử dụng Vanity Nameservers. Nghĩa là địa chỉ DNS tượng trưng.

**SSH Access**: Thiết lập cho phép truy cập vào máy chủ bằng giao thức SSH.

-   **sh**: Sử dụng /bin/sh
-   **bash**: Sử dụng /bin/bash
-   **nologin**: Sử dụng /sbin/nologin. Đại loại là không cho phép sử dụng SSH.

**Web Domains**: Số lượng domain được phép sử dụng.

**Web Aliases:** Số lượng domain biệt danh được phép sử dụng trên mỗi domain trong gói, hay còn gọi là một domain khác thay thế cho domain chính.

**DNS Domains**: Số lượng gói thiết lập DNS được phép sử dụng.

**DNS Records**: Số lượng bản ghi được phép vào trong mỗi gói DNS.

**Mail Domains**: Số lượng domain làm domain email được phép sử dụng.

**Mail Accounts**: Số lượng tài khoản email được phép sử dụng trên mỗi mail domain.

**Databases**: Số lượng database được phép tạo ra.

**Cron Jobs**: Số lượng cron jobs được phép tạo ra.

**Backups**: Số lượng bản lưu trữ được phép lưu trên hệ thống. Bản backup này là backup cho người dùng, toàn bộ người dùng sẽ được backup hàng ngày.

**Quota**: Dung lượng lưu trữ được phép sử dụng (tính bằng đơn vị MB).

**Bandwith**: Lưu lượng băng thông được phép sử dụng (tính bằng đơn vị MB).

**Nameservers**: Điền hai địa chỉ DNS của bạn đã tạo ra ở bài trước vào đây. Đây là thiết lập địa chỉ DNS cho người dùng sử dụng gói này.

## Thiết lập thông số gói thế nào

Về cơ bản các thiết lập ở trên không quá khó để hiểu nó. Tuy nhiên nếu bạn vẫn chưa hiểu thì mình gợi ý các bạn chọn thiết lập như sau để website hoạt động trơn tru mà không phải sửa lỗi quá nhiều.

**Web Template**

Phần này các bạn nên chọn là _default_ nếu các gói này bạn sử dụng với phạm vi cá nhân. Còn nếu bạn muốn bán gói host cho người khác thì nên chọn _hosting_ để tránh việc họ dùng quá nhiều tài nguyên của máy chủ bạn.

Còn nếu bạn đã có chút am hiểu về webserver rồi thì mình khuyến khích bạn chọn _phpcgi_. Nếu máy chủ của bạn có nhiều hơn 1GB RAM thì hãy chọn _phpfcgid_.

**Proxy Template**

Nếu ở phần Web Template bạn chọn là hosting thì phần này bạn nên chọn _default_. Tránh chọn _caching_ vì việc cho NGINX tự lưu cache toàn bộ trang chúng ta không thể kiểm soát được, và nếu người dùng không vào được SSH và có quyền sudo thì không thể xóa cache khi cần. Thiết lập default nó đã chứa thiết lập lưu cache cho các nội dung tĩnh như hình ảnh, CSS, Javascript, Font,…nên đã rất tốt rồi.

Tuy nhiên nếu bạn chạy một mã nguồn PHP tự viết, không có chức năng tạo và kiểm soát cache thì hãy chọn thiết lập _caching_ vì dù sao 15 phút NGINX sẽ tự làm sạch cache một lần.

Còn _php-fpm_ thì không nên chọn nhé vì chúng ta đã có Apache làm backend rồi. Tuy nhiên nếu ở bước cài đặt bạn chọn NGINX + PHP-FPM thì dùng cái này được.

**SSH Access**

Đối với đại đa số người dùng thì bạn không cần cho họ vào SSH. Còn với những người dùng chuyên nghiệp hoặc bạn tự tạo ra 1 người dùng khác cho mình thì nên chọn là _bash_.

**DNS**

Ngoại trừ ở DNS của domain chính chúng ta sử dụng là ns-child thì tất cả những user khác bạn nên chọn là default hết. Nếu user nào sử dụng template là Gmail thì họ sẽ không thể sử dụng email của VestaCP nhé.

Còn lại các thiết lập khác thì bạn chắc cũng biết rồi nên mình không cần nói qua nhé.

## Thay đổi thông số gói cho User

Để thay đổi thông số gói cho User bạn chọn, chon User -> Edit

![edit_user](https://github.com/octvitasut/fWS/blob/master/common/images/edit_user.PNG)

Tại Package chọn gói vừa khởi tạo

![choose_package](https://github.com/octvitasut/fWS/blob/master/common/images/choose_package.PNG)

