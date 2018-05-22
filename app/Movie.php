<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public static function search($searchTerm,$take=10) {
        if (!$searchTerm) {
            return self::paginate($take);
        } else {
            return self::where('title', 'LIKE', '%'.$searchTerm.'%')->paginate($take);
        }
        
    }
}
