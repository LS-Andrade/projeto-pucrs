<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Animal;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'animals' => Animal::where('status', 'available')
                ->with('photos')
                ->latest()
                ->take(6)
                ->get(),
        ]);
    }
}
