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
        'campus',
        'location_address',
        'price_range',
        'website',
        'phone_number',
        'email',
        'main_image',
        'banner_image',
        'carousel_images',
        'type',
        'cuisine',
        'price_range',
        'payment_options',
        'special_features',
    ];


    protected $casts = [
        'main_image' => 'string',
        'banner_image' => 'string',
        'carousel_images' => 'array',
        'cuisine' => 'array',
        'special_features' => 'array',
        'payment_options' => 'array',
    ];

    protected $table = 'listings';
    
    public function ratings() {
        return $this->hasMany(ratings::class, 'location_name', 'location_name');
    }
    
}
