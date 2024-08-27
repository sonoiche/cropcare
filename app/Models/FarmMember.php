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
    protected $appends = ['created_date', 'display_photo'];

    public function getCreatedDateAttribute()
    {
        $created_at = $this->attributes['created_at'] ?? '';
        if ($created_at) {
            return Carbon::parse($created_at)->format('F d, Y');
        }

        return '';
    }

    public function getDisplayPhotoAttribute()
    {
        $photo = $this->attributes['photo'] ?? '';
        if ($photo) {
            return url($photo);
        }

        $name = str_replace(" ", "+", $this->fullname);
        return 'https://ui-avatars.com/api/?name=' . $name . '&background=random';
    }
}
