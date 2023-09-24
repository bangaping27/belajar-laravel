@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Materi: {{ $materi->nama_materi }}</h1>

        <h2>Sub Materi:</h2>
        <ul>
            @if ($subMateri)
                @foreach ($subMateri as $sub)
                    <li>
                        {{ $sub->judul_sub }}
                        @if ($sub->isiSubMateri)
                            <ul>
                                @foreach ($sub->isiSubMateri as $isiSubMateri)
                                    <li>                                    <a href="{{ route('isi.show', ['isiSubMateri' => $isiSubMateri->id]) }}">{{ $isiSubMateri->judul_sub }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            @else
                <p>Tidak ada sub-materi yang tersedia untuk materi ini.</p>
            @endif
        </ul>
    </div>
@endsection
