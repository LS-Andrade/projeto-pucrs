@extends('layouts.app')

@section('title', $content->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <article class="mx-auto">
        {{-- Título --}}
        <h1 class="text-3xl md:text-4xl font-bold text-[#A02CDB] mb-2">
            {{ $content->title }}
        </h1>

        {{-- Categoria e data de publicação --}}
        <p class="text-sm text-gray-500 mb-6">
            {{ $content->category->name }} • Publicado em {{ $content->published_at->format('d/m/Y') }}
            • por {{ $content->author->name }}
        </p>

        {{-- Conteúdo --}}
        <div class="prose dark:prose-invert max-w-none">
            {!! $content->content !!}
        </div>
    </article>

    {{-- Botão de voltar --}}
    <a href="{{ route('contents.index') }}"
       class="inline-block mt-4 text-green-600 hover:underline">
        ← Voltar para conteúdos
    </a>
</div>
@endsection
