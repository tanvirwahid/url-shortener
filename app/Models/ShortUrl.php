<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShortUrl extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = [
        'url'
    ];

    protected $fillable = [
        'original_url',
        'shortened_url',
        'is_private',
        'user_id',
        'expires_at'
    ];

    public function getUrlAttribute(): ?string
    {
        return $this->shortened_url ? url($this->shortened_url) : null;
    }

    public function scopeActive(Builder $query)
    {
        $query->where('expires_at', '>=', Carbon::now())
            ->where('shortened_url', '!=', null);
    }
}
