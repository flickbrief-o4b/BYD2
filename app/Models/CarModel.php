<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'tagline',
        'starting_price',
        'image',
        'brochure_file',
        'range_km',
        'acceleration',
        'battery_type',
        'battery_capacity',
        'max_power',
        'charging_time',
        'description',
        'features',
        'order',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'starting_price' => 'integer',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function types(): HasMany
    {
        return $this->hasMany(CarType::class)->orderBy('order', 'asc');
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->starting_price, 0, ',', '.');
    }
}
