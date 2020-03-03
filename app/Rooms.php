<?php

namespace App;

use Laravel\Scout\Searchable;

use Laravelista\Comments\Commentable;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use Searchable,Commentable;

    public function searchableAs()
    {
        return config('scout.prefix').'rooms';
    }

    protected $fillable = [
        'title', 'type','no_guests','children', 'adults','beds','rooms','price','location','description','deposit','condition','image1','image2','image3','user_id'
    ];

}
