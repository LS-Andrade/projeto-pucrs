@extends('layouts.app')

@section('title', 'Pedido de adoção - Animalidade')

@section('content')
<section class="max-w-7xl mx-auto px-4 py-8">

    {{-- Breadcrumb --}}
    <nav class="mb-6 text-sm text-gray-600">
        <a href="{{ route('home') }}" class="hover:text-purple-600">Início</a> /
        <a href="{{ route('animals.index') }}" class="hover:text-purple-600">Adoção</a> /
        <a href="{{ route('animals.show', $animal) }}" class="hover:text-purple-600">{{ $animal->name }}</a> /
        <span class="font-semibold text-gray-800">Pedido de adoção</span>
    </nav>

    @auth
        <div class="grid grid-cols-1 gap-8">

            <h1 class="text-3xl font-bold text-green-600">
                Pedido de adoção - {{ $animal->name }}
            </h1>

            <div class="bg-white rounded-xl shadow-sm border overflow-hidden flex flex-col">
                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ url('/adocoes') }}">
                    @csrf
                    <input type="hidden" name="animal_id" value="{{ $animal->id }}">

                    <div class="p-4 flex flex-col flex-1">
                        <h5 class="text-red-500">Atenção!</h5>
                        <p>
                            Ao enviar este pedido de adoção, você concorda em seguir todos os procedimentos necessários para garantir o bem-estar do animal. Nossa equipe entrará em contato para discutir os próximos passos e avaliar sua adequação para a adoção.
                        </p>
                        <p>
                            O envio do pedido de adoção não garante a aprovação imediata. Cada pedido será cuidadosamente analisado para assegurar que o animal seja colocado em um ambiente seguro e amoroso.
                        </p>
                    </div>

                    <div class="p-4 flex flex-col flex-1">
                        <h2 class="text-lg font-semibold text-[#A02CDB] mb-1">
                            Por que você deseja adotar este animal?
                        </h2>
                    
                        <textarea
                            id="motivation"
                            name="motivation"
                            rows="5"
                            class="w-full border border-gray-500 rounded focus:ring-green-500 focus:border-green-500"
                            required>{{ old('motivation') }}</textarea>
                    </div>

                    <div class="p-4 flex flex-1 gap-4 justify-end ">
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
        
        </div>
    @else 
        <div class="grid grid-cols-1 gap-8">

            <h1 class="text-3xl font-bold text-green-600">
                Pedido de adoção
            </h1>
            
            <p>
                Para realizar um pedido de adoção, é necessário estar conectado!
            </p>
            <p>
                <a href="{{ route('login') }}" class="hover:text-primary transition">Clique aqui</a> para para se conectar
            </p>
        
        </div>
    @endauth
</section>
@endsection
