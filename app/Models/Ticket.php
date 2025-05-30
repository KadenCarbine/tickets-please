<?php

namespace App\Models;

use App\Http\Filters\V1\QueryFilter;
use Database\Factories\TicketsFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static Ticket create(array $attributes = [])
 */

/**
 * @method static Ticket findOrFail(int)
 */
class Ticket extends Model
{
    /** @use HasFactory<TicketsFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFilter(Builder $builder, QueryFilter $filters)
    {
        return $filters->applyFilters($builder);
    }
}
