<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{
    public function __invoke()
    {
        $page = Page::where('active', true)->firstOrFail();
        return view('pages.show', compact('page'));
    }
}
