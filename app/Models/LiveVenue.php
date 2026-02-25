<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveVenue extends Model
{
    /** @use HasFactory<\Database\Factories\LiveVenueFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'prefecture',
        'capacity',
        'nearest_station',
        'access',
        'google_maps_url',
        'toilet_layout',
    ];

    protected function casts(): array
    {
        return [
            'toilet_layout' => 'array',
        ];
    }
}
