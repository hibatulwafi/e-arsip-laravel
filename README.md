## About E Arsip Laravel

E- Arsip

## Installasi
- Download repository dan ekstrak atau clone repository
	
- Masuk ke direktori aplikasi dan jalankan composer
	```sh
	$ cd e-arsip-laravel
	$ composer install
	```
 - Copy file .env.example menjadi .env
	```sh
	$ cp .env.example .env
	```
- Generate key application
	```sh
	$ php artisan key:generate
	```
- Buat Database
- Edit database name, database username dan database password di file .env
    ```sh
	DB_DATABASE=your_db.
    DB_USERNAME=your_mysql_username.
    DB_PASSWORD=your_mysql_password.
	```
- Jalankan lokal development server
    ```sh
	$ php artisan serve
	```
- Buka di browser http://localhost:8000
- Login
    ```sh
	Username :  admin@admin.com
    Password :  password
	```