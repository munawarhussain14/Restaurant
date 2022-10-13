<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diploma extends Model
{
    use HasFactory;

    public function labour()
    {
        return $this->hasOne(Labour::class,"l_id","l_id");
    }

    public function scheme()
    {
        return $this->hasOne(Scheme::class,"id","scheme_id");
    }
}