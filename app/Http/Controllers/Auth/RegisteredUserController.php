<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // --- AWAL PERUBAAN: TAMBAHKAN VALIDASI UNTUK FIELD BARU ---
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => ['required', 'string', 'min:10'], // <--- TAMBAHKAN VALIDASI ALAMAT
            'phone' => ['required', 'string', 'min:10'],   // <--- TAMBAHKAN VALIDASI TELEPON
        ]);

        // --- AWAL PERUBAAN: TAMBAHKAN FIELD BARU SAAT MEMBUAT USER ---
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address, // <--- TAMBAHKAN INI
            'phone' => $request->phone,   // <--- TAMBAHKAN INI
            'role' => 'customer',        // <--- TAMBAHKAN DEFAULT ROLE
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}