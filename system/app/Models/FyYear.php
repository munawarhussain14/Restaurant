<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\FyScope;


class FyYear extends Model
{
    use HasFactory;
    protected $table = "fianancial_years";
    
    protected static function booted()
    {
        static::addGlobalScope(new FyScope);
    }
}
