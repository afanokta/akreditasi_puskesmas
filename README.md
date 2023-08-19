## Panduan Penggunaan
* Software Requirement
    a. XAMPP (sudah include Webserver Apache + PHP + MySQL) --> recomended
    b. Composer
* Instalasi
```
git clone https://github.com/afanokta/akreditasi_puskesmas.git
cd akreditasi_puskesmas
composer install --ignore-platform-req=ext-gd
php artisan jwt:secret
```
* Copy file `.env.example` dan rename menjadi `.env` kemudian sesuaikan konfigurasinya
* Jalankan perintah
```
php artisan migrate
php artisan db:seed
php artisan storage:link
```

* untuk mengulangi migration
```
php artisan migrate:fresh
php artisan db:seed
```
