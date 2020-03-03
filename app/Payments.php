<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    //
    protected $table = 'payments';

    protected $primaryKey = 'id';

    protected $fillable = [
        'room_id', 'user_id','amount','error'
    ];
}
