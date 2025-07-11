<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'seo',
        'active',
    ];

    protected $casts = [
        'seo' => 'json',
        'active' => 'bool',
    ];

    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class)
            ->orderBy('order_column');
    }
}
