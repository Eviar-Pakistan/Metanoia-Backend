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
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        
        // Check if user is admin
        if (Auth::user()->role_id != 1) {
            Auth::logout();

            // If JSON request (from React), return JSON error
            if ($request->expectsJson() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You do not have access to this application.',
                ], 403);
            }

            return redirect()->route('login')->withErrors([
                'email' => 'You do not have access to this application.',
            ]);
        }

        $request->session()->regenerate();

        // If JSON request (from React dashboard), return JSON with token
        if ($request->expectsJson() || $request->wantsJson()) {
            $user = Auth::user();
            $token = $user->createToken('dashboard')->plainTextToken;
            
            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'data' => [
                    'token' => $token,
                    'user' => [
                        'id' => $user->id,
                        'email' => $user->email,
                        'first_name' => $user->first_name,
                        'last_name' => $user->last_name,
                        'role_id' => $user->role_id,
                    ]
                ]
            ]);
        }

        // For traditional web (Blade views), redirect to dashboard
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
