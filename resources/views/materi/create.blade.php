@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Materi</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('materi.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama_materi">Nama Materi:</label>
                <input type="text" name="nama_materi" class="form-control" id="nama_materi">
            </div>
            <div class="form-group">
                <label for="progres">Progres:</label>
                <input type="number" name="progres" class="form-control" id="progres">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Materi</button>
        </form>
    </div>
@endsection
