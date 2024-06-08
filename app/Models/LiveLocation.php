<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MatanYadaev\EloquentSpatial\Objects\Point;

class LiveLocation extends Model
{
    use HasFactory;
    protected $table = 'live_locations';

    protected $fillable = [
        'driver_id',
        'plate_number',
        'coordinate',
        'timestamp',
        'speed',
        'accuracy',
    ];

    protected $casts = [
        'coordinate' => Point::class
    ];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }
}
