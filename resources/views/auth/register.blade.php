@extends('layouts.app')

@section('title', 'Daftar Akun')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-600 to-blue-500 p-6">
    <div class="max-w-md w-full bg-white shadow-xl rounded-2xl p-8 border border-gray-100">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Buat Akun Baru</h2>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" value="Name" class="text-gray-700" />
                <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                    class="block mt-1 w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email" value="Email" class="text-gray-700" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                    class="block mt-1 w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" value="Password" class="text-gray-700" />
                <x-text-input id="password" type="password" name="password" required autocomplete="new-password"
                    class="block mt-1 w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" value="Confirm Password" class="text-gray-700" />
                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                    class="block mt-1 w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- ============== AWAL TAMBAHAN ============== -->

            <!-- Address -->
            <div>
                <x-input-label for="address" value="Alamat Lengkap" class="text-gray-700" />
                <x-text-input id="address" type="text" name="address" :value="old('address')" required autocomplete="street-address"
                    class="block mt-1 w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <!-- Phone -->
            <div>
                <x-input-label for="phone" value="Nomor Telepon" class="text-gray-700" />
                <x-text-input id="phone" type="tel" name="phone" :value="old('phone')" required autocomplete="tel"
                    class="block mt-1 w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- ============== AKHIR TAMBAHAN ============== -->

            <div class="flex items-center justify-between pt-3">
                <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-blue-600 font-medium">
                    Sudah punya akun?
                </a>

                <x-primary-button class="px-6 py-2 rounded-lg bg-blue-600 hover:bg-blue-700">
                    Daftar
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
@endsection