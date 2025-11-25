@extends('layouts.app')
@section('title', 'Masuk Akun')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-600 to-blue-500 p-6">
    <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Masuk ke Akun Anda</h2>
        
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            
            <!-- Email Address -->
            <div>
                <x-input-label for="email" value="Email" class="font-semibold" />
                <x-text-input id="email"
                    class="block mt-1 w-full rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            
            <!-- Password -->
            <div>
                <x-input-label for="password" value="Password" class="font-semibold" />
                <x-text-input id="password"
                    class="block mt-1 w-full rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            
            <!-- Remember Me -->
            <div class="flex items-center justify-between mt-2">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                        name="remember">
                    <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
                </label>
                
                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </div>
            
            <!-- Button -->
            <div>
                <x-primary-button
                    class="w-full justify-center py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold shadow-md transition">
                    Masuk
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
@endsection