# REST API WILAYAH INDONESIA

REST API untuk menarik data provinsi, kota dan kabupaten, dan kecamatan yang ada di Indonesia. Dilengkapi dengan fitur pembuatan daftar nama konsumen via API

## Fitur Aplikasi
- Mengolah data provinsi, kota dan kabupaten, dan kecamatan di Indonesia
- Menyediakan API untuk menarik data provinsi, kota dan kabupaten, dan kecamatan di Indonesia
- Mengolah daftar nama customer dan memetakan sesuai wilayah masing-masing (provinsi, kota atau kabupatan, dan kecamatan) 
- Mengolah daftar nama customer via API (create, read, update, dan delete)
- Mengolah daftar user yang dapat mengakses API

## Tech
Aplikasi ini dibangun dengan menggunakan :
- [Laravel] - Laravel adalah framework berbasis bahasa pemrograman PHP yang bisa digunakan untuk membantu proses pengembangan sebuah website agar lebih maksimal.
- [Bootstrap] - Bootstrap merupakan sebuah library atau kumpulan dari berbagai fungsi yang terdapat di framework CSS dan dibuat secara khusus di bagian pengembangan pada front-end website
- [jQuery] - jQuery adalah library JavaScript yang akan mempercepat Anda dalam membuat website
- [HTML] - Hypertext Markup Language, yaitu bahasa markup standar untuk membuat dan menyusun halaman dan aplikasi web.

## Requirement
- Laravel Valet 2.5.1 or later
- PHP 8.2.4 or later
- Composer 2.5.4 or later
- MySQL Server 8.0 or later
- MySQL Workbench 8.0 CE or later

## Instalasi
Cloning repository git ke sebuah folder di local

```sh
git clone https://github.com/rahardian-dwi-saputra/api-zone.git
```

Install depedensi via composer

```sh
composer install
```

Buat sebuah file .env

```sh
cp .env.example .env
```

Buat sebuah database kemudian import file rest_api_baru.sql ke database

```sh
mysql -u root -p nama_database < api-zone/database/rest_api_baru.sql
```

Jalankan project dengan valet laravel
```sh
valet start
```

Akses melalui browser
```sh
http://api-zone.test
```