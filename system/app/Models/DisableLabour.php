<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisableLabour extends Model
{
    use HasFactory;

    protected $table = "disabled_labour";

    protected $fillable = [
    	"disability",
    	"l_id"
    ];

    public function labour()
    {
        return $this->hasOne(Labour::class,"l_id","l_id");
    }
}
