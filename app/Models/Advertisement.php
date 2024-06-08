<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin Builder
 */
class Advertisement extends Model
{
    use HasFactory;

    protected $table = 'advertisements';

    protected $guarded = [];

    protected $casts = [
        'status' => 'boolean',
    ];
}
