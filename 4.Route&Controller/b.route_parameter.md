#Perutean Dasar
Anda akan menentukan sebagian besar rute untuk aplikasi Anda dalam app/Http/routes.phpfile, yang dimuat oleh App\Providers\RouteServiceProviderkelas. Rute Laravel paling dasar hanya menerima URI dan Closure:

Rute GET Dasar
Route::get('/', function()
{
    return 'Hello World';
});
Rute Dasar Lainnya
Route::post('foo/bar', function()
{
    return 'Hello World';
});

Route::put('foo/bar', function()
{
    //
});

Route::delete('foo/bar', function()
{
    //
});
Mendaftarkan Rute Untuk Beberapa Kata Kerja
Route::match(['get', 'post'], '/', function()
{
    return 'Hello World';
});
Mendaftarkan Rute yang Merespons Semua Kata Kerja HTTP
Route::any('foo', function()
{
    return 'Hello World';
});
Seringkali, Anda perlu membuat URL ke rute Anda, Anda dapat melakukannya menggunakan urlhelper:

$url = url('foo')
----
#Perlindungan CSRF
Laravel memudahkan untuk melindungi aplikasi Anda dari pemalsuan permintaan lintas situs . Pemalsuan permintaan lintas situs adalah jenis eksploitasi berbahaya di mana perintah yang tidak sah dilakukan atas nama pengguna yang diautentikasi.

Laravel secara otomatis menghasilkan "token" CSRF untuk setiap sesi pengguna aktif yang dikelola oleh aplikasi. Token ini digunakan untuk memverifikasi bahwa pengguna yang diautentikasi adalah orang yang benar-benar membuat permintaan ke aplikasi.

Masukkan Token CSRF Ke Dalam Formulir
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
Tentu saja, menggunakan mesin templating Blade :

<input type="hidden" name="_token" value="{{ csrf_token() }}">
Anda tidak perlu memverifikasi token CSRF secara manual pada permintaan POST, PUT, atau DELETE. The VerifyCsrfToken HTTP middleware akan memverifikasi token input permintaan cocok token disimpan dalam sesi.

X-CSRF-TOKEN
Selain mencari token CSRF sebagai parameter "POST", middleware juga akan memeriksa X-CSRF-TOKENheader permintaan. Anda dapat, misalnya, menyimpan token dalam tag "meta" dan menginstruksikan jQuery untuk menambahkannya ke semua header permintaan:

<meta name="csrf-token" content="{{ csrf_token() }}" />

$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
Sekarang semua permintaan AJAX akan secara otomatis menyertakan token CSRF:

$.ajax({
   url: "/foo/bar",
})
X-XSRF-TOKEN
Laravel juga menyimpan token CSRF dalam XSRF-TOKENcookie. Anda dapat menggunakan nilai cookie untuk mengatur X-XSRF-TOKENheader permintaan. Beberapa kerangka kerja JavaScript, seperti Angular, melakukan ini secara otomatis untuk Anda.

Catatan: Perbedaan antara X-CSRF-TOKENdan X-XSRF-TOKENadalah bahwa yang pertama menggunakan nilai teks biasa dan yang terakhir menggunakan nilai terenkripsi, karena cookie di Laravel selalu dienkripsi. Jika Anda menggunakan csrf_token()fungsi untuk memberikan nilai token, Anda mungkin ingin menggunakan X-CSRF-TOKENheader.
-----
#Metode Spoofing
Formulir HTML tidak mendukung PUT, PATCHatau DELETEtindakan. Jadi, saat mendefinisikan PUT, PATCHatau DELETErute yang dipanggil dari formulir HTML, Anda perlu menambahkan _methodbidang tersembunyi ke formulir.

Nilai yang dikirim dengan _methodbidang akan digunakan sebagai metode permintaan HTTP. Sebagai contoh:

<form action="/foo/bar" method="POST">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
</form>

#Parameter Rute
Tentu saja, Anda dapat menangkap segmen URI permintaan dalam rute Anda:

Parameter Rute Dasar
Route::get('user/{id}', function($id)
{
    return 'User '.$id;
});
Catatan: Parameter rute tidak boleh berisi -karakter. Gunakan garis bawah ( _) sebagai gantinya.

Parameter Rute Opsional
Route::get('user/{name?}', function($name = null)
{
    return $name;
});
Parameter Rute Opsional Dengan Nilai Default
Route::get('user/{name?}', function($name = 'John')
{
    return $name;
});
Batasan Parameter Ekspresi Reguler
Route::get('user/{name}', function($name)
{
    //
})
->where('name', '[A-Za-z]+');

Route::get('user/{id}', function($id)
{
    //
})
->where('id', '[0-9]+');
Melewati Array Kendala
Route::get('user/{id}/{name}', function($id, $name)
{
    //
})
->where(['id' => '[0-9]+', 'name' => '[a-z]+']);
Mendefinisikan Pola Global
Jika Anda ingin parameter rute selalu dibatasi oleh ekspresi reguler yang diberikan, Anda dapat menggunakan patternmetode ini. Anda harus mendefinisikan pola-pola ini dalam bootmetode Anda RouteServiceProvider:

$router->pattern('id', '[0-9]+');
Setelah pola ditentukan, itu diterapkan ke semua rute menggunakan parameter itu:

Route::get('user/{id}', function($id)
{
    // Only called if {id} is numeric.
});
Mengakses Nilai Parameter Rute
Jika Anda perlu mengakses nilai parameter rute di luar rute, gunakan inputmetode:

if ($route->input('id') == 1)
{
    //
}
Anda juga dapat mengakses parameter rute saat ini melalui Illuminate\Http\Requestinstans. Contoh permintaan untuk permintaan saat ini dapat diakses melalui Requestfasad, atau dengan mengetikkan petunjuk di Illuminate\Http\Requestmana dependensi disuntikkan:

use Illuminate\Http\Request;

Route::get('user/{id}', function(Request $request, $id)
{
    if ($request->route('id'))
    {
        //
    }
});
#Rute Bernama
Rute bernama memungkinkan Anda menghasilkan URL atau pengalihan untuk rute tertentu dengan mudah. Anda dapat menentukan nama untuk rute dengan askunci array:

Route::get('user/profile', ['as' => 'profile', function()
{
    //
}]);
Anda juga dapat menentukan nama rute untuk tindakan pengontrol:

Route::get('user/profile', [
    'as' => 'profile', 'uses' => 'UserController@showProfile'
]);
Sekarang, Anda dapat menggunakan nama rute saat membuat URL atau pengalihan:

$url = route('profile');

$redirect = redirect()->route('profile');
The currentRouteNameMetode mengembalikan nama dari rute penanganan permintaan saat ini:

$name = Route::currentRouteName();

#Grup Rute
Terkadang banyak rute Anda akan berbagi persyaratan umum seperti segmen URL, middleware, namespace, dll. Daripada menentukan setiap opsi ini pada setiap rute secara individual, Anda dapat menggunakan grup rute untuk menerapkan atribut ke banyak rute.

Atribut bersama ditentukan dalam format array sebagai parameter pertama Route::groupmetode

#Middleware
Middleware diterapkan ke semua rute dalam grup dengan mendefinisikan daftar middleware dengan middlewareparameter pada larik atribut grup. Middleware akan dieksekusi sesuai urutan Anda mendefinisikan array ini:

Route::group(['middleware' => ['foo', 'bar']], function()
{
    Route::get('/', function()
    {
        // Has Foo And Bar Middleware
    });

    Route::get('user/profile', function()
    {
        // Has Foo And Bar Middleware
    });

});

#Ruang nama
Anda dapat menggunakan namespaceparameter dalam larik atribut grup Anda untuk menentukan namespace untuk semua pengontrol dalam grup:

Route::group(['namespace' => 'Admin'], function()
{
    // Controllers Within The "App\Http\Controllers\Admin" Namespace

    Route::group(['namespace' => 'User'], function()
    {
        // Controllers Within The "App\Http\Controllers\Admin\User" Namespace
    });
});
Catatan: Secara default, RouteServiceProvidermenyertakan routes.phpfile Anda dalam grup namespace, memungkinkan Anda untuk mendaftarkan rute pengontrol tanpa menentukan App\Http\Controllersawalan namespace lengkap 
#Perutean Sub-Domain
Rute Laravel juga menangani sub-domain wildcard, dan akan meneruskan parameter wildcard Anda dari domain:

Mendaftarkan Rute Sub-Domain
Route::group(['domain' => '{account}.myapp.com'], function()
{

    Route::get('user/{id}', function($account, $id)
    {
        //
    });

});

#Awalan Rute
Sekelompok rute dapat diawali dengan menggunakan prefixopsi dalam larik atribut grup:

Route::group(['prefix' => 'admin'], function()
{
    Route::get('users', function()
    {
        // Matches The "/admin/users" URL
    });
});
Anda juga dapat menggunakan prefixparameter untuk meneruskan parameter umum ke rute Anda:
Mendaftarkan parameter URL di awalan rute
Route::group(['prefix' => 'accounts/{account_id}'], function()
{
    Route::get('detail', function($account_id)
    {
        //
    });
});
Anda bahkan dapat menentukan batasan parameter untuk parameter bernama di awalan Anda:

Route::group([
    'prefix' => 'accounts/{account_id}',
    'where' => ['account_id' => '[0-9]+'],
], function() {

    // Define Routes Here
});
----
#Pengikatan Model Rute
Pengikatan model Laravel menyediakan cara mudah untuk menyuntikkan instance kelas ke dalam rute Anda. Misalnya, alih-alih menyuntikkan ID pengguna, Anda dapat menyuntikkan seluruh instance kelas Pengguna yang cocok dengan ID yang diberikan.

Pertama, gunakan metode router modeluntuk menentukan kelas untuk parameter yang diberikan. Anda harus mendefinisikan binding model Anda dalam RouteServiceProvider::bootmetode:

Mengikat Parameter Ke Model
public function boot(Router $router)
{
    parent::boot($router);

    $router->model('user', 'App\User');
}
Selanjutnya, tentukan rute yang berisi {user}parameter:

Route::get('profile/{user}', function(App\User $user)
{
    //
});
Karena kita telah mengikat {user}parameter ke App\Usermodel, sebuah Userinstance akan disuntikkan ke dalam rute. Jadi, misalnya, permintaan untuk profile/1akan menyuntikkan Userinstance yang memiliki ID 1.

Catatan: Jika contoh model yang cocok tidak ditemukan dalam database, kesalahan 404 akan muncul.

Jika Anda ingin menentukan perilaku "tidak ditemukan" Anda sendiri, berikan Penutupan sebagai argumen ketiga ke modelmetode:

Route::model('user', 'User', function()
{
    throw new NotFoundHttpException;
});
Jika Anda ingin menggunakan logika resolusi Anda sendiri, Anda harus menggunakan Route::bindmetode ini. Penutupan yang Anda berikan ke bindmetode akan menerima nilai segmen URI, dan harus mengembalikan instance kelas yang ingin Anda masukkan ke dalam rute:

Route::bind('user', function($value)
{
    return User::where('name', $value)->first();
});

#Melempar 404 Kesalahan
Ada dua cara untuk memicu kesalahan 404 secara manual dari suatu rute. Pertama, Anda dapat menggunakan abortpembantu:

abort(404);
The abortpembantu hanya melemparkan Symfony\Component\HttpKernel\Exception\HttpExceptiondengan kode status tertentu.

Kedua, Anda dapat secara manual membuang instance Symfony\Component\HttpKernel\Exception\NotFoundHttpException.