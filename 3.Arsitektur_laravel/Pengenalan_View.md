# PENGENALAN VIEW

Views adalah representasi visual dari suatu aplikasi. Pada bagian ini memiliki fungsi untuk menyajikan data yang diterima oleh Controller dari Model.  Atau dalam kata lain Views adalah bagian dari sistem di mana HTML dihasilkan dan kemudian ditampilkan.

View bisa dibilang merupakan informasi yang ditampilkan kepada pengunjung aplikasi. Dan sesusai dengan konsep MVC, sebisa mungkin didalam View tidak berisi logika-logika kode tetapi hanya berisi variabel-variabel yang berisi data yang siap ditampilkan. View bisa dibilang adalah halaman aplikasi yang dibuat menggunakan HTML dengan bantuan CSS atau JavaScript. Didalam view sebaiknya jangan ada kode untuk melakukan koneksi ke basis data.


Contoh penggunaan view dalam file Routes:

	Route::get('/halamanku', function()
	{
	return View::make('halamanku');
	});


Lalu buatlah file “halamanku.php” dan simpan di `app/views/halamanku.php` dengan isi:

	<html>
	<body>
	<h1>Halo</h1>
	Selamat datang di Aplikasi Laravel Saya<br>
	baru belajar nih, semangat!!
	</body>
	</html>

Cek kembali route `http:// localhost/kampusmerdeka/halamanku` dan hasilnya, tetap sama. Yang berubah adalah logicnya, sekarang kita memindahkan logic untuk menampilkan html ke file view terpisah. `View::make` pada routes akan mengarahkan ke `halaman/view` “halamanku.php”


**Sekian Terimakasih**
