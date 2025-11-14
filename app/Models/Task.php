<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
     use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'creator_id',
        'taker_id',
        'due_date',
    ];

    // Task creator
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    // Task taker
    public function taker()
    {
        return $this->belongsTo(User::class, 'taker_id');
    }
}
