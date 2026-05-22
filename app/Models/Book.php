<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    
    protected $table = 'books';
    
    protected $fillable = [
        'title',
        'author',
        'cover_image',
        'price',
        'published_date',
        'deleted'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'published_date' => 'date',
        'deleted' => 'boolean'
    ];

    // Only get non-deleted books by default
    protected static function booted()
    {
        static::addGlobalScope('notDeleted', function ($query) {
            $query->where('deleted', 0);
        });
    }

    // Scope for search functionality
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('title', 'LIKE', "%{$search}%")
                        ->orWhere('author', 'LIKE', "%{$search}%");
        }
        return $query;
    }
}
