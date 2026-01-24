@extends('layouts.app')

@section('title', 'Conteúdos')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    {{-- Título --}}
    <section class="mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-[#A02CDB] mb-2">
        Conteúdos
        </h1>
    </section>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @if($contents->count())
            @foreach($contents as $content)
                <div class="bg-white p-6 rounded shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold mb-2">{{ $content->title }}</h2>
                    <p class="text-sm text-gray-500 mb-2">
                        {{ $content->category->name }} • {{ $content->published_at->format('d/m/Y') }}
                    </p>
                    <p class="text-sm line-clamp-3">{{ Str::limit(strip_tags($content->content), 120) }}</p>

                    <a href="{{ route('contents.show', $content) }}"
                    class="inline-block mt-4 text-green-600 hover:underline">
                        Ler mais →
                    </a>
                </div>
            @endforeach
        @else
            <p class="col-span-full text-center text-gray-500">Nenhum conteúdo disponível.</p>
        @endif
    </div>

    {{-- Paginação --}}
    @if ($contents->hasPages())
        <div class="flex items-center justify-between mt-10 w-full">

            {{-- Anterior --}}
            @if ($contents->onFirstPage())
                <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-lg cursor-not-allowed">
                    ← Anterior
                </span>
            @else
                <a href="{{ $contents->previousPageUrl() }}"
                class="px-4 py-2 text-sm font-medium text-[#A02CDB] bg-white border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                    ← Anterior
                </a>
            @endif

            {{-- Próximo --}}
            @if ($contents->hasMorePages())
                <a href="{{ $contents->nextPageUrl() }}"
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
</div>
@endsection
