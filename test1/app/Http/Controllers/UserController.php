<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',

        ]);
        $validated["password"] = Hash::make($validated["password"]);
        User::create($validated);
        return redirect('/connection')->with('success', 'Compte créé avec succès !');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::where('email', $validated["email"])->first();

        if ($user && Hash::check($validated['password'], $user->password)) {
            Auth::login($user);
            return redirect('/')->with('success', 'Connecté avec succès !');
        }

        return back()->with('error', 'Email ou mot de passe incorrect.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect("/");
    }
}
