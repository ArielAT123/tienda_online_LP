<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private ApiService $api;

    public function __construct(ApiService $api)
    {
        $this->api = $api;
    }

    /**
     * Show login form
     */
    public function showLogin()
    {
        if (session('api_token')) {
            return redirect('/')->with('info', 'Ya has iniciado sesión');
        }
        return view('auth.login');
    }

    /**
     * Login user
     * API Response: { message, user: {id, name, email, is_vendor} }
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Call Django login endpoint
        $response = $this->api->post('/api/auth/login/', $validated);

        if ($response['success']) {
            // Store user data in session
            // API returns: { message, user: {id, name, email, is_vendor} }
            $user = $response['data']['user'] ?? null;
            
            if ($user) {
                session([
                    'api_token' => 'logged_in', // Mark as logged in (API doesn't return token)
                    'user_id' => $user['id'],
                    'user_name' => $user['name'],
                    'user_email' => $user['email'],
                    'is_vendor' => $user['is_vendor'] ?? false,
                ]);
            }
            
            return redirect('/')->with('success', '¡Bienvenido de vuelta, ' . ($user['name'] ?? 'Usuario') . '!');
        }

        return back()
            ->withInput()
            ->withErrors(['error' => $response['error'] ?? 'Credenciales inválidas']);
    }

    /**
     * Logout user
     */
    public function logout()
    {
        // Clear all session data
        session()->forget(['api_token', 'user_id', 'user_name', 'user_email', 'is_vendor']);
        
        return redirect('/')->with('success', 'Has cerrado sesión correctamente');
    }

    /**
     * Show client registration form
     */
    public function showRegisterClient()
    {
        return view('auth.register-client');
    }

    /**
     * Register a new client
     * API expects: email, password, name
     */
    public function registerClient(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'name' => 'required|string|max:255',
        ]);

        $response = $this->api->post('/api/auth/register_client/', $validated);

        if ($response['success']) {
            // Store token if returned
            if (isset($response['data']['token'])) {
                session(['api_token' => $response['data']['token']]);
                session(['user_name' => $validated['name']]);
            }
            return redirect('/')->with('success', '¡Registro exitoso! Bienvenido a nuestra tienda.');
        }

        return back()
            ->withInput()
            ->withErrors($response['errors'] ?? ['error' => $response['error']]);
    }

    /**
     * Show vendor registration form
     */
    public function showRegisterVendor()
    {
        return view('auth.register-vendor');
    }

    /**
     * Register a new vendor
     * API expects: email, password, name, direction, phone_number, store_name, store_description, store_logo
     */
    public function registerVendor(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'name' => 'required|string|max:255',
            'direction' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'store_name' => 'required|string|max:255',
            'store_description' => 'nullable|string',
            'store_logo' => 'nullable|url',
        ]);

        $response = $this->api->post('/api/auth/register_vendor/', $validated);

        if ($response['success']) {
            if (isset($response['data']['token'])) {
                session(['api_token' => $response['data']['token']]);
            }
            session(['user_name' => $validated['name']]);
            
            return redirect('/')->with('success', '¡Registro de vendedor exitoso!');
        }

        return back()
            ->withInput()
            ->withErrors($response['errors'] ?? ['error' => $response['error']]);
    }
}
