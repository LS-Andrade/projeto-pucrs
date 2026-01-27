@extends('layouts.dashboard')

@section('title', $titulo ?? 'Em breve')

@section('content')
<div class="max-w-2xl">
    <h1 class="text-2xl font-bold text-[#A02CDB] mb-2">{{ $titulo ?? 'Módulo' }}</h1>
    <p class="text-gray-600 mb-6">Este módulo está em desenvolvimento e estará disponível em breve.</p>
    <a href="{{ route('dashboard') }}" class="inline-block px-4 py-2 rounded-lg bg-[#A02CDB] text-white hover:bg-[#8a25bd] transition">← Voltar ao painel</a>
</div>
@endsection
