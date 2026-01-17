@extends('layouts.app')

@section('title', 'Animalidade — Bem-estar Animal')

@section('content')
<section class="max-w-5xl mx-auto text-center mb-12">
    <h1 class="text-3xl md:text-4xl font-bold text-green-600 mb-4">
        Animalidade — Promovendo o bem-estar animal
    </h1>
    <p class="text-lg text-gray-700 dark:text-gray-300">
        Nosso projeto visa conscientizar, proteger e promover os direitos dos animais,
        alinhado às boas práticas internacionais e à legislação brasileira.
    </p>
</section>

{{-- 5 Liberdades --}}
<section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto mb-12">
    {{-- Nutricional --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow hover:shadow-lg transition">
        <h2 class="text-xl font-semibold text-green-600 mb-2">🍽 Liberdade Nutricional</h2>
        <p class="mb-3">
            Garantir acesso a água limpa e alimentação adequada, em quantidade e qualidade suficientes.
        </p>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Referência legal: Constituição Federal (art. 225) e Decreto nº 24.645/1934.
        </p>
    </div>

    {{-- Sanitária --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow hover:shadow-lg transition">
        <h2 class="text-xl font-semibold text-green-600 mb-2">🩺 Liberdade Sanitária</h2>
        <p class="mb-3">
            Prevenir doenças, garantir atendimento veterinário e condições adequadas de saúde.
        </p>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Referência legal: Lei nº 9.605/1998 (Lei de Crimes Ambientais).
        </p>
    </div>

    {{-- Ambiental --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow hover:shadow-lg transition">
        <h2 class="text-xl font-semibold text-green-600 mb-2">🏠 Liberdade Ambiental</h2>
        <p class="mb-3">
            Oferecer ambiente adequado, seguro, limpo e compatível com a espécie.
        </p>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Referência legal: Decreto nº 24.645/1934 e normas estaduais/municipais de proteção animal.
        </p>
    </div>

    {{-- Comportamental --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow hover:shadow-lg transition">
        <h2 class="text-xl font-semibold text-green-600 mb-2">🐕 Liberdade Comportamental</h2>
        <p class="mb-3">
            Permitir que o animal expresse comportamentos naturais da sua espécie.
        </p>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Referência legal: Lei nº 9.605/1998 e diretrizes do Conselho Federal de Medicina Veterinária (CFMV).
        </p>
    </div>

    {{-- Psicológica --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow hover:shadow-lg transition md:col-span-2 lg:col-span-1">
        <h2 class="text-xl font-semibold text-green-600 mb-2">🧠 Liberdade Psicológica</h2>
        <p class="mb-3">
            Evitar sofrimento mental, medo, estresse e garantir condições emocionais adequadas.
        </p>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Referência legal: Constituição Federal (art. 225) e Lei nº 9.605/1998.
        </p>
    </div>
</section>

{{-- Base Legal --}}
<section class="max-w-5xl mx-auto bg-green-50 dark:bg-gray-800 p-8 rounded shadow mb-12">
    <h2 class="text-2xl font-semibold text-green-700 mb-4">Base Legal no Brasil</h2>
    <ul class="space-y-2 text-gray-700 dark:text-gray-300">
        <li>• Constituição Federal de 1988 — Art. 225: Proteção da fauna e vedação de práticas cruéis.</li>
        <li>• Decreto nº 24.645/1934 — Estabelece medidas de proteção aos animais.</li>
        <li>• Lei nº 9.605/1998 — Lei de Crimes Ambientais.</li>
        <li>• Resoluções do Conselho Federal de Medicina Veterinária (CFMV).</li>
        <li>• Leis estaduais e municipais de proteção animal.</li>
    </ul>
</section>

{{-- Call to Action --}}
<section class="text-center">
    <h2 class="text-2xl font-semibold mb-4">Como você pode ajudar?</h2>
    <p class="mb-6">
        Adote, denuncie maus-tratos e compartilhe informação.
    </p>
    <div class="flex justify-center space-x-4">
        <a href="{{ route('animals.index') }}"
           class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700 transition">
            Ver animais para adoção
        </a>
        <a href="{{ route('reports.create') }}"
           class="bg-red-600 text-white px-6 py-3 rounded hover:bg-red-700 transition">
            Fazer denúncia
        </a>
    </div>
</section>
@endsection
