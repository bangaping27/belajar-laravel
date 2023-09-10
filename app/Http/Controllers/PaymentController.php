<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Invoice;
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
        //dd ($response);
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
}

