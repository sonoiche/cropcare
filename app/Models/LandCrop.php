<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandCrop extends Model
{
    use HasFactory;

    protected $table = "land_crops";
    protected $guarded = [];
}
