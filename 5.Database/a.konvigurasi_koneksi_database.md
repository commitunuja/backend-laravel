### Pengantar 
 Setiap sistem yang terdapat data pasti terhubung dengan database, dengan menggunakan laravel dapat melakukan interaksi dengan database. Namun sebelum melakukan interaksi dengan database ada beberapa hal yang perlu di konfigurasi.

Secara default laravel menyediakan jenis database yang dapat di hubungkan yaitu MySQL, SQLite,PGSQL, dan SQLSRV. Laravel telah menyediakan file khusus untuk melakukan konfigurasi yaitu di folder awal laravel terdapat file dengan nama .env. Namun pada bagian file .env bukan hanya untuk database saja tetapi ada konfigurasi lain, untuk konfigurasi dengan database pada kode di bawah ini.


```java
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```
---
Pada bagian DB_CONNECTION untuk memilih jenis database yang ingin di pakai, selanjutnya di bawahnya konfigurasi berdasarkan database yang di pilih.

Pasti anda bertanya koneksi file .env khususnya untuk bagian database letaknya dimana, File konfigurasi yang murni terletak di folder config/database.php. Di file tersebut mengambil pengaturan .env.

Sebagai contoh saya ingin mengoneksikan dengan MySQL, ubah pengaturan seperti kode di bawah ini.

```java
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=didikprabowo
DB_USERNAME=root
DB_PASSWORD=
```
Untuk melakukan uji coba anda dapat menggunakan file default migration laravel dan mengetikan

```java
php artisan migrate
```
Kemudian lihat hasilnya, apakah di database akan ada 3 tabel atau tidak, jika ada maka koneksi ke database MySQL berhasil di lakukan. Untuk penjelasan mengenai migration saya akan bahas di materi selanjutnya.
