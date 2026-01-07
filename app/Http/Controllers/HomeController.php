<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private ApiService $api;

    public function __construct(ApiService $api)
    {
        $this->api = $api;
    }

    /**
     * Show the homepage
     */
    public function index()
    {
        // Try to get tags for homepage display
        $response = $this->api->get('/api/products/tags/');
        $tags = $response['success'] ? ($response['data'] ?? []) : [];

        return view('home', compact('tags'));
    }
}
