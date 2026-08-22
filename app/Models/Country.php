<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Country extends Model
{
    protected $fillable = [
        'name',
        'code',
        'flag',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function flagIconCode(): string
    {
        return match (strtoupper($this->code ?? '')) {
            'UK' => 'gb',
            default => strtolower($this->code ?? ''),
        };
    }

    public function flagIconUrl(): string
    {
        return 'https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/flags/4x3/' . $this->flagIconCode() . '.svg';
    }

    public function hasValidFlagEmoji(): bool
    {
        $flag = trim((string) $this->flag);

        return $flag !== '' && ! preg_match('/^\?+$/u', $flag);
    }
}
