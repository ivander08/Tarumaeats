<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ratings extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
    ];

    protected $table = 'ratings';

    public function listings() {
        return $this->belongsTo(listings::class, 'location_name', 'location_name');
    }
}
