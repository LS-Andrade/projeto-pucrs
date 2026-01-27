@extends('layouts.app')

@section('title', 'Entrar - Animalidade')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row justify-center items-center">
        <div class="w-full lg:w-2/5 order-1 hidden lg:block">
            <img 
                src="{{ asset('images/login.png') }}"
                alt="Animalidade - Cuidados com animais"
                class="w-full object-contain "
            />
        </div>  
        <div class="w-full lg:w-3/5 order-2 bg-white rounded-lg shadow-lg p-[50px] sm:p-[8px]" x-data="{ isLogin: {{ old('name') ? 'false' : (request()->routeIs('login') ? 'true' : 'false') }} }">
            <div x-show="isLogin">
                <h1 class="text-2xl sm:text-3xl font-bold text-[#A02CDB] mb-2">
                    Entrar
                </h1>
                <p class="text-gray-600 mb-6">
                    Acesse sua conta com e-mail e senha.
                </p>

                @if (session('error'))
                    <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-700 text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-700 text-sm">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.submit') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            E-mail
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-800
                                focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]
                                placeholder-gray-400"
                            placeholder="seu@email.com"
                        />
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                            Senha
                        </label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-800
                                focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]
                                placeholder-gray-400"
                            placeholder="••••••••"
                        />
                    </div>
                    
                    <div class="mb-6 text-blue-500">
                        <a href="#" class="hover:underline">
                            Esqueceu a senha?
                        </a>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-1">
                        <button
                            type="submit"
                            class="w-full sm:w-auto bg-[#A02CDB] text-white px-6 py-2.5 rounded-lg
                                font-medium hover:bg-[#8a25bd] transition shadow-sm"
                        >
                            Entrar
                        </button>
                        <a
                            href="{{ route('home') }}"
                            class="text-center text-gray-600 hover:text-[#A02CDB] text-sm transition"
                        >
                            Voltar ao início
                        </a>
                    </div>

                </form>
            </div>

            <div x-show="!isLogin">
                <h1 class="text-2xl sm:text-3xl font-bold text-[#A02CDB] mb-2">
                    Criar conta
                </h1>
                <p class="text-gray-600 mb-6">
                    Cadastre-se para adotar um animal.
                </p>

                @if ($errors->any())
                    <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-700 text-sm">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register.submit') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                            Nome completo
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-800
                                focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]
                                placeholder-gray-400"
                            placeholder="Seu nome completo"
                        />
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            E-mail
                        </label>
                        <input
                            type="email"
                            id="email_register"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-800
                                focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]
                                placeholder-gray-400"
                            placeholder="seu@email.com"
                        />
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                            Telefone
                        </label>
                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            value="{{ old('phone') }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-800
                                focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]
                                placeholder-gray-400"
                            placeholder="(11) 99999-9999"
                        />
                    </div>

                    <div>
                        <label for="password_register" class="block text-sm font-medium text-gray-700 mb-1">
                            Senha
                        </label>
                        <input
                            type="password"
                            id="password_register"
                            name="password"
                            required
                            autocomplete="new-password"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-800
                                focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]
                                placeholder-gray-400"
                            placeholder="••••••••"
                        />
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                            Confirmar senha
                        </label>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-800
                                focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]
                                placeholder-gray-400"
                            placeholder="••••••••"
                        />
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-1">
                        <button
                            type="submit"
                            class="w-full sm:w-auto bg-[#A02CDB] text-white px-6 py-2.5 rounded-lg
                                font-medium hover:bg-[#8a25bd] transition shadow-sm"
                        >
                            Criar conta
                        </button>
                        <a
                            href="{{ route('home') }}"
                            class="text-center text-gray-600 hover:text-[#A02CDB] text-sm transition"
                        >
                            Voltar ao início
                        </a>
                    </div>

                </form>
            </div>

            <div class="mt-6 text-center">
                <button @click="isLogin = !isLogin" class="text-[#A02CDB] hover:underline">
                    <span x-text="isLogin ? 'Não tem conta? Criar conta' : 'Já tem conta? Entrar'"></span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('phone').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length <= 11) {
        if (value.length <= 2) {
            value = value;
        } else if (value.length <= 6) {
            value = '(' + value.slice(0, 2) + ') ' + value.slice(2);
        } else if (value.length <= 10) {
            value = '(' + value.slice(0, 2) + ') ' + value.slice(2, 6) + '-' + value.slice(6);
        } else {
            value = '(' + value.slice(0, 2) + ') ' + value.slice(2, 7) + '-' + value.slice(7);
        }
    }
    e.target.value = value;
});
</script>
@endsection
