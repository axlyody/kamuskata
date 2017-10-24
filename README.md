## :whale: KamusKata
Cara membuat kamus dengan Laravel.

Sebenarnya cuma buat tugas kelompok nya temen aja, minta buatin kamus :p

![Terjemahan](http://i.imgur.com/mKbq3UE.png)

![Tambah kata](http://i.imgur.com/zhSH9H6.png)

![Admin database](http://i.imgur.com/ggGI0Ek.png)

![Terjemahan saya](http://i.imgur.com/bTHJ5HG.png)

## Install

Clone 
```sh
git clone git@github.com:axlyody/kamuskata.git
```
Ambil vendor
```sh
composer update
```
Sesuaikan database kamu di file .env

Selanjutnya memasukan table dengan migrate
```sh
php artisan migrate
php artisan db:seed
```
Jalankan
```sh
php artisan serve
```

#### User
Admin
```sh
admin@admin.com
admin
```
User
```sh
user@user.com
user
```

## Lisensi

MIT

