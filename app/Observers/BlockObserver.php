<?php

namespace App\Observers;

use App\Models\Block;
use Illuminate\Support\Facades\Cache;

class BlockObserver
{
    public function saved(Block $block)
    {
        Cache::forget('active_page_with_blocks');
    }

    public function deleted(Block $block)
    {
        Cache::forget('active_page_with_blocks');
    }
} 