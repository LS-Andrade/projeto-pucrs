@extends('layouts.app')

@section('title', 'Animalidade - Bem-estar Animal')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <section class="text-center mb-16">
        <img src="{{ asset('images/banner-home.jpg')}}" alt="Banner Animalidade" class="mx-auto shadow-lg">
    </section>

    {{-- Hero --}}
    <section class="text-center mb-16">
        <h1 class="text-3xl md:text-4xl font-bold text-[#A02CDB] mb-4">
            Animalidade - Promovendo o bem-estar animal
        </h1>
        <p class="text-lg text-gray-700 max-w-3xl mx-auto leading-relaxed">
            Nosso projeto visa conscientizar, proteger e promover os direitos dos animais,
            alinhado às boas práticas internacionais e à legislação brasileira.
        </p>
    </section>

    {{-- 5 Liberdades --}}
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-20">
        <div class="bg-white p-6 rounded-xl shadow-sm border">
            <h2 class="text-xl font-semibold text-[#2CDBC0] mb-2">🍽 Liberdade Nutricional</h2>
            <p class="mb-2">Garantir acesso a água limpa e alimentação adequada.</p>
            <p class="text-sm text-gray-600">
                Constituição Federal (art. 225) e Decreto nº 24.645/1934.
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border">
            <h2 class="text-xl font-semibold text-[#2CDBC0] mb-2">🩺 Liberdade Sanitária</h2>
            <p class="mb-2">Prevenir doenças e garantir atendimento veterinário.</p>
            <p class="text-sm text-gray-600">
                Lei nº 9.605/1998 - Crimes Ambientais.
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border">
            <h2 class="text-xl font-semibold text-[#2CDBC0] mb-2">🏠 Liberdade Ambiental</h2>
            <p class="mb-2">Ambiente seguro, limpo e compatível com a espécie.</p>
            <p class="text-sm text-gray-600">
                Decreto nº 24.645/1934.
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border">
            <h2 class="text-xl font-semibold text-[#2CDBC0] mb-2">🐕 Liberdade Comportamental</h2>
            <p class="mb-2">Expressar comportamentos naturais da espécie.</p>
            <p class="text-sm text-gray-600">
                Lei nº 9.605/1998 e diretrizes do CFMV.
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border md:col-span-2 lg:col-span-1">
            <h2 class="text-xl font-semibold text-[#2CDBC0] mb-2">🧠 Liberdade Psicológica</h2>
            <p class="mb-2">Evitar sofrimento mental, medo e estresse.</p>
            <p class="text-sm text-gray-600">
                Constituição Federal (art. 225) e Lei nº 9.605/1998.
            </p>
        </div>
    </section>

    {{-- CTA --}}
    <section class="text-center mb-12">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">
            Como você pode ajudar?
        </h2>
        <p class="mb-6 text-gray-700">
            Adote, denuncie maus-tratos e compartilhe informação.
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('animals.index') }}"
                class="bg-green-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-purple-700 transition shadow">
                Ver animais para adoção
            </a>

            <a href="{{ route('reports.create') }}"
               class="bg-red-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-red-700 transition shadow">
                Fazer denúncia
            </a>
        </div>
    </section>

</div>
@endsection
