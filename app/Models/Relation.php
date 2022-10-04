<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'teacher_id',
    ];


    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
