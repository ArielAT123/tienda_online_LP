<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class ApiService
{
    private string $baseUrl;
    private ?string $token = null;

    public function __construct()
    {
        $this->baseUrl = config('services.api.base_url', env('API_BASE_URL', 'http://localhost:8000'));
    }

    
      #Set authentication token for requests
     
    public function withToken(?string $token): self
    {
        $this->token = $token;
        return $this;
    }

    
     #Get token from session
    
    public function withSessionToken(): self
    {
        $this->token = session('api_token');
        return $this;
    }

    
     #Make a GET request
     
    public function get(string $endpoint, array $query = []): array
    {
        $response = $this->request()->get($this->url($endpoint), $query);
        return $this->handleResponse($response);
    }

    
     #Make a POST request
     
    public function post(string $endpoint, array $data = []): array
    {
        $response = $this->request()->post($this->url($endpoint), $data);
        return $this->handleResponse($response);
    }

    
     #Make a PUT request
    
    public function put(string $endpoint, array $data = []): array
    {
        $response = $this->request()->put($this->url($endpoint), $data);
        return $this->handleResponse($response);
    }

    
    #Make a DELETE request
    
    public function delete(string $endpoint): array
    {
        $response = $this->request()->delete($this->url($endpoint));
        return $this->handleResponse($response);
    }

    /**
     * Upload a file (multipart/form-data)
     * @param string $urlOrEndpoint Full URL or relative endpoint
     */
    public function uploadFile(string $urlOrEndpoint, $file, array $options = []): array
    {
        $http = Http::acceptJson()->timeout(60);

        if ($this->token) {
            $http = $http->withHeaders([
                'Authorization' => 'Token ' . $this->token
            ]);
        }

        // Use full URL if provided, otherwise use base URL
        $url = str_starts_with($urlOrEndpoint, 'http') ? $urlOrEndpoint : $this->url($urlOrEndpoint);

        $response = $http->attach(
            'image',
            file_get_contents($file->getRealPath()),
            $file->getClientOriginalName()
        )->post($url, $options);

        return $this->handleResponse($response);
    }
    
    
    #Build the full URL
    
    private function url(string $endpoint): string
    {
        return rtrim($this->baseUrl, '/') . '/' . ltrim($endpoint, '/');
    }

    
     #Get HTTP client with headers
    
    private function request()
    {
        $http = Http::acceptJson()->timeout(30);

        if ($this->token) {
            $http = $http->withHeaders([
                'Authorization' => 'Token ' . $this->token
            ]);
        }

        return $http;
    }

    
    #Handle API response
    
    private function handleResponse(Response $response): array
    {
        if ($response->successful()) {
            return [
                'success' => true,
                'data' => $response->json(),
                'status' => $response->status()
            ];
        }

        return [
            'success' => false,
            'error' => $response->json('message') ?? $response->json('error') ?? 'Error en la solicitud',
            'errors' => $response->json('errors') ?? [],
            'status' => $response->status()
        ];
    }
}

