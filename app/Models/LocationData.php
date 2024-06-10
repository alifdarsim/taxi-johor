<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin Builder
 */
class LocationData extends Model
{
    protected $table = 'location_data';

    protected $fillable = [
        'session',
        'data',
    ];

    protected $casts = [
        'data' => 'array'
    ];

}
