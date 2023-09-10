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
                <li><a href="/">Home</a></li>
                <li><a href="/about">About</a></li>
                <!-- Tambahkan item menu lainnya di sini -->
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
