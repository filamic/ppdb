
cp .env.example .env
composer install
php artisan key:generate
echo "Please setup your database inside .env file, then migrate your database"