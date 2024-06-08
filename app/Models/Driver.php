<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @mixin Builder
 */
class Driver extends Model
{
    use HasFactory;
    protected $fillable = [
        'association_id',
        'name',
        'phone',
        'taxi_list_id',
        'is_active',
        'address',
        'image',
        'zip',
        'city',
        'country',
    ];

    public function association(): BelongsTo
    {
        return $this->belongsTo(Association::class);
    }

    public function vehicle(): BelongsToMany
    {
        return $this->belongsToMany(Vehicle::class, 'driver_vehicle');
    }
}
