@extends('layouts.app')

@section('konten')
    <h1>{{ $judul }}</h1>
    <table>
        <thead>
            <tr><th>Program Studi</th><th>Jenjang</th><th>Akreditasi</th></tr>
        </thead>
        <tbody>
            @foreach ($programs as $p)
                <tr>
                    <td>{{ $p['nama'] }}</td>
                    <td>{{ $p['jenjang'] }}</td>
                    <td>{{ $p['akreditasi'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
