<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $filalble = [
        'title','type','no_guests','children','adults','beds','rooms','price','location','description','deposit','condition','image1','image2','image3','start_time','end_time','user_id','room_id','is_Admin'
    ];
    protected $dates = [
        'start_time','end_time'
    ];

    protected $primaryKey = 'id';
}
