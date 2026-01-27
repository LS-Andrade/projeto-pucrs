@extends('layouts.dashboard')

@section('title', 'Painel')

@section('content')
<div class="max-w-4xl">
    <h1 class="text-2xl font-bold text-[#A02CDB] mb-2">Painel Administrativo</h1>
    <p class="text-gray-600 mb-8">Selecione um módulo para gerenciar.</p>

    @if (session('error'))
        <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-700 text-sm">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <a href="{{ route('dashboard.categorias') }}" class="block p-5 bg-white rounded-xl border shadow-sm hover:shadow hover:border-[#A02CDB]/40 transition">
            <span class="text-2xl">📁</span>
            <h2 class="font-semibold text-gray-800 mt-2">Categorias</h2>
            <p class="text-sm text-gray-500">Conteúdos educacionais</p>
        </a>
        <a href="{{ route('dashboard.animais') }}" class="block p-5 bg-white rounded-xl border shadow-sm hover:shadow hover:border-[#A02CDB]/40 transition">
            <span class="text-2xl">🐕</span>
            <h2 class="font-semibold text-gray-800 mt-2">Animais</h2>
            <p class="text-sm text-gray-500">Cadastro para adoção</p>
        </a>
        <a href="{{ route('dashboard.conteudos') }}" class="block p-5 bg-white rounded-xl border shadow-sm hover:shadow hover:border-[#A02CDB]/40 transition">
            <span class="text-2xl">📄</span>
            <h2 class="font-semibold text-gray-800 mt-2">Conteúdos</h2>
            <p class="text-sm text-gray-500">Artigos e materiais</p>
        </a>
        <a href="{{ route('dashboard.denuncias') }}" class="block p-5 bg-white rounded-xl border shadow-sm hover:shadow hover:border-[#A02CDB]/40 transition">
            <span class="text-2xl">⚠️</span>
            <h2 class="font-semibold text-gray-800 mt-2">Denúncias</h2>
            <p class="text-sm text-gray-500">Maus-tratos</p>
        </a>
        <a href="{{ route('dashboard.adocoes') }}" class="block p-5 bg-white rounded-xl border shadow-sm hover:shadow hover:border-[#A02CDB]/40 transition">
            <span class="text-2xl">🏠</span>
            <h2 class="font-semibold text-gray-800 mt-2">Adoções</h2>
            <p class="text-sm text-gray-500">Pedidos e acompanhamento</p>
        </a>
        <a href="{{ route('dashboard.usuarios') }}" class="block p-5 bg-white rounded-xl border shadow-sm hover:shadow hover:border-[#A02CDB]/40 transition">
            <span class="text-2xl">👤</span>
            <h2 class="font-semibold text-gray-800 mt-2">Usuários</h2>
            <p class="text-sm text-gray-500">Contas do sistema</p>
        </a>
        <a href="{{ route('dashboard.organizacoes') }}" class="block p-5 bg-white rounded-xl border shadow-sm hover:shadow hover:border-[#A02CDB]/40 transition">
            <span class="text-2xl">🏢</span>
            <h2 class="font-semibold text-gray-800 mt-2">Organizações</h2>
            <p class="text-sm text-gray-500">Protetoras e ONGs</p>
        </a>
    </div>
</div>
@endsection
