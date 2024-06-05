
cp .env.example .env
composer install
php artisan key:generate
echo "Silahkan melakukan konfigurasi database pada file .env jika tidak ingin menggunakan Sqlite"