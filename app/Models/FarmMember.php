<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmMember extends Model
{
    use HasFactory;

    protected $table = "farm_members";
    protected $guarded = [];
    protected $appends = ['fullname','created_date'];

    public function getFullnameAttribute()
    {
        $fname = $this->attributes['fname'] ?? '';
        $lname = $this->attributes['lname'] ?? '';
        if($fname && $lname) {
            return $fname . ' ' . $lname;
        }

        return '';
    }

    public function getCreatedDateAttribute()
    {
        $created_at = $this->attributes['created_at'] ?? '';
        if($created_at) {
            return Carbon::parse($created_at)->format('F d, Y');
        }

        return '';
    }
}
