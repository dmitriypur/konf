<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{
    public function __invoke()
    {
        $page = Cache::remember('active_page_with_blocks', 3600, function () {
            return Page::where('active', true)
                ->with(['blocks' => function ($query) {
                    $query->orderBy('order_column');
                }])
                ->firstOrFail();
        });
        
        return view('welcome', compact('page'));
    }
}
