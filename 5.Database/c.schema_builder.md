### pengantar
Kelas Laravel Schemamenyediakan cara agnostik database untuk memanipulasi tabel. Ini bekerja dengan baik dengan semua database yang didukung oleh Laravel, dan memiliki API terpadu di semua sistem in

### Membuat & Menjatuhkan Tabel
Untuk membuat tabel database baru, Schema::createmetode yang digunakan:

```java
Schema::create('users', function($table)
{
    $table->increments('id');
});
```
Argumen pertama yang diteruskan ke createmetode adalah nama tabel, dan yang kedua adalah Closureyang akan menerima Blueprintobjek yang dapat digunakan untuk mendefinisikan tabel baru.

Untuk mengganti nama tabel database yang ada, renamemetode ini dapat digunakan
```java
Schema::rename($from, $to);
```

Untuk menentukan koneksi mana operasi skema harus dilakukan, gunakan Schema::connectionmetode:
```java
Schema::connection('foo')->create('users', function($table)
{
    $table->increments('id');
});
```
Untuk menjatuhkan tabel, Anda dapat menggunakan Schema::dropmetode:
```java
Schema::drop('users');
Schema::dropIfExists('users');
```

