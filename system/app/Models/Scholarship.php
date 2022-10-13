<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models;
use App\Scopes\ScholarshipScope;

class Scholarship extends Model
{
    use HasFactory;
    protected $table = 'scholarship_apply';
    protected $primaryKey = "id";
    protected $fillable = [
        "s_id",
        "ad_date",
        "institute",
        "class",
        "subject",
        "session",
        "obtained_marks",
        "total_marks",
        "other_apply",
        "position_holder",
        "special_institute",
        "passing_year",
        "roll_no",
        "board",
        "reg_no",
        "category",
        "fy_year",
        "serial",
        "covid"
    ];

    protected static function booted()
    {
        static::addGlobalScope(new ScholarshipScope);
    }

    public function student()
    {
        return $this->hasOne(Children::class,"id","s_id");
    }

    public function getClassAttribute($value)
    {
        if($value=="1")
        {
            $value = "1st";
        }
        else if($value=="2")
        {
            $value = "2nd";
        }
        else if($value=="3")
        {
            $value = "3rd";
        }
        else if($value=="4")
        {
            $value = "4th";
        }
        else if($value=="5")
        {
            $value = "5th";
        }
        else if($value=="6")
        {
            $value = "6th";
        }
        else if($value=="7")
        {
            $value = "7th";
        }
        else if($value=="8")
        {
            $value = "8th";
        }
        else if($value=="9")
        {
            $value = "9th";
        }
        else if($value=="10")
        {
            $value = "10th";
        }
        else if($value=="11")
        {
            $value = "1st Year";
        }
        else if($value=="12")
        {
            $value = "2nd Year";
        }
        else if($value=="13")
        {
            $value = "DAE";
        }
        else if($value=="16")
        {
            $value = "Bacholar";
        }
        else if($value=="18")
        {
            $value = "Master";
        }
        return ucfirst($value);
    }

}