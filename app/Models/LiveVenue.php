<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveVenue extends Model
{
    /** @use HasFactory<\Database\Factories\LiveVenueFactory> */
    use HasFactory;

    public $guarded = [];

    protected function casts(): array
    {
        return [
            'toilet_layout' => 'array',
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
        ];
    }
}
