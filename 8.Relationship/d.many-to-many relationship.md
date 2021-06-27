Many-To-Many Relationship

Hubungan polimorfik banyak-ke-banyak sedikit lebih rumit daripada hubungan "morf satu" dan "morf banyak". Misalnya, Postmodel dan Videomodel dapat berbagi relasi polimorfik dengan Tagmodel. Menggunakan relasi polimorfik banyak-ke-banyak dalam situasi ini akan memungkinkan aplikasi Anda memiliki satu tabel tag unik yang mungkin terkait dengan postingan atau video. Pertama, mari kita periksa struktur tabel yang diperlukan untuk membangun hubungan ini
------
source code
posts
    id - integer
    name - string

videos
    id - integer
    name - string

tags
    id - integer
    name - string

taggables
    tag_id - integer
    taggable_id - integer
    taggable_type - string
------
#Struktur Model

Selanjutnya, kita siap untuk mendefinisikan hubungan pada model. Model Postdan Videokeduanya akan berisi tagsmetode yang memanggil morphToManymetode yang disediakan oleh kelas model Eloquent dasar.

The morphToManyMetode menerima nama model terkait serta "nama hubungan". Berdasarkan nama yang kami tetapkan untuk nama tabel perantara kami dan kunci yang dikandungnya, kami akan menyebut hubungan sebagai "dapat diberi tag":
-----
Selanjutnya, kita siap untuk mendefinisikan hubungan pada model. Model Postdan Videokeduanya akan berisi tagsmetode yang memanggil morphToManymetode yang disediakan oleh kelas model Eloquent dasar.

The morphToManyMetode menerima nama model terkait serta "nama hubungan". Berdasarkan nama yang kami tetapkan untuk nama tabel perantara kami dan kunci yang dikandungnya, kami akan menyebut hubungan sebagai "dapat diberi tag":

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Get all of the tags for the post.
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
-----
#Mendefinisikan Invers dari Hubungan
Selanjutnya, pada Tagmodel, Anda harus menentukan metode untuk setiap kemungkinan model induknya. Jadi, dalam contoh ini, kita akan mendefinisikan postsmetode dan videosmetode. Kedua metode ini harus mengembalikan hasil morphedByManymetode.

The morphedByManyMetode menerima nama model terkait serta "nama hubungan". Berdasarkan nama yang kami tetapkan untuk nama tabel perantara kami dan kunci yang dikandungnya, kami akan menyebut hubungan sebagai "dapat diberi tag":
-----
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * Get all of the posts that are assigned this tag.
     */
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    /**
     * Get all of the videos that are assigned this tag.
     */
    public function videos()
    {
        return $this->morphedByMany(Video::class, 'taggable');
    }
}
----
#Mengambil Hubungan
Setelah tabel dan model database Anda ditentukan, Anda dapat mengakses hubungan melalui model Anda. Misalnya, untuk mengakses semua tag untuk sebuah postingan, Anda dapat menggunakan tagsproperti hubungan dinamis:
-----
use App\Models\Post;

$post = Post::find(1);

foreach ($post->tags as $tag) {
    //
}
-----
#Anda dapat mengambil induk relasi polimorfik dari model anak polimorfik dengan mengakses nama metode yang melakukan panggilan ke morphedByMany. Dalam hal ini, yaitu postsatau videosmetode pada Tagmodel:
---
use App\Models\Tag;

$tag = Tag::find(1);

foreach ($tag->posts as $post) {
    //
}

foreach ($tag->videos as $video) {
    //
}
-----
#Jenis Polimorfik Kustom
Secara default, Laravel akan menggunakan nama kelas yang sepenuhnya memenuhi syarat untuk menyimpan "tipe" model terkait. Misalnya, mengingat contoh hubungan satu-ke-banyak di atas di mana Commentmodel mungkin milik a Postatau Videomodel, defaultnya commentable_typeadalah salah satu App\Models\Postatau App\Models\Video, masing-masing. Namun, Anda mungkin ingin memisahkan nilai-nilai ini dari struktur internal aplikasi Anda.

Misalnya, alih-alih menggunakan nama model sebagai "tipe", kita dapat menggunakan string sederhana seperti postdan video. Dengan melakukannya, nilai kolom "tipe" polimorfik dalam database kami akan tetap valid bahkan jika model diganti namanya:
-----
se Illuminate\Database\Eloquent\Relations\Relation;

Relation::morphMap([
    'post' => 'App\Models\Post',
    'video' => 'App\Models\Video',
]);
Anda dapat mendaftarkan morphMapdalam bootfungsi Anda App\Providers\AppServiceProviderkelas atau membuat penyedia layanan terpisah jika Anda inginkan.

Anda dapat menentukan alias morph dari model yang diberikan saat runtime menggunakan metode model getMorphClass. Sebaliknya, Anda dapat menentukan nama kelas yang sepenuhnya memenuhi syarat yang terkait dengan alias morph menggunakan Relation::getMorphedModelmetode:

use Illuminate\Database\Eloquent\Relations\Relation;

$alias = $post->getMorphClass();

$class = Relation::getMorphedModel($alias);
-----
use Illuminate\Database\Eloquent\Relations\Relation;

$alias = $post->getMorphClass();

$class = Relation::getMorphedModel($alias);

Saat menambahkan "morph map" ke aplikasi Anda yang sudah ada, setiap *_typenilai kolom morphable di database Anda yang masih berisi kelas yang sepenuhnya memenuhi syarat perlu dikonversi ke nama "map"-nya.


Hubungan Dinamis
Anda dapat menggunakan resolveRelationUsingmetode untuk mendefinisikan hubungan antara model Eloquent saat runtime. Meskipun biasanya tidak direkomendasikan untuk pengembangan aplikasi normal, ini terkadang berguna saat mengembangkan paket Laravel.

The resolveRelationUsingMetode menerima nama hubungan yang diinginkan sebagai argumen pertama. Argumen kedua yang diteruskan ke metode harus berupa penutupan yang menerima instance model dan mengembalikan definisi hubungan Eloquent yang valid. Biasanya, Anda harus mengonfigurasi hubungan dinamis dalam metode boot penyedia layanan :

use App\Models\Order;
use App\Models\Customer;

Order::resolveRelationUsing('customer', function ($orderModel) {
    return $orderModel->belongsTo(Customer::class, 'customer_id');
});


