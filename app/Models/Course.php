<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    protected $fillable = [
        'subject_title',
        'section',
        'schedule_room',
    ];
}
