## Pengantar

Paginator Laravel terintegrasi dengan query builder dan Eloquent ORM dan menyediakan pagination record database yang nyaman dan mudah digunakan tanpa konfigurasi nol.

Secara default, HTML yang dihasilkan oleh paginator kompatibel dengan framework Tailwind CSS ; namun, dukungan pagination Bootstrap juga tersedia.
## Penggunaan Dasar
### Membuat Paginasi Hasil Query Builder
Ada beberapa cara untuk membuat halaman item. Yang paling sederhana adalah dengan menggunakan **paginate** metode pada query builder atau query Eloquent . **paginate** Metode otomatis menangani pengaturan queri "batas" dan "offset" berdasarkan pada halaman saat ini sedang dilihat oleh pengguna. Secara default, halaman saat ini dideteksi oleh nilai **page** argumen string queri pada permintaan HTTP. Nilai ini secara otomatis terdeteksi oleh Laravel, dan juga secara otomatis dimasukkan ke dalam tautan yang dihasilkan oleh paginator.

Dalam contoh ini, satu-satunya argumen yang diteruskan ke **paginate** metode adalah jumlah item yang ingin Anda tampilkan "per halaman". Dalam hal ini, mari kita tentukan bahwa kita ingin menampilkan 15 item per halaman:
```java
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Show all of the users for the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index', [
            'users' => DB::table('users')->paginate(15)
        ]);
    }
}
```
### paginasi sederhana
Metode **paginate** menghitung jumlah total catatan cocok dengan queri sebelum mengambil catatan dari database. Hal ini dilakukan agar paginator mengetahui jumlah halaman record yang ada secara total. Namun, jika Anda tidak berencana untuk menampilkan jumlah total halaman di UI aplikasi Anda, maka queri penghitungan catatan tidak diperlukan.

Oleh karena itu, jika Anda hanya perlu menampilkan tautan "Berikutnya" dan "Sebelumnya" sederhana di UI aplikasi, Anda dapat menggunakan **simplePaginate** metode ini untuk melakukan kueri tunggal yang efisien:
```java
$users = DB::table('users')->simplePaginate(15);
```
### Membuat Paginasi Hasil Fasih
Dalam contoh ini, kami akan membuat halaman **App\Models\User** model dan menunjukkan bahwa kami berencana untuk menampilkan 15 catatan per halaman. Seperti yang Anda lihat, sintaksnya hampir identik dengan membuat halaman hasil query builder:
```java
use App\Models\User;

$users = User::paginate(15);
```
Tentu saja, Anda dapat memanggil **paginate** metode setelah menetapkan batasan lain pada kueri, seperti **where** klausa:
```java
$users = User::where('votes', '>', 100)->paginate(15);
```
Anda juga dapat menggunakan **simplePaginate** metode ini saat membuat paginasi model Eloquent:
```java
$users = User::where('votes', '>', 100)->simplePaginate(15);
```
Demikian pula, Anda dapat menggunakan **cursorPaginate** metode untuk membuat kursor paginasi model Eloquent:
```java
$users = User::where('votes', '>', 100)->cursorPaginate(15);
```
### Paginasi Kursor
Sementara **paginate** dan **simplePaginate** membuat kueri menggunakan klausa "offset" SQL, paginasi kursor bekerja dengan membuat klausa "di mana" yang membandingkan nilai kolom terurut yang terdapat dalam kueri, memberikan kinerja database paling efisien yang tersedia di antara semua metode paginasi Laravel. Metode pagination ini sangat cocok untuk kumpulan data besar dan antarmuka pengguna scrolling "tak terbatas".

Tidak seperti pagination berbasis offset, yang menyertakan nomor halaman dalam string kueri URL yang dihasilkan oleh paginator, pagination berbasis kursor menempatkan string "kursor" dalam string kueri. Kursor adalah string yang disandikan yang berisi lokasi kueri paginasi berikutnya harus memulai penomoran halaman dan arah yang harus dipaginasi:
```java
http://localhost/users?cursor=eyJpZCI6MTUsIl9wb2ludHNUb05leHRJdGVtcyI6dHJ1ZX0
```
Anda dapat membuat instance paginator berbasis kursor melalui **cursorPaginate** metode yang ditawarkan oleh pembuat kueri. Metode ini mengembalikan sebuah instance dari **Illuminate\Pagination\CursorPaginator**:
```java
$users = DB::table('users')->orderBy('id')->cursorPaginate(15);
```
Setelah Anda mengambil instance paginator kursor, Anda dapat menampilkan hasil pagination seperti biasanya saat menggunakan metode **paginate** and **simplePaginate**. Untuk informasi lebih lanjut tentang metode instans yang ditawarkan oleh kursor paginator, silakan lihat dokumentasi metode instans paginator kursor .

### Membuat Paginator Secara Manual
Terkadang Anda mungkin ingin membuat instance pagination secara manual, meneruskannya ke array item yang sudah Anda miliki di memori. Anda dapat melakukannya dengan membuat **Illuminate\Pagination\Paginator, Illuminate\Pagination\LengthAwarePaginator** atau **Illuminate\Pagination\CursorPaginatorinstance,** tergantung pada kebutuhan Anda.

**Paginator** dan **CursorPaginator** kelas tidak perlu tahu jumlah item di set hasil; namun, karena ini, kelas-kelas ini tidak memiliki metode untuk mengambil indeks halaman terakhir. Di **LengthAwarePaginator** menerima hampir argumen yang sama seperti Paginator; namun, ini membutuhkan hitungan jumlah total item dalam kumpulan hasil.

Dengan kata lain, **Paginator** sesuai dengan **simplePaginate** metode pada pembuat kueri, **CursorPaginator** sesuai dengan **cursorPaginate** metode, dan **LengthAwarePaginator** sesuai dengan **paginate** metode.
### Menyesuaikan URL Pagination
Secara default, tautan yang dihasilkan oleh paginator akan cocok dengan URI permintaan saat ini. Namun, metode paginator **withPath** memungkinkan Anda untuk menyesuaikan URI yang digunakan oleh paginator saat membuat tautan. Misalnya, jika Anda ingin paginator menghasilkan tautan seperti **http://example.com/admin/users?page=N,** Anda harus meneruskan **/admin/users** ke **withPath** metode:
```java
use App\Models\User;

Route::get('/users', function () {
    $users = User::paginate(15);

    $users->withPath('/admin/users');

    //
});
```
### Menambahkan Nilai String Kueri
Anda dapat menambahkan string queri tautan pagination menggunakan **appends** metode ini. Misalnya, untuk menambahkan **sort=votes** ke setiap tautan pagination, Anda harus membuat panggilan berikut ke **appends**:
```java
use App\Models\User;

Route::get('/users', function () {
    $users = User::paginate(15);

    $users->appends(['sort' => 'votes']);

    //
});
```
Anda dapat menggunakan **withQueryString** metode ini jika ingin menambahkan semua nilai string queri permintaan saat ini ke tautan pagination:
```java
$users = User::paginate(15)->withQueryString();
```
### Menambahkan Fragmen Hash
Jika Anda perlu menambahkan "fragmen hash" ke URL yang dihasilkan oleh paginator, Anda dapat menggunakan **fragment** metode ini. Misalnya, untuk menambahkan **#users** ke akhir setiap tautan pagination, Anda harus memanggil **fragment** metode seperti ini:
```java
$users = User::paginate(15)->fragment('users');
```
### Menampilkan Hasil Pagination
Saat memanggil **paginate** metode, Anda akan menerima turunan dari **Illuminate\Pagination\LengthAwarePaginator,** saat memanggil **simplePaginate** metode mengembalikan turunan dari **Illuminate\Pagination\Paginator.** Dan, akhirnya, memanggil **cursorPaginate** metode mengembalikan sebuah instance dari **Illuminate\Pagination\CursorPaginator**.

Objek-objek ini menyediakan beberapa metode yang menjelaskan kumpulan hasil. Selain metode pembantu ini, instance paginator adalah iterator dan dapat diulang sebagai array. Jadi, setelah Anda mengambil hasilnya, Anda dapat menampilkan hasilnya dan merender tautan halaman menggunakan Blade :
```java
<div class="container">
    @foreach ($users as $user)
        {{ $user->name }}
    @endforeach
</div>

{{ $users->links() }}
```
**links**Metode akan membuat link ke seluruh halaman dalam hasil set. Masing-masing tautan ini sudah akan berisi pagevariabel string kueri yang tepat . Ingat, HTML yang dihasilkan oleh linksmetode ini kompatibel dengan kerangka kerja Tailwind CSS .
## Metode Instance Paginator dan LengthAwarePaginator
Setiap instance paginator memberikan informasi pagination tambahan melalui metode berikut:
| Metode | Deskripsi |
| --- | --- |
|$paginator->count()	|Dapatkan jumlah item untuk halaman saat ini.|
|$paginator->currentPage()	|Dapatkan nomor halaman saat ini.|
|$paginator->firstItem()	|Dapatkan nomor hasil item pertama dalam hasil.|
|$paginator->getOptions()	|Dapatkan opsi paginator.|
|$paginator->getUrlRange($start, $end)	|Buat rentang URL pagination.|
|$paginator->hasPages()	|Tentukan apakah ada cukup item untuk dibagi menjadi beberapa halaman.|
|$paginator->hasMorePages()	|Tentukan apakah ada lebih banyak item di penyimpanan data.|
|$paginator->items()	|Dapatkan item untuk halaman saat ini.|
|$paginator->lastItem()	|Dapatkan nomor hasil item terakhir dalam hasil.|
|$paginator->lastPage()	|Dapatkan nomor halaman dari halaman terakhir yang tersedia. (Tidak tersedia saat menggunakan simplePaginate).|
|$paginator->nextPageUrl()	|Dapatkan URL untuk halaman berikutnya.|
|$paginator->onFirstPage()	|Tentukan apakah paginator ada di halaman pertama.|
|$paginator->perPage()	|Jumlah item yang akan ditampilkan per halaman.|
|$paginator->previousPageUrl()	|Dapatkan URL untuk halaman sebelumnya.|
|$paginator->total()	|Tentukan jumlah total item yang cocok di penyimpanan data. (Tidak tersedia saat menggunakan simplePaginate).|
|$paginator->url($page)	|Dapatkan URL untuk nomor halaman tertentu.|
|$paginator->getPageName()	|Dapatkan variabel string kueri yang digunakan untuk menyimpan halaman.|
|$paginator->setPageName($name)	|Setel variabel string kueri yang digunakan untuk menyimpan halaman.|
## Metode Instance Paginator Kursor
Setiap instance paginator kursor memberikan informasi pagination tambahan melalui metode berikut:

|metode	|Deskripsi|
|---|---|
|$paginator->count()	|Dapatkan jumlah item untuk halaman saat ini.|
|$paginator->cursor()	|Dapatkan instance kursor saat ini.|
|$paginator->getOptions()	|Dapatkan opsi paginator.|
|$paginator->hasPages()	|Tentukan apakah ada cukup item untuk dibagi menjadi beberapa halaman.|
|$paginator->hasMorePages()	|Tentukan apakah ada lebih banyak item di penyimpanan data.|
|$paginator->getCursorName()	|Dapatkan variabel string kueri yang digunakan untuk menyimpan kursor.|
|$paginator->items()	|Dapatkan item untuk halaman saat ini.|
|$paginator->nextCursor()	|Dapatkan instance kursor untuk set item berikutnya.|
|$paginator->nextPageUrl()	|Dapatkan URL untuk halaman berikutnya.|
|$paginator->onFirstPage()	|Tentukan apakah paginator ada di halaman pertama.|
|$paginator->perPage()	|Jumlah item yang akan ditampilkan per halaman.|
|$paginator->previousCursor()	|Dapatkan instance kursor untuk set item sebelumnya.|
|$paginator->previousPageUrl()	|Dapatkan URL untuk halaman sebelumnya.|
|$paginator->setCursorName()	|Atur variabel string kueri yang digunakan untuk menyimpan kursor.|
|$paginator->url($cursor)	|Dapatkan URL untuk instance kursor tertentu.|