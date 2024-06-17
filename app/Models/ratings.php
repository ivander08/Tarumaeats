<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ratings extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'location_name', 
        'rating'
    ];

    protected $table = 'ratings';

    public function listings() {
        return $this->belongsTo(listings::class, 'location_name', 'location_name');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'name', 'name');
    }
}
