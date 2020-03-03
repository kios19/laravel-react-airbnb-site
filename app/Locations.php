<?php

namespace App;

use Laravel\Scout\Searchable;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    use Searchable;
    //
    public function searchableAs()
    {
        return config('scout.prefix').'locations';
    }

    protected $table = 'location';

    protected $primaryKey = 'id';
}
