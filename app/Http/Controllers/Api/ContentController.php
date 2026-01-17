<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContentStoreRequest;
use App\Http\Requests\ContentUpdateRequest;
use App\Models\Content;

class ContentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Content::class, 'content');
    }

    public function index()
    {
        return Content::with('category', 'author')->paginate();
    }

    public function show(Content $content)
    {
        return $content->load('category', 'author');
    }

    public function store(ContentStoreRequest $request)
    {
        return Content::create([
            ...$request->validated(),
            'author_id'  => auth()->id(),
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);
    }

    public function update(ContentUpdateRequest $request, Content $content)
    {
        $content->update($request->validated());
        $content->updated_by = auth()->id();
        $content->save();

        return $content;
    }

    public function destroy(Content $content)
    {
        $content->delete();
        return response()->noContent();
    }
}
