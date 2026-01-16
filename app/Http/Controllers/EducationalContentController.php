<?php
namespace App\Http\Controllers;

use App\Models\EducationalContent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EducationalContentController extends Controller
{
    public function index()
    {
        return EducationalContent::where('is_published', true)->latest()->paginate(15);
    }

    public function show($slug)
    {
        return EducationalContent::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();
    }

    public function store(Request $request)
    {
        $this->authorize('create', EducationalContent::class);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        $content = EducationalContent::create([
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'content' => $data['content'],
            'author_id' => $request->user()->id,
            'is_published' => false
        ]);

        return response()->json($content, 201);
    }

    public function update(Request $request, EducationalContent $content)
    {
        $this->authorize('update', $content);

        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string'
        ]);

        if (isset($data['title'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $content->update($data);

        return response()->json($content);
    }

    public function destroy(EducationalContent $content)
    {
        $this->authorize('delete', $content);

        $content->delete();

        return response()->json(['message' => 'Conteúdo removido']);
    }

    public function publish(EducationalContent $content)
    {
        $this->authorize('publish', $content);

        $content->update(['is_published' => true]);

        return response()->json($content);
    }

    public function unpublish(EducationalContent $content)
    {
        $this->authorize('publish', $content);

        $content->update(['is_published' => false]);

        return response()->json($content);
    }
}