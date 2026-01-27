@extends('layouts.dashboard')

@section('title', 'Conteúdos')

@section('content')
<div class="max-w-4xl">
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-[#A02CDB]">Conteúdos</h1>
            <p class="text-gray-600">Gerencie os conteúdos educacionais do site.</p>
        </div>
        <a href="{{ route('dashboard.conteudos.create') }}" class="px-4 py-2 rounded-lg bg-[#A02CDB] text-white font-medium hover:bg-[#8a25bd] transition">
            Novo conteúdo
        </a>
    </div>

    <div id="msg" class="mb-4 hidden"></div>

    <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
        <div id="conteudos-list" class="divide-y">
            <p class="p-6 text-gray-500">Carregando…</p>
        </div>
        <div id="conteudos-pagination" class="p-4 border-t flex justify-center gap-2 flex-wrap"></div>
    </div>
</div>

@push('scripts')
<script>
(function() {
    const listEl = document.getElementById('conteudos-list');
    const paginationEl = document.getElementById('conteudos-pagination');
    const msgEl = document.getElementById('msg');

    function showMsg(text, isError) {
        msgEl.textContent = text;
        msgEl.className = 'mb-4 p-4 rounded-lg ' + (isError ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700');
        msgEl.classList.remove('hidden');
    }

    function load(page) {
        listEl.innerHTML = '<p class="p-6 text-gray-500">Carregando…</p>';
        const url = '/api/contents' + (page ? '?page=' + page : '');
        fetch(url, { credentials: 'same-origin', headers: { 'Accept': 'application/json' } })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                const arr = data.data || data;
                if (!arr.length) {
                    listEl.innerHTML = '<p class="p-6 text-gray-500">Nenhum conteúdo cadastrado.</p>';
                    paginationEl.innerHTML = '';
                    return;
                }
                listEl.innerHTML = arr.map(function(c) {
                    const ativa = c.is_active ? 'Publicado' : 'Rascunho';
                    const cor = c.is_active ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-700';
                    return '<div class="p-4 flex items-center justify-between"><div><span class="font-medium">' + (c.title || '') + '</span><span class="text-gray-500 ml-2">' + (c.slug || '') + '</span><span class="ml-2 px-2 py-0.5 text-xs rounded ' + cor + '">' + ativa + '</span></div><div class="flex gap-2"><a href="/dashboard/conteudos/' + c.id + '/editar" class="px-3 py-1 text-sm rounded border text-[#A02CDB] hover:bg-gray-50">Editar</a><button type="button" data-id="' + c.id + '" data-title="' + (c.title || '').replace(/"/g, '&quot;') + '" class="btn-delete px-3 py-1 text-sm rounded border border-red-200 text-red-600 hover:bg-red-50">Excluir</button></div></div>';
                }).join('');

                paginationEl.innerHTML = '';
                if (data.last_page > 1) {
                    if (data.current_page > 1) paginationEl.innerHTML += '<a href="?page=' + (data.current_page - 1) + '" class="px-3 py-1 rounded border text-[#A02CDB] hover:bg-gray-50">← Anterior</a>';
                    paginationEl.innerHTML += '<span class="px-3 py-1 text-gray-600">' + data.current_page + ' / ' + data.last_page + '</span>';
                    if (data.current_page < data.last_page) paginationEl.innerHTML += '<a href="?page=' + (data.current_page + 1) + '" class="px-3 py-1 rounded border text-[#A02CDB] hover:bg-gray-50">Próximo →</a>';
                }

                listEl.querySelectorAll('.btn-delete').forEach(function(btn) {
                    btn.onclick = function() {
                        if (!confirm('Excluir o conteúdo ' + btn.dataset.title + '?')) return;
                        var id = btn.dataset.id;
                        var page = (new URLSearchParams(window.location.search)).get('page') || 1;
                        fetch('/api/contents/' + id, { method: 'DELETE', credentials: 'same-origin', headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') } })
                            .then(function(r) { if (r.ok) { showMsg('Conteúdo excluído.'); load(page); } else return r.json().then(function(j) { throw j.message || 'Erro'; }); })
                            .catch(function(e) { showMsg(typeof e === 'string' ? e : (e.message || 'Erro ao excluir.'), true); });
                    };
                });
            })
            .catch(function() { listEl.innerHTML = '<p class="p-6 text-red-600">Erro ao carregar.</p>'; });
    }

    var params = new URLSearchParams(window.location.search);
    load(params.get('page') || 1);
})();
</script>
@endpush
@endsection