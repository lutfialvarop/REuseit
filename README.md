# REuseit App Management Content

## How To use

Cara menjalankan laravel

-   `git clone (link)` untuk clone project
-   masuk ke folder project, lalu buka terminal
-   `composer update` untuk update dependency
-   `composer install` untuk install dependency
-   `cp .env.example .env` untuk copy file .env
-   rename 'APP_NAME' di file .env jadi 'REuseit'
-   `php artisan key:generate` untuk generate key
-   `php artisan migrate` untuk migrate database
-   `npm install` untuk install dependency
-   `npm run dev` untuk compile js
-   `php artisan serve` untuk jalanin laravel

## Account For Login
link untuk login `http://127.0.0.1:8000/auth/login`
-   Admin:
    -   email: john.doe@example.com
    -   password: password123
-   User:
    -   email: test@example.com
    -   password: password123
    
Anda bisa juga register dengan link berikut
`http://127.0.0.1:8000/auth/register`
secara default untuk role saat register adalah user
