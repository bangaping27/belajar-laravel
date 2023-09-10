@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Checkout</div>
                <div class="card-body">
                    <h4>{{ $product->name }}</h4>
                    <p>Harga: ${{ $product->price }}</p>
                    <p>Deskripsi: {{ $product->description }}</p>
                    <p>Stok: {{ $product->stock }}</p>
                    <p>Terjual: {{ $product->sold }}</p>
                    <p>Terakhir diupdate: {{ $product->updated_at }}</p>
                    <hr>
                    <form method="POST" action="/checkout/{{ $product->id }}">
                        @csrf
                        <input type="hidden" name="amount" value="{{ $product->price }}">
                        <button type="submit" class="btn btn-primary">Bayar dengan Xendit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
