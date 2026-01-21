<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Animalidade')</title>

    <meta name="description" content="Animalidade - Plataforma para promoção do bem-estar animal, adoção responsável e educação animal.">

    {{-- Assets compilados --}}
    @php
        $manifestPath = public_path('build/manifest.json');
    @endphp

    @if(file_exists($manifestPath))
        @php
            $manifest = json_decode(file_get_contents($manifestPath), true);
        @endphp

        {{-- Carregar todos os arquivos CSS --}}
        @foreach($manifest as $file => $data)
            @if(str_ends_with($file, '.css'))
                <link rel="stylesheet" href="{{ asset('build/' . $data['file']) }}">
            @endif
        @endforeach

        {{-- Carregar todos os arquivos JS --}}
        @foreach($manifest as $file => $data)
            @if(str_ends_with($file, '.js'))
                <script src="{{ asset('build/' . $data['file']) }}" defer></script>
            @endif
        @endforeach
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
