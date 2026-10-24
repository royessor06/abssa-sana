<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    /**
     * Affiche le formulaire de connexion admin
     */
    public function showLogin()
    {
        return view('admin.login');
    }

    /**
     * Traite la connexion admin
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Identifiants admin (simples, sans middleware)
        $adminUser = 'admin';
        $adminPassword = 'admin123';

        if (
            $request->username === $adminUser &&
            $request->password === $adminPassword
        ) {
            session([
                'admin_logged_in' => true,
                'admin_username' => $adminUser,
            ]);

            return redirect()->route('admin.dashboard')
                ->with('success', 'Connexion réussie');
        }

        return back()->withErrors([
            'login' => 'Identifiants administrateur invalides'
        ])->withInput();
    }

    /**
     * Déconnexion admin
     */
    public function logout()
    {
        session()->forget([
            'admin_logged_in',
            'admin_username'
        ]);

        return redirect()->route('admin.login')
            ->with('success', 'Déconnexion réussie');
    }
}
