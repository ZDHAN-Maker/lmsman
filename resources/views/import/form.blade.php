@extends('adminlte::page') {{-- atau layout kamu sendiri --}}

@section('content')
    <h1>Import Data Guru</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('import.guru') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="file">Pilih file CSV/Excel:</label>
            <input type="file" name="file" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Import Guru</button>
    </form>
@endsection
