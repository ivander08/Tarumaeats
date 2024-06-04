<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listings extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_name',
        'location_address',
        'price_range',
        'website',
        'phone_number',
        'email',
        'latitude',
        'longitude',
        'images',
        'tags',
        'special_features',
        'price_per_person',
        'payment_options',
        'open_hours',
        'closed_hours',
    ];


    protected $casts = [
        'latitude' => 'string',
        'longitude' => 'string',
        'images' => 'array',
        'tags' => 'array',
        'special_features' => 'array',
        'payment_options' => 'array',
    ];

    protected $table = 'listings';
}
