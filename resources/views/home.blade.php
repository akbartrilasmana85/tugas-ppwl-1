@extends('layouts.app')

@section('konten')
    <div class="kartu">
        <h1>{{ $judul }}</h1>
        <p>{{ $deskripsi }}</p>
    </div>
    <div class="kartu">
        <ul>
            @foreach ($highlights as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    </div>
@endsection
