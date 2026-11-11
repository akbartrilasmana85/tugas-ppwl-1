@extends('layouts.app')

@section('konten')
    <h1>{{ $judul }}</h1>
    <div class="kartu">
        <p><strong>Alamat:</strong> {{ $kontak['alamat'] }}</p>
        <p><strong>Email:</strong> {{ $kontak['email'] }}</p>
        <p><strong>Telepon:</strong> {{ $kontak['telepon'] }}</p>
    </div>
@endsection
