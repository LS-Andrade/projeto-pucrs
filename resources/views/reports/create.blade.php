@extends('layouts.app')

@section('title', 'Fazer Denúncia')

@section('content')
<h1 class="text-2xl font-bold mb-6">Fazer Denúncia</h1>

<form method="POST" action="{{ route('reports.store') }}"
      class="max-w-xl bg-white dark:bg-gray-800 p-6 rounded shadow space-y-4">
    @csrf

    <div>
        <label class="block text-sm mb-1">Descrição do animal</label>
        <textarea name="animal_description" class="w-full rounded border-gray-300 dark:border-gray-700" required></textarea>
    </div>

    <div>
        <label class="block text-sm mb-1">Localização</label>
        <input type="text" name="location" class="w-full rounded border-gray-300 dark:border-gray-700" required>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm mb-1">Cidade</label>
            <input type="text" name="city" class="w-full rounded border-gray-300 dark:border-gray-700" required>
        </div>
        <div>
            <label class="block text-sm mb-1">Estado</label>
            <input type="text" name="state" class="w-full rounded border-gray-300 dark:border-gray-700" maxlength="2" required>
        </div>
    </div>

    <button class="bg-red-600 text-white px-6 py-3 rounded hover:bg-red-700 transition">
        Enviar denúncia
    </button>
</form>
@endsection
