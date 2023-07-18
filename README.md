## Challenge Adolic Laravel

     git clone git@github.com:mangiu90/adolic_laravel.git
     cd adolic_laravel
     cp .env.example .env
     php artisan migrate
     php artisan seed
     php artisan app:populate-entities
     php artisan serve

     GET/ {{host}}/api/{category}