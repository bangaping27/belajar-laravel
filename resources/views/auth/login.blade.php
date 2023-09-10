@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded shadow-md w-full sm:w-96">
        <h1 class="text-2xl font-semibold mb-6">Login</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                <input type="email" name="email" id="email" class="form-input @error('email') border-red-500 @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" id="password" class="form-input @error('password') border-red-500 @enderror" required autocomplete="current-password">
                @error('password')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember" class="text-gray-700 text-sm font-bold">Remember me</label>
            </div>
            <div>
                <button type="submit" class="bg-blue-500 text-white text-sm font-semibold px-4 py-2 rounded-full hover:bg-blue-600 transition duration-300">Login</button>
            </div>
        </form>
        <p class="mt-4 text-gray-600 text-sm">Don't have an account? <a href="{{ route('register') }}" class="text-blue-500">Register</a></p>
    </div>
</div>
@endsection
