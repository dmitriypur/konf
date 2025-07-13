<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ClearPageCache extends Command
{
    protected $signature = 'page:clear-cache';
    protected $description = 'Clear page cache when blocks are updated';

    public function handle()
    {
        Cache::forget('active_page_with_blocks');
        $this->info('Page cache cleared successfully!');
    }
} 