@extends('layouts.dashboard')

@section('title', 'Editar conteúdo')

@section('content')
<div class="max-w-4xl">
    <div class="mb-6">
        <a href="{{ route('dashboard.conteudos') }}" class="text-[#A02CDB] hover:underline">← Conteúdos</a>
    </div>
    <h1 class="text-2xl font-bold text-[#A02CDB] mb-2">Editar conteúdo</h1>
    <p class="text-gray-600 mb-6">Altere os dados do conteúdo.</p>

    <div id="msg" class="mb-4 hidden"></div>
    <div id="loading" class="p-6 text-gray-500">Carregando…</div>

    <form id="form" class="bg-white rounded-xl border shadow-sm p-6 space-y-4 hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                <input type="text" id="title" name="title" required maxlength="255"
                       class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
            </div>
            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                <input type="text" id="slug" name="slug" required maxlength="255"
                       class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
            </div>
        </div>
        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Categoria</label>
            <select id="category_id" name="category_id" required
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
                <option value="">Selecione uma categoria</option>
            </select>
        </div>
        <div>
            <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Conteúdo</label>
            <div id="content" style="height: 400px;"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="published_at" class="block text-sm font-medium text-gray-700 mb-1">Data de publicação</label>
                <input type="datetime-local" id="published_at" name="published_at"
                       class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[#A02CDB] focus:border-[#A02CDB]">
                <p class="text-xs text-gray-500 mt-1">Deixe em branco para publicar imediatamente.</p>
            </div>
            <div class="flex items-center gap-2 pt-6">
                <input type="checkbox" id="is_active" name="is_active" value="1"
                       class="rounded border-gray-300 text-[#A02CDB] focus:ring-[#A02CDB]">
                <label for="is_active" class="text-sm text-gray-700">Conteúdo ativo (publicado)</label>
            </div>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="px-4 py-2 rounded-lg bg-[#A02CDB] text-white font-medium hover:bg-[#8a25bd] transition">Salvar</button>
            <a href="{{ route('dashboard.conteudos') }}" class="px-4 py-2 rounded-lg border text-gray-700 hover:bg-gray-50 transition">Cancelar</a>
        </div>
    </form>
</div>

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script>
(function() {
    var id = {{ (int) $id }};
    var loading = document.getElementById('loading');
    var form = document.getElementById('form');
    var msg = document.getElementById('msg');

    // Load categories
    fetch('/api/categories', { credentials: 'same-origin', headers: { 'Accept': 'application/json' } })
        .then(function(r) { return r.json(); })
        .then(function(cats) {
            const select = document.getElementById('category_id');
            cats.data.forEach(function(cat) {
                const option = document.createElement('option');
                option.value = cat.id;
                option.textContent = cat.name;
                select.appendChild(option);
            });

            // Load content
            fetch('/api/contents/' + id, { credentials: 'same-origin', headers: { 'Accept': 'application/json' } })
                .then(function(r) {
                    if (!r.ok) throw new Error('Não encontrado');
                    return r.json();
                })
                .then(function(c) {
                    loading.classList.add('hidden');
                    document.getElementById('title').value = c.title || '';
                    document.getElementById('slug').value = c.slug || '';
                    document.getElementById('category_id').value = c.category_id || '';
                    document.getElementById('published_at').value = c.published_at ? new Date(c.published_at).toISOString().slice(0, 16) : '';
                    document.getElementById('is_active').checked = !!c.is_active;

                    // Initialize Quill after setting content
                    var quill = new Quill('#content', {
                        theme: 'snow',
                        placeholder: 'Digite o conteúdo aqui...',
                        modules: {
                            toolbar: [
                                [{ 'header': [1, 2, 3, false] }],
                                ['bold', 'italic', 'underline', 'strike'],
                                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                                [{ 'script': 'sub'}, { 'script': 'super' }],
                                [{ 'indent': '-1'}, { 'indent': '+1' }],
                                ['link', 'image', 'video'],
                                ['blockquote', 'code-block'],
                                [{ 'color': [] }, { 'background': [] }],
                                [{ 'align': [] }],
                                ['clean']
                            ]
                        }
                    });

                    // Set content
                    quill.root.innerHTML = c.content || '';

                    form.classList.remove('hidden');
                })
                .catch(function() {
                    loading.innerHTML = 'Conteúdo não encontrado. <a href="{{ route("dashboard.conteudos") }}" class="text-[#A02CDB] underline">Voltar</a>';
                });
        })
        .catch(function() { console.error('Erro ao carregar categorias'); });

    form.onsubmit = function(e) {
        e.preventDefault();
        msg.classList.add('hidden');
        var quill = Quill.find(document.getElementById('content'));
        var body = {
            title: document.getElementById('title').value,
            slug: document.getElementById('slug').value,
            content: quill.root.innerHTML,
            category_id: document.getElementById('category_id').value,
            published_at: document.getElementById('published_at').value || null,
            is_active: document.getElementById('is_active').checked
        };
        fetch('/api/contents/' + id, {
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
            if (o.ok) window.location = '{{ route("dashboard.conteudos") }}';
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