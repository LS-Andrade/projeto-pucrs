<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Animalidade')</title>

    <meta name="description" content="Animalidade — Plataforma para promoção do bem-estar animal, adoção responsável e educação animal.">

    {{-- Assets compilados --}}
    @php
        $manifestPath = public_path('build/manifest.json');
    @endphp

    @if(file_exists($manifestPath))
        @php
            $manifest = json_decode(file_get_contents($manifestPath), true);
            $css = $manifest['resources/css/app.css']['file'] ?? null;
            $js = $manifest['resources/js/app.js']['file'] ?? null;
        @endphp

        @if($css)
            <link rel="stylesheet" href="{{ asset('build/' . $css) }}">
        @endif

        @if($js)
            <script src="{{ asset('build/' . $js) }}" defer></script>
        @endif
    @else
        {{-- Fallback --}}
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}" defer></script>
    @endif
</head>
<body class="bg-gray-50 text-gray-800 font-sans min-h-screen flex flex-col">

    {{-- Header --}}
    @include('partials.header')

    {{-- Main --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    @stack('scripts')
</body>
</html>
