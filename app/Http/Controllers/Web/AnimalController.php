<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Animal::with('mainPhoto')->where('status', 'available');

        if ($request->filled('species')) {
            $query->where('species', $request->species);
        }

        if ($request->filled('size')) {
            $query->where('size', $request->size);
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('is_castrated')) {
            $query->where('is_castrated', $request->is_castrated);
        }

        if ($request->filled('is_vaccinated')) {
            $query->where('is_vaccinated', $request->is_vaccinated);
        }

        $animals = $query->latest()->paginate(12)->withQueryString();

        return view('animals.index', compact('animals'));
    }
    
    public function show(Animal $animal)
    {
        return view('animals.show', [
            'animal' => $animal->load('photos', 'organization'),
        ]);
    }
}
