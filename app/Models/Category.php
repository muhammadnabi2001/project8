<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['name'];
    public function post()
    {
        return $this->hasOne(Post::class, 'category_id', 'id');
    }
}
