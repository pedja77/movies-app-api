<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public static function search($searchTerm) {
        if (!$searchTerm) {
            return self::all();
        } else {
            return self::where('title', 'LIKE', '%'.$searchTerm.'%')->get();
        }
        
    }
}
