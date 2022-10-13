<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    public function officeDistrict()
    {
        return $this->hasOne(District::class,"d_id","district");
    }
}
