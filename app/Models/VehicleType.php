<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

/**
 * @mixin Builder
 */
class VehicleType extends Model
{
    protected $fillable = [
        'brand_id',
        'transportation',
        'model',
        'image',
        'additional_info',
    ];

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    public function brand(): BelongsTo
    {
        return $this->BelongsTo(Brand::class);
    }

    public static function getBrands(): Collection
    {
        return Brand::all()->pluck('name', 'id');
    }
}
