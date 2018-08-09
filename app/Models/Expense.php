<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table="expenses";
    protected $fillable=['user_id','category','money_spent','spent_at_date','spent_at_time','spent_at_merediem'];
}
