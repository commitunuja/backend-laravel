# PENGENALAN ROUTING

  Routing digunakan untuk mengatur URL atau alamat yang bisa diakses oleh pengguna ,serta menentukan halaman mana yang akan dibuka ketika pengguna aplikasi mengakses _URI(Uniform Resorce Indentifier)_ tertentu.
  
  ![image](https://user-images.githubusercontent.com/79132332/124295319-e9392580-db82-11eb-936e-791f845c8696.png)

Didalam folder Route ,terdapat 4 file yaitu : `api.php`, `channels.php`, `console.php`, `web.php` . masing masing file digunakan untuk mengatur proses Routing,tetapi memiliki fungsi yang berbeda,yaitu:

•	`api.php` : File ini digunakan untuk membuat routing API, di dalam file ini kita juga dapat membuat core service API dengan menggunakan Laravel.

•	`channels.php` : File ini digunakan untuk membuat routing yang bersifat broadcasting event, seperti notification.

•	`console.php` : File ini digunakan untuk membuat routing command yang berjalan di terminal. Jadi kita juga bisa membuat perintah artisan kita sendiri.

•	`web.php` : File ini digunakan untuk membuat routing web biasa.

## **Metode Yang Tersedia**

Route di Laravel memungkinkan kita untuk merespon semua HTTP verb.

	Route::get($uri, $callback);
	Route::post($uri, $callback);
	Route::put($uri, $callback);
	Route::patch($uri, $callback);
	Route::delete($uri, $callback);
	Route::options($uri, $callback);
Ada waktu dimana kita butuh untuk mendaftarkan beberapa _HTTP verbs_ dalam satu _route_. Kita bisa gunakan method `match` atau `any`.

	Route::match(['get', 'post'], '/', function () {
    	//
	});

	Route::any('/', function () {
    	//
	});
	
## **Proteksi CSRF**

File HTML apa saja yang memiliki form yang berkaitan dengan method `POST`, `PUT`, `PATCH`, `DELETE` yang didefinisikan di route `web.php` maka harus menyertakan field token CSRF. Jika tidak maka request akan ditolak.

	<form method="POST" action="/userswo">
    	@csrf
    	...
	</form>

## **Basic Routing**

Menyediakan metode yang sangat sederhana dan ekspresif dalam mendefinisikan rute. Dimana Route Laravel yang paling dasar hanya menerima uri .. kita dapat menambahkan source ini ke dalam file `routes/web.php`

	Route::get('/belajar-route', function () {
    	return 'Hello World';
	});

Keterangan:

- `get` merupakan method yang diizinkan untuk menjalankan fungsi pada route.

- `‘/belajar-route’` merupakan alamat URI yang ingin diakses untuk menjalankan sebuah fungsi pada route.

- `return ‘Hello World’;` merupakan callback function yang akan dijalankan ketika suatu URI diakses dengan method yang sesuai.
Silahkan run laravel anda dan output dari hasilnya akan seperti gambar dibawah ini ..
 
 ![image](https://user-images.githubusercontent.com/79132332/124297128-f0613300-db84-11eb-917b-9702358b2897.png)


## **Route Parameters**

Terkadang saat membuat sebuah URI, kita perlu mengambil sebuah parameter yang merupakan bagian dari segmen URI dalam route kita.
Misalnya, kita mungkin perlu mengambil ID dari URI. Anda dapat melakukannya dengan menentukan parameter route .. silahkan coba tambahkan source dibawah ini ke dalam file `routes/web.php`

	Route::get('/belajar/{page}', function ($page) {
    	return "Hello, ini halaman Belajar Route ".$page;
	});

 ![image](https://user-images.githubusercontent.com/79132332/124297943-dd9b2e00-db85-11eb-816e-c3c30571892e.png)

Keterangan:

- `'/belajar/{page}'` merupakan alamat URI yang memiliki nilai parameter saat akan diakses untuk menjalankan sebuah fungsi pada route.

- `function ($page)` merupakan fungsi yang menangkap nilai dari parameter.

- `return "Hello, ini halaman Belajar Route ".$page;` merupakan callback function yang akan dijalankan ketika suatu URI diakses dengan method yang sesuai.
Namun, apabila nilai parameter tidak dimasukan .. maka page tidak akan ditemukan

![image](https://user-images.githubusercontent.com/79132332/124297981-ebe94a00-db85-11eb-9c7b-eca543e49e4c.png)

 
## **Optional Parameters**

Kita dapat menentukan nilai parameter route, tetapi menjadikan nilai parameter route tersebut opsional. Pastikan untuk memberikan variabel yang sesuai pada route sebagai nilai default
Oke, sekarang kita coba buat parameters optional .. tambahkan source ini di file `routes/web.php`

	Route::get('/belajar-optional/{page?}', function ($page=1) {
    	return "Hello, Anda sedang mengakses halaman ".$page;
	});
	
Lanjut.. jika sudah ditambahkan, silahkan di run ..

![image](https://user-images.githubusercontent.com/79132332/124298039-fe638380-db85-11eb-84a3-65c98137d455.png)


Disini kita mengakses tanpa nilai parameter

![image](https://user-images.githubusercontent.com/79132332/124298097-0e7b6300-db86-11eb-8320-f119feb22abd.png)


Disini kita mengakses dengan memasukan nilai 24 sebagai parameter

Jeng jeng .., meski nilai parameter tidak kita tambahkan pada URI, halaman tetap bisa diakses dengan menampilkan nilai parameter secara default. Nah saat kita memasukan nilai parameternya, ouputnya sesuai dengan hasil yg kita masukan.


## **Named Routes**
Route ini memungkinkan generasi URL yang mudah digunakan atau pengalihan untuk route tertentu. Kita dapat menentukan nama untuk route dengan merantai metode nama ke definisi rute.

	Route::get('example/profile', function () {
    	echo "Hello User!";
	})->name('profile');
Anda juga dapat menentukan nama route untuk tindakan pengontrol.

Route path: -

	Route::get('abc/profile', 'AccountController@nameRoute')->name('pic');

Controller path: -

	public function nameRoute()
	{
  	return "Hello World!";		
	}

## **Generating URLs To Named Routes**
Setelah kita menetapkan nama ke route tertentu, kita dapat menggunakan nama route saat membuat URL atau pengalihan melalui fungsi route global.

	$url = route('profile');
	return redirect()->route('profile');

Jika route bernama mendefinisikan parameter, Anda dapat meneruskan parameter sebagai argumen kedua ke fungsi route. Parameter yang diberikan secara otomatis akan dimasukkan ke URL di posisi yang benar.

	route::get('Admin/{id}/profile', function ($id) {
   	 $url = route('profile', ['id' => 1]);
		return "Print Always Same Result";
	})->name('profile');


**Sekian Terimakasih**
