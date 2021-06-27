#pengantar
Sebuah tenang pengontrol sumber daya set up beberapa rute default untuk Anda dan bahkan nama-nama mereka.
```java
Route::resource('users', 'UsersController');
```
```java
Verb          Path                        Action  Route Name
GET           /users                      index   users.index
GET           /users/create               create  users.create
POST          /users                      store   users.store
GET           /users/{user}               show    users.show
GET           /users/{user}/edit          edit    users.edit
PUT|PATCH     /users/{user}               update  users.update
DELETE        /users/{user}               destroy users.destroy
```
---
Dan Anda akan mengatur pengontrol Anda seperti ini (tindakan = metode
```java
class UsersController extends BaseController {

    public function index() {}

    public function show($id) {}

    public function store() {}

}
```
Anda juga dapat memilih tindakan apa yang disertakan atau dikecualikan seperti ini:

```java
Route::resource('users', 'UsersController', [
    'only' => ['index', 'show']
]);

Route::resource('monkeys', 'MonkeysController', [
    'except' => ['edit', 'create']
]);
```