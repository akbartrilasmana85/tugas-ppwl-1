@extends('layouts.app')

@section('konten')
    <h1>{{ $judul }}</h1>
    <style>
        .alur { display: flex; flex-wrap: wrap; align-items: center; gap: 6px; }
        .kotak { background: #1e3a5f; color: #fff; padding: 10px 12px; border-radius: 6px; font-size: 14px; min-width: 130px; text-align: center; }
        .kotak small { display: block; opacity: .8; font-size: 11px; }
        .panah { font-size: 20px; color: #1e3a5f; }
    </style>
    <div class="kartu">
        <p>Alur <code>GET /program-studi</code> dari browser sampai response:</p>
        <div class="alur">
            @foreach ($tahap as $i => $t)
                <div class="kotak">
                    {{ $t['label'] }}
                    <small>{{ $t['detail'] }}</small>
                </div>
                @if (! $loop->last)
                    <span class="panah">&rarr;</span>
                @endif
            @endforeach
        </div>
    </div>
@endsection
