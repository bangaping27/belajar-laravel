<!DOCTYPE html>
<html>
<head>
    <title>Simulate Payment</title>
</head>
<body>
    <h1>Simulate Payment</h1>

    <form method="POST" action="{{ route('simulatePayment') }}">
        @csrf
        <label for="transfer_amount">Transfer Amount:</label>
        <input type="text" name="transfer_amount" required><br><br>

        <label for="bank_account_number">Bank Account Number:</label>
        <input type="text" name="bank_account_number" required><br><br>

        <label for="bank_code">Bank Code:</label>
        <input type="text" name="bank_code" required><br><br>

        <button type="submit">Simulate Payment</button>
    </form>
</body>
</html>
