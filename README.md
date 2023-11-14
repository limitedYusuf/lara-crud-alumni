<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

Membuat CRUD Simple dengan Laravel (By Request)

#### Requirement :
- [x] PHP 8
- [x] MySQL
- [x] Apache

#### Cara Install :
- Clone git ini
- Buka terminal dan pastikan sudah berada di folder project
- Ketik ```cp .env.example .env``` & enter
- Ketik ```composer install``` & enter
- Ketik ```npm install``` & enter
- Ketik ```npm run build``` & enter
- Buka file ```.env``` kemudian sesuaikan ```DB_DATABASE, DB_USERNAME, DB_PASSWORD``` sesuai server anda
- Ketik ```php artisan migrate:fresh --seed``` & enter
- Ketik ```php artisan storage:link``` & enter
- Ketik ```php artisan serve```

Normal nya url ```http://127.0.0.1:8000``` sudah bisa diakses di browser

Auth login?
Cek data di tabel ```users``` di database kemudian pilih salah satu email (bebas)

Password : ```123```

- URL Admin : ```http://127.0.0.1:8000/admin/login```
- URL Alumni : ```http://127.0.0.1:8000/alumni/login```