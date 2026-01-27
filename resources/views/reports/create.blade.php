@extends('layouts.app')

@section('title', 'Fazer Denúncia - Animalidade')

@section('content')
<section class="max-w-7xl mx-auto px-4 py-8">

    {{-- Breadcrumb --}}
    <nav class="mb-6 text-sm text-gray-600">
        <a href="{{ route('home') }}" class="hover:text-purple-600">Início</a> /
        <span class="font-semibold text-gray-800">Fazer denúncia</span>
    </nav>

    <div class="grid grid-cols-1 gap-8">

        <h1 class="text-3xl font-bold text-red-600">
            Fazer Denúncia
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

            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('reports.web.store') }}" enctype="multipart/form-data" onsubmit="console.log('Enviando formulário com', document.getElementById('attachments').files.length, 'arquivos')">
                @csrf

                <div class="p-4 flex flex-col flex-1">
                    <h5 class="text-red-500 mb-2">Atenção!</h5>
                    <p class="mb-4">
                        As denúncias são uma ferramenta importante para proteger animais em situação de risco. Forneça o máximo de detalhes possível para que possamos investigar adequadamente. Todas as informações fornecidas são tratadas com confidencialidade.
                    </p>
                    <p class="mb-4">
                        Após enviar a denúncia, nossa equipe irá analisar as informações e tomar as medidas necessárias. Você pode acompanhar o andamento através do número de protocolo que será gerado.
                    </p>
                </div>

                <div class="p-4 flex flex-col flex-1">
                    <h2 class="text-lg font-semibold text-[#A02CDB] mb-3">
                        Descrição da situação
                    </h2>

                    <div class="mb-4">
                        <label for="animal_description" class="block text-sm font-medium text-gray-700 mb-1">
                            Descrição do animal e situação <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            id="animal_description"
                            name="animal_description"
                            rows="4"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500"
                            placeholder="Descreva o animal, a situação encontrada, local exato, condições do animal, etc."
                            required>{{ old('animal_description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">
                            Localização específica <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="location"
                            name="location"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500"
                            placeholder="Ex: Rua das Flores, próximo ao mercado central"
                            value="{{ old('location') }}"
                            required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-1">
                                Cidade <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="city"
                                name="city"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500"
                                placeholder="Ex: Porto Alegre"
                                value="{{ old('city') }}"
                                required>
                        </div>
                        <div>
                            <label for="state" class="block text-sm font-medium text-gray-700 mb-1">
                                Estado <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="state"
                                name="state"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500"
                                required>
                                <option value="">Selecione o estado</option>
                                <option value="AC" {{ old('state') == 'AC' ? 'selected' : '' }}>Acre</option>
                                <option value="AL" {{ old('state') == 'AL' ? 'selected' : '' }}>Alagoas</option>
                                <option value="AP" {{ old('state') == 'AP' ? 'selected' : '' }}>Amapá</option>
                                <option value="AM" {{ old('state') == 'AM' ? 'selected' : '' }}>Amazonas</option>
                                <option value="BA" {{ old('state') == 'BA' ? 'selected' : '' }}>Bahia</option>
                                <option value="CE" {{ old('state') == 'CE' ? 'selected' : '' }}>Ceará</option>
                                <option value="DF" {{ old('state') == 'DF' ? 'selected' : '' }}>Distrito Federal</option>
                                <option value="ES" {{ old('state') == 'ES' ? 'selected' : '' }}>Espírito Santo</option>
                                <option value="GO" {{ old('state') == 'GO' ? 'selected' : '' }}>Goiás</option>
                                <option value="MA" {{ old('state') == 'MA' ? 'selected' : '' }}>Maranhão</option>
                                <option value="MT" {{ old('state') == 'MT' ? 'selected' : '' }}>Mato Grosso</option>
                                <option value="MS" {{ old('state') == 'MS' ? 'selected' : '' }}>Mato Grosso do Sul</option>
                                <option value="MG" {{ old('state') == 'MG' ? 'selected' : '' }}>Minas Gerais</option>
                                <option value="PA" {{ old('state') == 'PA' ? 'selected' : '' }}>Pará</option>
                                <option value="PB" {{ old('state') == 'PB' ? 'selected' : '' }}>Paraíba</option>
                                <option value="PR" {{ old('state') == 'PR' ? 'selected' : '' }}>Paraná</option>
                                <option value="PE" {{ old('state') == 'PE' ? 'selected' : '' }}>Pernambuco</option>
                                <option value="PI" {{ old('state') == 'PI' ? 'selected' : '' }}>Piauí</option>
                                <option value="RJ" {{ old('state') == 'RJ' ? 'selected' : '' }}>Rio de Janeiro</option>
                                <option value="RN" {{ old('state') == 'RN' ? 'selected' : '' }}>Rio Grande do Norte</option>
                                <option value="RS" {{ old('state') == 'RS' ? 'selected' : '' }}>Rio Grande do Sul</option>
                                <option value="RO" {{ old('state') == 'RO' ? 'selected' : '' }}>Rondônia</option>
                                <option value="RR" {{ old('state') == 'RR' ? 'selected' : '' }}>Roraima</option>
                                <option value="SC" {{ old('state') == 'SC' ? 'selected' : '' }}>Santa Catarina</option>
                                <option value="SP" {{ old('state') == 'SP' ? 'selected' : '' }}>São Paulo</option>
                                <option value="SE" {{ old('state') == 'SE' ? 'selected' : '' }}>Sergipe</option>
                                <option value="TO" {{ old('state') == 'TO' ? 'selected' : '' }}>Tocantins</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="attachments" class="block text-sm font-medium text-gray-700 mb-1">
                            Fotos da situação (opcional)
                        </label>
                        <input
                            type="file"
                            id="attachments"
                            name="attachments[]"
                            multiple
                            accept="image/*"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500">
                        <p class="text-xs text-gray-500 mt-1">
                            Selecione uma ou mais imagens. Formatos aceitos: JPG, PNG, GIF. Tamanho máximo: 5MB por imagem.
                        </p>
                        <div id="preview-container" class="mt-2 grid grid-cols-2 md:grid-cols-4 gap-2"></div>
                    </div>
                </div>

                <div class="p-4 flex flex-1 gap-4 justify-end bg-gray-50">
                    <a href="{{ route('home') }}"
                       class="px-6 py-2 border rounded text-gray-700 hover:bg-gray-100 transition">
                        Cancelar
                    </a>

                    <button type="submit"
                            class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700 transition">
                        Enviar denúncia
                    </button>
                </div>
            </form>
        </div>

    </div>
</section>

@push('scripts')
<script>
document.getElementById('attachments').addEventListener('change', function(e) {
    const previewContainer = document.getElementById('preview-container');
    previewContainer.innerHTML = '';

    console.log('Arquivos selecionados:', e.target.files.length);

    Array.from(e.target.files).forEach((file, index) => {
        console.log('Arquivo', index, ':', file.name, file.type, file.size);

        if (file.type.startsWith('image/')) {
            const div = document.createElement('div');
            div.className = 'flex items-center gap-2 p-2 bg-gray-50 rounded border';
            div.innerHTML = `
                <a href="#" onclick="previewImage(event, ${index})" class="text-blue-600 hover:text-blue-800 underline">
                    📎 ${file.name}
                </a>
                <button type="button" class="text-red-500 hover:text-red-700 text-sm" onclick="removeImage(${index})">
                    Remover
                </button>
            `;
            previewContainer.appendChild(div);
        }
    });
});

function previewImage(event, index) {
    event.preventDefault();
    const input = document.getElementById('attachments');
    const file = input.files[index];

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const newWindow = window.open('', '_blank');
            newWindow.document.write(`
                <html>
                    <head>
                        <title>${file.name}</title>
                        <style>body{margin:0;display:flex;justify-content:center;align-items:center;min-height:100vh;background:#f3f4f6;}img{max-width:90%;max-height:90vh;}</style>
                    </head>
                    <body>
                        <img src="${e.target.result}" alt="${file.name}">
                    </body>
                </html>
            `);
        };
        reader.readAsDataURL(file);
    }
}

function removeImage(index) {
    const input = document.getElementById('attachments');
    const dt = new DataTransfer();

    console.log('Removendo arquivo', index, 'de', input.files.length, 'arquivos');

    // Filtrar apenas arquivos válidos (não null)
    Array.from(input.files)
        .filter((file, i) => i !== index && file !== null)
        .forEach(file => {
            dt.items.add(file);
        });

    input.files = dt.files;
    console.log('Arquivos restantes:', input.files.length);

    input.dispatchEvent(new Event('change'));
}
</script>
@endpush
@endsection
