## Panduan Penggunaan
* instalasi
```
git clone https://github.com/afanokta/akreditasi_puskesmas.git
cd akreditasi_puskesmas
composer install
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan serve
```

* untuk mengulangi migration
```
php artisan migrate:fresh
php artisan db:seed
```
