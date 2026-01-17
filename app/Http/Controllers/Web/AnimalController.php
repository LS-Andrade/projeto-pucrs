<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index(Request $request)
    {
        $query = Animal::query()->where('status', 'available');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('species')) {
            $query->where('species', $request->species);
        }

        if ($request->filled('size')) {
            $query->where('size', $request->size);
        }

        return view('animals.index', [
            'animals' => $query->with('photos')->paginate(9)->withQueryString(),
            'speciesList' => Animal::select('species')->distinct()->pluck('species'),
        ]);
    }
    
    public function show(Animal $animal)
    {
        return view('animals.show', [
            'animal' => $animal->load('photos', 'organization'),
        ]);
    }
}
