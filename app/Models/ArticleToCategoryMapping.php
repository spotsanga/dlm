<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleToCategoryMapping extends Model
{
    protected $table="article_to_category_mapping";
    protected $fillable=['id','article_id','category_id'];
}
