@extends('layouts.dashboard')

@section('title', 'Novo animal')

@section('content')
<div class="max-w-xl">
    <div class="mb-6">
        <a href="{{ route('dashboard.animais') }}" class="text-[#A02CDB] hover:underline">← Animais</a>
    </div>
    <h1 class="text-2xl font-bold text-[#A02CDB] mb-2">Novo animal</h1>
    <p class="text-gray-600 mb-6">Preencha os campos.</p>
        
    <div id="msg" class="mb-4 hidden"></div>

    <form id="form" class="bg-white rounded-xl border shadow-sm p-6 space-y-4">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
            <input type="text" id="name" name="name" required maxlength="100"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
        </div>
        <div>
            <label for="species" class="block text-sm font-medium text-gray-700 mb-1">Espécie</label>
            <select name="species" id="species" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
                <option value="">Selecione</option>
                <option value="dog">Cachorro</option>
                <option value="rabbit">Coelho</option>
                <option value="cat">Gato</option>
                <option value="bird">Pássaro</option>
                <option value="other">Outros</option>
            </select>
        </div>
        <div>
            <label for="breed" class="block text-sm font-medium text-gray-700 mb-1">Raça</label>
            <input type="text" id="breed" name="breed" required maxlength="120"
                   class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
        </div>
        <div>
            <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gênero</label>
            <select name="gender" id="gender" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
                <option value="">Selecione</option>
                <option value="male">Macho</option>
                <option value="female">Fêmea</option>
            </select>
        </div>
        <div>
            <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-1">Data de nascimento</label>
            <input type="date" id="birth_date" name="birth_date"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
        </div>
        <div>
            <label for="age" class="block text-sm font-medium text-gray-700 mb-1">Idade</label>
            <input type="number" id="age" name="age" required min="1"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
        </div>
        <div>
            <label for="size" class="block text-sm font-medium text-gray-700 mb-1">Porte</label>
            <select name="size" id="size" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
                <option value="">Selecione</option>
                <option value="small">Pequeno</option>
                <option value="medium">Médio</option>
                <option value="large">Grande</option>
            </select>
        </div>
        <div>
            <label for="color" class="block text-sm font-medium text-gray-700 mb-1">Cor</label>
            <input type="text" id="color" name="color" required maxlength="120"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
        </div>
        <div>
            <label  for="description" class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
            <textarea
                id="description"
                name="description"
                rows="4"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]"
                required></textarea>
        </div>
        <div class="flex items-center gap-2">
            <input type="checkbox" id="is_castrated" name="is_castrated" value="1"
                class="rounded border-gray-300 text-[#A02CDB] focus:ring-[#A02CDB]">
            <label for="is_castrated" class="text-sm text-gray-700">É castrado</label>
        </div>
        <div class="flex items-center gap-2">
            <input type="checkbox" id="is_vaccinated" name="is_vaccinated" value="1"
                class="rounded border-gray-300 text-[#A02CDB] focus:ring-[#A02CDB]">
            <label for="is_vaccinated" class="text-sm text-gray-700">É vacinado</label>
        </div>
        <div>
            <label for="health_status" class="block text-sm font-medium text-gray-700 mb-1">Saúde</label>
            <select name="health_status" id="health_status" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
                <option value="">Selecione</option>
                <option value="healthy">Saudável</option>
                <option value="under treatment">Em tratamento</option>
                <option value="special needs">Cuidados especiais</option>
            </select>
        </div>
        <div>
            <label for="organization_id" class="block text-sm font-medium text-gray-700 mb-1">Organização</label>
            <select name="organization_id" id="organization_id" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
                <option value="">Selecione</option>
            </select>
        </div>
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" id="status" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
                <option value="">Selecione</option>
                <option value="available">Disponível</option>
                <option value="adopted">Adotado</option>
                <option value="reserved">Reservado</option>
            </select>
        </div>
        <div>
            <label for="photos" class="block text-sm font-medium text-gray-700 mb-1">Fotos do animal</label>
            <input type="file" id="photos" name="photos" multiple accept="image/*"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
            <div id="photo-previews" class="mt-4 space-y-2"></div>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="px-4 py-2 rounded-lg bg-[#A02CDB] text-white font-medium hover:bg-[#8a25bd] transition">Salvar</button>
            <a href="{{ route('dashboard.animais') }}" class="px-4 py-2 rounded-lg border text-gray-700 hover:bg-gray-50 transition">Cancelar</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
(function() {
    async function loadOrganizations() {
        const urlOrg = '/api/organizations';
        fetch(
            urlOrg, { credentials: 'same-origin', headers: { 'Accept': 'application/json' } 
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            const arr = data.data || data;
            const orgSelect = document.getElementById('organization_id');
            arr.forEach(function(org) {
                const option = document.createElement('option');
                option.value = org.id;
                option.textContent = org.name || '';
                orgSelect.appendChild(option);
            });
        })
    }

    loadOrganizations();
    document.getElementById('age').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // Handle photo uploads
    const photosInput = document.getElementById('photos');
    const photoPreviews = document.getElementById('photo-previews');
    let selectedFiles = [];

    photosInput.addEventListener('change', function(e) {
        selectedFiles = Array.from(e.target.files);
        renderPhotoPreviews();
    });

    function renderPhotoPreviews() {
        photoPreviews.innerHTML = '';
        selectedFiles.forEach((file, index) => {
            const div = document.createElement('div');
            div.className = 'flex items-center gap-4 p-2 border rounded';
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.className = 'w-16 h-16 object-cover rounded';
            const label = document.createElement('label');
            label.className = 'flex items-center gap-2';
            const radio = document.createElement('input');
            radio.type = 'radio';
            radio.name = 'main_photo';
            radio.value = index;
            if (index === 0) radio.checked = true; // First one as default main
            label.appendChild(radio);
            label.appendChild(document.createTextNode('Principal'));
            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'text-red-500 hover:text-red-700';
            removeBtn.textContent = 'Remover';
            removeBtn.onclick = () => {
                selectedFiles.splice(index, 1);
                renderPhotoPreviews();
            };
            div.appendChild(img);
            div.appendChild(label);
            div.appendChild(removeBtn);
            photoPreviews.appendChild(div);
        });
    }

    var form = document.getElementById('form');
    var msg = document.getElementById('msg');

    form.onsubmit = async function(e) {
        e.preventDefault();
        msg.classList.add('hidden');
        var body = {
            name: document.getElementById('name').value,
            species: document.getElementById('species').value,
            breed: document.getElementById('breed').value,
            gender: document.getElementById('gender').value,
            birth_date: document.getElementById('birth_date').value,
            age: document.getElementById('age').value,
            size: document.getElementById('size').value,
            color: document.getElementById('color').value,
            description: document.getElementById('description').value,
            is_castrated: document.getElementById('is_castrated').checked,
            is_vaccinated: document.getElementById('is_vaccinated').checked,
            health_status: document.getElementById('health_status').value,
            organization_id: document.getElementById('organization_id').value,
            status: document.getElementById('status').value
        };
        try {
            const response = await fetch('/api/animals', {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(body)
            });
            const result = await response.json();
            if (response.ok) {
                const animalId = result.id;
                // Upload photos
                const mainIndex = document.querySelector('input[name="main_photo"]:checked')?.value;
                for (let i = 0; i < selectedFiles.length; i++) {
                    const formData = new FormData();
                    formData.append('photo', selectedFiles[i]);
                    formData.append('animal_id', animalId);
                    formData.append('is_main', i == mainIndex ? '1' : '0');
                    await fetch('/api/animal-photos', {
                        method: 'POST',
                        credentials: 'same-origin',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: formData
                    });
                }
                //window.location = '{{ route("dashboard.animais") }}';
            } else {
                var t = (result.message || result.errors) ? (result.errors ? Object.values(result.errors).flat().join(' ') : result.message) : 'Erro ao salvar.';
                msg.textContent = t;
                msg.className = 'mb-4 p-4 rounded-lg bg-red-100 text-red-700';
                msg.classList.remove('hidden');
            }
        } catch (error) {
            msg.textContent = 'Erro ao salvar.';
            msg.className = 'mb-4 p-4 rounded-lg bg-red-100 text-red-700';
            msg.classList.remove('hidden');
        }
    };
})();
</script>
@endpush
@endsection
