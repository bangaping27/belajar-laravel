<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your App Title</title>
    <!-- Tambahkan link ke CSS, JavaScript, atau pustaka lainnya di sini -->
</head>
<body>
    <header>
        <!-- Tambahkan header Anda di sini -->
        <nav>
            <ul>
                <li><a href="/add-product">Tambah Produk</a></li>
                <li><a href="/create-virtual-account">Bikin Virtual Account</a></li>
                <li><a href="/simulate-payment">Simulasi Payment</a></li>   
                <li><a href="/materi/create">Buat Materi</a></li>                             
            </ul>
        </nav>
    </header>

    <main>
        @yield('content') <!-- Ini adalah tempat konten halaman akan ditampilkan -->
    </main>

    <footer>
        <!-- Tambahkan footer Anda di sini -->
    </footer>
</body>
</html>
