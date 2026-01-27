@extends('layouts.dashboard')

@section('title', 'Adoções')

@section('content')
<div class="max-w-6xl">
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-[#A02CDB]">Adoções</h1>
            <p class="text-gray-600">Gerencie os pedidos de adoção de animais.</p>
        </div>
    </div>

    <div id="msg" class="mb-4 hidden"></div>

    <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
        <div id="adocoes-list" class="divide-y">
            <p class="p-6 text-gray-500">Carregando…</p>
        </div>
        <div id="adocoes-pagination" class="p-4 border-t flex justify-center gap-2 flex-wrap"></div>
    </div>
</div>

@push('scripts')
<script>
(function() {
    const listEl = document.getElementById('adocoes-list');
    const paginationEl = document.getElementById('adocoes-pagination');
    const msgEl = document.getElementById('msg');

    function showMsg(text, isError) {
        msgEl.textContent = text;
        msgEl.className = 'mb-4 p-4 rounded-lg ' + (isError ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700');
        msgEl.classList.remove('hidden');
    }

    function getStatusText(status) {
        switch(status) {
            case 'pending': return 'Pendente';
            case 'approved': return 'Aprovado';
            case 'rejected': return 'Rejeitado';
            default: return status;
        }
    }

    function getStatusColor(status) {
        switch(status) {
            case 'pending': return 'bg-yellow-100 text-yellow-800';
            case 'approved': return 'bg-green-100 text-green-800';
            case 'rejected': return 'bg-red-100 text-red-800';
            default: return 'bg-gray-100 text-gray-800';
        }
    }

    function load(page) {
        listEl.innerHTML = '<p class="p-6 text-gray-500">Carregando…</p>';
        const url = '/api/adoptions' + (page ? '?page=' + page : '');
        fetch(url, { credentials: 'same-origin', headers: { 'Accept': 'application/json' } })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                const arr = data.data || data;
                if (!arr.length) {
                    listEl.innerHTML = '<p class="p-6 text-gray-500">Nenhum pedido de adoção encontrado.</p>';
                    paginationEl.innerHTML = '';
                    return;
                }
                listEl.innerHTML = arr.map(function(a) {
                    const statusText = getStatusText(a.status);
                    const statusColor = getStatusColor(a.status);
                    const actionButtons = a.status === 'pending' 
                        ? '<button type="button" data-id="' + a.id + '" data-status="approved" class="btn-approve px-3 py-1 text-sm rounded border text-green-600 hover:bg-green-50">Aprovar</button><button type="button" data-id="' + a.id + '" data-status="rejected" class="btn-reject px-3 py-1 text-sm rounded border text-red-600 hover:bg-red-50">Rejeitar</button>'
                        : '';
                    return '<div class="p-4"><div class="flex items-center justify-between"><div class="flex-1"><div class="flex items-center gap-4"><div><h3 class="font-medium">' + (a.animal?.name || 'Animal não encontrado') + '</h3><p class="text-sm text-gray-600">Adotante: ' + (a.adopter?.name || 'Não informado') + '</p><p class="text-sm text-gray-600">E-mail: ' + (a.adopter?.email || 'Não informado') + '</p><p class="text-sm text-gray-600">Telefone: ' + (a.adopter?.phone || 'Não informado') + '</p><p class="text-sm text-gray-500">Solicitado em: ' + new Date(a.created_at).toLocaleDateString('pt-BR') + '</p></div></div></div><div class="flex items-center gap-4"><span class="px-2 py-1 text-xs rounded ' + statusColor + '">' + statusText + '</span><div class="flex gap-2"><button type="button" data-id="' + a.id + '" class="btn-followup px-3 py-1 text-sm rounded border text-green-600 hover:bg-green-50">Interações</button>' + actionButtons + '</div></div></div><div id="followups-' + a.id + '" class="mt-4 hidden"><div class="bg-gray-50 p-4 rounded"><h4 class="font-medium mb-2">Interações</h4><div id="followups-list-' + a.id + '" class="space-y-2"></div><button type="button" data-id="' + a.id + '" class="btn-add-interaction mt-2 px-3 py-1 text-sm bg-green-600 text-white rounded hover:bg-green-700">Adicionar interação</button></div></div></div>';
                }).join('');

                paginationEl.innerHTML = '';
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
                }

                // Event listeners
                listEl.querySelectorAll('.btn-followup').forEach(function(btn) {
                    btn.onclick = function() {
                        toggleFollowups(btn.dataset.id);
                    };
                });

                listEl.querySelectorAll('.btn-approve').forEach(function(btn) {
                    btn.onclick = function() {
                        updateStatus(btn.dataset.id, 'approved');
                    };
                });

                listEl.querySelectorAll('.btn-reject').forEach(function(btn) {
                    btn.onclick = function() {
                        updateStatus(btn.dataset.id, 'rejected');
                    };
                });

                listEl.querySelectorAll('.btn-add-interaction').forEach(function(btn) {
                    btn.onclick = function() {
                        showAddFollowupModal(btn.dataset.id);
                    };
                });
            })
            .catch(function() { listEl.innerHTML = '<p class="p-6 text-red-600">Erro ao carregar.</p>'; });
    }

    function toggleFollowups(adoptionId) {
        const followupsDiv = document.getElementById('followups-' + adoptionId);
        if (followupsDiv.classList.contains('hidden')) {
            followupsDiv.classList.remove('hidden');
            loadFollowups(adoptionId);
        } else {
            followupsDiv.classList.add('hidden');
        }
    }

    function updateStatus(adoptionId, newStatus) {
        if (!confirm('Tem certeza que deseja ' + (newStatus === 'approved' ? 'aprovar' : 'rejeitar') + ' esta solicitação de adoção?')) return;

        fetch('/api/adoptions/' + adoptionId, {
            method: 'PUT',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ status: newStatus })
        })
        .then(function(r) { return r.json().then(function(j) { return { ok: r.ok, j: j }; }); })
        .then(function(o) {
            if (o.ok) {
                showMsg('Solicitação ' + (newStatus === 'approved' ? 'aprovada' : 'rejeitada') + ' com sucesso.');
                load((new URLSearchParams(window.location.search)).get('page') || 1);
            } else {
                showMsg('Erro ao atualizar status.', true);
            }
        })
        .catch(function() { showMsg('Erro ao atualizar status.', true); });
    }

    function showDetailsModal(adoption) {
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
        modal.style.position = 'fixed';
        modal.style.top = '0';
        modal.style.left = '0';
        modal.style.width = '100%';
        modal.style.height = '100%';
        modal.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
        modal.style.display = 'flex';
        modal.style.alignItems = 'center';
        modal.style.justifyContent = 'center';
        modal.style.zIndex = '9999';
        modal.innerHTML = `
            <div class="bg-white rounded-lg max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold">Detalhes da Adoção</h2>
                        <button class="text-gray-500 hover:text-gray-700" onclick="this.closest('.fixed').remove()">×</button>
                    </div>
                    <div class="space-y-4">
                        <div><strong>Animal:</strong> ${adoption.animal?.name || 'Não informado'}</div>
                        <div><strong>Adotante:</strong> ${adoption.adopter?.name || 'Não informado'}</div>
                        <div><strong>E-mail:</strong> ${adoption.adopter?.email || 'Não informado'}</div>
                        <div><strong>Telefone:</strong> ${adoption.adopter?.phone || 'Não informado'}</div>
                        <div><strong>Status:</strong> <span class="px-2 py-1 text-xs rounded ${getStatusColor(adoption.status)}">${getStatusText(adoption.status)}</span></div>
                        <div><strong>Motivação:</strong> ${adoption.motivation || 'Não informada'}</div>
                        <div><strong>Data da solicitação:</strong> ${new Date(adoption.created_at).toLocaleString('pt-BR')}</div>
                    </div>
                    <div class="mt-6">
                        <h3 class="font-bold mb-2">Interações</h3>
                        <div id="followups-list" class="space-y-2"></div>
                        <button type="button" data-id="${adoption.id}" class="btn-add-interaction-modal mt-4 px-4 py-2 bg-[#A02CDB] text-white rounded hover:bg-[#8a25bd]">Adicionar interação</button>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
        loadFollowups(adoption.id);

        modal.querySelector('.btn-add-interaction-modal').onclick = function() {
            showAddFollowupModal(adoption.id);
        };
    }

    function loadFollowups(adoptionId) {
        fetch('/api/adoption-followups?adoption_id=' + adoptionId, { credentials: 'same-origin', headers: { 'Accept': 'application/json' } })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                const followupsList = document.getElementById('followups-list-' + adoptionId);
                if (!data.data || !data.data.length) {
                    followupsList.innerHTML = '<p class="text-gray-500">Nenhum follow-up registrado.</p>';
                    return;
                }
                followupsList.innerHTML = data.data.map(function(f) {
                    return `
                        <div class="border rounded p-3">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <p class="text-sm text-gray-600">${f.notes}</p>
                                    <p class="text-xs text-gray-500 mt-1">Data da visita: ${f.visit_date ? new Date(f.visit_date).toLocaleDateString('pt-BR') : 'Não informada'}</p>
                                    <p class="text-xs text-gray-500">Criado em: ${new Date(f.created_at).toLocaleDateString('pt-BR')}</p>
                                </div>
                            </div>
                        </div>
                    `;
                }).join('');
            })
            .catch(function() { console.error('Erro ao carregar follow-ups'); });
    }

    window.showAddFollowupModal = function(adoptionId) {
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
        modal.style.position = 'fixed';
        modal.style.top = '0';
        modal.style.left = '0';
        modal.style.width = '100%';
        modal.style.height = '100%';
        modal.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
        modal.style.display = 'flex';
        modal.style.alignItems = 'center';
        modal.style.justifyContent = 'center';
        modal.style.zIndex = '9999';
        modal.innerHTML = `
            <div class="bg-white rounded-lg max-w-md w-full mx-4" style="max-width: 28rem;">
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-4">Adicionar interação</h3>
                    <form id="followup-form">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Notas</label>
                            <textarea id="notes" name="notes" rows="4" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Data da visita</label>
                            <input type="date" id="visit_date" name="visit_date" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
                        </div>
                        <div class="flex gap-3">
                            <button type="submit" class="px-4 py-2 bg-[#A02CDB] text-white rounded hover:bg-[#8a25bd]">Salvar</button>
                            <button type="button" class="px-4 py-2 border text-gray-700 rounded hover:bg-gray-50" onclick="this.closest('.fixed').remove()">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        `;
        document.body.appendChild(modal);

        document.getElementById('followup-form').onsubmit = function(e) {
            e.preventDefault();
            const formData = {
                adoption_id: adoptionId,
                notes: document.getElementById('notes').value,
                visit_date: document.getElementById('visit_date').value || null
            };

            fetch('/api/adoption-followups', {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(formData)
            })
            .then(function(r) { return r.json().then(function(j) { return { ok: r.ok, j: j }; }); })
            .then(function(o) {
                if (o.ok) {
                    modal.remove();
                    loadFollowups(adoptionId);
                    showMsg('Follow-up adicionado com sucesso.');
                } else {
                    showMsg('Erro ao adicionar follow-up.', true);
                }
            })
            .catch(function() { showMsg('Erro ao adicionar follow-up.', true); });
        };
    }

    var params = new URLSearchParams(window.location.search);
    load(params.get('page') || 1);
})();
</script>
@endpush
@endsection