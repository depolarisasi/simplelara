<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::creating(function ($location) {
            // Set default owner_id to 1 (Admin) if not provided
            if (empty($location->owner_id)) {
                $location->owner_id = 1;
            }
        });
    }

    /**
     * Get the owner that owns the location.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Get the category that the location belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(LocationCategory::class, 'location_category_id');
    }

    /**
     * Get the photos for the location.
     */
    public function photos(): HasMany
    {
        // Using the correct model name LocationPhotos
        return $this->hasMany(LocationPhotos::class);
    }

    /**
     * Get the city that the location belongs to.
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the province that the location belongs to.
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }
}
