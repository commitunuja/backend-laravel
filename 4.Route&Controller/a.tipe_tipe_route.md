# PEGANTAR
## Pada Laravel Framework kita memiliki beberapa route, antara lain :
---
**API**

**Web**

**Channels**

**Console**


Di antara 4 Route di atas yang paling sering kita gunakan adalah Route API & Route Web.

Definisi Route Web ini Terletak Di Folder routes\web.php dan untuk file Route API Terletak Di Folder routes\api.php

Di Laravel Terdapat 4 Route Http Antra Lain :

Route GET
Route POST
Route PUT
Route DELETE
Contoh Penulisan Route GET:
```java
Route::get('/customer', function () {    
    return dd('ini halaman customer');
});
﻿
PHP
Contoh Penulisan Route POST :

Route::post('/customer/create', 'customerController@create');
PHP
Contoh Penulisan Route PUT :

Route::put('/customer/{id}', 'customerController@update');
PHP
kita dapat juga membuat group route contohnya :

Route::group(['prefix'=>'/customer'], function () {
    
    Route::get('/all', function () {
        return 'Halaman Daftar Customer';
    });
    
    Route::get('/add', function () {
        return 'Halaman Tambah Customer';
    });

});
```
