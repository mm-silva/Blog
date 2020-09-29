<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "post";

    protected $fillable = ["id","title","content", "author_id","image", "date"];
    public $timestamps = false;
}
