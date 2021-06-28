KONFIGURASI AWAL
Sejatinya konfigurasi dari framework Laravel tersimpan pada direktori "conifg", disana terdapat banyak sekali file konfigurasi dari framework Laravel, namun untuk konfigurasi utama dari aplikasi kita terdapat pada file ".env" yang ada pada direktori utama projek Laravel, mari kita cari tahu masing masing fungsi variabel yang ada pada file ".env".
 
Pada bagian awal variabel dikelompokkan untuk variabel yang digunakan untuk konfigurasi aplikasi semisal nama aplikasi yang akan digunakan untuk keperluan pada email biasanya, environment dari aplikasi kita, kunci untuk keamanan tambahan aplikasi, status debugging aplikasi, dan url dari aplikasi kita yang digunakan sebagai url utama dari tautan yang dikirim semisal dalam proses lupa password.
 
Bagian kedua digunakan untuk mengatur channel yang digunakan untuk logging. 
 
Bagian ketiga ini digunakan sesuai dengan prefixnya DB atau database, bagian ini berurusan untuk mengatur koneksi database.
 
Bagian empat ini mengatur beberapa kebutuhan sekaligus driver untuk broadcast, driver cache, koneksi untuk queue dan session. 
 
Bagian kelima khusus untuk setelan redis. 
 Bagian keenam berususan dengan setelan email, digunakan untuk setelan berkirim email dari aplikasi Laravel kita. 
 
Bagian ketujuh digunakan untuk mengatur setelan dari penyimpanan pada server AWS ( Amazon Web Services ).
 
Bagian terakhir berurusan dengan pusher yang biasa digunakan untuk aplikasi realtime. 
Sekian penjelasan singkat tentang variabel yang ada di dalam file ".env".

kjdhjkhdjkhaju
