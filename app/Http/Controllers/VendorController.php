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
            abort(404, 'Vendedor no encontrado');
        }

        $vendor = $response['data'];
        return view('vendors.show', compact('vendor'));
    }
}
