<?php

namespace App;

use App\User;
use App\Lesson;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'lesson_id',
        'user_id'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function lesson()
    {
    	return $this->belongsTo(Lesson::class);
    }
}