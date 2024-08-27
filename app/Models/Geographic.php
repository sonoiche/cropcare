<?php

namespace App\Models;

use App\Models\User;
use App\Models\LandCrop;
use App\Models\FarmMember;
use App\Models\Association;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Geographic extends Model
{
    use HasFactory;

    protected $table = "geographics";
    protected $guarded = [];

    public function president()
    {
        return $this->belongsTo(User::class, 'president_id');
    }

    public function land()
    {
        return $this->belongsTo(LandCrop::class, 'location_id');
    }

    public function association()
    {
        return $this->belongsTo(Association::class, 'association_id');
    }

    public function farmer()
    {
        return $this->belongsTo(FarmMember::class, 'farmer_id');
    }
}
