<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //
    protected $fillable = [
        'user_id','product_id','rating'
    ];
    protected $table = 'ratings';

    protected $primaryKey = 'id';
}
