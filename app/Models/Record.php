<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class record extends Model
{
    protected $fillable = [
        'user_id',
        'study_date',
        'category',
        'test_time',
        'correct_rate',
        'minutes',
        'memo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
