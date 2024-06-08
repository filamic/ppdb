#!/bin/bash

# Check if .env file exists
if [ ! -f .env ]; then
  echo "File .env belum ada, membuat file .env..."
  
  # Copy .env.example to .env
  cp .env.example .env
  echo "Berhasil membuat file .env"

  # Install composer dependencies
  composer install
  echo "Berhasil menginstall dependensi menggunakan composer"

  # Generate application key
  php artisan key:generate
  echo "Berhasil generate Key Aplikasi"

  # Run database migrations
  php artisan migrate
  echo "Berhasil Melakukan migrasi database"

  # Run storage link
  php artisan storage:link
  echo "Berhasil Melakukan symlink"

  # Create a Filament user
  echo "Silahkan membuat user admin untuk login"
  php artisan make:filament-user
  echo "Berhasil membuat user"

  echo "Silahkan melakukan konfigurasi database pada file .env jika tidak ingin menggunakan Sqlite"
else
  echo "file .env sudah ada. Tidak perlu menjalankan setup lagi, terima kasih."
fi
