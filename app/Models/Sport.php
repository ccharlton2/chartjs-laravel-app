<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;

    // Defines the relationship between Sports and Users
    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'sports_users',
            'sport_id',
            'user_id'
        );
    }
}
