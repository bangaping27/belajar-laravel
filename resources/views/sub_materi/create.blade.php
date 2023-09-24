@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Sub Materi</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/materi/{{ $materi->id }}/sub-materi" method="POST">
            @csrf
            <div class="form-group">
                <label for="judul_sub">Judul Sub Materi:</label>
                <input type="text" name="judul_sub" class="form-control" id="judul_sub">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Sub Materi</button>
        </form>
    </div>
@endsection
