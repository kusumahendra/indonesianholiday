# indonesianholiday
check indonesian holiday using Laravel 5.5 + google calendar API

##How to Install
1. Clone the project
2. Duplicate .env.example file and rename to .env (GOOGLE API KEY is there)
3. Install all required package
```
composer install
composer dumpautoload
```
4. Generate application key
```
php artisan key:generate
```
5. Clear config and cache
```
php artisan config:clear
php artisan cache:clear
```