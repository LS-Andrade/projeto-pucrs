<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index(Request $request)
    {
        $query = Content::where('is_active', true)
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->with('category', 'author');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $contents = $query->paginate(9)->withQueryString();

        return view('contents.index', compact('contents'));
    }

    public function show(Content $content)
    {
        abort_unless($content->is_active, 404);

        return view('contents.show', [
            'content' => $content->load('category', 'author'),
        ]);
    }
}
