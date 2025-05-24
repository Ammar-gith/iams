<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    public const user_status = [
        1 => 'Active',
        0 => 'In Active'
    ];

    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    // The attributes that are mass assignable
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'designation',
        'image',
        'department_id',
        'office_id',
        'newspaper_id',
        'adv_agency_id',
        'status_id',
        'activation_date',
        'deactivation_data',

    ];

    // The attributes that should be hidden for serialization
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // The attributes that should be cast
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // User
    public function advertisements()
    {
        return $this->hasMany(Advertisement::class, 'user_id');
    }
}
