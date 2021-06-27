###pengantar
Laravel menyertakan kemampuan untuk menyemai database Anda dengan data uji menggunakan kelas benih. Semua kelas benih disimpan dalam database/seedersdirektori. Secara default, DatabaseSeederkelas ditentukan untuk Anda. Dari kelas ini, Anda dapat menggunakan callmetode untuk menjalankan kelas benih lain, memungkinkan Anda untuk mengontrol urutan penyemaian.
---
#Menulis Seeders
Untuk menghasilkan seeder, jalankan make:seeder perintah Artisan . Semua seeder yang dihasilkan oleh kerangka kerja akan ditempatkan di database/seedersdirektori:
```java
php artisan make:seeder UserSeeder
```

Kelas seeder hanya berisi satu metode secara default: run. Metode ini dipanggil ketika db:seed perintah Artisan dijalankan. Dalam runmetode ini, Anda dapat memasukkan data ke dalam database Anda sesuka Anda. Anda dapat menggunakan pembuat kueri untuk memasukkan data secara manual atau Anda dapat menggunakan pabrik model Eloquent .

Sebagai contoh, mari ubah DatabaseSeederkelas default dan tambahkan pernyataan penyisipan database ke runmetode:
```java
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
```
#Menggunakan Pabrik Model
Tentu saja, secara manual menentukan atribut untuk setiap benih model tidak praktis. Sebagai gantinya, Anda dapat menggunakan pabrik model untuk menghasilkan sejumlah besar catatan database dengan mudah. Pertama, tinjau dokumentasi pabrik model untuk mempelajari cara mendefinisikan pabrik Anda.

Misalnya, mari buat 50 pengguna yang masing-masing memiliki satu pos terkait:
```java
use App\Models\User;

/**
 * Run the database seeders.
 *
 * @return void
 */
public function run()
{
    User::factory()
            ->count(50)
            ->hasPosts(1)
            ->create();
}
```

#Memanggil Seeder Tambahan
Di dalam DatabaseSeederkelas, Anda dapat menggunakan callmetode untuk mengeksekusi kelas benih tambahan. Menggunakan callmetode ini memungkinkan Anda untuk memecah seeding database Anda menjadi beberapa file sehingga tidak ada satu kelas seeder yang menjadi terlalu besar. The callMetode menerima array kelas seeder yang harus dijalankan:

```java
/**
 * Run the database seeders.
 *
 * @return void
 */
public function run()
{
    $this->call([
        UserSeeder::class,
        PostSeeder::class,
        CommentSeeder::class,
    ]);
}
```

#Menjalankan Seeder
Anda dapat menjalankan db:seedperintah Artisan untuk menyemai database Anda. Secara default, db:seedperintah menjalankan Database\Seeders\DatabaseSeederkelas, yang pada gilirannya dapat memanggil kelas benih lainnya. Namun, Anda dapat menggunakan --classopsi untuk menentukan kelas seeder tertentu untuk dijalankan secara individual:

```java
php artisan db:seed

php artisan db:seed --class=UserSeeder
```

Anda juga dapat menyemai database Anda menggunakan migrate:freshperintah yang dikombinasikan dengan --seedopsi, yang akan menghapus semua tabel dan menjalankan kembali semua migrasi Anda. Perintah ini berguna untuk sepenuhnya membangun kembali database Anda

```java
php artisan migrate:fresh --seed
```

