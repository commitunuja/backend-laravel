Selain pernyataan bersyarat, Blade menyediakan arahan sederhana untuk bekerja dengan struktur loop PHP. Sekali lagi, masing-masing arahan ini berfungsi identik dengan rekan PHP mereka:
```java
@for ($i = 0; $i < 10; $i++)
    The current value is {{ $i }}
@endfor

@foreach ($users as $user)
    <p>This is user {{ $user->id }}</p>
@endforeach

@forelse ($users as $user)
    <li>{{ $user->name }}</li>
@empty
    <p>No users</p>
@endforelse

@while (true)
    <p>I'm looping forever.</p>
@endwhile
```
Saat menggunakan loop, Anda juga dapat mengakhiri loop atau melewatkan iterasi saat ini menggunakan arahan **@continue** and **@break**:
```java
@foreach ($users as $user)
    @if ($user->type == 1)
        @continue
    @endif

    <li>{{ $user->name }}</li>

    @if ($user->number == 5)
        @break
    @endif
@endforeach
```
Anda juga dapat menyertakan kondisi kelanjutan atau pemutusan dalam deklarasi direktif:
```java
@foreach ($users as $user)
    @continue($user->type == 1)

    <li>{{ $user->name }}</li>

    @break($user->number == 5)
@endforeach
```
### Variabel Loop
Saat mengulang, sebuah **$loop** variabel akan tersedia di dalam loop Anda. Variabel ini menyediakan akses ke beberapa bit informasi yang berguna seperti indeks loop saat ini dan apakah ini adalah iterasi pertama atau terakhir melalui loop:
```java
@foreach ($users as $user)
    @if ($loop->first)
        This is the first iteration.
    @endif

    @if ($loop->last)
        This is the last iteration.
    @endif

    <p>This is user {{ $user->id }}</p>
@endforeach
```
Jika Anda berada dalam loop bersarang, Anda dapat mengakses **$loop** variabel loop induk melalui **parent** properti:
```java
@foreach ($users as $user)
    @foreach ($user->posts as $post)
        @if ($loop->parent->first)
            This is the first iteration of the parent loop.
        @endif
    @endforeach
@endforeach
```

**$loop** variabel juga mengandung berbagai sifat yang berguna lainnya:

|Properti	| Deskripsi |
| --- | ---|
|$loop->index	| Indeks iterasi loop saat ini (dimulai dari 0).|
|$loop->iteration	| Iterasi loop saat ini (dimulai dari 1).|
|$loop->remaining	| Iterasi yang tersisa dalam loop.|
|$loop->count	| Jumlah total item dalam array yang diulang.|
|$loop->first	| Apakah ini adalah iterasi pertama melalui loop.|
|$loop->last	| Apakah ini adalah iterasi terakhir melalui loop.|
|$loop->even	| Apakah ini merupakan iterasi genap melalui loop.|
|$loop->odd	| Apakah ini merupakan iterasi ganjil melalui loop.|
|$loop->depth	| Tingkat bersarang dari loop saat ini.|
|$loop->parent	| Saat berada dalam loop bersarang, variabel loop induk.|

### Komentar
Blade juga memungkinkan Anda untuk menentukan komentar dalam pandangan Anda. Namun, tidak seperti komentar HTML, komentar Blade tidak disertakan dalam HTML yang dikembalikan oleh aplikasi Anda:
```java
{{-- This comment will not be present in the rendered HTML --}}
```