<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Content;

class ContentController extends Controller
{
    public function index()
    {
        return view('contents.index', [
            'contents' => Content::where('is_active', true)
                ->whereNotNull('published_at')
                ->latest('published_at')
                ->with('category', 'author')
                ->paginate(9),
        ]);
    }

    public function show(Content $content)
    {
        abort_unless($content->is_active, 404);

        return view('contents.show', [
            'content' => $content->load('category', 'author'),
        ]);
    }
}
