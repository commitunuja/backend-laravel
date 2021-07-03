### pengantar
Migrasi seperti kontrol versi untuk database Anda, memungkinkan tim Anda untuk dengan mudah memodifikasi dan berbagi skema database aplikasi. Migrasi biasanya dipasangkan dengan pembuat skema Laravel untuk dengan mudah membangun skema database aplikasi Anda. Jika Anda pernah harus memberi tahu rekan satu tim untuk menambahkan kolom secara manual ke skema basis data lokal mereka, Anda menghadapi masalah yang dipecahkan oleh migrasi basis data.

### Menghasilkan Migrasi
Untuk membuat migrasi, gunakan make:migration perintah Artisa

```java
php artisan make:migration create_users_table
```
Migrasi baru akan ditempatkan di database/migrationsdirektori Anda . Setiap nama file migrasi berisi stempel waktu yang memungkinkan Laravel menentukan urutan migrasi.

the --tabledan --createpilihan juga dapat digunakan untuk menunjukkan nama tabel dan apakah migrasi akan menciptakan tabel baru. Opsi ini mengisi terlebih dahulu file rintisan migrasi yang dihasilkan dengan tabel yang ditentukan:

```java
php artisan make:migration create_users_table --create=users

php artisan make:migration add_votes_to_users_table --table=users
```

Jika Anda ingin menentukan jalur keluaran khusus untuk migrasi yang dihasilkan, Anda dapat menggunakan --pathopsi saat menjalankan make:migrationperintah. Jalur yang diberikan harus relatif terhadap jalur dasar aplikasi Anda.

### Struktur Migrasi

Kelas migrasi berisi dua metode: updan down. The upmetode yang digunakan untuk menambahkan tabel baru, kolom, atau indeks ke database Anda, sedangkan downmetode harus membalikkan operasi yang dilakukan oleh upmetode.

Dalam kedua metode ini, Anda dapat menggunakan pembuat skema Laravel untuk membuat dan memodifikasi tabel secara ekspresif. Untuk mempelajari tentang semua metode yang tersedia di Schemabuilder, lihat dokumentasinya . Misalnya, contoh migrasi ini membuat flightstabel:

```java
<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('airline');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('flights');
    }
}
```
### Menjalankan Migrasi
Untuk menjalankan semua migrasi luar biasa Anda, jalankan migrateperintah Artisan:

```java
php artisan migrate
Memaksa Migrasi Berjalan Dalam Produksi
php artisan migrate --force
```
### Mengembalikan Migrasi
Untuk mengembalikan operasi migrasi terbaru, Anda dapat menggunakan rollbackperintah. Perintah ini mengembalikan "kumpulan" migrasi terakhir, yang mungkin menyertakan beberapa file migrasi:

```java
php artisan migrate:rollback
```
Anda dapat mengembalikan migrasi dalam jumlah terbatas dengan memberikan stepopsi pada rollbackperintah. Misalnya, perintah berikut akan mengembalikan lima migrasi terakhir:

```java
php artisan migrate:rollback --step=5
```
The migrate:resetperintah akan memutar kembali semua migrasi aplikasi Anda:

```java
php artisan migrate:reset
```
Kembalikan & Migrasi Dalam Satu Perintah
The migrate:refreshperintah akan memutar kembali semua migrasi Anda dan kemudian jalankan migrateperintah. Perintah ini secara efektif membuat ulang seluruh database Anda:

```java
php artisan migrate:refresh
```

// Refresh the database and run all database seeds...
php artisan migrate:refresh --seed
Anda dapat mengembalikan & memigrasi ulang sejumlah migrasi terbatas dengan memberikan stepopsi pada refreshperintah. Misalnya, perintah berikut akan mengembalikan & memigrasi ulang lima migrasi terakhir:

```java
php artisan migrate:refresh --step=5
```
Jatuhkan Semua Tabel & Migrasi
The migrate:freshperintah akan drop semua tabel dari database dan kemudian jalankan migrateperintah:

```java
php artisan migrate:fresh

php artisan migrate:fresh --seed
```