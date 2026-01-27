@extends('layouts.dashboard')

@section('title', 'Editar usuário')

@section('content')
<div class="max-w-xl">
    <div class="mb-6">
        <a href="{{ route('dashboard.usuarios') }}" class="text-[#A02CDB] hover:underline">← Usuários</a>
    </div>
    <h1 class="text-2xl font-bold text-[#A02CDB] mb-2">Editar usuário</h1>
    <p class="text-gray-600 mb-6">Altere os dados do usuário e salve.</p>

    <div id="msg" class="mb-4 hidden"></div>
    <div id="loading" class="p-6 text-gray-500">Carregando…</div>

    <form id="form" class="bg-white rounded-xl border shadow-sm p-6 space-y-4 hidden">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome completo</label>
            <input type="text" id="name" name="name" required maxlength="255"
                   class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
            <input type="email" id="email" name="email" required maxlength="255"
                   class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
        </div>
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
            <input type="text" id="phone" name="phone" maxlength="20"
                   class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
        </div>
        <div>
            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Função</label>
            <select id="role" name="role" required
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
                <option value="user">Usuário</option>
                <option value="staff">Funcionário</option>
                <option value="manager">Gerente</option>
                <option value="admin">Administrador</option>
            </select>
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Nova senha (opcional)</label>
            <input type="password" id="password" name="password" minlength="8"
                   class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]"
                   placeholder="Deixe em branco para manter a senha atual">
            <p class="text-xs text-gray-500 mt-1">Mínimo 8 caracteres. Deixe em branco para não alterar.</p>
        </div>
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar nova senha</label>
            <input type="password" id="password_confirmation" name="password_confirmation" minlength="8"
                   class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]"
                   placeholder="Confirme a nova senha">
        </div>
        <div class="flex items-center gap-2">
            <input type="checkbox" id="is_active" name="is_active" value="1"
                   class="rounded border-gray-300 text-[#A02CDB] focus:ring-[#A02CDB]">
            <label for="is_active" class="text-sm text-gray-700">Usuário ativo</label>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="px-4 py-2 rounded-lg bg-[#A02CDB] text-white font-medium hover:bg-[#8a25bd] transition">Salvar</button>
            <a href="{{ route('dashboard.usuarios') }}" class="px-4 py-2 rounded-lg border text-gray-700 hover:bg-gray-50 transition">Cancelar</a>
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

    fetch('/api/users/' + id, { credentials: 'same-origin', headers: { 'Accept': 'application/json' } })
        .then(function(r) {
            if (!r.ok) throw new Error('Não encontrado');
            return r.json();
        })
        .then(function(u) {
            loading.classList.add('hidden');
            document.getElementById('name').value = u.name || '';
            document.getElementById('email').value = u.email || '';
            document.getElementById('phone').value = u.phone || '';
            document.getElementById('role').value = u.role || 'user';
            document.getElementById('is_active').checked = !!u.is_active;
            form.classList.remove('hidden');
        })
        .catch(function() {
            loading.innerHTML = 'Usuário não encontrado. <a href="{{ route("dashboard.usuarios") }}" class="text-[#A02CDB] underline">Voltar</a>';
        });

    form.onsubmit = function(e) {
        e.preventDefault();
        msg.classList.add('hidden');
        var body = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            role: document.getElementById('role').value,
            is_active: document.getElementById('is_active').checked
        };

        // Só inclui senha se foi preenchida
        var password = document.getElementById('password').value;
        if (password) {
            body.password = password;
            body.password_confirmation = document.getElementById('password_confirmation').value;
        }

        fetch('/api/users/' + id, {
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
            if (o.ok) window.location = '{{ route("dashboard.usuarios") }}';
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