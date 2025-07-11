<?php

namespace App\Models;

use App\Enums\BlockType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * @property string $id
 * @property BlockType $type
 * @property string $title
 * @property string $anchor
 * @property integer $order_column
 * @property array $settings
 * @property array $payload
 */
class Block extends Model implements Sortable
{
    use HasFactory, SortableTrait;
    protected $fillable = [
        'page_id',
        'title',
        'anchor',
        'type',
        'settings',
        'payload',
        'order_column',
    ];

    protected $casts = [
        'type' => BlockType::class,
        'settings' => 'json',
        'payload' => 'json',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
