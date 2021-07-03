### Grup Rute
Grup rute memungkinkan Anda untuk berbagi atribut rute, seperti middleware atau ruang nama, di sejumlah besar rute tanpa perlu mendefinisikan atribut tersebut pada setiap rute individu. Atribut bersama ditentukan dalam format array sebagai parameter pertama metode.$router->group

Untuk mempelajari lebih lanjut tentang grup rute, kami akan membahas beberapa kasus penggunaan umum untuk fitur tersebut.


### Middleware
Untuk menetapkan middleware ke semua rute dalam grup, Anda dapat menggunakan middlewarekunci dalam larik atribut grup. Middleware akan dieksekusi sesuai urutan Anda mendefinisikan array ini:

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/', function () {
        // Uses Auth Middleware
    });

    $router->get('user/profile', function () {
        // Uses Auth Middleware
    });
});
-----
### Perutean Subdomain
###pendahuluan
Grup rute juga dapat digunakan untuk menangani perutean subdomain. Subdomain dapat diberi parameter rute seperti halnya URI rute, memungkinkan Anda untuk menangkap sebagian subdomain untuk digunakan di rute atau pengontrol Anda. Subdomain dapat ditentukan dengan memanggil domainmetode sebelum mendefinisikan grup:

```java
Route::domain('{account}.example.com')->group(function () {
    Route::get('user/{id}', function ($account, $id) {
        //
    });
});
```
-----
### Awalan Rute
The prefixMetode dapat digunakan untuk awalan setiap rute dalam kelompok dengan URI yang diberikan. Misalnya, Anda mungkin ingin mengawali semua URI rute dalam grup dengan admin:
```java
Route::prefix('admin')->group(function () {
    Route::get('/users', function () {
        // Matches The "/admin/users" URL
    });
});
```
-----
3Awalan Nama Rute
The nameMetode dapat digunakan untuk awalan setiap nama rute dalam kelompok dengan string yang diberikan. Misalnya, Anda mungkin ingin mengawali semua nama rute yang dikelompokkan dengan admin. String yang diberikan diawali dengan nama rute persis seperti yang ditentukan, jadi kami akan memastikan untuk memberikan .karakter tambahan di awalan:
```java
Route::name('admin.')->group(function () {
    Route::get('/users', function () {
        // Route assigned name "admin.users"...
    })->name('users');
});
```