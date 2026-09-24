<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Aspiration extends Model
{
    use HasFactory;

    public const STATUS_BARU = 'baru';
    public const STATUS_DIPROSES = 'diproses';
    public const STATUS_SELESAI = 'selesai';
    public const STATUS_DITOLAK = 'ditolak';

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'location',
        'photo_path',
        'status',
        'progress_percent',
    ];

    protected $casts = [
        'progress_percent' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function feedbacks(): HasMany
    {
        return $this->hasMany(AspirationFeedback::class)->latest();
    }

    public function latestFeedback(): HasOne
    {
        return $this->hasOne(AspirationFeedback::class)->latestOfMany();
    }

    /**
     * @param  Builder<Aspiration>  $query
     * @param  array{
     *   q?: string|null,
     *   status?: string|null,
     *   category_id?: string|int|null,
     *   user_id?: string|int|null,
     *   from?: string|null,
     *   to?: string|null,
     *   month?: string|null
     * }  $filters
     */
    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when(($filters['q'] ?? null), function (Builder $q, string $term) {
            $term = trim($term);
            if ($term === '') {
                return;
            }

            $q->where(function (Builder $sub) use ($term) {
                $sub->where('title', 'like', "%{$term}%")
                    ->orWhere('description', 'like', "%{$term}%")
                    ->orWhere('location', 'like', "%{$term}%");
            });
        });

        $query->when(($filters['status'] ?? null), fn (Builder $q, $status) => $q->where('status', $status));
        $query->when(($filters['category_id'] ?? null), fn (Builder $q, $id) => $q->where('category_id', $id));
        $query->when(($filters['user_id'] ?? null), fn (Builder $q, $id) => $q->where('user_id', $id));

        // Range filter (YYYY-MM-DD)
        $query->when(($filters['from'] ?? null), fn (Builder $q, $from) => $q->whereDate('created_at', '>=', $from));
        $query->when(($filters['to'] ?? null), fn (Builder $q, $to) => $q->whereDate('created_at', '<=', $to));

        // Month filter (YYYY-MM)
        $query->when(($filters['month'] ?? null), function (Builder $q, $month) {
            $month = trim((string) $month);
            if (!preg_match('/^\d{4}-\d{2}$/', $month)) {
                return;
            }

            $driver = DB::getDriverName();
            if ($driver === 'mysql' || $driver === 'mariadb') {
                $q->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$month]);
            } else {
                // sqlite
                $q->whereRaw("strftime('%Y-%m', created_at) = ?", [$month]);
            }
        });
    }
}


