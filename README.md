# Trang bán hàng online Eshop

## Mở đầu
Phiên bản trang web này được xây dựng trên nền tảng Laravel 9x (PHP version: 8.0)
* [Larave 9.x Homepage](https://laravel.com)
### Điều khiện tiên quyết
* Sao chép kho lưu trữ eShop : https://github.com/minh130403/eshop
* DBMS: MySql ([Xampp](https://www.apachefriends.org/download.html))
#### Windown với Visual Studio Code
* [Visual Studio Code](https://code.visualstudio.com/)
* [Composer](https://getcomposer.org/)
* [Nodejs](https://nodejs.org/en/download) (v22)

## Chạy ứng dụng
1. Tạo cơ sở dữ liệu 'eshop' trong MySQL
2. Sử dụng CLI trong thư mục dự án chạy lệnh artisan sau:
``` php artisan serve```
3. Tiếp tục sử dụng CLI chạy lệnh: ```npm run dev```
4. Tạo các bảng trong CSDL sử dụng lệnh: ```php artisan migrate```
5. Để có dữ liệu sử dụng lệnh 🌱: ``` php artisan db:seed```

---
### Truy cập trang quản trị ứng dụng bằng đường dẫn http://localhost:8000/admin/
