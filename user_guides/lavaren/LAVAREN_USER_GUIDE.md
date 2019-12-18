---
# __Hướng dẫn cấu hình LARAVEN trên VESTACP__
---

## __1. Tạo wesite, cấu hình SQL DB, chứng thư SSL cho website__
Như trong user guide chung của VESTA CP: https://github.com/fagolabs/fWS/blob/master/user_guides/portal_vestacp/VESTA_CP_USER_GUIDE.md

## __2. Cài đặt lavarel__
### __2.1. Tải source code lavarel mẫu từ github__
- Sử dụng account và password đã được cấp cho user để ssh lên server hosting (giả sử account là user1, website đã cấu hình hosting ở bước trên là laravel.demo.com)

- Chuyển đến thư mục: /home/user1/web/laravel.demo.com/

- Tải source code mẫu của laravel: 

  ```
  git clone https://github.com/laravel/quickstart-basic
  mv quickstart-basic/* public_html/
  mv quickstart-basic/.env public_html/
  cd public_html/
  ```

- Cài đặt laravel: composer install

### __2.2. Cấu hình môi trường cho laravel__
- Mở và edit file .env theo hướng dẫn sau:

  ```
  APP_ENV=production
  APP_DEBUG=false
  APP_KEY=b809vCwvtawRbsG0BmP1tWgnlXQypSKf
  APP_URL=http://laravel.demo.com

  DB_HOST=127.0.0.1
  DB_DATABASE=admin_laravel
  DB_USERNAME=admin_laravel
  DB_PASSWORD=123456aA@
  ```
  
  Trong đó DB_DATABASE, DB_USERNAME, DB_PASSWORD là database, user, password đã cấu hình cho website trong mục bước 1
  
 - Chạy lệnh migrate database: php artisan migrate


