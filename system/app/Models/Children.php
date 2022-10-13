<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models;

class Children extends Model
{
    use HasFactory;
    protected $table = "children";
    protected $primaryKey = "id";
    protected $fillable = [
        "id",
        "name",
        "reg_no",
        "father_id",
        "dob",
        "gender",
        "disabled",
        "disability_factor"
    ];

    public function father()
    {
        return $this->hasOne(Labour::class,"l_id","father_id");
    }

    public function preApply()
    {
        return $this->hasOne(Scholarship::class,"s_id","id")->where("fy_year","2020-21");
    }

    public function apply()
    {
        $fy = FyYear::first();
        return $this->hasOne(Scholarship::class,"s_id","id")->where("fy_year",$fy->year);
    }

    public function diploma()
    {
        $fy = FyYear::first();
        return $this->hasOne(Diploma::class,"child_id","id")->where("fy_year",$fy->year);
    }

}