<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    CONST ROLE_AGRICULTURIST = "Agriculturist";
    CONST ROLE_PRESIDENT = "President";

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $appends = ['fullname','display_photo'];

    public function getFullnameAttribute()
    {
        $fname = $this->attributes['fname'] ?? '';
        $lname = $this->attributes['lname'] ?? '';

        if($fname && $lname) {
            return $fname . ' ' . $lname;
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
