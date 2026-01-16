<?php
namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Feedback::class);
        return Feedback::with('user')->latest()->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'message' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5'
        ]);

        $feedback = Feedback::create([
            'user_id' => $request->user()->id,
            'message' => $data['message'],
            'rating' => $data['rating'] ?? null
        ]);

        return response()->json($feedback, 201);
    }
}