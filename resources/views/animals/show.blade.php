@extends('layouts.app')

@section('title', $animal->name . ' - Animalidade')

@section('content')
<section class="max-w-7xl mx-auto px-4 py-8">

    {{-- Breadcrumb --}}
    <nav class="mb-6 text-sm text-gray-600">
        <a href="{{ route('home') }}" class="hover:text-purple-600">Início</a> /
        <a href="{{ route('animals.index') }}" class="hover:text-purple-600">Adoção</a> /
        <span class="font-semibold text-gray-800">{{ $animal->name }}</span>
    </nav>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        {{-- Galeria --}}
        <div x-data="{ photo: '{{ $animal->photos->first()?->photo ? ($animal->photos->first()->photo) : '' }}' }">
            <div class="bg-gray-100 rounded-xl overflow-hidden mb-4 h-80 flex items-center justify-center shadow">
                @if($animal->photos->first())
                    <img :src="photo" alt="{{ $animal->name }}" class="w-full h-full object-cover">
                @else
                    <span class="text-gray-500">Sem imagens</span>
                @endif
            </div>

            @if($animal->photos->count() > 1)
                <div class="flex space-x-2 overflow-x-auto pb-2">
                    @foreach($animal->photos as $photo)
                        <img src="{{ $photo->photo }}"
                             alt="{{ $animal->name }}"
                             @click="photo='{{ $photo->photo }}'"
                             class="w-20 h-20 object-cover rounded-lg cursor-pointer border-2 border-transparent hover:border-purple-600 transition">
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Informações --}}
        <div>
            <h1 class="text-3xl font-bold text-purple-700 mb-2">
                {{ $animal->name }}
            </h1>

            <p class="text-gray-700 mb-4 leading-relaxed">
                {{ $animal->description ?? 'Sem descrição disponível.' }}
            </p>

            <div class="grid grid-cols-2 gap-4 text-sm mb-6">
                <div><strong>Espécie:</strong> {{ ucfirst($animal->species) }}</div>
                <div><strong>Raça:</strong> {{ $animal->breed ?? 'Não informada' }}</div>
                <div><strong>Sexo:</strong> {{ ucfirst($animal->gender) }}</div>
                <div><strong>Porte:</strong> {{ ucfirst($animal->size) }}</div>
                <div><strong>Cor:</strong> {{ $animal->color ?? 'Não informada' }}</div>
                <div><strong>Idade:</strong> {{ $animal->age ?? 'Não informada' }}</div>
                <div><strong>Castrado:</strong> {{ $animal->is_castrated ? 'Sim' : 'Não' }}</div>
                <div><strong>Vacinado:</strong> {{ $animal->is_vaccinated ? 'Sim' : 'Não' }}</div>
                <div><strong>Saúde:</strong> {{ $animal->health_status ?? 'Não informada' }}</div>
                <div>
                    <strong>Status:</strong>
                    <span class="inline-block px-2 py-1 rounded text-xs font-medium
                        {{ $animal->status === 'available' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-700' }}">
                        {{ ucfirst($animal->status) }}
                    </span>
                </div>
            </div>

            {{-- Organização --}}
            <div class="bg-sky-500 p-4 rounded-xl mb-6 shadow-sm">
                <h2 class="text-lg font-semibold mb-2 text-gray-800">Responsável</h2>
                <p class="font-medium text-gray-900">
                    {{ $animal->organization->name ?? 'Organização não informada' }}
                </p>
                @if($animal->organization)
                    <p class="text-sm text-gray-600">
                        {{ $animal->organization->city }}, {{ $animal->organization->state }}
                    </p>
                    <p class="text-sm text-gray-600 mt-1">
                        📞 {{ $animal->organization->phone }}<br>
                        ✉️ {{ $animal->organization->email }}
                    </p>
                @endif
            </div>

            {{-- CTA --}}
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('adoptions.create', $animal) }}"
                   class="bg-purple-600 text-white px-6 py-3 rounded-xl text-center font-semibold hover:bg-purple-700 transition">
                    Quero adotar
                </a>

                <a href="{{ route('reports.create') }}"
                   class="bg-red-600 text-white px-6 py-3 rounded-xl text-center font-semibold hover:bg-red-700 transition">
                    Denunciar maus-tratos
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
