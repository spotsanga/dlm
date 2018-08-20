<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table="messages";
    protected $fillable=['id','user_id','message'];
}
