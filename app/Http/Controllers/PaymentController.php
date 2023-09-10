<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // Tambahkan bank lain sesuai kebutuhan
    ];

    return view('payments.create-virtual-account', ['banks' => $banks]);
}

public function createVirtualAccount(Request $request)
{
    $secret_key = 'Basic '.config('xendit.key_auth');
$external_id = Str::random(10);

$data_request = Http::withHeaders([
    'Authorization' => $secret_key
])->post('https://api.xendit.co/callback_virtual_accounts', [
    'external_id' => $external_id,
    'bank_code' => $request->bank_code,
    'name' => $request->name,
]);

dd ($data_request->object());

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

}

