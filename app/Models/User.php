<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'date_joined',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Defines the relationship between Users and Sports
    public function sports()
    {
        return $this->belongsToMany(
            Sport::class,
            'sports_users',
            'user_id',
            'sport_id'
        );
    }

    // Defines the relationship between Users and Jobs
    public function jobs()
    {
        return $this->belongsToMany(
            Job::class,
            'users_jobs',
            'user_id',
            'job_id'
        );
    }
}
