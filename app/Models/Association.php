<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin Builder
 */
class Association extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'address',
        'zip',
        'city',
        'country',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function drivers(): HasMany
    {
        return $this->hasMany(Driver::class);
    }
}
