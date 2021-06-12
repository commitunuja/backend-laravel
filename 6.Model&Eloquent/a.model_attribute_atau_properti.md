### PENGANTAR 

Laravel menyertakan Eloquent, sebuah object-relational mapper (ORM) yang membuatnya menyenangkan untuk berinteraksi dengan database Anda. Saat menggunakan Eloquent, setiap tabel database memiliki "Model" terkait yang digunakan untuk berinteraksi dengan tabel tersebut. Selain mengambil catatan dari tabel database, model Eloquent memungkinkan Anda untuk menyisipkan, memperbarui, dan menghapus catatan dari tabel juga.

### Menghasilkan Kelas Model

Model biasanya tinggal di **app\Models** direktori dan memperluas **Illuminate\Database\Eloquent\Modelkelas**. Anda dapat menggunakan make:model perintah Artisan untuk menghasilkan model baru:

```java
php artisan make:model Flight
```

Jika Anda ingin membuat migrasi database saat membuat model, Anda dapat menggunakan opsi **--migration** atau **-m**:

```java
php artisan make:model Flight --migration
```
Anda dapat menghasilkan berbagai jenis kelas lain saat membuat model, seperti pabrik, seeder, dan pengontrol. Selain itu, opsi ini dapat digabungkan untuk membuat beberapa kelas sekaligus:

```java
# Generate a model and a FlightFactory class...
php artisan make:model Flight --factory
php artisan make:model Flight -f

# Generate a model and a FlightSeeder class...
php artisan make:model Flight --seed
php artisan make:model Flight -s

# Generate a model and a FlightController class...
php artisan make:model Flight --controller
php artisan make:model Flight -c

# Generate a model and a migration, factory, seeder, and controller...
php artisan make:model Flight -mfsc

# Shortcut to generate a model, migration, factory, seeder, and controller...
php artisan make:model Flight --all

# Generate a pivot model...
php artisan make:model Member --pivot
```


Ada 10 magic property yang dapat kita gunakan :

1. $table
2. $primaryKey
3. $fillable
4. $guarded
5. $dates
6. $timestamps
7. $casts
8. $hidden
9. $visible
10. $appends

$TABLE

umumnya properti ini tidak perlu didefinisikan. Sebagai contoh, kita punya model dengan nama classÂ UserÂ (tunggal/singular), maka Eloquent menganggap nama tabelnya adalahÂ usersÂ (jamak/plural).
Lalu kapan kita menggunakan property ini ? nah property ini di gunakan jika table kita tidak sama dengan class model kita seperti ini :

```java
<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Page extends Model
{
    /**
    * Set default table name
    * @type {String}
    */
    protected $table = 'halaman';
}
```

$primarykey

Dalam penggunaan eloquent di laravel kolum atribut dengan nama idÂ akan langsung di anggap sebuah primary key oleh eloquent, nah penggunaan primaryKey ini dapat di gunakan jika anda memiliki atribut key yang berbeda seperti ini :

```java
/**
 * Set default primary key
 * @type {String}
 */
protected $primary = 'user_id';
```

$fillable

Properti yang satu ini punya fungsi untuk mendaftarkan atribut apa saja yang sekiranya dapat disimpan atau dimanipulasi menggunakanÂ create()Â atauÂ insert().

```java
/**
 * The attributes that are mass assignable.
 *
 * @var array
 */
protected $fillable = [
 'name',
 'email',
 'gender'
];

```
Cara insert menggunakan create :
```java
\App\User::create([
    'name'      => $faker->name,
    'email'     => $faker->email,
    'birthdate' => $faker->date,
    'gender'    => $faker->sex,
]);
```
$dates

Jika terbiasa menggunakan migration di Laravel, pasti tidak asing dengan dua atribut ajaib dengan namaÂ created_atÂ danÂ updated_at. Nilainya sendiri berupa DateTime MySQL.

Ketika digunakan dalam aplikasi, dua atribut tersebut merupakan objek dari classÂ Carbon. Memungkinkan kita untuk menggunakan method yang ada pada Carbon, semisal

```java
$user->created_at->format('d-m-Y H:i');
$user->updated_at->diffForHumans();
$user->register_at()->addDays(3);
```
Bagaimana jika kita punya atribut serupa, dengan nama lain tapi isian sama? Nah, kita bisa mendaftarkannya menggunakan propertiÂ $dates.

```java
/**
 * The attributes that are mass assignable.
 *
 * @var array
 */
protected $dates = [
 'registered_at'
];
```
$timestamps

property ini sangat erat hubunganya dengan property date, jika di migration akan muncul atribut columnÂ  created_at dan updated_atÂ nah property $timestamps ini berfungsi untuk meniadakan atribute tadi menjadi false jika tidak ingin menggunakanya tau meu membuat atribut secara manual :
```java
/**
 * Disable timestamps format
 * @type {Boolean}
 */
public $timetamps = false;
```
$hidden

Property ini berfungsi untuk menyembunyikan suatu atribut kolom pada table misalakan saya memiliki atribut seperti ini :
```java
    protected $hidden = [
     'password',
     'remember_token',
     'hash_method'
    ];
```
Properti ini sangat berguna untuk menghindari â€œkecelakaanâ€ saat menampilkan kembalian data collection dari model. Sebagai contoh, kita punya atributÂ name, password, danÂ remember_token

$Visible

Visible itu sndiri adalah kebalikan dari hidden dimana fungsinya akan menampilkan atribut yg telah di defenisikan:

```java
    protected $visible = [
     'name',
     'remember_token'
    ];
```
Jika nilainya diisi, maka hanya menampilkan atribut yang telah didefinisikan pada $visibleÂ dan mengabaikan propertiÂ $hidden. Jadi, cukup satu saja yang perlu didefinisikan. Dan perlu diingat,Â $visibleÂ lebih tinggi prioritasnya dibandingkanÂ $hidden.

$appends

menambahkan atribut baru berdasarkan atribut lainnya. Tak harus selalu berbasis atribut lainnya, dalam property $appends juga bisa menggunakan data statis.
```java
protected $appends = ['full_name'];
```
PropertiÂ $appendsÂ hanya dapat digunakan bersamaan dengan Accessor pada Eloquent. Agar skrip di atas dapat digunakan, kita harus membuat sebuah method baru dengan getFullNameAttribute().

```java
    public function getNameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }
```