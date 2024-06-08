<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdvertisementHistory extends Model
{
    use HasFactory;

    const STATUS_INSTALLED = 'installed';
    protected $table = 'advertisement_histories';
    protected $guarded = [];
    protected $casts = [
        'status' => 'boolean',
    ];

    public function advertisement(): BelongsTo
    {
        return $this->belongsTo(Advertisement::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public static function getAdvertisementOptions(): array
    {
        return Advertisement::pluck('name', 'id')->toArray();
    }

}
