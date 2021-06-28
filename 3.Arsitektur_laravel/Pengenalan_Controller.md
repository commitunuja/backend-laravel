PENGENALAN CONTROLLER
Sebelumnya mari kita buka project Laravel kita yang kemarin, setelah itu kita buat dulu satu file Controller yang akan kita pakai untuk belajar. 
Pertanyaannya, bagaimana cara membuatnya? ok agar lebih mudah maka kita akan menggunakan salah satu fitur Laravel yaitu artisan. 
buka command prompt-nya masing-masing dan jangan lupa ya arahkan dulu ke direktori/folder project kita kemarin. 
Jika sudah silakan ketikan perintah artisan berikut :
 
maka secara otomatis Laravel akan meng-generate sebuah file Controller yang kita butuhkan. 
Coba buka di app/Http/Controllers maka akan ada file dengan nama BelajarController.
php yang sudah kita buat tadi, mudah kan? Sekarang silakan kalian rubah isinya menjadi seperti dibawah ini :
 

lalu bagaimana caranya kita bisa menampilkannya di views? pada tutorial sebelumnya kita sudah belajar mengirim data dari route ke views, 
nah caranya tidak jauh beda hanya saja kita akan memakai controller untuk memprosesnya. 
Coba buka lagi file web.php lalu tambahkan satu route seperti di bawah ini :
 
kemudian kita buka juga file index.blade.php dan buat menjadi seperti berikut :
 
Kita telah membuat satu route lalu kita terima di Controller kemudian dari Controller kita mengirimkannya ke index.blade.php yang ada di views dengan mengirim satu data dan menyimpannya pada variable $title.
Selanjutnya coba kalian akses di url dengan mengetikan localhost:8000/belajar maka akan tampil seperti gambar di bawah ini :
 
	
