@extends('layouts.app')

@section('content')

    <div class="container">
        @if ($data->isNotEmpty())
            <h1>Sub Materi: {{ $data->first()->judul_sub }}</h1>
            <h2>Isi Sub Materi:</h2>
            <ul>
                @foreach ($data as $isi)
                {!! $isi->text !!}
                @endforeach
            </ul>
        @else
            <p>Sub-materi tidak ditemukan.</p>
        @endif
    </div>
@endsection
