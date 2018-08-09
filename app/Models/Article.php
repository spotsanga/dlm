<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table="articles";
    protected $fillable=['name','author','title','description','url','urlToImage','publishedAt','topic'];
}
