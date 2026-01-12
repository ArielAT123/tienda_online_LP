<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    private ApiService $api;

    public function __construct(ApiService $api)
    {
        $this->api = $api;
    }

    /**
     * Show vendor profile
     * API: GET /api/auth/vendors/{vendor_id}/
     * Response: { id, name, email, direction, phone_number, average_rating, reviews[] }
     */
    public function show(int $id)
    {
        $response = $this->api->get("/api/auth/vendors/{$id}/");
        
        if (!$response['success']) {
            // If requesting your own vendor profile and API fails, show a minimal profile from session
            if (session('user_id') && (string)session('user_id') === (string)$id) {
                $vendor = [
                    'id' => $id,
                    'name' => session('user_name'),
                    'email' => session('user_email'),
                    'phone_number' => session('user_phone') ?? null,
                    'direction' => session('user_direction') ?? null,
                    'reviews' => [],
                    'average_rating' => null,
                ];
                return view('vendors.show', compact('vendor'))->with('info', 'Mostrando tu perfil con información básica debido a un problema temporal con el servicio.');
            }

            abort(404, 'Vendedor no encontrado');
        }

        $vendor = $response['data'];
        return view('vendors.show', compact('vendor'));
    }
}
