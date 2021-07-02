# One-to-One Relationship 

 One to One Relationship yaitu contoh simplenya adalah satu orang hanya punya satu passport sedangkan satu passport hanya dimiliki oleh satu orang. Jadi One to One Relationship adalah sistem relation yang sifatnya timbal balik artinya satu table hanya boleh punya satu item didalam table lain. 
Jadi itu dia penjelasan tentang One to One Relationshipnya. 
 Nah sekarang teman teman siapkan dulu yaitu menginstal laravelnya lalu jalankan local servernya dengan mengetikkan `php artisan serve` dibagian command prompt-nya

    php artisan serve

Maka kita akan dapat hasil tulisan Laravelnya dan satu lagi yang harus kita siapkan yaitu sistem databasenya. Saya sudah buatkan nama database yang masih kosong. 
Selanjutnya kita akan atur settingan file `.env`-nya atau settingan databasenya dengan menentukan DB_HOST username, password lalu nama databasenya disesuikan.

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=


Jika sudah kita akan melakukan migration dengan mengetikkan perintah seperti ini

    php artisan make::migration create_passports_table --create="passports"


Dan bila kita buka difolder `database/migrations` otomatis kita akan punya passports tabelnya. Disini kita hanya butuh user table dan passport table. 
Yang pertama untuk user tablenya kita buat sesimple mungkin kita hanya punya `id`, `name` dan `timestamps` seperti ini:

            $table->increments('id');
            $table->string('name');
            $table->timestamp();
            
            
            
Lalu untuk passport tablenya kita akan tambahkan beberapa hal yang pertama terdapat `no_passport` dalam bentuk string dengan opsi unique lalu yang kedua ini bagian yang paling penting untuk table passport harus memiliki foreign key dari `user_id`. 
Foreign key ini adalah bagaimana cara kita menghubungkan table satu dengan table lainnya. Pada kasus kali ini dalam bentuk integer yaitu `user_id`

            $table->increments('id');
            $table->string('no_passport',10)->unique();
            $table->integer('user_id)->unsigned();
            
            
Dan kita juga akan memberi tahu bila `user_id` ini adalah foreign key dengan cara seperti berikut:

            $table->timestamp();
            $table->foreign('user_id')
                  ->references(id)
                  ->on('users')
                  ->onDelete('cascade');
            
Artinya nama kolom id yang ada ditable users dan dia sebagai foreign key lalu diberikan metode `onDelete cascade` yaitu ketika id usernya di hapus otomatis semua passport atau item-item yang mempunyai id yang sama akan ikut terhapus. 
Jika tidak ada masalah kita akan jalankan diterminalnya yaitu `php artisan migrate`

    php artisan migrate


Semuanya berhasil di migrasi dan teman teman bisa lihat didatabasenya otomatis akan ada beberapa table yaitu table passports dan usersnya. Sebagai catatan buat teman teman nama kolom `user_id` saya ikutin aturan dari dokumentasi laravelnya jadi nama tablenya plurals yaitu users maka kita ambil nama foreign keynya dengan nama singular yaitu `user_id`.


**Sekian Terimakasih :)**
