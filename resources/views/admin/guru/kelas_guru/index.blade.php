{{-- resources/views/kelas/kelas_guru/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Kelas') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Kelas</h1>
                {{-- Loop kelas --}}
                @foreach($kelas as $k)
                    <div>{{ $k->name }}</div>
                @endforeach
            </div>
        </div>
    </div>
    <main>
        
    </main>
</x-app-layout>