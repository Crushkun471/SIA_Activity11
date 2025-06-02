<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'plant_id',
        'customer_id',
        'price',
        'quantity',
        'total',
        'user_id',
    ];

    // Relationships
    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Optional accessor (can be removed if not needed)
    public function getTotalAttribute()
    {
        return $this->plant ? $this->quantity * $this->plant->price : 0;
    }
}
