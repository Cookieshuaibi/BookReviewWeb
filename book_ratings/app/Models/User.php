<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function Reviews()
    // {
    //     return $this->hasMany(Reviews::class);
    // }

    public function reviews()
    {
        return $this->hasMany(Reviews::class);
    }
    public function books()
    {
        return $this->hasMany(Books::class,'user_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function hasRoles($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }
    public function hasAnyRoles($roles)
    {
        return $this->roles()->whereIn('name', $roles)->exists();
    }
}
