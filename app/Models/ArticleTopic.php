<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleTopic extends Model
{
    protected $table="article_topics";
    protected $fillable=['topic'];
}
