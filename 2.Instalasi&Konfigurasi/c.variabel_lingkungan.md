# Variabel Lingkungan .env

secara keseluruhan konfigurasi laravel sendiri di simpan di salam folder config, dan di dalamnya di pisah-pisah lagi ke dalam bentuk file seperti `database.php`, `app.php` dan lain-lain. Untuk memudahkan di buat lah satu file ini yaitu `.env`, karena dengan adanya file ini kita hanya perlu membuka satu file ini saja tanpa merubah isi dari file yang ada di dalam folder config.

Kita sendiri juga bisa saja menambahkan variabel environment kita sendiri apabila di perlukan. Contoh, saya hendak menambahkan slug untuk url ke halaman admin, maka saya tambahkan baris ini pada file `.env` :

```ADMIN_PAGE=halaman-rahasia```

Dan untuk memanggil nya bisa di gunakan perintah di bawah ini :

```env('ADMIN_PAGE', 'default-value'); // ARGUMENT KE DUA BISA DI ISI KAN DEFAULT VALUE APABILA TERNYATA VARIABLE YANG DI MINTA TIDAK ADA PADA FILE .env```

 
Perlu menjadi catatan juga untuk penulisan variable dalam file `.env` tidak boleh memakai spasi, namun apabila memaksakan untuk memakai spasi bisa dengan menambahkan tanda double quote dalam value nya. Contoh :

```INGIN_PAKAI_SPASI="boleh tapi harus begini"```

**Terimakasih :)**
