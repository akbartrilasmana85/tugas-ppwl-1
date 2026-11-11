@extends('layouts.app')

@section('konten')
    <h1>{{ $judul }}</h1>
    <p>
        <a href="{{ route('architecture.lifecycle') }}">Request Lifecycle</a> |
        <a href="{{ route('architecture.environment') }}">Environment</a>
    </p>
    <h2>Struktur Folder Penting</h2>
    <table>
        <thead><tr><th>Folder</th><th>Fungsi</th></tr></thead>
        <tbody>
            @foreach ($folders as $f)
                <tr><td><code>{{ $f['nama'] }}</code></td><td>{{ $f['fungsi'] }}</td></tr>
            @endforeach
        </tbody>
    </table>
@endsection
