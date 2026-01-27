@extends('layouts.dashboard')

@section('title', 'Minhas adoções')

@section('content')
<div class="max-w-4xl">
    <h1 class="text-2xl font-bold text-[#A02CDB] mb-2">Minhas adoções</h1>
    <p class="text-gray-600 mb-6">Acompanhe os pedidos de adoção que você realizou.</p>

    <div id="my-adoptions-list" class="space-y-4">
        <p class="text-gray-500">Carregando…</p>
    </div>

    <div id="my-adoptions-pagination" class="mt-6 flex justify-center gap-2"></div>
</div>

@push('scripts')
<script>
(function() {
    const base = '/api/my-adoptions';
    const listEl = document.getElementById('my-adoptions-list');
    const paginationEl = document.getElementById('my-adoptions-pagination');

    function statusLabel(s) {
        const map = { pending: 'Pendente', approved: 'Aprovada', rejected: 'Recusada', completed: 'Concluída' };
        return map[s] || s;
    }

    function render(data) {
        if (!data.data || data.data.length === 0) {
            listEl.innerHTML = '<p class="text-gray-500">Você ainda não fez nenhum pedido de adoção.</p>';
            paginationEl.innerHTML = '';
            return;
        }
        listEl.innerHTML = data.data.map(function (a) {
            const animal = a.animal || {};
            const nome = animal.name || 'Animal';
            const link = animal.id ? '/animais/' + animal.id : '#';
            return '<div class="bg-white p-4 rounded-lg border shadow-sm"><div class="flex justify-between items-start"><div class="flex-1"><a href="' + link + '" class="font-semibold text-[#A02CDB] hover:underline">' + nome + '</a><p class="text-sm text-gray-500 mt-1">Status: ' + statusLabel(a.status) + '</p><p class="text-sm text-gray-600 mt-1">' + (a.motivation || '').substring(0, 120) + (a.motivation && a.motivation.length > 120 ? '…' : '') + '</p></div><div class="flex flex-col gap-2"><span class="px-2 py-1 text-xs rounded self-end ' + (a.status === "pending" ? "bg-amber-100 text-amber-800" : a.status === "approved" || a.status === "completed" ? "bg-green-100 text-green-800" : "bg-gray-100 text-gray-700") + '">' + statusLabel(a.status) + '</span><button class="px-3 py-1 text-sm rounded border text-[#A02CDB] hover:bg-gray-50 self-end" onclick="showAdoptionDetails(' + a.id + ')">Ver detalhes</button></div></div></div>';
        }).join('');

        if (data.last_page > 1) {
            let paginationHtml = '<div class="flex items-center justify-center gap-2 flex-wrap">';

            // Primeira página
            if (data.current_page > 1) {
                paginationHtml += '<a href="?page=1" class="px-3 py-1 rounded border text-[#A02CDB] hover:bg-gray-50">Primeira</a>';
                paginationHtml += '<a href="?page=' + (data.current_page - 1) + '" class="px-3 py-1 rounded border text-[#A02CDB] hover:bg-gray-50">← Anterior</a>';
            }

            // Números das páginas
            const startPage = Math.max(1, data.current_page - 2);
            const endPage = Math.min(data.last_page, data.current_page + 2);

            if (startPage > 1) {
                paginationHtml += '<span class="px-2 py-1 text-gray-500">...</span>';
            }

            for (let i = startPage; i <= endPage; i++) {
                if (i === data.current_page) {
                    paginationHtml += '<span class="px-3 py-1 rounded bg-[#A02CDB] text-white font-medium">' + i + '</span>';
                } else {
                    paginationHtml += '<a href="?page=' + i + '" class="px-3 py-1 rounded border text-[#A02CDB] hover:bg-gray-50">' + i + '</a>';
                }
            }

            if (endPage < data.last_page) {
                paginationHtml += '<span class="px-2 py-1 text-gray-500">...</span>';
            }

            // Última página
            if (data.current_page < data.last_page) {
                paginationHtml += '<a href="?page=' + (data.current_page + 1) + '" class="px-3 py-1 rounded border text-[#A02CDB] hover:bg-gray-50">Próximo →</a>';
                paginationHtml += '<a href="?page=' + data.last_page + '" class="px-3 py-1 rounded border text-[#A02CDB] hover:bg-gray-50">Última</a>';
            }

            paginationHtml += '</div>';
            paginationEl.innerHTML = paginationHtml;
        } else {
            paginationEl.innerHTML = '';
        }
    }

    function load(page) {
        listEl.innerHTML = '<p class="text-gray-500">Carregando…</p>';
        const url = page ? base + '?page=' + page : base;
        fetch(url, { credentials: 'same-origin', headers: { 'Accept': 'application/json' } })
            .then(function (r) { return r.json(); })
            .then(render)
            .catch(function () { listEl.innerHTML = '<p class="text-red-600">Erro ao carregar. Verifique se está logado.</p>'; });
    }

    window.showAdoptionDetails = function(adoptionId) {
        fetch('/api/adoptions/' + adoptionId, { credentials: 'same-origin', headers: { 'Accept': 'application/json' } })
            .then(function(r) { return r.json(); })
            .then(function(adoption) {
                const modal = document.createElement('div');
                modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
                modal.innerHTML = `
                    <div class="bg-white rounded-lg max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl font-bold">Detalhes da Adoção</h2>
                                <button class="text-gray-500 hover:text-gray-700 text-2xl" onclick="this.closest('.fixed').remove()">×</button>
                            </div>
                            <div class="space-y-4">
                                <div><strong>Animal:</strong> ${adoption.animal?.name || 'Não informado'}</div>
                                <div><strong>Status:</strong> <span class="px-2 py-1 text-xs rounded ${adoption.status === "pending" ? "bg-amber-100 text-amber-800" : adoption.status === "approved" ? "bg-green-100 text-green-800" : "bg-gray-100 text-gray-700"}">${statusLabel(adoption.status)}</span></div>
                                <div><strong>Motivação:</strong> ${adoption.motivation || 'Não informada'}</div>
                                <div><strong>Data da solicitação:</strong> ${new Date(adoption.created_at).toLocaleString('pt-BR')}</div>
                            </div>
                            <div class="mt-6">
                                <h3 class="font-bold mb-2">Follow-ups</h3>
                                <div id="followups-list-${adoptionId}" class="space-y-2"></div>
                            </div>
                        </div>
                    </div>
                `;
                document.body.appendChild(modal);
                loadFollowups(adoptionId);
            })
            .catch(function() { alert('Erro ao carregar detalhes da adoção.'); });
    }

    function loadFollowups(adoptionId) {
        fetch('/api/adoption-followups?adoption_id=' + adoptionId, { credentials: 'same-origin', headers: { 'Accept': 'application/json' } })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                const followupsList = document.getElementById('followups-list-' + adoptionId);
                if (!data.data || !data.data.length) {
                    followupsList.innerHTML = '<p class="text-gray-500">Nenhum follow-up registrado ainda.</p>';
                    return;
                }
                followupsList.innerHTML = data.data.map(function(f) {
                    return `
                        <div class="border rounded p-3 bg-gray-50">
                            <p class="text-sm">${f.notes}</p>
                            <p class="text-xs text-gray-500 mt-1">Data da visita: ${f.visit_date ? new Date(f.visit_date).toLocaleDateString('pt-BR') : 'Não informada'}</p>
                            <p class="text-xs text-gray-500">Registrado em: ${new Date(f.created_at).toLocaleDateString('pt-BR')}</p>
                        </div>
                    `;
                }).join('');
            })
            .catch(function() { console.error('Erro ao carregar follow-ups'); });
    }

    const params = new URLSearchParams(window.location.search);
    load(params.get('page') || 1);
})();
</script>
@endpush
@endsection
