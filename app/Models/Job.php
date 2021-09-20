<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    // Defines the relationship between Jobs and Users
    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'users_jobs',
            'user_id',
            'job_id'
        );
    }
}
