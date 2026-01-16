@extends('layouts.app')

@section('title', 'Bem-Estar Animal')

@section('content')
<div class="text-center">
    <h1 class="text-3xl md:text-4xl font-bold text-emerald-700 mb-4">
        Promovendo o bem-estar animal através da tecnologia 🐾
    </h1>

    <p class="text-gray-600 max-w-2xl mx-auto mb-6">
        Uma plataforma dedicada à adoção responsável, denúncias de maus-tratos,
        educação e proteção animal.
    </p>

    <div class="flex flex-col md:flex-row justify-center gap-4">
        <a href="/animals"
           class="inline-block bg-emerald-600 text-white px-6 py-3 rounded-lg hover:bg-emerald-700 transition">
            Ver animais para adoção
        </a>

        <a href="/reports"
           class="inline-block border border-emerald-600 text-emerald-600 px-6 py-3 rounded-lg hover:bg-emerald-50 transition">
            Fazer uma denúncia
        </a>
    </div>
</div>
@endsection
