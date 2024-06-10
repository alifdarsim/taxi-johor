<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin Builder
 */
class LocationHistory extends Model
{
    protected $table = 'location_histories';

    public function data(): HasMany
    {
        return $this->hasMany(LocationData::class, 'session', 'session');
    }
}
