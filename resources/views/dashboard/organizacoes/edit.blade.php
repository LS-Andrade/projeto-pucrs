@extends('layouts.dashboard')

@section('title', 'Editar organização')

@section('content')
<div class="max-w-xl">
    <div class="mb-6">
        <a href="{{ route('dashboard.organizacoes') }}" class="text-[#A02CDB] hover:underline">← Organizações</a>
    </div>
    <h1 class="text-2xl font-bold text-[#A02CDB] mb-2">Editar organização</h1>
    <p class="text-gray-600 mb-6">Altere os dados da organização e salve.</p>

    <div id="msg" class="mb-4 hidden"></div>
    <div id="loading" class="p-6 text-gray-500">Carregando…</div>

    <form id="form" class="bg-white rounded-xl border shadow-sm p-6 space-y-4 hidden">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome da organização</label>
            <input type="text" id="name" name="name" required maxlength="255"
                   class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
        </div>
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
            <textarea id="description" name="description" rows="3" maxlength="1000"
                      class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]"></textarea>
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
            <input type="email" id="email" name="email" maxlength="255"
                   class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
        </div>
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
            <input type="text" id="phone" name="phone" maxlength="20"
                   class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
        </div>
        <div>
            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Endereço</label>
            <input type="text" id="address" name="address" maxlength="255"
                   class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="city" class="block text-sm font-medium text-gray-700 mb-1">Cidade</label>
                <input type="text" id="city" name="city" required maxlength="100"
                       class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
            </div>
            <div>
                <label for="state" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                <select id="state" name="state" required
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
                    <option value="">Selecione</option>
                    <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AP">Amapá</option>
                    <option value="AM">Amazonas</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Ceará</option>
                    <option value="DF">Distrito Federal</option>
                    <option value="ES">Espírito Santo</option>
                    <option value="GO">Goiás</option>
                    <option value="MA">Maranhão</option>
                    <option value="MT">Mato Grosso</option>
                    <option value="MS">Mato Grosso do Sul</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>
                    <option value="PR">Paraná</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piauí</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="RO">Rondônia</option>
                    <option value="RR">Roraima</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SP">São Paulo</option>
                    <option value="SE">Sergipe</option>
                    <option value="TO">Tocantins</option>
                </select>
            </div>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="px-4 py-2 rounded-lg bg-[#A02CDB] text-white font-medium hover:bg-[#8a25bd] transition">Salvar</button>
            <a href="{{ route('dashboard.organizacoes') }}" class="px-4 py-2 rounded-lg border text-gray-700 hover:bg-gray-50 transition">Cancelar</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
(function() {
    var id = {{ (int) $id }};
    var loading = document.getElementById('loading');
    var form = document.getElementById('form');
    var msg = document.getElementById('msg');

    fetch('/api/organizations/' + id, { credentials: 'same-origin', headers: { 'Accept': 'application/json' } })
        .then(function(r) {
            if (!r.ok) throw new Error('Não encontrado');
            return r.json();
        })
        .then(function(o) {
            loading.classList.add('hidden');
            document.getElementById('name').value = o.name || '';
            document.getElementById('description').value = o.description || '';
            document.getElementById('email').value = o.email || '';
            document.getElementById('phone').value = o.phone || '';
            document.getElementById('address').value = o.address || '';
            document.getElementById('city').value = o.city || '';
            document.getElementById('state').value = o.state || '';
            form.classList.remove('hidden');
        })
        .catch(function() {
            loading.innerHTML = 'Organização não encontrada. <a href="{{ route("dashboard.organizacoes") }}" class="text-[#A02CDB] underline">Voltar</a>';
        });

    form.onsubmit = function(e) {
        e.preventDefault();
        msg.classList.add('hidden');
        var body = {
            name: document.getElementById('name').value,
            description: document.getElementById('description').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            address: document.getElementById('address').value,
            city: document.getElementById('city').value,
            state: document.getElementById('state').value
        };
        fetch('/api/organizations/' + id, {
            method: 'PUT',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(body)
        })
        .then(function(r) { return r.json().then(function(j) { return { ok: r.ok, j: j }; }); })
        .then(function(o) {
            if (o.ok) window.location = '{{ route("dashboard.organizacoes") }}';
            else {
                var t = (o.j.message || o.j.errors) ? (o.j.errors ? Object.values(o.j.errors).flat().join(' ') : o.j.message) : 'Erro ao salvar.';
                msg.textContent = t;
                msg.className = 'mb-4 p-4 rounded-lg bg-red-100 text-red-700';
                msg.classList.remove('hidden');
            }
        })
        .catch(function() { msg.textContent = 'Erro ao salvar.'; msg.className = 'mb-4 p-4 rounded-lg bg-red-100 text-red-700'; msg.classList.remove('hidden'); });
    };
})();
</script>
@endpush
@endsection