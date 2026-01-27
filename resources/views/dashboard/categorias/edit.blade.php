@extends('layouts.dashboard')

@section('title', 'Editar categoria')

@section('content')
<div class="max-w-xl">
    <div class="mb-6">
        <a href="{{ route('dashboard.categorias') }}" class="text-[#A02CDB] hover:underline">← Categorias</a>
    </div>
    <h1 class="text-2xl font-bold text-[#A02CDB] mb-2">Editar categoria</h1>
    <p class="text-gray-600 mb-6">Altere os dados e salve.</p>

    <div id="msg" class="mb-4 hidden"></div>
    <div id="loading" class="p-6 text-gray-500">Carregando…</div>

    <form id="form" class="bg-white rounded-xl border shadow-sm p-6 space-y-4 hidden">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
            <input type="text" id="name" name="name" required maxlength="100"
                   class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
        </div>
        <div>
            <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
            <input type="text" id="slug" name="slug" required maxlength="120"
                   class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
        </div>
        <div class="flex items-center gap-2">
            <input type="checkbox" id="is_active" name="is_active" value="1"
                   class="rounded border-gray-300 text-[#A02CDB] focus:ring-[#A02CDB]">
            <label for="is_active" class="text-sm text-gray-700">Categoria ativa</label>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="px-4 py-2 rounded-lg bg-[#A02CDB] text-white font-medium hover:bg-[#8a25bd] transition">Salvar</button>
            <a href="{{ route('dashboard.categorias') }}" class="px-4 py-2 rounded-lg border text-gray-700 hover:bg-gray-50 transition">Cancelar</a>
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

    fetch('/api/categories/' + id, { credentials: 'same-origin', headers: { 'Accept': 'application/json' } })
        .then(function(r) {
            if (!r.ok) throw new Error('Não encontrado');
            return r.json();
        })
        .then(function(c) {
            loading.classList.add('hidden');
            document.getElementById('name').value = c.name || '';
            document.getElementById('slug').value = c.slug || '';
            document.getElementById('is_active').checked = !!c.is_active;
            form.classList.remove('hidden');
        })
        .catch(function() {
            loading.innerHTML = 'Categoria não encontrada. <a href="{{ route("dashboard.categorias") }}" class="text-[#A02CDB] underline">Voltar</a>';
        });

    form.onsubmit = function(e) {
        e.preventDefault();
        msg.classList.add('hidden');
        var body = {
            name: document.getElementById('name').value,
            slug: document.getElementById('slug').value,
            is_active: document.getElementById('is_active').checked
        };
        fetch('/api/categories/' + id, {
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
            if (o.ok) window.location = '{{ route("dashboard.categorias") }}';
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
