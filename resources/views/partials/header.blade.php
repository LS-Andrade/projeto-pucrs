<header class="bg-white shadow-sm border-b">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center space-x-3">
            <img src="{{ asset('images/logo-animalidade.svg') }}" alt="Animalidade" class="h-10">
        </a>

        {{-- Menu Desktop --}}
        <nav class="hidden md:flex space-x-6 text-sm md:text-base font-medium text-gray-700">
            <a href="{{ route('home') }}" class="hover:text-primary transition">Início</a>
            <a href="{{ route('animals.index') }}" class="hover:text-primary transition">Adoção</a>
            <a href="{{ route('reports.create') }}" class="hover:text-primary transition">Denúncias</a>
            <a href="{{ route('contents.index') }}" class="hover:text-primary transition">Conteúdos</a>

            @auth
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('dashboard') }}" class="hover:text-primary transition">Painel</a>
                @else
                    <a href="{{ route('dashboard') }}" class="hover:text-primary transition">Minhas adoções</a>
                @endif
                <a href="{{ route('logout') }}" class="hover:text-primary transition">Sair</a>
            @else
                <a href="{{ route('login') }}" class="hover:text-primary transition">Entrar</a>
            @endauth
        </nav>

        {{-- Menu Mobile --}}
        <div class="md:hidden" x-data="{ open: false }">
            <button @click="open = !open" class="text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <div x-show="open" @click.outside="open = false"
                 class="absolute right-4 mt-2 w-48 bg-white rounded-lg shadow-lg border z-50 py-2 text-sm text-gray-700">
                <a href="{{ route('home') }}" class="block px-4 py-2 hover:bg-gray-100">Início</a>
                <a href="{{ route('animals.index') }}" class="block px-4 py-2 hover:bg-gray-100">Adoção</a>
                <a href="{{ route('reports.create') }}" class="block px-4 py-2 hover:bg-gray-100">Denúncias</a>
                <a href="{{ route('contents.index') }}" class="block px-4 py-2 hover:bg-gray-100">Conteúdos</a>
                @auth
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-gray-100">Painel</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-gray-100">Minhas adoções</a>
                    @endif
                    
                    <a href="{{ route('logout') }}" class="block px-4 py-2 hover:bg-gray-100">Sair</a>
                @else
                    <a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-gray-100">Entrar</a>
                @endauth
            </div>
        </div>
    </div>
</header>
