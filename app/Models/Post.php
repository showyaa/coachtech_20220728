<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'teacher_id',
        'subject_id',
        'check',
        'text',
    ];

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }

    public function replies()
    {
        return $this->hasMany('App\Models\Reply');
    }

    public function images()
    {
        return $this->hasMany('App\Models\Image');
    }
}
