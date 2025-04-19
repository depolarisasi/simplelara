<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AppSlider extends Model
{
    use HasFactory;

    protected $fillable = [
        'slider_url',
        'slider_title',
        'slider_caption',
        'slider_type'
    ];

    /**
     * Get slider image URL
     *
     * @return string|null
     */
    public function getImageUrl()
    {
        if ($this->slider_url) {
            try {
                // Menggunakan temporary URL untuk mengatasi masalah CORS
                return Storage::disk('s3')->temporaryUrl($this->slider_url, now()->addMinutes(30));
            } catch (\Exception $e) {
                // Jika gagal, gunakan URL biasa
                \Log::error('Gagal membuat temporary URL untuk gambar slider: ' . $e->getMessage());
                return Storage::disk('s3')->url($this->slider_url);
            }
        }
        return null;
    }

    /**
     * Scope a query to only include big sliders.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBig($query)
    {
        return $query->where('slider_type', 'Big');
    }

    /**
     * Scope a query to only include small sliders.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSmall($query)
    {
        return $query->where('slider_type', 'Small');
    }
} 