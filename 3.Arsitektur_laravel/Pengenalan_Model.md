PENGENALAN MODEL
Model merupakan salah satu dari bagian MVC yang bertugas berhubungan langsung dengan database. Bisa dikatakan juga bahwa Model adalah penghubung setiap alur program yang berhubungan dengan data. Nantinya, model yang sudah terhubung ke database akan digunakan/dipanggil via Controller sebagaimana konsep MVC itu berjalan.
Bagaimana cara membuat model di Laravel ?
Biasakan nama model menggunakan nama tabel di database (harus sama). Jalankan perintah berikut untuk membuat model Siswa dan nama tabelnya “siswa”.
php artisan make:model Siswa
 
Perintah di atas akan membuat sebuah file baru (Siswa.php) di dalam folder app.
 
Isinya adalah seperti berikut.
namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
//
}
Silahkan sesuaikan isi modelnya seperti ini :
namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
protected $table="siswa";
protected $primaryKey="id";
protected $fillable=['nama','umur','alamat','no_hp'];
}
o	protected $table = “siswa”; berisi nama tabel yang digunakan.
o	protected $fillable = [‘nama’, ‘umur’, ‘alamat’, ‘no_hp’]; berisi atribut nama-nama column yang ada di dalam tabel tersebut dan bersifat publik/akan diisi. ID bersifat private dan sebaiknya tidak perlu ditulis dalam $fillable karena sudah auto increment.
o	Jika kita tidak menggunakan created dan updated_at dari laravel, silahkan tambahkan public $timestamps = false; dalam file model.
