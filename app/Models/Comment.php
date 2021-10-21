<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Post;

class Comment extends Model
{
    use HasFactory;

    public $fillable = ['content','user_id','post_id'];

    public function posts()
    {
        return $this->BelongsTo(Post::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
