<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Adoption;
use App\Models\Animal;
use Illuminate\Http\Request;

class AdoptionController extends Controller
{
    public function create(Animal $animal)
    {
        return view('adoptions.create', compact('animal'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'animal_id'  => ['required', 'exists:animals,id'],
            'motivation' => ['required', 'string', 'min:10'],
        ]);

        // Verificar se o usuário já fez uma solicitação para este animal
        $existingAdoption = Adoption::where('animal_id', $validated['animal_id'])
            ->where('adopter_id', auth()->id())
            ->first();

        if ($existingAdoption) {
            return redirect()->back()
                ->withErrors(['animal_id' => 'Você já enviou uma solicitação de adoção para este animal.']);
        }

        Adoption::create([
            'animal_id'   => $validated['animal_id'],
            'adopter_id'  => auth()->id(),
            'status'      => 'pending',
            'motivation'  => $validated['motivation'],
            'created_by'  => auth()->id(),
            'updated_by'  => auth()->id(),
        ]);

        return redirect()->route('animals.show', $validated['animal_id'])
            ->with('success', 'Pedido de adoção enviado com sucesso!');
    }
}
