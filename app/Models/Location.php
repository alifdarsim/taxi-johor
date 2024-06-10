<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\Point;

/**
 * @mixin Builder
 */
class Location extends Model
{
    protected $table = 'locations';

    protected $fillable = [
        'number_plate',
        'coordinate',
        'timestamp',
        'speed',
        'accuracy',
        'timestamp',
        'location_date',
        'session',
        'processed',
    ];

    protected $casts = [
        'processed' => 'boolean',
        'coordinate' => Point::class
    ];

    public function getLat()
    {
        return $this->coordinate->latitude;
    }

    public function getLng()
    {
        return $this->coordinate->longitude;
    }
}
