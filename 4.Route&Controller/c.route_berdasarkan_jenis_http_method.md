### Router Methods
Seperti yang telah dibahas sebelumnya bahwa router juga memilah request berdasarkan HTTP method, sehingga kita bisa mendefinisikan sebuah route untuk merespon HTTP verb.

```java
Route::get($uri, $callback);
Route::post($uri, $callback);
Route::put($uri, $callback);
Route::patch($uri, $callback);
Route::delete($uri, $callback);
Route::options($uri, $callback);
Untuk beberapa kasus kita mungkin perlu untuk mendaftarkan sebuah route untuk merespon beberapa HTTP verb. Misalnya, kita harus mengizinkan url blog untuk merespon request GET dan POST, dalam kasus ini kita bisa menggunakan method match.

Route::match(['get', 'post'], 'blog', function () {
    return 'Ini halaman blog';
});
```
Untuk mencoba method POST kita bisa menggunakan Postman.


