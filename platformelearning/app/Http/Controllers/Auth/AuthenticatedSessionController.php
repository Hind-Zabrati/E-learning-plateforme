<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Affiche le formulaire de connexion.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Traite la tentative d'authentification.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // 1. Authentification via LoginRequest (validation + check des credentials)
        $request->authenticate();

        // 2. Régénère l'ID de session pour prévenir les attaques de fixation
        $request->session()->regenerate();

        // 3. Récupère l'utilisateur connecté
        $user = Auth::user();

        // 4. Redirection selon le rôle
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'formateur':
                return redirect()->route('formateur.dashboard');
            case 'apprenant':
            default:
                return redirect()->route('apprenant.dashboard');
        }
    }

    /**
     * Détruit la session authentifiée (logout).
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        //Pour rediriger vers /login 
        return redirect()->route('login');
    }
}
