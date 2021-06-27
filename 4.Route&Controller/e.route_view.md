#Lihat Rute
Jika rute Anda hanya perlu mengembalikan tampilan, Anda dapat menggunakan metode Route::view. Seperti metode redirect, metode ini menyediakan pintasan sederhana sehingga Anda tidak perlu menentukan rute atau pengontrol penuh. Metode tampilan menerima URI sebagai argumen pertama dan nama tampilan sebagai argumen kedua. Selain itu, Anda dapat memberikan larik data untuk diteruskan ke tampilan sebagai argumen ketiga opsional:
oute::view('/welcome', 'welcome');

Route::view('/welcome', 'welcome', ['name' => 'Taylor']);