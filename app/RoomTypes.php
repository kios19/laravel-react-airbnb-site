<?php

namespace App;

use Laravel\Scout\Searchable;

use Illuminate\Database\Eloquent\Model;

class RoomTypes extends Model
{
    use Searchable;
    //

    public function searchableAs()
    {
        return config('scout.prefix').'room_types';
    }

    protected $table = 'room_type';

    protected $primaryKey = 'type_id';
}
