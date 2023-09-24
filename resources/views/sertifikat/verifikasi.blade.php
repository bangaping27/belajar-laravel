<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Sertifikat</title>
</head>
<body>
    <h1>Verifikasi Sertifikat</h1>
    <h1>Pesan : {{$msg}}</h1>
    <form action="{{ route('sertifikat.verify') }}" method="POST">
        @csrf
        <label for="kode">Masukkan Kode Sertifikat:</label>
        <input type="text" name="kode" id="kode" required>
        <button type="submit">Verifikasi</button>
    </form>
</body>
</html>
