@extends('layouts.app')

@section('title', $content->title)

@section('content')
<article class="max-w-3xl mx-auto">
    <h1 class="text-3xl font-bold mb-4">{{ $content->title }}</h1>

    <p class="text-sm text-gray-500 mb-6">
        {{ $content->category->name }} • Publicado em {{ $content->published_at->format('d/m/Y') }}
        • por {{ $content->author->name }}
    </p>

    <div class="prose dark:prose-invert max-w-none">
        {!! $content->content !!}
    </div>
</article>
@endsection
