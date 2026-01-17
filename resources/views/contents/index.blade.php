@extends('layouts.app')

@section('title', 'Conteúdos')

@section('content')
<h1 class="text-2xl font-bold mb-6">Conteúdos</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($contents as $content)
        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow hover:shadow-lg transition">
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
    @empty
        <p class="col-span-full text-center text-gray-500">Nenhum conteúdo disponível.</p>
    @endforelse
</div>

<div class="mt-8">
    {{ $contents->links() }}
</div>
@endsection
