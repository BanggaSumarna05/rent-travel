<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Cviebrock\EloquentSluggable\Sluggable;

class Car extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Sluggable;

    protected $fillable = [
        'name',
        'brand',
        'slug',
        'category',
        'price_per_day',
        'transmission',
        'passenger_capacity',
        'fuel_type',
        'year',
        'description',
        'is_featured',
        'status',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'price_per_day' => 'decimal:2',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function transactions()
    {
        return $this->morphMany(Transaction::class , 'bookable');
    }
}
