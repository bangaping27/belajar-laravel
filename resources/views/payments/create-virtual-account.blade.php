<!DOCTYPE html>
<html>
<head>
    <title>Create Virtual Account</title>
</head>
<body>
    <h1>Create Virtual Account</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="/create-virtual-account">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" required><br><br>

        <label for="bank_code">Bank:</label>
        <select name="bank_code" required>
            @foreach($banks as $bankCode => $bankName)
                <option value="{{ $bankCode }}">{{ $bankName }}</option>
            @endforeach
        </select><br><br>
        <button type="submit">Create Virtual Account</button>
    </form>
</body>
</html>
