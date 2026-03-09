<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Cviebrock\EloquentSluggable\Sluggable;

class Motorcycle extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Sluggable;

    protected $fillable = [
        'name',
        'brand',
        'slug',
        'price_per_day',
        'engine_capacity',
        'description',
        'status',
    ];

    protected $casts = [
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
