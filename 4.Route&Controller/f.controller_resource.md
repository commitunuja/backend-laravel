### pengantar
Alih-alih mendefinisikan semua logika penanganan permintaan Anda dalam satu routes.phpfile, Anda mungkin ingin mengatur perilaku ini menggunakan kelas Controller. Pengontrol dapat mengelompokkan logika penanganan permintaan HTTP terkait ke dalam kelas. Kontroler disimpan dalam app/Http/Controllersdirektori.

### Pengendali Dasar
Berikut adalah contoh kelas pengontrol dasar. Semua pengontrol Laravel harus memperluas kelas pengontrol dasar yang disertakan dengan instalasi Laravel default:
```java
<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function showProfile($id)
    {
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }
}
```
Kami dapat merutekan ke tindakan pengontrol seperti:
```java
Route::get('user/{id}', 'UserController@showProfile');
```
---
Sekarang, ketika permintaan cocok dengan URI rute yang ditentukan, showProfilemetode pada UserControllerkelas akan dieksekusi. Tentu saja, parameter rute juga akan diteruskan ke metode.

### Pengontrol & Ruang Nama
Sangat penting untuk dicatat bahwa kita tidak perlu menentukan namespace pengontrol penuh saat menentukan rute pengontrol. Kami hanya mendefinisikan bagian dari nama kelas yang muncul setelah App\Http\Controllersnamespace "root". Secara default, file RouteServiceProviderakan dimuat routes.phpdalam grup rute yang berisi namespace pengontrol root.

Jika Anda memilih untuk membuat sarang atau mengatur pengontrol Anda menggunakan ruang nama PHP lebih dalam ke dalam App\Http\Controllersdirektori, cukup gunakan nama kelas tertentu relatif terhadap App\Http\Controllersruang nama root. Jadi, jika kelas pengontrol lengkap Anda adalah App\Http\Controllers\Photos\AdminController, Anda akan mendaftarkan rute seperti ini:
```java
Route::get('foo', 'Photos\AdminController@method');
```
Penamaan Rute Pengontrol
Seperti rute Penutupan, Anda dapat menentukan nama pada rute pengontrol:
```java
Route::get('foo', ['uses' => 'FooController@method', 'as' => 'name']);
Anda juga dapat menggunakan routehelper untuk menghasilkan URL ke rute pengontrol bernama:

$url = route('name');
Kontroler Middleware
Middleware dapat ditetapkan ke rute pengontrol seperti:

Route::get('profile', [
    'middleware' => 'auth',
    'uses' => 'UserController@showProfile'
]);
```---
Namun, akan lebih mudah untuk menentukan middleware dalam konstruktor pengontrol Anda. Menggunakan middlewaremetode dari konstruktor pengontrol Anda, Anda dapat dengan mudah menetapkan middleware ke pengontrol. Anda bahkan dapat membatasi middleware hanya pada metode tertentu pada kelas pengontrol:
```java
class UserController extends Controller
{
    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('log', ['only' => [
            'fooAction',
            'barAction',
        ]]);

        $this->middleware('subscribed', ['except' => [
            'fooAction',
            'barAction',
        ]]);
    }
}
```

### Pengontrol Sumber Daya RESTful
Pengontrol sumber daya membuatnya mudah untuk membangun pengontrol RESTful di sekitar sumber daya. Misalnya, Anda mungkin ingin membuat pengontrol yang menangani permintaan HTTP terkait "foto" yang disimpan oleh aplikasi Anda. Menggunakan make:controllerperintah Artisan, kita dapat dengan cepat membuat pengontrol seperti itu:

```java
php artisan make:controller PhotoController --resource
```

Perintah Artisan akan menghasilkan file pengontrol di app/Http/Controllers/PhotoController.php. Kontroler akan berisi metode untuk setiap operasi sumber daya yang tersedia.

Selanjutnya, Anda dapat mendaftarkan rute sumber daya ke controller:
```java
Route::resource('photo', 'PhotoController');
```
Deklarasi rute tunggal ini membuat beberapa rute untuk menangani berbagai tindakan RESTful pada sumber daya foto. Demikian juga, pengontrol yang dihasilkan akan memiliki metode yang dimatikan untuk setiap tindakan ini, termasuk catatan yang memberi tahu Anda URI dan kata kerja mana yang mereka tangani.
```java
Tindakan yang Ditangani Oleh Pengontrol Sumber Daya
Kata kerja	jalan	   Tindakan	            Nama Rute
DAPATKAN	/photo	 indeks	                foto.index
DAPATKAN	/photo /createmembuat	        foto.buat
POS	/photo	toko    foto.toko
DAPATKAN	/photo/ {photo}	menunjukkan	    foto.tampilkan
DAPATKAN	/photo/ {photo}/edit	edit	foto.edit
PUT/PATCH	/photo/{photo}	memperbarui	    foto.update
MENGHAPUS	/photo/{photo}	menghancurkan	foto.hancurkan
```
---
Ingat, karena formulir HTML tidak dapat membuat permintaan PUT, PATCH, atau DELETE, Anda perlu menambahkan _methodbidang tersembunyi untuk menipu kata kerja HTTP ini:
```java
<input type="hidden" name="_method" value="PUT">
```
### Rute Sumber Daya Sebagian
Saat mendeklarasikan rute sumber daya, Anda dapat menentukan subset tindakan untuk ditangani pada rute:

```java
Route::resource('photo', 'PhotoController', ['only' => [
    'index', 'show'
]]);

Route::resource('photo', 'PhotoController', ['except' => [
    'create', 'store', 'update', 'destroy'
]]);
```
### Penamaan Rute Sumber Daya
Secara default, semua tindakan pengontrol sumber daya memiliki nama rute; namun, Anda dapat mengganti nama-nama ini dengan melewatkan namesarray dengan opsi Anda:
```java
Route::resource('photo', 'PhotoController', ['names' => [
    'create' => 'photo.build'
]]);
```
### Penamaan Parameter Rute Sumber Daya
Secara default, Route::resourceakan membuat parameter rute untuk rute sumber daya Anda berdasarkan nama sumber daya. Anda dapat dengan mudah mengganti ini berdasarkan per sumber daya dengan meneruskan parametersarray opsi. The parametersArray harus array asosiatif nama sumber daya dan nama parameter:
```java
Route::resource('user', 'AdminUserController', ['parameters' => [
    'user' => 'admin_user'
]]);
```
Contoh di atas menghasilkan URI berikut untuk rute sumber daya show:
---
```java
/user/{admin_user}
Alih-alih meneruskan array nama parameter, Anda juga dapat dengan mudah meneruskan kata singularuntuk menginstruksikan Laravel menggunakan nama parameter default, tetapi "singularisasikan" mereka:

Route::resource('users.photos', 'PhotoController', [
    'parameters' => 'singular'
]);

// /users/{user}/photos/{photo}
Atau, Anda dapat menyetel parameter rute sumber daya menjadi singular global atau menetapkan pemetaan global untuk nama parameter sumber daya Anda:

Route::singularResourceParameters();

Route::resourceParameters([
    'user' => 'person', 'photo' => 'image'
]);
```

Saat menyesuaikan parameter sumber daya, penting untuk mengingat prioritas penamaan:
Parameter secara eksplisit diteruskan ke Route::resource.
Pemetaan parameter global diatur melalui Route::resourceParameters.
The singularpengaturan lulus melalui parametersarray untuk Route::resourceatau set via Route::singularResourceParameters.
Perilaku bawaan.
Melengkapi Pengontrol Sumber Daya
Jika perlu untuk menambahkan rute tambahan ke pengontrol sumber daya di luar rute sumber daya default, Anda harus menentukan rute tersebut sebelum panggilan Anda ke Route::resource; jika tidak, rute yang ditentukan oleh resourcemetode mungkin secara tidak sengaja lebih diutamakan daripada rute tambahan Anda:
```java
Route::get('photos/popular', 'PhotoController@method');

Route::resource('photos', 'PhotoController');
```
-----
### Injeksi & Pengontrol Ketergantungan
Injeksi Konstruktor
Wadah layanan Laravel digunakan untuk menyelesaikan semua pengontrol Laravel. Akibatnya, Anda dapat mengetik-petunjuk dependensi apa pun yang mungkin diperlukan pengontrol Anda di konstruktornya. Ketergantungan akan secara otomatis diselesaikan dan disuntikkan ke instance pengontrol:
```java
<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;

class UserController extends Controller
{
    /**
     * The user repository instance.
     */
    protected $users;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }
}
```
Tentu saja, Anda juga dapat mengetik-petunjuk kontrak Laravel apa pun . Jika wadah dapat menyelesaikannya, Anda dapat mengetik-petunjuknya.
### Pengantar
Metode Injeksi
Selain injeksi konstruktor, Anda juga dapat mengetikkan dependensi petunjuk pada metode tindakan pengontrol Anda. Sebagai contoh, mari kita ketik-petunjuk Illuminate\Http\Requestpada salah satu metode kita:

```java
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $name = $request->input('name');

        //
    }
}
```
Jika metode pengontrol Anda juga mengharapkan input dari parameter rute, cukup cantumkan argumen rute Anda setelah dependensi Anda yang lain. Misalnya, jika rute Anda didefinisikan seperti ini:
```java
Route::put('user/{id}', 'UserController@update');
```
Anda masih dapat mengetik-petunjuk Illuminate\Http\Requestdan mengakses parameter rute Anda iddengan mendefinisikan metode pengontrol Anda seperti berikut:
```java
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Update the specified user.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
```
### Caching Rute
Catatan: Caching rute tidak berfungsi dengan rute berbasis Penutupan. Untuk menggunakan cache rute, Anda harus mengonversi rute Penutupan apa pun untuk menggunakan kelas pengontrol.

Jika aplikasi Anda secara eksklusif menggunakan rute berbasis pengontrol, Anda harus memanfaatkan cache rute Laravel. Menggunakan cache rute akan secara drastis mengurangi jumlah waktu yang diperlukan untuk mendaftarkan semua rute aplikasi Anda. Dalam beberapa kasus, pendaftaran rute Anda bahkan bisa mencapai 100x lebih cepat! Untuk menghasilkan cache rute, cukup jalankan route:cacheperintah Artisan:

```java
php artisan route:cache
```
Itu saja! File rute cache Anda sekarang akan digunakan sebagai ganti app/Http/routes.phpfile Anda . Ingat, jika Anda menambahkan rute baru, Anda perlu membuat cache rute baru. Karena itu, Anda hanya boleh menjalankan route:cacheperintah selama penerapan proyek Anda.

Untuk menghapus file rute yang di-cache tanpa membuat cache baru, gunakan route:clearperintah:
```java
php artisan route:clear
```