### Read & Write Connections
Kadang-kadang Anda mungkin ingin menggunakan satu koneksi database untuk pernyataan SELECT, dan satu lagi untuk pernyataan INSERT, UPDATE, dan DELETE. Laravel membuat ini mudah, dan koneksi yang tepat akan selalu digunakan baik Anda menggunakan kueri mentah, pembuat kueri, atau ORM Eloquent.

Untuk melihat bagaimana koneksi baca / tulis harus dikonfigurasi, mari kita lihat contoh ini:
```java
'mysql' => [
    'read' => [
        'host' => [
            '192.168.1.1',
            '196.168.1.2',
        ],
    ],
    'write' => [
        'host' => [
            '196.168.1.3',
        ],
    ],
    'sticky' => true,
    'driver' => 'mysql',
    'database' => 'database',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
],
```
Perhatikan bahwa tiga kunci telah ditambahkan ke larik konfigurasi: **read, write** dan **sticky**.**read** dan **write** kunci memiliki nilai array yang berisi kunci tunggal: **host**. Opsi database lainnya untuk **read** dan **write** koneksi akan digabungkan dari **mysql** larik konfigurasi utama .

Anda hanya perlu menempatkan item dalam array **read** and **write** jika Anda ingin mengganti nilai dari **mysql** array utama . Jadi, dalam hal ini, **192.168.1.1** akan digunakan sebagai host untuk koneksi "baca", sedangkan **192.168.1.3** akan digunakan untuk koneksi "tulis". Kredensial basis data, awalan, kumpulan karakter, dan semua opsi lain di **mysql** larik utama akan dibagikan di kedua koneksi. Ketika beberapa nilai ada dalam **host** array konfigurasi, host database akan dipilih secara acak untuk setiap permintaan.

### The stickyOption
The **sticky** pilihan adalah opsional nilai yang dapat digunakan untuk memungkinkan pembacaan langsung dari catatan yang telah ditulis ke database selama siklus permintaan saat ini. Jika **sticky** opsi diaktifkan dan operasi "tulis" telah dilakukan terhadap database selama siklus permintaan saat ini, operasi "baca" lebih lanjut akan menggunakan koneksi "tulis". Ini memastikan bahwa setiap data yang ditulis selama siklus permintaan dapat segera dibaca kembali dari database selama permintaan yang sama. Terserah Anda untuk memutuskan apakah ini perilaku yang diinginkan untuk aplikasi Anda.

### Running SQL Queries
Setelah Anda mengonfigurasi koneksi database, Anda dapat menjalankan kueri menggunakan **DB**fasad. The **DB**fasad menyediakan metode untuk setiap jenis query: **select, update, insert, delete,** dan **statement**.

### Running A Select Query
Untuk menjalankan kueri SELECT dasar, Anda dapat menggunakan **select**metode pada **DB**fasad:
```java
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::select('select * from users where active = ?', [1]);

        return view('user.index', ['users' => $users]);
    }
}
```
Argumen pertama yang diteruskan ke **select**metode adalah kueri SQL, sedangkan argumen kedua adalah pengikatan parameter apa pun yang perlu diikat ke kueri. Biasanya, ini adalah nilai dari **where** batasan klausa. Pengikatan parameter memberikan perlindungan terhadap injeksi SQL.

**select** metode akan selalu mengembalikan **array**hasil. Setiap hasil dalam array akan menjadi **stdClass**objek PHP yang mewakili catatan dari database:
```java
use Illuminate\Support\Facades\DB;

$users = DB::select('select * from users');

foreach ($users as $user) {
    echo $user->name;
}
```
### Using Named Bindings
Alih-alih menggunakan **?**untuk mewakili binding parameter Anda, Anda dapat menjalankan kueri menggunakan binding bernama:
```java
$results = DB::select('select * from users where id = :id', ['id' => 1]);
```
### Running An Insert Statement
Untuk mengeksekusi **insert** pernyataan, Anda dapat menggunakan **insert** metode pada **DB** fasad. Seperti **select**, metode ini menerima kueri SQL sebagai argumen pertama dan binding sebagai argumen kedua:
```java
use Illuminate\Support\Facades\DB;

DB::insert('insert into users (id, name) values (?, ?)', [1, 'Marc']);
```
### Running An Update Statement
**update** metode harus digunakan untuk memperbarui catatan yang ada dalam database. Jumlah baris yang terpengaruh oleh pernyataan dikembalikan oleh metode:
```java
use Illuminate\Support\Facades\DB;

$affected = DB::update(
    'update users set votes = 100 where name = ?',
    ['Anita']
);
```
### Running A Delete Statement
**delete** Metode harus digunakan untuk menghapus catatan dari database. Seperti **update**, jumlah baris yang terpengaruh akan dikembalikan dengan metode:
```java
use Illuminate\Support\Facades\DB;

$deleted = DB::delete('delete from users');
```
### Running A General Statement
Beberapa pernyataan database tidak mengembalikan nilai apa pun. Untuk jenis operasi ini, Anda dapat menggunakan **statement** metode pada **DB**fasad:
```java
DB::statement('drop table users');
```
### Running An Unprepared Statement
Terkadang Anda mungkin ingin menjalankan pernyataan SQL tanpa mengikat nilai apa pun. Anda dapat menggunakan metode **DB** fasad **unprepared** untuk mencapai ini:
```java
DB::unprepared('update users set votes = 100 where name = "Dries"');
```
### Using Multiple Database Connections
Jika aplikasi Anda mendefinisikan beberapa koneksi dalam **config/database.php** file konfigurasi Anda, Anda dapat mengakses setiap koneksi melalui **connection** metode yang disediakan oleh **DB** fasad. Nama koneksi yang diteruskan ke **connection** metode harus sesuai dengan salah satu koneksi yang terdaftar di **config/database.php** file konfigurasi Anda atau dikonfigurasi saat runtime menggunakan **config** helper:
```java
use Illuminate\Support\Facades\DB;

$users = DB::connection('sqlite')->select(...);
```
Anda dapat mengakses instans PDO dasar dari koneksi menggunakan getPdometode pada instans koneksi:
```java
$pdo = DB::connection()->getPdo();
```
### Listening For Query Events
Jika Anda ingin menentukan penutupan yang dipanggil untuk setiap kueri SQL yang dijalankan oleh aplikasi Anda, Anda dapat menggunakan metode **DB**fasad **listen**. Metode ini dapat berguna untuk membuat log kueri atau debugging. Anda dapat mendaftarkan penutupan pendengar kueri Anda dalam **boot**metode penyedia layanan :
```java
<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DB::listen(function ($query) {
            // $query->sql;
            // $query->bindings;
            // $query->time;
        });
    }
}
```