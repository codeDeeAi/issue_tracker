web: vendor/bin/heroku-php-apache2 public/
worker1: php artisan migrate
worker2: php artisan queue:work
worker: npm run build