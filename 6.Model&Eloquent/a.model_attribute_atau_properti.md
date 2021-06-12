### PENGANTAR 

Laravel menyertakan Eloquent, sebuah object-relational mapper (ORM) yang membuatnya menyenangkan untuk berinteraksi dengan database Anda. Saat menggunakan Eloquent, setiap tabel database memiliki "Model" terkait yang digunakan untuk berinteraksi dengan tabel tersebut. Selain mengambil catatan dari tabel database, model Eloquent memungkinkan Anda untuk menyisipkan, memperbarui, dan menghapus catatan dari tabel juga.

### Menghasilkan Kelas Model

Model biasanya tinggal di app\Modelsdirektori dan memperluas Illuminate\Database\Eloquent\Modelkelas. Anda dapat menggunakan make:model perintah Artisan untuk menghasilkan model baru:

```java
php artisan make:model Flight
```

Ada 10 magic property yang dapat kita gunakan :

1. $table
2. $primaryKey
3. $fillable
4. $guarded
5. $dates
6. $timestamps
7. $casts
8. $hidden
9. $visible
10. $appends