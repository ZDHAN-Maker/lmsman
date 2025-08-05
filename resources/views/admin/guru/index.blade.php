
<x-app-layout>
<div class="container">
    <h1>Daftar Guru</h1>
    <a href="{{ route('admin.guru.create') }}" class="btn btn-primary mb-3">Tambah Guru</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>NIP</th>
            </tr>
        </thead>
        <tbody>
            @foreach($gurus as $guru)
                <tr>
                    <td>{{ $guru->name }}</td>
                    <td>{{ $guru->email }}</td>
                    <td>{{ $guru->nip}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>
