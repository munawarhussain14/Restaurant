<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models;

class Labour extends Model
{
    use HasFactory;
    protected $table = 'labours';
    protected $primaryKey = "l_id";

    protected $fillable = [
        "lease_owner_name",
        "lease_no",
        "lease_district_id",
        "mineral_id",
        "lease_address",
        "work_end_date"
    ];

    public function district()
    {
        return $this->hasOne(District::class,"d_id","domicile_district");
    }

    public function account()
    {
        return $this->hasOne(BankAccount::class,"l_id","l_id");
    }

    public function bank()
    {
        return $this->hasOne(Bank::class,"b_id","bank_id");
    }

    public function work()
    {
        return $this->hasOne(WorkType::class,"wt_id","work_id");
    }

    public function perm_district()
    {
        return $this->hasOne(District::class,"d_id","perm_district_id");
    }

    public function postal_district()
    {
        return $this->hasOne(District::class,"d_id","postal_district_id");
    }

    public function lease_district()
    {
        return $this->hasOne(District::class,"d_id","lease_district_id");
    }

    public function mineral()
    {
        return $this->hasOne(Minerals::class,"m_id","mineral_id");
    }

    public function child()
    {
        return $this->hasOne(Children::class,"father_id","l_id");
    }

    public function children()
    {
        return $this->hasMany(Children::class,"father_id","l_id");
    }

    public function pulmonary()
    {
        $fy = FyYear::first();
        return $this->hasOne(PulmonaryLabour::class,"l_id","l_id")->where("fy_year",$fy->year);
    }

    public function prePulmonary()
    {
        $fy = FyYear::first();
        return $this->hasOne(PulmonaryLabour::class,"l_id","l_id")->where("fy_year","<>",$fy->year)->where("status","approved");
    }

    public function disabledLabour()
    {
        $fy = FyYear::first();
        return $this->hasOne(DisableLabour::class,"l_id","l_id")->where("fy_year",$fy->year);
    }

    public function preDisabledLabour()
    {
        $fy = FyYear::first();
        return $this->hasOne(DisableLabour::class,"l_id","l_id")->where("fy_year","<>",$fy->year)->where("status","approved");
    }
}