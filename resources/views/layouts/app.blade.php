<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Bem-Estar Animal')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 antialiased">

<div class="min-h-screen flex flex-col">

    {{-- Navbar --}}
    <header x-data="{ open: false }" class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-xl font-bold text-emerald-600">
                🐾 Bem-Estar Animal
            </a>

            {{-- Desktop menu --}}
            <nav class="hidden md:flex space-x-6">
                <a href="/animals" class="text-gray-700 hover:text-emerald-600">Animais</a>
                <a href="/contents" class="text-gray-700 hover:text-emerald-600">Conteúdos</a>
                <a href="/reports" class="text-gray-700 hover:text-emerald-600">Denúncias</a>
                @auth
                    <a href="/dashboard" class="text-gray-700 hover:text-emerald-600">Dashboard</a>
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-700">Sair</button>
                    </form>
                @else
                    <a href="/login" class="text-gray-700 hover:text-emerald-600">Entrar</a>
                    <a href="/register" class="text-gray-700 hover:text-emerald-600">Cadastrar</a>
                @endauth
            </nav>

            {{-- Mobile menu button --}}
            <button @click="open = !open" class="md:hidden text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        {{-- Mobile menu --}}
        <div x-show="open" @click.outside="open = false" class="md:hidden bg-white border-t">
            <nav class="flex flex-col px-4 py-3 space-y-2">
                <a href="/animals" class="block py-2 text-gray-700 hover:text-emerald-600">Animais</a>
                <a href="/contents" class="block py-2 text-gray-700 hover:text-emerald-600">Conteúdos</a>
                <a href="/reports" class="block py-2 text-gray-700 hover:text-emerald-600">Denúncias</a>
                @auth
                    <a href="/dashboard" class="block py-2 text-gray-700 hover:text-emerald-600">Dashboard</a>
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit" class="block py-2 text-left text-red-600 hover:text-red-700 w-full">
                            Sair
                        </button>
                    </form>
                @else
                    <a href="/login" class="block py-2 text-gray-700 hover:text-emerald-600">Entrar</a>
                    <a href="/register" class="block py-2 text-gray-700 hover:text-emerald-600">Cadastrar</a>
                @endauth
            </nav>
        </div>
    </header>

    {{-- Conteúdo principal --}}
    <main class="flex-1 max-w-7xl mx-auto px-4 py-6">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-white border-t">
        <div class="max-w-7xl mx-auto px-4 py-6 text-center text-sm text-gray-500">
            © {{ date('Y') }} Projeto Bem-Estar Animal — Desenvolvido por Lucas Andrade 🐾
        </div>
    </footer>

</div>

</body>
</html>
