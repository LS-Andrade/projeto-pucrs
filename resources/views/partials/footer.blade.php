<footer class="bg-white border-t mt-12">
  <div class="max-w-7xl mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-3 gap-6 text-sm text-gray-600">
      <div>
          <p class="font-semibold text-primary text-lg">Animalidade</p>
          <p class="mt-2">Promovendo o bem-estar animal, a adoção responsável e a educação.</p>
      </div>

      <div>
          <p class="font-semibold text-gray-800 mb-2">Navegação</p>
          <ul class="space-y-1">
              <li><a href="{{ route('home') }}" class="hover:text-primary">Início</a></li>
              <li><a href="{{ route('animals.index') }}" class="hover:text-primary">Adoção</a></li>
              <li><a href="{{ route('contents.index') }}" class="hover:text-primary">Conteúdos</a></li>
              <li><a href="{{ route('reports.create') }}" class="hover:text-primary">Denunciar</a></li>
          </ul>
      </div>

      <div>
          <p class="font-semibold text-gray-800 mb-2">Contato</p>
          <p>Email: contato@animalidade.org</p>
          <p>Telefone: (00) 00000-0000</p>
      </div>
  </div>

  <div class="text-center text-xs text-gray-500 pb-4">
      © {{ date('Y') }} Animalidade. Todos os direitos reservados.
  </div>
</footer>
