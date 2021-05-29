Laravel Database Relationship

Dalam memanfaatkan database, dikenal ada relasi antar entity atau antar tabel. Penggunaan fitur ini pada database konvesional membutuhkan penggunaan perintah SQL yang relatif panjang dan juga membutuhkan penanganan dari program yang membutuhkan program yang rumit pula. Artikel ini membahas mengenai Relationship pada Eloquent yang memudahkan penggunaan database yang memiliki relationship.

Laravel Database Relationship
Berikut adalah beberapa jenis relasi database yang dikenal pada umumnya dan telah diakomodasi oleh Laravel.

Relasi one to one dimana sebuah data pada sebuah tabel hanya memiliki relasi ke sebuah data pada tabel yang lain. Misalnya, sebuah data tabel tb_User memiliki relasi 1 nomor telepon di tabel tb_Contact.
Relasi one to many dimana sebuah data pada sebuah tabel memiliki relasi ke beberapa data pada tabel yang lain. Misalnya, sebuah data tabel tb_Category memiliki relasi banyak data barang di tb_Inventory. Atau dengan kata lain, 1 kategori memiliki banyak data inventory.
Relasi many to one (One to many Inverse) dimana merupakan kebalikan dari relasi one to many. Misalnya kita ingin mengetahui data barang di tb_Inventory memiliki kategori apa, maka relasi ini yang akan digunakan.
Relasi many to many dimana banyak data pada sebuah tabel memiliki relasi ke banyak data juga pada tabel yang lainnya. Relasi tersebut terbentuk melalui sebuah tabel bantu. Misalnya, banyak data pada tabel tb_Siswa memiliki relasi peminjaman ke banyak data pada tabel tb_Buku. Relasi tersebut terbentuk dengan tabel bantu bernama tb_Transaksi.