<x-app-layout>
    <div class="py-6" x-data="{ openModal: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Tombol Trigger Modal -->
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">Daftar Kelas</h3>
                    <button @click="openModal = true" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        + Tambah Kelas
                    </button>
                </div>

                <!-- Tabel Kelas -->
                <table class="table-auto w-full border">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="px-4 py-2">Nama Kelas</th>
                            <th class="px-4 py-2">Guru</th>
                            <th class="px-4 py-2">Semester</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kelas as $k)
                        <tr>
                            <td class="px-4 py-2">{{ $k->name }}</td>
                            <td class="px-4 py-2">{{ $k->guru->name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $k->semester->nama ?? '-' }} - {{ $k->semester->tahun_ajaran ?? '' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-4 py-2 text-center">Belum ada kelas</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Form Tambah Kelas -->
        <div x-show="openModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 z-50 flex items-center justify-center">
            <div @click.away="openModal = false" class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h3 class="text-lg font-bold mb-4">Tambah Kelas</h3>
                <form action="{{ route('admin.kelas.kelas_admin.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama Kelas</label>
                        <input type="text" name="name" class="mt-1 block w-full border-gray-300 rounded shadow-sm">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Guru</label>
                        <select name="guru_id" class="mt-1 block w-full border-gray-300 rounded shadow-sm">
                            <option value="">-- Pilih Guru --</option>
                            @foreach ($gurus as $guru)
                            <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Semester</label>
                        <select name="semester_id" class="mt-1 block w-full border-gray-300 rounded shadow-sm">
                            <option value="">-- Pilih Semester --</option>
                            @foreach($semesters as $semester)
                            <option value="{{ $semester->id }}">{{ $semester->nama }} - {{ $semester->tahun_ajaran }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="openModal = false" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">
                            Batal
                        </button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
