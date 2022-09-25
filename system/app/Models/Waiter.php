<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waiter extends Model
{
    use HasFactory;

    public function restaurant(){
        return $this->hasOne(Restaurant::class,"id","restaurant_id");
    }
}
