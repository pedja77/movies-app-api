<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public static function search($term, $skip, $take) {
        // if (!$searchTerm) {
        //     return self::paginate($take);
        // } else {
        //     return self::where('title', 'LIKE', '%'.$searchTerm.'%')->paginate($take);
        // }

        return self::where('title', 'LIKE', '%'.$term.'%')->skip($skip)->take($take);//->get();

    }
}
