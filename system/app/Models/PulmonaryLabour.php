<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PulmonaryLabour extends Model
{
    use HasFactory;

    protected $fillable = [
    	"hospital_name",
    	"disease",
    	"from_date",
    	"to_date",
    	"l_id",
    	"work_end_date"
    ];

    protected $table = "pulmonary_labour";

    public function labour()
    {
        return $this->hasOne(Labour::class,"l_id","l_id");
    }
}
