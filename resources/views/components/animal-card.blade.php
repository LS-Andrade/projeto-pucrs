<div class="bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition overflow-hidden">
  <img src="{{ $animal->mainPhoto?->photo_url ?? '/images/animal-placeholder.jpg' }}"
       alt="{{ $animal->name }}"
       class="w-full h-48 object-cover">

  <div class="p-4">
      <h3 class="text-lg font-semibold">{{ $animal->name }}</h3>
      <p class="text-sm text-gray-600 dark:text-gray-400">
          {{ ucfirst($animal->species) }} • {{ $animal->age }} anos
      </p>
      <p class="mt-2 text-sm line-clamp-3">
          {{ $animal->description }}
      </p>

      <a href="{{ route('animals.show', $animal) }}"
         class="inline-block mt-4 text-green-600 hover:underline">
          Ver detalhes →
      </a>
  </div>
</div>
