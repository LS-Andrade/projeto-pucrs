<aside class="w-64 min-h-[calc(100vh-8rem)] bg-white border-r border-gray-200 flex-shrink-0">
    <nav class="p-4 space-y-1">
        <a href="{{ route('dashboard') }}"
           class="block px-4 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'bg-[#A02CDB]/10 text-[#A02CDB]' : 'text-gray-700 hover:bg-gray-100' }}">
            {{ Auth::user()->role === 'admin' ? 'Início' : 'Minhas adoções' }}
        </a>

        @if (Auth::user()->role === 'admin')
            <div class="pt-2 mt-2 border-t border-gray-200">
                <p class="px-4 py-1 text-xs font-semibold text-gray-500 uppercase">Administração</p>
                <a href="{{ route('dashboard.categorias') }}"
                   class="block px-4 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('dashboard.categorias*') ? 'bg-[#A02CDB]/10 text-[#A02CDB]' : 'text-gray-700 hover:bg-gray-100' }}">
                    Categorias
                </a>
                <a href="{{ route('dashboard.animais') }}"
                   class="block px-4 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('dashboard.animais*') ? 'bg-[#A02CDB]/10 text-[#A02CDB]' : 'text-gray-700 hover:bg-gray-100' }}">
                    Animais
                </a>
                <a href="{{ route('dashboard.conteudos') }}"
                   class="block px-4 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('dashboard.conteudos*') ? 'bg-[#A02CDB]/10 text-[#A02CDB]' : 'text-gray-700 hover:bg-gray-100' }}">
                    Conteúdos
                </a>
                <a href="{{ route('dashboard.denuncias') }}"
                   class="block px-4 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('dashboard.denuncias*') ? 'bg-[#A02CDB]/10 text-[#A02CDB]' : 'text-gray-700 hover:bg-gray-100' }}">
                    Denúncias
                </a>
                <a href="{{ route('dashboard.adocoes') }}"
                   class="block px-4 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('dashboard.adocoes*') ? 'bg-[#A02CDB]/10 text-[#A02CDB]' : 'text-gray-700 hover:bg-gray-100' }}">
                    Adoções
                </a>
                <a href="{{ route('dashboard.usuarios') }}"
                   class="block px-4 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('dashboard.usuarios*') ? 'bg-[#A02CDB]/10 text-[#A02CDB]' : 'text-gray-700 hover:bg-gray-100' }}">
                    Usuários
                </a>
                <a href="{{ route('dashboard.organizacoes') }}"
                   class="block px-4 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('dashboard.organizacoes*') ? 'bg-[#A02CDB]/10 text-[#A02CDB]' : 'text-gray-700 hover:bg-gray-100' }}">
                    Organizações
                </a>
            </div>
        @endif
    </nav>
</aside>
