<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Cviebrock\EloquentSluggable\Sluggable;

class TourPackage extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'duration',
        'price',
        'itinerary',
        'include',
        'exclude',
        'description',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'itinerary' => 'array',
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

    public function getPrimaryImageUrlAttribute()
    {
        return $this->getFirstMediaUrl('tour_packages')
            ?: $this->getFirstMediaUrl('tours')
            ?: 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?auto=format&fit=crop&q=80&w=800';
    }
}
