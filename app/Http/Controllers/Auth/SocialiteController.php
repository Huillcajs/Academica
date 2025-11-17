<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class SocialiteController extends Controller
{
    // 1. Redirige al proveedor (Google)
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // 2. Maneja el Callback
    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Error de autenticación con ' . ucfirst($provider) . '. Inténtalo de nuevo.');
        }

        // Buscar si el usuario ya existe por email
        $user = User::where('email', $socialUser->getEmail())->first();

        if ($user) {
            // LOGIN: El usuario existe, actualizamos sus datos de proveedor por seguridad y logueamos.
            $user->provider = $provider;
            $user->provider_id = $socialUser->getId();
            $user->save();
            Auth::login($user, true);
        } else {
            // REGISTRO: Creamos un nuevo usuario
            $newUser = User::create([
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                'email' => $socialUser->getEmail(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                // El rol por defecto es 'alumno'
            ]);
            Auth::login($newUser, true);
        }

        return redirect()->route('dashboard');
    }
    
    // 3. Cerrar Sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
