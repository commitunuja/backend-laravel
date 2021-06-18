### Pengantar
Tentu saja, tidak praktis untuk mengembalikan seluruh string dokumen HTML langsung dari rute dan pengontrol Anda. Untungnya, tampilan menyediakan cara yang nyaman untuk menempatkan semua HTML kami di file terpisah. Tampilan memisahkan logika pengontrol/aplikasi Anda dari logika presentasi Anda dan disimpan dalam **resources/views** direktori. Tampilan sederhana mungkin terlihat seperti ini:
```java
<!-- View stored in resources/views/greeting.blade.php -->

<html>
    <body>
        <h1>Hello, {{ $name }}</h1>
    </body>
</html>
```
Karena tampilan ini disimpan di **resources/views/greeting.blade.php**, kami dapat mengembalikannya menggunakan bantuan global **view** seperti:
```java
Route::get('/', function () {
    return view('greeting', ['name' => 'James']);
});
```
### Membuat & Merender Tampilan
Anda dapat membuat tampilan dengan menempatkan file dengan **.blade.php** ekstensi di **resources/views** direktori aplikasi Anda . **.blade.php** ekstensi menginformasikan kerangka bahwa file berisi template yang pisau . Template Blade berisi HTML serta arahan Blade yang memungkinkan Anda untuk dengan mudah menggemakan nilai, membuat pernyataan "jika", mengulangi data, dan banyak lagi.

Setelah Anda membuat tampilan, Anda dapat mengembalikannya dari salah satu rute atau pengontrol aplikasi Anda menggunakan bantuan global **view**:
```java
Route::get('/', function () {
    return view('greeting', ['name' => 'James']);
});
```
Tampilan juga dapat dikembalikan menggunakan **View** fasad:
```java
use Illuminate\Support\Facades\View;

return View::make('greeting', ['name' => 'James']);
```
Seperti yang Anda lihat, argumen pertama yang diteruskan ke **view** helper sesuai dengan nama file tampilan di **resources/views** direktori. Argumen kedua adalah larik data yang harus tersedia untuk tampilan. Dalam hal ini, kami meneruskan **name** variabel, yang ditampilkan dalam tampilan menggunakan *sintaks Blade* .

### Direktori Tampilan Bersarang
Tampilan juga dapat disarangkan dalam subdirektori **resources/views** direktori. Notasi "Titik" dapat digunakan untuk mereferensikan tampilan bersarang. Misalnya, jika tampilan Anda disimpan di **resources/views/admin/profile.blade.php**, Anda dapat mengembalikannya dari salah satu rute/pengontrol aplikasi Anda seperti:
```java
return view('admin.profile', $data);
```
### Membuat Tampilan Pertama yang Tersedia
Menggunakan metode **View** fasad **first**, Anda dapat membuat tampilan pertama yang ada dalam array tampilan tertentu. Ini mungkin berguna jika aplikasi atau paket Anda memungkinkan tampilan dikustomisasi atau ditimpa:
```java
use Illuminate\Support\Facades\View;

return View::first(['custom.admin', 'admin'], $data);
```
### Menentukan Jika Sebuah View Ada
Jika Anda perlu menentukan apakah ada pemandangan, Anda dapat menggunakan **View** fasad. **exists** Metode akan kembali **true** jika tampilan ada:
```java
use Illuminate\Support\Facades\View;

if (View::exists('emails.customer')) {
    //
}
```

### Berbagi Data Dengan Semua Tampilan
Terkadang, Anda mungkin perlu berbagi data dengan semua tampilan yang dirender oleh aplikasi Anda. Anda dapat melakukannya dengan menggunakan metode **View** fasad **share**. Biasanya, Anda harus melakukan panggilan ke **share** metode dalam metode penyedia layanan **boot**. Anda bebas menambahkannya ke **App\Providers\AppServiceProvider** kelas atau membuat penyedia layanan terpisah untuk menampungnya:
```java
<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;

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
        View::share('key', 'value');
    }
}
```
### View Komposer
View composer adalah callback atau metode kelas yang dipanggil saat tampilan dirender. Jika Anda memiliki data yang ingin Anda ikat ke tampilan setiap kali tampilan tersebut dirender, penyusun tampilan dapat membantu Anda mengatur logika tersebut ke dalam satu lokasi. View composer mungkin terbukti sangat berguna jika tampilan yang sama dikembalikan oleh beberapa rute atau pengontrol dalam aplikasi Anda dan selalu membutuhkan bagian data tertentu.

Biasanya, penyusun tampilan akan didaftarkan dalam salah satu penyedia layanan aplikasi Anda . Dalam contoh ini, kita akan berasumsi bahwa kita telah membuat yang baru **App\Providers\ViewServiceProvider** untuk menampung logika ini.

Kami akan menggunakan metode **View** fasad **composer** untuk mendaftarkan view composer. Laravel tidak menyertakan direktori default untuk penyusun tampilan berbasis kelas, jadi Anda bebas mengaturnya sesuka Anda. Misalnya, Anda dapat membuat **app/Http/View/Composers** direktori untuk menampung semua penyusun tampilan aplikasi Anda:
```java
<?php

namespace App\Providers;

use App\Http\View\Composers\ProfileComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        // Using class based composers...
        View::composer('profile', ProfileComposer::class);

        // Using closure based composers...
        View::composer('dashboard', function ($view) {
            //
        });
    }
}
```
Sekarang setelah kita mendaftarkan komposer, **compose** metode **App\Http\View\Composers\ProfileComposer** kelas akan dieksekusi setiap kali **profile** tampilan dirender. Mari kita lihat contoh kelas komposer:
```java
<?php

namespace App\Http\View\Composers;

use App\Repositories\UserRepository;
use Illuminate\View\View;

class ProfileComposer
{
    /**
     * The user repository implementation.
     *
     * @var \App\Repositories\UserRepository
     */
    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param  \App\Repositories\UserRepository  $users
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        // Dependencies are automatically resolved by the service container...
        $this->users = $users;
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('count', $this->users->count());
    }
}
```
Seperti yang Anda lihat, semua view composer diselesaikan melalui service container , jadi Anda dapat mengetik-petunjuk dependensi apa pun yang Anda perlukan dalam konstruktor composer.

### Melampirkan Komposer Ke Beberapa Tampilan
Anda dapat melampirkan penyusun tampilan ke beberapa tampilan sekaligus dengan meneruskan array tampilan sebagai argumen pertama ke **composer**metode:
```java
use App\Http\Views\Composers\MultiComposer;

View::composer(
    ['profile', 'dashboard'],
    MultiComposer::class
);
```
**composer** Metode juga menerima (*)karakter sebagai wildcard, yang memungkinkan Anda untuk melampirkan komposer untuk semua pandangan:
```java
View::composer('*', function ($view) {
    //
});
```
### View creators
View "creators" sangat mirip dengan view composer; namun, mereka dieksekusi segera setelah tampilan dipakai alih-alih menunggu hingga tampilan akan dirender. Untuk mendaftarkan pembuat tampilan, gunakan **creator** metode:
```java
use App\Http\View\Creators\ProfileCreator;
use Illuminate\Support\Facades\View;

View::creator('profile', ProfileCreator::class);
```
### Mengoptimalkan Tampilan
Secara default, tampilan template Blade dikompilasi sesuai permintaan. Saat permintaan dieksekusi yang membuat tampilan, Laravel akan menentukan apakah ada versi tampilan yang dikompilasi. Jika file tersebut ada, Laravel kemudian akan menentukan apakah tampilan yang tidak dikompilasi telah dimodifikasi lebih baru daripada tampilan yang dikompilasi. Jika tampilan yang dikompilasi tidak ada, atau tampilan yang tidak dikompilasi telah dimodifikasi, Laravel akan mengkompilasi ulang tampilan.

Mengkompilasi tampilan selama permintaan mungkin memiliki dampak negatif kecil pada kinerja, jadi Laravel menyediakan **view:cache** perintah Artisan untuk mengkompilasi semua tampilan yang digunakan oleh aplikasi Anda. Untuk meningkatkan kinerja, Anda mungkin ingin menjalankan perintah ini sebagai bagian dari proses penerapan Anda:
```java
php artisan view:cache
```
Anda dapat menggunakan **view:clear** perintah untuk menghapus cache tampilan:
```java
php artisan view:clear
```