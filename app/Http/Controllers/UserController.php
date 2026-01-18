<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private ApiService $api;

    public function __construct(ApiService $api)
    {
        $this->api = $api;
    }

    /**
     * Show user profile
     * Uses: GET /api/auth/profile/{user_id}/
     * Response depends on is_vendor (client vs vendor)
     */
    public function show(Request $request)
    {
        // Check if user is logged in
        if (!session('api_token') || !session('user_id')) {
            return redirect()->route('auth.login.show')->with('info', 'Debes iniciar sesión para ver tu perfil');
        }

        $userId = session('user_id');
        $isVendor = session('is_vendor', false);

        // Fetch profile from API using session user_id
        $response = $this->api->get("/api/auth/profile/{$userId}/");

        if ($response['success']) {
            $profile = $response['data'];
            
            // If user is vendor, show vendor profile with store and products
            if ($isVendor || ($profile['is_vendor'] ?? false)) {
                return view('users.vendor-profile', [
                    'user' => $profile,
                    'store' => $profile['store'] ?? null,
                    'products' => $profile['products'] ?? [],
                    'products_count' => $profile['products_count'] ?? 0,
                ]);
            }
            
            // Regular client profile
            return view('users.show', ['user' => $profile]);
        }

        // Fallback to session data if API fails
        $user = [
            'id' => $userId,
            'name' => session('user_name'),
            'email' => session('user_email'),
            'is_vendor' => $isVendor,
        ];

        return view('users.show', compact('user'));
    }
}
