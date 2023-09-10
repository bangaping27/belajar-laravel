@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Keranjang Belanja</h1>

    @if(count($cartItems) > 0)
    <div class="text-center">
        <form method="POST" action="{{ route('cart.clear') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Hapus Semua</button>
        </form>
    </div>
    
    <table class="table">
        <!-- Tabel item keranjang yang sudah ada -->
    
        <!-- Kolom Hapus Satu -->
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Hapus Satu</th>
                <th>Hapus Semua</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>Rp. {{ number_format($item['price'], 0, ',', '.') }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>Rp. {{ number_format($item['total_price'], 0, ',', '.') }}</td>
                <td>
                    <form method="POST" action="{{ route('cart.remove.satu', $item['id']) }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Hapus Satu</button>
                    </form>
                </td>
                <td>
                    <form method="POST" action="{{ route('cart.remove', $item['id']) }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Hapus Semua barang</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-center">
        <h3>Total Harga: Rp. {{ number_format($totalPrice, 0, ',', '.') }}</h3>
        <a href="{{ route('createVirtualAccount') }}" class="btn btn-success">Checkout</a>
    </div>
    
    @else
    <p>Keranjang belanja kosong.</p>
    @endif
</div>
@endsection
