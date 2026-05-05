
@props(['items'])




<div x-data="{ open: false }" class="relative">
    <!-- Dropdown Button -->
    {{-- <button  class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">
        Pilih Cabang
    </button> --}}

    <button @click="open = !open" type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 shadow-xs ring-gray-300 ring-inset hover:bg-gray-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
        Pilih Cabang
        <svg class="-mr-1 size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
          <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
        </svg>
      </button>

    <!-- Dropdown List -->
    <div x-show="open" @click.away="open = false" class="absolute left-0 mt-2 w-48 bg-white border border-gray-300 shadow-md rounded-md">
        @foreach ($items as $item)
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                {{ $item }}
            </a>
        @endforeach
    </div>
</div>