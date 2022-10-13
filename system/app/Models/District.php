<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models;

class District extends Model
{
    use HasFactory;
    protected $table = 'districts';
    protected $primaryKey = "d_id";

}