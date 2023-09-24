@extends('layouts.app')

@section('content')
<script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>    <div class="container">
        <h1>Tambah Isi Sub Materi</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/sub-materi/{{ $subMateri->id }}/isi" method="POST">
            @csrf
            <div class="form-group">
                <label for="judul_sub">Judul Sub Materi:</label>
                <input type="text" name="judul_sub" class="form-control" id="judul_sub">
            </div>
            <div class="form-group">
                <label for="text">Isi Sub Materi:</label>
                <textarea name="text" id="editor"></textarea>
                <script>
                   CKEDITOR.replace( 'text', {

} );
            </script>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Isi Sub Materi</button>
        </form>
    </div>
  
    
    
@endsection
