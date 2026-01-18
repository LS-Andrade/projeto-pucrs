<div x-data="{ open: false }">

    {{-- Toggle mobile --}}
    <button 
        class="lg:hidden w-full mb-4 bg-[#A02CDB] text-white py-2 rounded-lg font-semibold"
        @click="open = !open"
        x-text="open ? 'Fechar filtros' : 'Abrir filtros'">
    </button>

    {{-- Formulário de filtros --}}
    <form 
        method="GET" 
        action="{{ route('animals.index') }}"
        class="bg-white p-6 rounded-xl shadow-sm border space-y-6
               lg:block" 
        :class="{ 'hidden': !open && window.innerWidth < 1024 }">

        <h2 class="text-xl font-semibold text-[#A02CDB] mb-2">
            Filtrar animais
        </h2>

        {{-- Espécie --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Espécie</label>
            <select name="species" class="w-full border rounded-lg px-3 py-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
                <option value="">Todas</option>
                <option value="dog" {{ request('species')=='dog' ? 'selected' : '' }}>Cachorro</option>
                <option value="cat" {{ request('species')=='cat' ? 'selected' : '' }}>Gato</option>
                <option value="other" {{ request('species')=='other' ? 'selected' : '' }}>Outros</option>
            </select>
        </div>

        {{-- Sexo --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Sexo</label>
            <select name="gender" class="w-full border rounded-lg px-3 py-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
                <option value="">Todos</option>
                <option value="male" {{ request('gender')=='male' ? 'selected' : '' }}>Macho</option>
                <option value="female" {{ request('gender')=='female' ? 'selected' : '' }}>Fêmea</option>
            </select>
        </div>

        {{-- Porte --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Porte</label>
            <select name="size" class="w-full border rounded-lg px-3 py-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
                <option value="">Todos</option>
                <option value="small" {{ request('size')=='small' ? 'selected' : '' }}>Pequeno</option>
                <option value="medium" {{ request('size')=='medium' ? 'selected' : '' }}>Médio</option>
                <option value="large" {{ request('size')=='large' ? 'selected' : '' }}>Grande</option>
            </select>
        </div>

        {{-- Castrado --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Castrado</label>
            <select name="is_castrated" class="w-full border rounded-lg px-3 py-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
                <option value="">Todos</option>
                <option value="1" {{ request('is_castrated')==='1' ? 'selected' : '' }}>Sim</option>
                <option value="0" {{ request('is_castrated')==='0' ? 'selected' : '' }}>Não</option>
            </select>
        </div>

        {{-- Vacinado --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Vacinado</label>
            <select name="is_vaccinated" class="w-full border rounded-lg px-3 py-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
                <option value="">Todos</option>
                <option value="1" {{ request('is_vaccinated')==='1' ? 'selected' : '' }}>Sim</option>
                <option value="0" {{ request('is_vaccinated')==='0' ? 'selected' : '' }}>Não</option>
            </select>
        </div>

        {{-- Botões --}}
        <div class="flex flex-col gap-3">
            <button type="submit" class="bg-[#2CDBC0] text-gray-900 py-2 rounded-lg font-semibold hover:bg-teal-400 transition">
                Aplicar filtros
            </button>

            <a href="{{ route('animals.index') }}" class="text-center text-sm text-gray-600 hover:underline">
                Limpar filtros
            </a>
        </div>

    </form>
</div>
