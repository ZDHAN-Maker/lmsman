<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Hi Admin !!' ) }}
        </h2>
    </x-slot>

    <div class="py-12 px-6">
        <div>Total Guru: {{ $totalGuru }}</div>
        <div>Total Murid: {{ $totalMurid }}</div>
        <div>Total Kelas: {{ $totalKelas }}</div>
        <div>Total Absensi Guru: {{ $totalAbsensiGuru }}</div>
        <div>Total Absensi Murid: {{ $totalAbsensiMurid }}</div>
    </div>
</x-app-layout>