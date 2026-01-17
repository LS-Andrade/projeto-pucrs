<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Animalidade')</title>

    <meta name="description" content="Animalidade — Plataforma dedicada ao bem-estar animal, adoção responsável, proteção e conscientização.">
    <meta name="keywords" content="bem-estar animal, adoção, proteção animal, direitos dos animais, legislação animal, animalidade">
    <meta name="author" content="Animalidade">

    <meta property="og:title" content="Animalidade — Bem-estar Animal">
    <meta property="og:description" content="Plataforma dedicada ao bem-estar animal, adoção responsável e proteção.">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="pt_BR">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

<header class="bg-white dark:bg-gray-800 shadow">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center space-x-3">
            <img src="{{ asset('images/logo-animalidade.svg') }}" alt="Animalidade" class="h-10">
        </a>

        <nav class="space-x-6">
            <a href="{{ route('home') }}" class="hover:text-green-600">Início</a>
            <a href="{{ route('animals.index') }}" class="hover:text-green-600">Adoção</a>
            <a href="{{ route('reports.create') }}" class="hover:text-green-600">Denúncias</a>
            <a href="{{ route('contents.index') }}" class="hover:text-green-600">Conteúdos</a>

            @auth
                <a href="{{ route('dashboard') }}" class="hover:text-green-600">Painel</a>
            @endauth
        </nav>
    </div>
</header>

<main class="min-h-screen py-10 px-4">
    @yield('content')
</main>

<footer class="bg-white dark:bg-gray-800 border-t mt-12">
    <div class="max-w-7xl mx-auto px-4 py-6 text-center text-sm text-gray-600 dark:text-gray-400">
        © {{ date('Y') }} Animalidade — Promovendo o bem-estar animal.
    </div>
</footer>

</body>
</html>
