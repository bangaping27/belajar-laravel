<!DOCTYPE html>
<html>
<head>
    <title>Proses Pembayaran Virtual Account</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
    <h1>Proses Pembayaran Virtual Account</h1>

    <h2>Rincian Pembayaran:</h2>
    <ul>
        @if ($response)
        <h2>Payment Details:</h2>
        <ul>
            <li>Bank Code: {{ $response->bank_code }}</li>
            <li>Account Number: {{ $response->account_number }}</li>   
            <li>Nominal yang akan dibayarkan: Rp. {{ number_format($response->expected_amount, 2, ',', '.') }}</li>
            <li>NAMA: {{ $response->name }}</li>     
        </ul>
        <li>Metode Pembayaran yang Tersedia: ATM, IBANKING, MBANKING</li>
        @if(isset($teksTerbilang))
        <p>Terbilang: {{ $teksTerbilang }}</p>
    @endif
    </ul>
    <h1>Countdown Timer</h1>
    <div id="countdown"></div>
    <h2>Instruksi Pembayaran:</h2>
    <ol>
        <li>Temukan ATM Terdekat</li>
        <li>Masukkan kartu ATM Anda</li>
        <li>Pilih bahasa</li>
        <li>Masukkan PIN ATM Anda</li>
        <li>Detail Pembayaran</li>
        <li>Pilih "Menu Lainnya"</li>
        <li>Pilih "Transfer"</li>
        <li>Pilih jenis rekening yang akan Anda gunakan (contoh: "Dari Rekening Tabungan")</li>
        <li>Pilih "Virtual Account Billing"</li>
        <li>Masukkan Nomor Virtual Account Anda {{ $response->account_number }}</li>
        <li>Tagihan yang harus dibayarkan akan muncul pada layar konfirmasi</li>
        <li>Konfirmasi, apabila telah sesuai, lanjutkan transaksi</li>
        <li>Transaksi Berhasil</li>
        <li>Transaksi Anda telah selesai</li>
    </ol>

    <p>Setelah transaksi Anda selesai, invoice ini akan diupdate secara otomatis. Proses ini mungkin memakan waktu hingga 5 menit.</p>
</body>

<script>
    // Mengambil tanggal akhir dari PHP dan mengonversinya ke dalam format milidetik
    var endDate = new Date("{{ $response->expiration_date }}").getTime();
    
    // Memperbarui countdown setiap 1 detik
    var countdownInterval = setInterval(function() {
        var currentDate = new Date().getTime();
        var timeLeft = endDate - currentDate;

        // Hitung jam, menit, dan detik yang tersisa
        var hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

        // Tampilkan countdown pada elemen dengan id "countdown"
        document.getElementById("countdown").innerHTML = hours + "h " + minutes + "m " + seconds + "s ";

        // Jika waktu telah habis, hentikan countdown
        if (timeLeft <= 0) {
            clearInterval(countdownInterval);
            document.getElementById("countdown").innerHTML = "Waktu telah habis!";
        }
    }, 1000);
</script>
@else
<p>No payment details available.</p>
@endif
</html>