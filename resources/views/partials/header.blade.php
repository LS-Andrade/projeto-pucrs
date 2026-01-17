<header class="bg-white dark:bg-gray-800 shadow">
  <nav class="container mx-auto px-4 py-4 flex items-center justify-between">
      <a href="{{ url('/') }}" class="text-xl font-bold text-green-600">
          Animal Care
      </a>

      <div class="hidden md:flex items-center space-x-6">
          <a href="{{ route('home') }}" class="hover:text-green-600">Início</a>
          <a href="{{ route('animals.index') }}" class="hover:text-green-600">Animais</a>
          <a href="{{ route('reports.create') }}" class="hover:text-green-600">Denunciar</a>
          <a href="{{ route('contents.index') }}" class="hover:text-green-600">Conteúdo</a>
      </div>

      <div class="flex items-center space-x-4">
        @auth
            <span class="text-sm">Olá, {{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-red-500 hover:text-red-600">Sair</button>
            </form>
        @endauth
        
          {{-- Mobile menu button --}}
          <button @click="open = !open" class="md:hidden focus:outline-none" x-data="{ open: false }">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                   stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"/>
              </svg>
          </button>
      </div>
  </nav>

  {{-- Mobile menu --}}
  <div class="md:hidden px-4 pb-4" x-show="open" @click.away="open = false">
      <a href="{{ route('home') }}" class="block py-2">Início</a>
      <a href="{{ route('animals.index') }}" class="block py-2">Animais</a>
      <a href="{{ route('reports.create') }}" class="block py-2">Denunciar</a>
      <a href="{{ route('contents.index') }}" class="block py-2">Conteúdo</a>
  </div>
</header>
