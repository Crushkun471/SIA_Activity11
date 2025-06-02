<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plant extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'water_requirement',
        'temperature',
        'planted_date',
        'price', // ✅ Add this line
    ];
}
