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
     * Show user profile (private)
     * - Requires user to be logged in (session api_token)
     * - If the user is a vendor, redirect to vendor profile
     */
    public function show(Request $request)
    {
        if (!session('api_token') || !session('user_id')) {
            return redirect()->route('auth.login.show')->with('info', 'Debes iniciar sesión para ver tu perfil');
        }

        $userId = session('user_id');

        // If user is vendor, try to resolve vendor id and redirect to vendor profile
        if (session('is_vendor')) {
            // attempt to fetch user details to obtain vendor id if present
            $userResp = $this->api->get("/api/auth/users/{$userId}/");
            if ($userResp['success']) {
                $vendorId = $userResp['data']['vendor_id'] ?? ($userResp['data']['vendor']['id'] ?? $userId);
            } else {
                $vendorId = $userId; // fallback to user id
            }
            return redirect()->route('vendors.show', ['id' => $vendorId]);
        }

        // Try to fetch more user details from API, fallback to session data
        $response = $this->api->get("/api/auth/users/{$userId}/");

        if ($response['success']) {
            $user = $response['data'];
        } else {
            $user = [
                'id' => $userId,
                'name' => session('user_name'),
                'email' => session('user_email'),
            ];
        }

        return view('users.show', compact('user'));
    }
}
