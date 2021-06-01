Pernahkah kalian membuka berkas model Laravel yang berbasis Eloquent? Jika iya, tak sedikit dari kita yang dibuat bingung karena tidak ada sama sekali properti yang didefinisikan di dalamnya. Seolah, model tersebut paham betul nama tabel atau primary key yang digunakan.
Di lain sisi, kita juga kadang dibuat bingung karena ada banyaknya properti yang didefinisikan pada suatu model. Memang sih, namanya cukup mudah dipahami. Namun, tetap saja kita harus mencari-cari di dokumnetasi Laravel untuk memahami fungsi sebenarnya.
Pada dokumentasi Laravel sendiri, bahasan ini masuk dalam kategori khusus dengan nama Eloquent Mutator. Tak hanya properti yang dijabarkan, ada juga beberapa (magic) method yang dijelaskan.
Biar tidak bingung, mari kita berkenalan satu persatu dengan properti yang ada di Eloquent. Semakin kita paham fungsi masing-masing properti, semakin meningkat produktivitas kita dalam memanipulasi data.
Semua properti di bawah didefinisikan dengan visibility protected. Sebagai contoh protected $property = []. Selengkapnya mengenai visibility dalam OOP dapat dibaca pada dokumentasi PHP berikut.
$table
Jika kita mengikuti naming convention dari Laravel, umumnya properti ini tidak perlu didefinisikan. Sebagai contoh, kita punya model dengan nama class User, maka Eloquent menganggap nama tabelnya adalah users.
Properti $table digunakan ketika penamaan tabel yang akan digunakan tidak sesuai dengan aturan baku penamaan tabel sesuai Eloquent.
Sebagai contoh, jika kita puya tabel dengan nama halaman, maka sintaksnya bisa dibuat seperti berikut.
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
$primaryKey
Eloquent akan mengganggap atribut id dalam tabel sebagai primary key dan mengkonversinya (cast) menjadi tipe data integer. Jika selain itu, gunakan properti $primaryKey untuk menjelaskan kepada Eloquent kalau kita menggunakan nama atribut yang lain.
/**
 * Set default primary key
 * @type {String}
 */
protected $primary = 'user_id';
$fillable
Properti yang satu ini punya fungsi untuk mendaftarkan atribut apa saja yang sekiranya dapat disimpan atau dimanipulasi menggunakan create() atau insert().
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
Contoh penyimpanan data menggunakan create().
\App\User::create([
    'name'      => $faker->name,
    'email'     => $faker->email,
    'birthdate' => $faker->date,
    'gender'    => $faker->sex,
]);
Properti $fillable juga sangat berguna ketika ingin melakukan mass assignment, atau dengan bahasa lebih sederhananya, menyimpan banyak data dalam satu perintah. Sebagai contoh:
$users = [];
foreach (range(1, 10) as $loop) {
    $users[] = [
        'name'  => $faker->name,
        'email' => $faker->email,
    ];
}
User::insert($users);
$guarded
Merupakan properti kebalikan dari $fillable. Secara bawaan, nilainya adalah [*] yang berarti berlaku untuk semua atribut. Itulah kenapa, jika $fillable tidak didefinisikan, maka akan menyebabkan kegagalan dengan pesan kesalahan seperti ini.
MassAssignmentException in Model.php line 421: field
MassAssignmentException in Model.php line 421:
field
Dengan mendefinisikan $guarded, maka Eloquent akan mengabaikan atribut tersebut pada mass assignment.
/**
 * The attributes that are guarded from mass assignable
 *
 * @var array
 */
protected $guarded = [
 'gender'
];
$dates
Jika terbiasa menggunakan migrations di Laravel, pasti tidak asing dengan dua atribut ajaib dengan nama created_at dan updated_at. Nilanya sendiri berupa DateTime MySQL.
Ketika digunakan dalam aplikasi, dua atribut tersebut merupakan objek dari class Carbon. Memungkinkan kita untuk menggunakan method yang ada pada Carbon, semisal:
$user->created_at->format('d-m-Y H:i');
$user->updated_at->diffForHumans();
$user->register_at()->addDays(3);
Bagaimana jika kita punya atribut serupa, dengan nama lain tapi isian sama? Nah, kita bisa mendaftarkannya menggunakan properti $dates.
/**
 * The attributes that are mass assignable.
 *
 * @var array
 */
protected $dates = [
 'registered_at'
];
$timesamps
Masih berhubungan dengan properti $dates di atas, di mana atribut created_at dan updated_at otomatis akan selalu diisi pada saat penyimpanan maupun perbaruan data (hanya created_at) walaupun kita tidak mendefinisikannya.
Jika dalam tabel kita tidak ingin ada dua atribut tersebut, atau ingin mengisinya secara manual, maka dapat menggunakan properti $timestamps.
/**
 * Disable timestamps format
 * @type {Boolean}
 */
protected $timetamps = false;
$casts
Saya sedikit kebingungan mencari padanan yang tepat dalam Bahasa Indonesia untuk kata cast. Satu-satunya yang cukup dimengerti adalah konversi.
Mari simak contoh data berikut:
{
 name: "Laravel Indonesia",
 rate: "10",
 average: "7.8",
 is_published: "1"
}
Saya punya atribut dengan nama is_published dengan tipe data TinyInteger(1) pada MySQL. Sayangnya, Eloquent selalu mengembalikannya dalam bentuk string.
Dalam PHP, hal ini tidak menjadi masalah ketika di-compare dengan ($user->is_published == $value) (nilai harus sama), namun menjadi masalah ketika di-compare menggunakan ($user->is_published === $value) (nilai dan tipe data harus sama). Lebih bermasalah lagi ketika digunakan oleh bahasa pemrograman lain, seperti JavaScript misalnya. Karena string “1” dan “0” akan dianggap true.
Hal yang sama juga terjadi pada atribut rate dan average, di mana saya ingin menjadikan rate sebagai integer dan average sebagai float.
/**
 * Cast fields into different type
 * @type {Array}
 */
$casts = [
    'rate'         => 'integer',
    'average'      => 'float',
    'is_published' => 'boolean',
];
Konversi yang didukung antara lain: integer, real, float, double, string, boolean, object, array, collection, date, datetime, dan timetamp.
$hidden
Dengan properti ini, memungkinkan untuk hanya menampilkan beberapa atribut. Sebagai contoh:
protected $hidden = [
 'password',
 'remember_token',
 'hash_method'
];
Properti ini sangat berguna untuk menghindari “kecelakaan” saat menampilkan kembalian data collection dari model. Sebagai contoh, kita punya atribut name, password, dan remember_token.
return User::first();
{
 "nama": "Laravel Indonesia"
}
$visible
Kebalikan dari properti $hidden di mana akan menampikan atribut yang didefinisikan.
protected $visible = [
 'name',
 'remember_token'
];
Jika nilannya diisi, maka hanya menampilkan atribut yang telah didefinisikan pada $visible dan mengabaikan properti $hidden. Jadi, cukup satu saja yang perlu didefinisikan. Dan perlu diingat, $visible lebih tinggi prioritasnya dibandingkan $hidden.
$appends
Menambahkan attribute baru berdasarkan attribute lainnya. Tak harus selalu berbasis attribute lainnya, dalam property $appends juga bisa menggunakan data statis.
protected $appends = ['full_name'];
Eloquent: Mutators - Laravel - The PHP Framework For Web Artisans
Laravel - The PHP framework for web artisans.
laravel.com

Properti $appends hanya dapat digunakan bersamaan dengan Accessor pada Eloquent. Agar skrip di atas dapat digunakan, kita harus membuat sebuah method baru dengan getFullNameAttribute() .
public function getNameAttribute()
{
    return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
}