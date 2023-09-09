Halloo,

ini laravel 5.8, support di php 7.3 ke atas. cara installnya : 

panduan :
1. download dulu zip nya, 
2. extract file nya
3. buka directorinya di terminal

command : 
1. composer install,
2. copy .env.example .env (kalo pake windows) atau cp .env.example .env(kalo pake linux atau mac),
3. php artisan key generate

configurasi database: 
1. buat database di mysql
2. masukan nama database di .env di bagian database name
3. php artisan migrate

siapp digunakan 
