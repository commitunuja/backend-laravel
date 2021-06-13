### Soft Deletes

Soft deletes adalah fitur dari laravel untuk membuat penghapusan data sementara. kita bisa menghapus data pada table, tapi data tersebut tidak benar-benar langsung dihapus, masi tersimpan dalam table tapi tidak tampil lagi.

misalnya, ibaratnya kita bisa memasukkan data ke tong sampah. seperti recycle bin misalnya jika OS windows. Nah, data yang sudah kita masukkan ke tong sampah tersebut bisa kita tampilkan kembali atau bisa juga kita hapus secara permanen. 

Selain benar-benar menghapus catatan dari database Anda, Eloquent juga dapat "menghapus lunak" model. Saat model dihapus sementara, mereka tidak benar-benar dihapus dari database Anda. Sebaliknya, **deleted_at** atribut diatur pada model dan dimasukkan ke dalam database. 

Jika model memiliki nilai bukan nol **deleted_at**, model telah dihapus sementara. Untuk mengaktifkan penghapusan lunak untuk model, gunakan **Illuminate\Database\Eloquent\SoftDeletessifat** pada model dan tambahkan **deleted_at** kolom ke **$dates** properti Anda :

```java 
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flight extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}
```
Anda juga harus menambahkan **deleted_at** kolom ke tabel database Anda. *Pembuat skema* Laravel berisi metode pembantu untuk membuat kolom ini:

```java
Schema::table('flights', function (Blueprint $table) {
    $table->softDeletes();
});
```
Sekarang, ketika Anda memanggil **delete** metode pada model, **deleted_at** kolom akan diatur ke tanggal dan waktu saat ini. Dan, saat mengqueri model yang menggunakan soft deletes, model yang dihapus sementara akan secara otomatis dikeluarkan dari semua hasil queri.

Untuk menentukan apakah instance model tertentu telah dihapus sementara, gunakan **trashed** metode:
```java
if ($flight->trashed()) {
    //
}
```

###Including Soft Deleted Models

Seperti disebutkan di atas, model yang dihapus sementara akan secara otomatis dikeluarkan dari hasil queri. Namun, Anda dapat memaksa model yang dihapus sementara untuk muncul di kumpulan hasil menggunakan **withTrashed** metode pada queri:

```java
$flights = App\Flight::withTrashed()
                ->where('account_id', 1)
                ->get();
```

Di **withTrashed** Metode ini juga dapat digunakan pada hubungan query:

```java
$flight->history()->withTrashed()->get();
```

### Retrieving Only Soft Deleted Models

**onlyTrashed** Metode akan mengambil hanya soft deletes:

```java
$flights = App\Flight::onlyTrashed()
                ->where('airline_id', 1)
                ->get();
```

### Restoring Soft Deleted Models

Untuk memulihkan model yang dihapus sementara ke status aktif, gunakan **restore** metode pada instance model:

```java
$flight->restore();
```
### Permanently Deleting Models
Terkadang Anda mungkin perlu benar-benar menghapus model dari database Anda. Untuk menghapus model yang dihapus secara permanen dari database, gunakan **forceDelete** metode:
```java
// Force deleting a single model instance...
$flight->forceDelete();

// Force deleting all related models...
$flight->history()->forceDelete();
```