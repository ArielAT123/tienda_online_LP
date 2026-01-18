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

