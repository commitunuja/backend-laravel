### Pengantar
Blade adalah mesin templating sederhana namun kuat yang disertakan dengan Laravel. Tidak seperti beberapa mesin templating PHP, Blade tidak membatasi Anda untuk menggunakan kode PHP biasa di templat Anda. Faktanya, semua template Blade dikompilasi ke dalam kode PHP biasa dan di-cache sampai dimodifikasi, yang berarti Blade pada dasarnya menambahkan nol overhead ke aplikasi Anda. File template blade menggunakan **.blade.php** ekstensi file dan biasanya disimpan dalam **resources/views** direktori.

Tampilan blade dapat dikembalikan dari rute atau pengontrol menggunakan bantuan global **view**. Tentu saja, seperti yang disebutkan dalam dokumentasi pada **views** , data dapat diteruskan ke tampilan Blade menggunakan viewargumen kedua helper:
```java
Route::get('/', function () {
    return view('greeting', ['name' => 'Finn']);
});
```
### Menampilkan Data
Anda dapat menampilkan data yang diteruskan ke tampilan Blade Anda dengan membungkus variabel dalam kurung kurawal. Misalnya, diberikan rute berikut:
```java
Route::get('/', function () {
    return view('welcome', ['name' => 'Samantha']);
});
```
Anda dapat menampilkan isi namevariabel seperti ini:
```java
Hello, {{ $name }}.
```
### Tata Letak Menggunakan Warisan Template
#### Mendefinisikan Tata Letak
Tata letak juga dapat dibuat melalui "warisan template". Ini adalah cara utama membangun aplikasi sebelum pengenalan komponen .

Untuk memulai, mari kita lihat contoh sederhana. Pertama, kita akan memeriksa tata letak halaman. Karena sebagian besar aplikasi web mempertahankan tata letak umum yang sama di berbagai halaman, lebih mudah untuk mendefinisikan tata letak ini sebagai tampilan Blade tunggal:
```java
<!-- resources/views/layouts/app.blade.php -->

<html>
    <head>
        <title>App Name - @yield('title')</title>
    </head>
    <body>
        @section('sidebar')
            This is the master sidebar.
        @show

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
```
Seperti yang Anda lihat, file ini berisi mark-up HTML biasa. Namun, perhatikan **@section** dan **@yield** arahannya. **@section** direktif, seperti namanya, mendefinisikan bagian dari konten, sedangkan **@yield** direktif digunakan untuk menampilkan isi dari bagian yang diberikan.

Sekarang setelah kita mendefinisikan tata letak untuk aplikasi kita, mari kita tentukan halaman anak yang mewarisi tata letak.

#### Memperluas Tata Letak
Saat mendefinisikan tampilan anak, gunakan **@extends** arahan Blade untuk menentukan tata letak mana yang harus "diwarisi" oleh tampilan anak. Tampilan yang memperluas tata letak Blade dapat menyuntikkan konten ke bagian tata letak menggunakan **@section** arahan. Ingat, seperti yang terlihat pada contoh di atas, isi dari bagian-bagian ini akan ditampilkan dalam tata letak menggunakan **@yield**:
```java
<!-- resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <p>This is my body content.</p>
@endsection
```
Dalam contoh ini, **sidebar** bagian tersebut menggunakan **@parent** arahan untuk menambahkan (bukan menimpa) konten ke bilah sisi tata letak. **@parent** direktif akan digantikan oleh isi dari tata letak saat view dirender.
**@yield** direktif juga menerima nilai default sebagai parameter kedua. Nilai ini akan diberikan jika bagian yang dihasilkan tidak ditentukan:
```java
@yield('content', 'Default content')
```