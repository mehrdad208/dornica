<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['title', 'image', 'status', 'body', 'published_at', 'author_id', 'category_id'];


    public function postCategory()
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(user::class, 'author_id');
    }
}