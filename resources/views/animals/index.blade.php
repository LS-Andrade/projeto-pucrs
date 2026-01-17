@extends('layouts.app')

@section('title', 'Animais para adoção')

@section('content')
<div x-data="{ openFilters: false }">
    <h1 class="text-2xl font-bold mb-6">Animais disponíveis para adoção</h1>

    {{-- Filtros --}}
    <div class="mb-6">
        <button @click="openFilters = !openFilters"
                class="md:hidden bg-green-600 text-white px-4 py-2 rounded mb-4">
            Filtros
        </button>

        <form method="GET"
              class="grid grid-cols-1 md:grid-cols-4 gap-4 bg-white dark:bg-gray-800 p-4 rounded shadow">

            {{-- Busca --}}
            <div>
                <label class="block text-sm mb-1">Buscar por nome</label>
                <input type="text" name="search" value="{{ request('search') }}"
                       class="w-full rounded border-gray-300 dark:border-gray-700 dark:bg-gray-900">
            </div>

            {{-- Espécie --}}
            <div>
                <label class="block text-sm mb-1">Espécie</label>
                <select name="species"
                        class="w-full rounded border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                    <option value="">Todas</option>
                    @foreach($speciesList as $species)
                        <option value="{{ $species }}" @selected(request('species') == $species)>
                            {{ ucfirst($species) }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Porte --}}
            <div>
                <label class="block text-sm mb-1">Porte</label>
                <select name="size"
                        class="w-full rounded border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                    <option value="">Todos</option>
                    <option value="small" @selected(request('size') == 'small')>Pequeno</option>
                    <option value="medium" @selected(request('size') == 'medium')>Médio</option>
                    <option value="large" @selected(request('size') == 'large')>Grande</option>
                </select>
            </div>

            {{-- Botão --}}
            <div class="flex items-end">
                <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition w-full">
                    Filtrar
                </button>
            </div>
        </form>
    </div>

    {{-- Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($animals as $animal)
            @include('components.animal-card', ['animal' => $animal])
        @empty
            <p class="col-span-full text-center text-gray-500">Nenhum animal encontrado.</p>
        @endforelse
    </div>

    {{-- Paginação --}}
    <div class="mt-8">
        {{ $animals->links() }}
    </div>
</div>
@endsection
