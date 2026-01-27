@extends('layouts.dashboard')

@section('title', 'Novo usuário')

@section('content')
<div class="max-w-xl">
    <div class="mb-6">
        <a href="{{ route('dashboard.usuarios') }}" class="text-[#A02CDB] hover:underline">← Usuários</a>
    </div>
    <h1 class="text-2xl font-bold text-[#A02CDB] mb-2">Novo usuário</h1>
    <p class="text-gray-600 mb-6">Preencha os campos para criar um novo usuário no sistema.</p>

    <div id="msg" class="mb-4 hidden"></div>

    <form id="form" class="bg-white rounded-xl border shadow-sm p-6 space-y-4">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome completo</label>
            <input type="text" id="name" name="name" required maxlength="255"
                   class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]"
                   placeholder="Ex.: João Silva">
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
            <input type="email" id="email" name="email" required maxlength="255"
                   class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]"
                   placeholder="Ex.: joao@email.com">
        </div>
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
            <input type="text" id="phone" name="phone" maxlength="20"
                   class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]"
                   placeholder="Ex.: (51) 99999-9999">
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
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
            <input type="password" id="password" name="password" required minlength="8"
                   class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]"
                   placeholder="Mínimo 8 caracteres">
        </div>
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar senha</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required minlength="8"
                   class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]"
                   placeholder="Digite a senha novamente">
        </div>
        <div class="flex items-center gap-2">
            <input type="checkbox" id="is_active" name="is_active" value="1" checked
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
    var form = document.getElementById('form');
    var msg = document.getElementById('msg');
    form.onsubmit = function(e) {
        e.preventDefault();
        msg.classList.add('hidden');
        var body = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            role: document.getElementById('role').value,
            password: document.getElementById('password').value,
            password_confirmation: document.getElementById('password_confirmation').value,
            is_active: document.getElementById('is_active').checked
        };
        fetch('/api/users', {
            method: 'POST',
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