# membuat project
Software Pendukung
Untuk kebutuhan belajar ,andamemerlukan software sebagai berikut:
1.Xampp/Wampp/Lampp (disarankan support PHP 7.2.0
Download Xampp di https://www.apachefriends.org/index.html
2.Composer
Download Composer di https://code.visualstudio.com/
3.Text Editor (Visual Studio Code)
Download Visual Studio code di https://getcomposer.org/download/
PENGINSTALAN FRAMEWORK LARAVEL	
-Buka Command Prompt
-Masuk terlebih dahulu kedalam folder htdocs pada Xampp
	 
-Buka halaman https://laravel.com/docsdisini sudah tersedia semua langkah-langkah instalasi Laravel berbagai versi .
-Pilih Instalasi via composer create-project
	 
-Masukkan command diatas ke terminal anda
	 
-Pastikan PC anda telah terhubung ke internet saat proses Instalasi berlangsung
-Tunggu hingga Instalasi selesai
-Setelah Instalasi selesai ,kita akan meng-akses project yang telah dibuat.
-Pastikan actions sekaligus service Apache dan Mysql dalam Xampp sudah dalam keadaan start 
-Selanjutnya ,kita dapat meng-aksesnya di Google dengan menuliskan “localhost/kampusmerdeka/public” lalu tekan enter
-jika muncul halaman seperti berikut,maka Instalasi project anda berhasil.
	 
-Selain mengakses Laravel dengan localhost,cara kedua untuk mengakses project Laravel anda adalah dengan menggunakan perintah “php artisan”.
- buka command prompt anda,masuk ke dalam folder project yaitu “kampusmerdeka”
-lalu tuliskan perintah “php artisan serve” seperti gambar dibawah ini:
	 
-jalankan server tersebut
- jika muncul halaman seperti berikut ,maka Instalasi project anda berhasil.
	 
Struktur laravel
Berikut adalah beberapa struktur dari laravel :
•	App
Berisi kumpulan logika dan alur sistem yang akan dibuat.
•	Bootstrap
Direktori ini berisi beberapa file kerangka framework laravel termasuk autoload yang befungsi untuk mengoptimasi kinerja sistem yang dihasilkan.
•	Config
Mencakup seluruh konfigurasi framework mulai dari database, app, mail, dan lain sebagainya.
•	Database
Sebagai folder penampung file migrations dan seeds yang berhubungan langsung ke pengolahan data dalam database.
•	Public
Sebagai folder yang akan diakses oleh public/users nantinya. Folder ini juga berisi file-file assets (css/js/images/dll)
•	Resource
Folder ini berisi semua resource untuk bagian frontend.
•	Routes
Folder ini digunakan untuk menentukan format url yang digunakan untuk mengakses halaman yang dibuat
•	Storage
Berisi compiled blade templates, session, cache, logs dan file lainnya yang di-generateotomatis oleh framework.
•	Tests
Berisi semua test yang kita buat untuk aplikasi.
•	Vendor
Berisi seluruh library-library yang digunakan dalam framework laravel maupun yang diinstall melalui composer.



