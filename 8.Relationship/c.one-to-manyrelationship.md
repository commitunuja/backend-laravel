One-To-Many Relationship

Hubungan satu ke banyak digunakan untuk mendefinisikan hubungan di mana model tunggal adalah induk dari satu atau lebih model anak. Misalnya, posting blog mungkin memiliki jumlah komentar yang tidak terbatas. Seperti semua hubungan Eloquent lainnya, hubungan satu-ke-banyak didefinisikan dengan mendefinisikan metode pada model Eloquent Anda:

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Get the comments for the blog post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

Ingat, Eloquent akan secara otomatis menentukan kolom kunci asing yang tepat untuk Commentmodel tersebut. Dengan konvensi, Eloquent akan mengambil nama "snake case" dari model induk dan menambahkannya dengan _id. Jadi, dalam contoh ini, Eloquent akan menganggap kolom kunci asing pada Commentmodel adalah post_id

Setelah metode hubungan didefinisikan, kita dapat mengakses kumpulan komentar terkait dengan mengakses commentsproperti. Ingat, karena Eloquent menyediakan "properti hubungan dinamis", kita dapat mengakses metode hubungan seolah-olah mereka didefinisikan sebagai properti pada model:

use App\Models\Post;

$comments = Post::find(1)->comments;

foreach ($comments as $comment) {
    //
}

Karena semua relasi juga berfungsi sebagai pembuat kueri, Anda dapat menambahkan batasan lebih lanjut ke kueri relasi dengan memanggil commentsmetode dan melanjutkan merangkai kondisi ke kueri:

$comment = Post::find(1)->comments()
                    ->where('title', 'foo')
                    ->first();

Seperti hasOnemetodenya, Anda juga dapat mengganti kunci asing dan lokal dengan meneruskan argumen tambahan ke hasManymetode:

return $this->hasMany(Comment::class, 'foreign_key');

return $this->hasMany(Comment::class, 'foreign_key', 'local_key');