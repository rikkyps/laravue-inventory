<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Installation
Pastikan di komputernya terinstall Composer. Project ini dibuat di environment Laravel Valet.

Clone repository ke desktop

Jalankan perintah composer install d root directory aplikasinya (tunggu hingga selesai)

ubah nama file .env.example jadi .env

Setting database di .env

Buka terminal dan arahkan pada directory project

Jalankan perintah 'php artisan key:generate'

Jalankan perintah 'php artisan migrate --seed'

Jalankan perintah 'php artisan jwt:secret' untuk membuat secret key JWT

Jalankan perintah 'npm install' untuk melengkapi packages yang dibutuhkan (jika pakai NPM)

Jalankan perintah npm run dev / npm run watch / npm run watch-poll (Pilih salah satu)

Masukan link http://namahost/ pada address bar browser

Login menggunakan email dan password yang telah di generate di database pada table users (untuk passwordnya: 'password')


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
