<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'content',
        'editor_mode',
        'status',
        'published_at',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_enabled',
        'is_public',
        'settings',
        'sort_order',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'is_public' => 'boolean',
        'settings' => 'array',
        'published_at' => 'datetime',
    ];

    /**
     * Scope to get only enabled pages
     */
    public function scopeEnabled(Builder $query): Builder
    {
        return $query->where('is_enabled', true);
    }

    /**
     * Scope to get only public pages
     */
    public function scopePublic(Builder $query): Builder
    {
        return $query->where('is_public', true);
    }

    /**
     * Scope to get only published pages
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->where(function ($q) {
                $q->whereNull('published_at')
                  ->orWhere('published_at', '<=', now());
            });
    }

    /**
     * Scope to get draft pages
     */
    public function scopeDraft(Builder $query): Builder
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope to get scheduled pages
     */
    public function scopeScheduled(Builder $query): Builder
    {
        return $query->where('status', 'scheduled')
            ->where('published_at', '>', now());
    }

    /**
     * Scope to get pages ordered by sort_order
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }

    /**
     * Get enabled and public pages for navigation
     */
    public static function getNavigationPages()
    {
        return Cache::remember('navigation_pages', 3600, function () {
            return self::enabled()->public()->ordered()->get();
        });
    }

    /**
     * Find page by slug
     */
    public static function findBySlug(string $slug)
    {
        return Cache::remember("page_{$slug}", 3600, function () use ($slug) {
            return self::where('slug', $slug)->first();
        });
    }

    /**
     * Check if page is enabled
     */
    public function isEnabled(): bool
    {
        return $this->is_enabled;
    }

    /**
     * Check if page is public
     */
    public function isPublic(): bool
    {
        return $this->is_public;
    }

    /**
     * Check if page is published
     */
    public function isPublished(): bool
    {
        if ($this->status !== 'published') {
            return false;
        }
        
        if ($this->published_at && $this->published_at->isFuture()) {
            return false;
        }
        
        return true;
    }

    /**
     * Check if page is draft
     */
    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    /**
     * Check if page is scheduled
     */
    public function isScheduled(): bool
    {
        return $this->status === 'scheduled' && $this->published_at && $this->published_at->isFuture();
    }

    /**
     * Get processed content
     */
    public function getContent(): string
    {
        return $this->content ?? '';
    }

    /**
     * Get page setting by key
     */
    public function getSetting(string $key, $default = null)
    {
        return $this->settings[$key] ?? $default;
    }

    /**
     * Set page setting
     */
    public function setSetting(string $key, $value): void
    {
        $settings = $this->settings ?? [];
        $settings[$key] = $value;
        $this->settings = $settings;
    }

    /**
     * Clear page cache when saving
     */
    protected static function booted()
    {
        static::saved(function ($page) {
            Cache::forget('navigation_pages');
            // Clear all page-related cache keys without using tags
            Cache::forget('pages_all');
            Cache::forget('pages_public');
            Cache::forget('pages_enabled');
            // Clear the specific page cache
            Cache::forget("page_{$page->slug}");
        });

        static::deleted(function ($page) {
            Cache::forget('navigation_pages');
            // Clear all page-related cache keys without using tags
            Cache::forget('pages_all');
            Cache::forget('pages_public');
            Cache::forget('pages_enabled');
            // Clear the specific page cache
            Cache::forget("page_{$page->slug}");
        });
    }

    /**
     * Get the route key name for model binding
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
