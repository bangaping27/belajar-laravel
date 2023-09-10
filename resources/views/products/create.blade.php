@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Tambah Produk</div>
                <div class="card-body">
                    <form method="POST" action="/add-product">
                        @csrf
                        <div class="form-group">
                            <label for="product_name">Nama Produk</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" required>
                        </div>
                        <div class="form-group">
                            <label for="product_price">Harga</label>
                            <input type="number" class="form-control" id="product_price" name="product_price" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Produk</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Daftar Produk</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    <form method="POST" action="{{ route('cart.add', $product->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>                        
                    </table>
                </div>
                <a href="{{ route('cart.index') }}" class="btn btn-success">Lihat Keranjang</a>

                <div class="card-footer">
                    <a href="{{ route('product.create') }}" class="btn btn-success">Tambah Produk Baru</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
