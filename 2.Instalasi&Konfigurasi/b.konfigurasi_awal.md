# KONFIGURASI AWAL
------------
 Sejatinya konfigurasi dari framework Laravel tersimpan pada direktori `config`, disana terdapat banyak sekali file konfigurasi dari framework Laravel, namun untuk konfigurasi utama dari aplikasi kita terdapat pada file `.env` yang ada pada direktori utama projek Laravel, mari kita cari tahu masing masing fungsi variabel yang ada pada file `.env`
 
  ![image](https://user-images.githubusercontent.com/79132332/124286354-0c5ed780-db79-11eb-8eba-6a55d506c209.png)

Pada bagian awal variabel dikelompokkan untuk variabel yang digunakan untuk konfigurasi aplikasi semisal nama aplikasi yang akan digunakan untuk keperluan pada _email_ biasanya, _environment_ dari aplikasi kita, kunci untuk keamanan tambahan aplikasi, status _debugging_ aplikasi, dan url dari aplikasi kita yang digunakan sebagai url utama dari tautan yang dikirim semisal dalam proses lupa password.

 ![image](https://user-images.githubusercontent.com/79132332/124286775-7b3c3080-db79-11eb-9b5d-73eba95dc6c2.png)

Bagian kedua digunakan untuk mengatur _channel_ yang digunakan untuk _logging_ 

 ![image](https://user-images.githubusercontent.com/79132332/124286990-b9d1eb00-db79-11eb-9d7d-2b466b617152.png)

Bagian ketiga ini digunakan sesuai dengan prefixnya `DB` atau `database`, bagian ini berurusan untuk mengatur koneksi `database`.

 ![image](https://user-images.githubusercontent.com/79132332/124287251-fef61d00-db79-11eb-8bcf-3dfa0c70831e.png)

Bagian empat ini mengatur beberapa kebutuhan sekaligus _driver_ untuk _broadcast, driver cache_, koneksi untuk _queue_ dan _session_. 

 ![image](https://user-images.githubusercontent.com/79132332/124287357-1cc38200-db7a-11eb-941e-51cb29c60a4d.png)

Bagian kelima khusus untuk setelan redis.

 ![image](https://user-images.githubusercontent.com/79132332/124287523-51cfd480-db7a-11eb-94bd-02b1a9a66a33.png)

Bagian keenam berurusan dengan setelan _email_, digunakan untuk setelan berkirim _email_ dari aplikasi Laravel kita. 

 ![image](https://user-images.githubusercontent.com/79132332/124287651-76c44780-db7a-11eb-854c-ad1469bfe8cc.png)

Bagian ketujuh digunakan untuk mengatur setelan dari penyimpanan pada server _AWS ( Amazon Web Services )_.

 ![image](https://user-images.githubusercontent.com/79132332/124287737-922f5280-db7a-11eb-94c4-9650bec562a5.png)

Bagian terakhir berurusan dengan _pusher_ yang biasa digunakan untuk aplikasi _realtime_.

 ![image](https://user-images.githubusercontent.com/79132332/124287831-ae32f400-db7a-11eb-942e-31ba7c4cac36.png)

Sekian penjelasan singkat tentang variabel yang ada di dalam file `.env`

## Sekian Terimakasih:)
