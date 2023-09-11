<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Invoice;
use Illuminate\Http\Request;


class PaymentController extends Controller
{
    public function checkout(Product $product)
{
    return view('payments.checkout', compact('product'));
}

public function processPayment(Product $product)
    {
        $secret_key = 'Basic '.config('xendit.key_auth');
        $external_id = Str::random(10);
        $data_request = Http::withHeaders([
            'Authorization' => $secret_key
        ])->post('https://api.xendit.co/v2/invoices', [
            'external_id' => $external_id,
            'amount' => request('amount'),
            'payment_methods' => [
        'BCA', 'QRIS'
    ]
        ]);
        $response = $data_request->object();
        dd ($response);
        Invoice::create([
            'user_id' => '1', // Ganti dengan $user_id jika sudah ada fitur login
            'external_id' => $external_id,
            'amount' => request('amount'),
            'description' => 'Pembayaran untuk ',
            'payment_status' => $response->status,
            'payment_link' => $response->invoice_url,
        ]);
        //kirim semua data response ke halaman pilhan pembayaran
        return view('payments.choose-payment', compact('response'));
    }

    public function showCreateForm()
{
    $banks = [
        'BNI' => 'Bank BNI',
        'BCA' => 'Bank BCA',
        'BRI' => 'Bank BRI',
        'MANDIRI' => 'Bank Mandiri',
        'PERMATA' => 'Bank Permata',
        'CIMB' => 'Bank CIMB',
        'BTPN' => 'Bank BTPN',
        'ALFAMART' => 'Alfamart',
        // Tambahkan bank lain sesuai kebutuhan
    ];

    // Ambil total harga dari sesi
    $totalPrice = session()->get('total_price');

    return view('payments.create-virtual-account', ['banks' => $banks, 'totalPrice' => $totalPrice]);
}


public function createVirtualAccount(Request $request)
{
    $secret_key = 'Basic '.config('xendit.key_auth');
$external_id = Str::random(3);
$data_request = Http::withHeaders([
    'Authorization' => $secret_key
])->post('https://api.xendit.co/fixed_payment_code', [
    'external_id' => $external_id,
    'retail_outlet_name' => 'ALFAMART',
    'name' => 'Rizky Ramadhan',
    'expected_amount' => 10000,
]);

$response = $data_request->object();

dd ($response);

        // Menggunakan NumberFormatter untuk mengonversi angka ke kata-kata dalam bahasa Indonesia
        $formatter = new \NumberFormatter("id", \NumberFormatter::SPELLOUT);
        $teksTerbilang = $formatter->format($response->expected_amount);
return view('payments.virtual-account', compact('response', 'teksTerbilang'));
}

public function showSimulatePaymentForm()
{
    return view('payments.simulate-payment');
}

public function simulatePayment(Request $request)
    {
        $transferAmount = $request->input('transfer_amount');
        $bankAccountNumber = $request->input('bank_account_number');
        $bankCode = $request->input('bank_code');
        $secret_key = 'Basic '.config('xendit.key_auth');
        $response = Http::withHeaders([
            'Authorization' => $secret_key,
            'Content-Type' => 'application/json',
        ])->post('https://api.xendit.co/pool_virtual_accounts/simulate_payment', [
            'transfer_amount' => $transferAmount,
            'bank_account_number' => $bankAccountNumber,
            'bank_code' => $bankCode,
        ]);
        // Mendapatkan respons dari server dalam bentuk JSON
        $responseData = $response->json();
        // Menampilkan respons dari server
        return response()->json($responseData);
    }

    public function retrieveFpc($fpcId)
    {
        // Set your Xendit API key
        $apiKey =  'Basic '.config('xendit.key_auth');

        // Make the GET request to retrieve the FPC
        $response = Http::withHeaders([
            'Authorization' => $apiKey,
            'Content-Type' => 'application/json',
        ])->get('https://api.xendit.co/fixed_payment_code/' . $fpcId);
        

        dd ($response);
    }
}

