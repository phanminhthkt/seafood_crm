<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Giới thiệu về dự án.

Dự án được viết bằng laravel mix vue js.
- Larvel version: v8.12.
- Php version: v7.3.
- Vue js version: 2.6.12.

## Bao gồm các chức năng chính.
- Admin tạo tài khoản cho thành viên thuộc 2 nhóm lập trình và kinh doanh.
- Nhân viên lập trình đăng nhập vào xem dự án được giao và báo tiến độ gửi mail.
- Nhân viên kinh doanh vào đăng và xem tiến độ dự án.
- Admin vào duyệt và chọn nhân viên lập trình cho dự án.

## Sau khi clone dự án về thì thực hiện các bước: 

1.Chạy lệnh:

- composer install
- npm install 

2.Sau đó copy file env và cập nhật thông tin:

- cp .env.example .env

3.Tạo key cho dự án:

- php artisan key:generate

4.Tạo ra các bảng và dữ liệu mẫu cho database:

- php artisan migrate
- php artisan db:seed

Information login:

- user:admin
- pass:123456