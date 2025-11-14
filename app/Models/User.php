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
    protected $fillable = [
        'name',
        'email',
         'role',
        'password',
    ];
     // Tasks created by the user
    public function createdTasks()
    {
        return $this->hasMany(Task::class, 'creator_id');
    }

    // Tasks assigned to the user
    public function assignedTasks()
    {
        return $this->hasMany(Task::class, 'taker_id');
    }

    // Optional: Activity logs
    // public function activityLogs()
    // {
    //     return $this->hasMany(ActivityLog::class);
    // }
    public function hasRole($role)
    {
        return $this->role === $role;
    }

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
}
