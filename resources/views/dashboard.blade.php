@extends('adminlte::page')

@section('title', 'Dashboard') {{-- Sesuaikan Judul --}}

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Selamat datang di dashboard AdminLTE Anda!</p>
    {{-- Letakkan konten dashboard Anda di sini --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Contoh Kartu</h3>
        </div>
        <div class="card-body">
            Isi kartu
        </div>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop