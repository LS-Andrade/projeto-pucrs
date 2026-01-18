@extends('layouts.app')

@section('title', 'Pedido de adoção — Animalidade')

@section('content')
<section class="max-w-3xl mx-auto">

    <nav class="mb-6 text-sm text-gray-600 dark:text-gray-400">
        <a href="{{ route('home') }}" class="hover:underline">Início</a> /
        <a href="{{ route('animals.index') }}" class="hover:underline">Adoção</a> /
        <a href="{{ route('animals.show', $animal) }}" class="hover:underline">{{ $animal->name }}</a> /
        <span class="font-semibold">Pedido de adoção</span>
    </nav>

    <h1 class="text-3xl font-bold text-green-600 mb-6">
        Pedido de adoção — {{ $animal->name }}
    </h1>

    <div class="bg-white dark:bg-gray-800 rounded shadow p-6">
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('adoptions.store') }}">
            @csrf
            <input type="hidden" name="animal_id" value="{{ $animal->id }}">

            <div class="mb-4">
                <label for="motivation" class="block font-semibold mb-2">
                    Por que você deseja adotar este animal?
                </label>
                <textarea
                    id="motivation"
                    name="motivation"
                    rows="5"
                    class="w-full border-gray-300 rounded focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    required>{{ old('motivation') }}</textarea>
            </div>

            <div class="flex justify-end gap-4">
                <a href="{{ route('animals.show', $animal) }}"
                   class="px-6 py-2 border rounded text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    Cancelar
                </a>

                <button type="submit"
                        class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">
                    Enviar pedido
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
