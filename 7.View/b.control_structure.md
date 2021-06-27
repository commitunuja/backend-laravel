## Control Structure
Selain pewarisan template dan tampilan data, Blade juga menyediakan pintasan yang nyaman untuk struktur kontrol PHP umum, seperti pernyataan bersyarat dan loop. Pintasan ini menyediakan cara yang sangat bersih dan singkat untuk bekerja dengan struktur kontrol PHP sementara juga tetap akrab dengan rekan PHP mereka.

Anda dapat membuat **if** pernyataan menggunakan **@if, @elseif, @else**, dan **@endif** direktif. Arahan ini berfungsi identik dengan rekan-rekan PHP mereka:
```java
@if (count($records) === 1) //condition
    I have one record! //statement
@elseif (count($records) > 1)//condition
    I have multiple records!//statement
@else
    I don't have any records! //statement
@endif
```
Untuk kenyamanan, Blade juga memberikan **@unless** arahan:
```java
@unless (Auth::check())
    You are not signed in.
@endunless
```
Selain direktif bersyarat yang telah dibahas, direktif **@isset** and **@empty** dapat digunakan sebagai jalan pintas yang nyaman untuk fungsi PHP masing-masing:
```java
@isset($records)
    // $records is defined and is not null...
@endisset

@empty($records)
    // $records is "empty"...
@endempty
```
### Petunjuk Otentikasi
**@auth** dan **@guest** arahan dapat digunakan untuk dengan cepat menentukan apakah pengguna saat ini dikonfirmasi atau tamu:
```java
@auth
    // The user is authenticated...
@endauth

@guest
    // The user is not authenticated...
@endguest
```
Jika diperlukan, Anda dapat menentukan penjaga otentikasi yang harus diperiksa saat menggunakan perintah **@auth** and **@guest** :
```java
@auth('admin')
    // The user is authenticated...
@endauth

@guest('admin')
    // The user is not authenticated...
@endguest
```
