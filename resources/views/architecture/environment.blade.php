@extends('layouts.app')

@section('konten')
    <h1>{{ $judul }}</h1>
    <p>Info di bawah sudah difilter. APP_KEY dan kredensial database sengaja tidak ditampilkan.</p>
    <table>
        <tbody>
            @foreach ($info as $label => $nilai)
                <tr><th>{{ $label }}</th><td>{{ $nilai }}</td></tr>
            @endforeach
        </tbody>
    </table>
@endsection
