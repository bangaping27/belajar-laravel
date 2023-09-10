<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Response</h1>
    <p>id: {{ $response->id }}</p>
    <p>external_id: {{ $response->external_id }}</p>
    <p>user_id: {{ $response->user_id }}</p>
    <p>status: {{ $response->status }}</p>
    <p>merchant_name: {{ $response->merchant_name }}</p>
    <p>merchant_profile_picture_url: {{ $response->merchant_profile_picture_url }}</p>
    <p>amount: {{ $response->amount }}</p>
    <p>invoice_url: {{ $response->invoice_url }}</p>
    <p>available_banks:</p>
<ul>
    @foreach ($response->available_banks as $bank)
        <li>
            <p>bank_code: {{ $bank->bank_code }}</p>
            <p>collection_type: {{ $bank->collection_type }}</p>
            <p>transfer_amount: {{ $bank->transfer_amount }}</p>
            <p>bank_branch: {{ $bank->bank_branch }}</p>
            <p>account_holder_name: {{ $bank->account_holder_name }}</p>
            <p>identity_amount: {{ $bank->identity_amount }}</p>
        </li>
    @endforeach
    <p>QRIS : {{ $bank->available_qr_codes }}</p>
</ul>

    </body>
</html>