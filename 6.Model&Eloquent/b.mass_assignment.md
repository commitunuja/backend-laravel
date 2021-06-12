### Mass Assignment

Mass Assignment yaitu salah satu fitur yang memudahkan kita untuk menyimpan atau mengupdate data pada Eloquent Model. Mass Assignment pada Laravel memungkinkan kita untuk mengirimkan data dalam bentuk array dengan array_keys adalah kolom yang digunakan pada database.

Ketika menginisialisasi sebuah model, kita bisa mengirimkan attribute-attribute dalam bentuk array pada model constructor. Attribute-attribute ini nantinya akan di assign ke model. Proses inilah yang disebut sebagai Mass Assignment.

Berikut ini adalah contoh bagaimana menyimpan data menggunakan Mass Assignment.

```java
$user = new User([
    'name' => 'Diyah Ayu A',
    'email' => 'email@domain.com'
    ]);
$user->save();
```

Selain menggunakan kode seperti diatas, kita juga bisa mempersingkat proses diatas dengan menggunakan method create dari Laravel.
```java
User::create([
    'name' => 'Diyah Ayu A',
    'email' => 'email@domain.com'
]);User::create([
    'name' => 'Diyah Ayu A',
    'email' => 'email@domain.com'
]);
```

Agar bisa menggunakan fitur Mass Assignment, kita perlu mengatur property **$fillable** atau **$guarded** pada model. Property **$fillable** digunakan untuk mendefinisikan attribute mana saja yang diizinkan untuk di assign menggunakan Mass Assignment, sementara property **$guarded** untuk mendefinisikan attribute mana saja yang tidak diizinkan untuk di assign menggunakan Mass Assignment.
```java
namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
    ];

    //
}
```
### Fillable vs Guarded

Gunakan property **$fillable** jika jumlah kolom yang diizinkan untuk di assign menggunakan Mass Assignment lebih sedikit dibandingkan dengan yang tidak diizinkan. Sebaliknya gunakan property **$guarded** jika jumlah kolom yang diizinkan untuk di assign menggunakan Mass Assignment lebih banyak.

Contoh :

kita memiliki sebuah table dengan 15 kolom, 12 diantaranya diizinkan untuk di assign menggunakan Mass Assignment. Pada kasus ini, karena jumlah kolom yang diizinkan untuk di assign menggunakan Mass Assignment lebih banyak dari yang tidak diizinkan, kita bisa menggunakan property **$guarded** untuk kasus ini.
```java
class User extends Model
{
    protected $guarded = [
        'field_13',
        'field_14',
        'field_15',
    ];
    //
}
```

Bayangkan jika kita menggunakan property **$fillable** untuk kasus diatas. Akan sangat banyak attribute yang harus kita definisikan disini.
```java
class User extends Model
{
    protected $fillable = [
        'field_1',
        'field_2',
        'field_3',
        //
        //
        'field_12'
    ];
    //
}
```

### Keuntungan Mass Assignment

Lalu, apa keuntungan menggunakan Mass Assignment, perbandingan menggunakan Mass Assignment dengan tanpa Mass Assignment pada contoh diatas tidak terlihat menonjol. Jumlah Baris kode yang digunakan pun tidak terlampau jauh berbeda.

Memang kode diatas tidak terlihat memiliki perbedaan yang signifikan, tapi bayangkan jika kita menggunakan Form HTML untuk mengisi data pada database dan kita memiliki sebuah table yang memiliki banyak kolom, tentu akan sangat tidak efisien jika kita harus meng-assign attribute tersebut satu per satu.

Sekarang mari kita lihat perbedaan keduanya ketika kita menyimpan data melalui Form HTML.

Contoh cara menyimpan data dari Form HTML tanpa menggunakan Mass Assignment.
```java
public function store(Request $request)
{
    $user = new User();
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->field_1 = $request->input('field_1');
    $user->field_2 = $request->input('field_2');
    $user->field_3 = $request->input('field_2');
    //
    //
    $user->save();
    //
}
```

Dengan menggunakan Mass Assignment, proses menyimpan data akan terlihat seperti ini.
```java
public function store(Request $request)
{
    User::create($request->all());
}
```