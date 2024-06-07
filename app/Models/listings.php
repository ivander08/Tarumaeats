<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listings extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location_name',
        'location_address',
        'price_range',
        'website',
        'phone_number',
        'email',
        'latitude',
        'longitude',
        'images',
        'type',
        'cuisine',
        'price_range',
        'payment_options',
        'special_features',
    ];


    protected $casts = [
        'latitude' => 'string',
        'longitude' => 'string',
        'images' => 'array',
        'cuisine' => 'array',
        'special_features' => 'array',
        'payment_options' => 'array',
    ];

    protected $table = 'listings';
}
