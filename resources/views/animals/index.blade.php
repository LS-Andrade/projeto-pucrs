@extends('layouts.app')

@section('title', 'Animais para Adoção — Animalidade')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">

    {{-- Título --}}
    <section class="mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-[#A02CDB] mb-2">
            Animais para adoção
        </h1>
        <p class="text-gray-700">
            Encontre um novo amigo e pratique a adoção responsável.
        </p>
    </section>

    <div class="flex flex-col lg:flex-row gap-8">

        {{-- Filtros --}}
        <aside class="w-full lg:w-3/12 order-2 lg:order-1">
            @include('partials.filters')
        </aside>
    
        {{-- Lista --}}
        <section class="w-full lg:w-9/12 order-1 lg:order-2">

            @if($animals->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                    @foreach($animals as $animal)
                        <div class="bg-white rounded-xl shadow-sm border overflow-hidden flex flex-col">

                            {{-- Foto --}}
                            <a href="{{ route('animals.show', $animal) }}">
                                <div class="h-48 bg-gray-100 flex items-center justify-center overflow-hidden">
                                    @if($animal->photos->first())
                                        <img src="{{ $animal->photos->first()->photo }}"
                                             alt="{{ $animal->name }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <span class="text-gray-400 text-sm">Sem imagem</span>
                                    @endif
                                </div>
                            </a>

                            {{-- Conteúdo --}}
                            <div class="p-4 flex flex-col flex-1">
                                <h2 class="text-lg font-semibold text-gray-800 mb-1">
                                    {{ $animal->name }}
                                </h2>

                                <p class="text-sm text-gray-600 mb-2">
                                    {{ ucfirst($animal->species) }} • {{ ucfirst($animal->gender) }}
                                </p>

                                <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                    {{ $animal->description ?? 'Sem descrição disponível.' }}
                                </p>

                                <div class="mt-auto">
                                    <a href="{{ route('animals.show', $animal) }}"
                                       class="inline-block w-full text-center bg-[#A02CDB] text-white py-2 rounded-lg font-semibold hover:bg-purple-700 transition">
                                        Ver detalhes
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Paginação --}}
                @if ($animals->hasPages())
                    <div class="flex items-center justify-between mt-10">

                        {{-- Anterior --}}
                        @if ($animals->onFirstPage())
                            <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-lg cursor-not-allowed">
                                ← Anterior
                            </span>
                        @else
                            <a href="{{ $animals->previousPageUrl() }}"
                            class="px-4 py-2 text-sm font-medium text-[#A02CDB] bg-white border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                                ← Anterior
                            </a>
                        @endif

                        {{-- Próximo --}}
                        @if ($animals->hasMorePages())
                            <a href="{{ $animals->nextPageUrl() }}"
                            class="px-4 py-2 text-sm font-medium text-[#A02CDB] bg-white border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                                Próximo →
                            </a>
                        @else
                            <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-lg cursor-not-allowed">
                                Próximo →
                            </span>
                        @endif

                    </div>
                @endif

            @else
                <div class="bg-white p-8 rounded-xl shadow-sm border text-center">
                    <p class="text-gray-600">
                        Nenhum animal encontrado com os filtros selecionados.
                    </p>
                </div>
            @endif

        </section>
    </div>
</div>
@endsection
