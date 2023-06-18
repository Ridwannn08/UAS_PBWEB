## Setting Project

```
git clone [link]
cd folder_name
cp .env.example .env
```
Edit file env dan sesukan dengan database
```
composer install
php artisan migrate:refresh
php artisan db:seed --class=DummyUserSeed
php artisan serve
```