<?php
namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\Animal;
use Illuminate\Http\Request;

class AdoptionController extends Controller
{
    public function index(Request $request)
    {
        return Adoption::with('animal', 'adopter')
            ->where('adopter_id', $request->user()->id)
            ->orWhereHas('animal.organization.users', fn($q) => $q->where('users.id', $request->user()->id))
            ->paginate(15);
    }

    public function show(Adoption $adoption)
    {
        $this->authorize('view', $adoption);
        return $adoption->load('animal', 'adopter', 'followups');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'motivation' => 'nullable|string'
        ]);

        $animal = Animal::findOrFail($data['animal_id']);

        if ($animal->status !== 'available') {
            return response()->json(['message' => 'Animal não disponível para adoção'], 422);
        }

        $adoption = Adoption::create([
            'animal_id' => $animal->id,
            'adopter_id' => $request->user()->id,
            'motivation' => $data['motivation'] ?? null,
            'status' => 'pending'
        ]);

        $animal->update(['status' => 'pending']);

        return response()->json($adoption, 201);
    }

    public function approve(Adoption $adoption)
    {
        $this->authorize('approve', $adoption);

        $adoption->update(['status' => 'approved']);

        return response()->json($adoption);
    }

    public function reject(Adoption $adoption)
    {
        $this->authorize('reject', $adoption);

        $adoption->update(['status' => 'rejected']);
        $adoption->animal->update(['status' => 'available']);

        return response()->json($adoption);
    }

    public function complete(Adoption $adoption)
    {
        $this->authorize('complete', $adoption);

        $adoption->update(['status' => 'completed']);
        $adoption->animal->update(['status' => 'adopted']);

        return response()->json($adoption);
    }
}