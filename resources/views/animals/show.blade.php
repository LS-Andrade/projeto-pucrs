@extends('layouts.app')

@section('title', $animal->name)

@section('content')
<div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">

    {{-- Galeria --}}
    <div>
        <img src="{{ $animal->mainPhoto?->photo_url ?? '/images/animal-placeholder.jpg' }}"
             class="w-full h-80 object-cover rounded mb-4">

        <div class="grid grid-cols-4 gap-2">
            @foreach($animal->photos as $photo)
                <img src="{{ $photo->photo_url }}"
                     class="h-20 w-full object-cover rounded cursor-pointer hover:opacity-80">
            @endforeach
        </div>
    </div>

    {{-- Informações --}}
    <div>
        <h1 class="text-3xl font-bold mb-4">{{ $animal->name }}</h1>

        <p class="text-gray-600 mb-2">
            {{ ucfirst($animal->species) }} • {{ ucfirst($animal->gender) }} • {{ $animal->age }} anos
        </p>

        <p class="mb-4">{{ $animal->description }}</p>

        <ul class="space-y-2 text-sm">
            <li><strong>Porte:</strong> {{ ucfirst($animal->size) }}</li>
            <li><strong>Cor:</strong> {{ ucfirst($animal->color) }}</li>
            <li><strong>Saúde:</strong> {{ ucfirst($animal->health_status) }}</li>
            <li><strong>Castrado:</strong> {{ $animal->is_castrated ? 'Sim' : 'Não' }}</li>
            <li><strong>Vacinado:</strong> {{ $animal->is_vaccinated ? 'Sim' : 'Não' }}</li>
            <li><strong>Organização:</strong> {{ $animal->organization->name }}</li>
        </ul>

        <div class="mt-6">
            <a href="{{ route('adoptions.create', $animal) }}"
               class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700 transition">
                Quero adotar
            </a>
        </div>
    </div>
</div>
@endsection
