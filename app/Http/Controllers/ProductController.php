<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ApiService $api;

    public function __construct(ApiService $api)
    {
        $this->api = $api;
    }

    /**
     * Show all product tags
     * API Response: { count: N, tags: [{value, label}] }
     */
    public function tags()
    {
        $response = $this->api->get('/api/products/tags/');
        
        // API returns: { tags: [{value, label}] }
        $tags = [];
        $error = null;
        
        if ($response['success'] && isset($response['data']['tags'])) {
            $tags = $response['data']['tags'];
        } elseif (!$response['success']) {
            $error = $response['error'];
        }

        return view('products.tags', compact('tags', 'error'));
    }

    /**
     * Show products by tag
     * API Response: { tag, count, products: [{id, id_product, name_product, description, price, stock, status, vendor: {id, name}, tags}] }
     */
    public function byTag(string $tag)
    {
        $response = $this->api->get("/api/products/by-tag/{$tag}/");
        
        $products = [];
        $error = null;
        
        if ($response['success'] && isset($response['data']['products'])) {
            $products = $response['data']['products'];
        } elseif (!$response['success']) {
            $error = $response['error'];
        }

        return view('products.by-tag', compact('products', 'tag', 'error'));
    }

    /**
     * Show add product form
     */
    public function showAddForm()
    {
        // Get tags for the dropdown
        $tagsResponse = $this->api->get('/api/products/tags/');
        $tags = [];
        
        if ($tagsResponse['success'] && isset($tagsResponse['data']['tags'])) {
            $tags = $tagsResponse['data']['tags'];
        }

        return view('products.add', compact('tags'));
    }

    /**
     * Add a new product
     * API expects: { id_product, name_product, description, price, stock, vendor_id, tags[] }
     */
    public function addProduct(Request $request)
    {
        $validated = $request->validate([
            'id_product' => 'required|string|max:50',
            'name_product' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'vendor_id' => 'required|integer',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
        ]);

        // Convert tags from string to array if needed
        if (is_string($validated['tags'] ?? null)) {
            $validated['tags'] = explode(',', $validated['tags']);
        }

        $response = $this->api->withSessionToken()->post('/api/products/add/', $validated);

        if ($response['success']) {
            return redirect('/etiquetas')->with('success', '¡Producto agregado exitosamente!');
        }

        return back()
            ->withInput()
            ->withErrors($response['errors'] ?? ['error' => $response['error']]);
    }

    /**
     * Search products by tags and query
     */
    public function search(Request $request)
    {
        $query = $request->input('q');
        $selectedTags = $request->input('tags', []);

        $products = [];
        $error = null;

        if (!empty($selectedTags)) {
            foreach ($selectedTags as $tag) {
                $response = $this->api->get("/api/products/by-tag/{$tag}/");

                if ($response['success'] && isset($response['data']['products'])) {
                    $products = array_merge($products, $response['data']['products']);
                }
            }

            // Eliminar duplicados por ID
            $products = collect($products)
                ->unique('id')
                ->values()
                ->toArray();
        }

        // Filtro por texto (nombre)
        if ($query) {
            $products = array_filter($products, function ($product) use ($query) {
                return str_contains(
                    strtolower($product['name_product'] ?? ''),
                    strtolower($query)
                );
            });
        }

        // Obtener todas las etiquetas para los filtros
        $tagsResponse = $this->api->get('/api/products/tags/');
        $tags = $tagsResponse['data']['tags'] ?? [];

        return view('products.search', compact(
            'products',
            'tags',
            'selectedTags',
            'query',
            'error'
        ));
    }

    /**
     * Show a single product
     */
    public function show(int $id)
    {
        $response = $this->api->get("/api/products/{$id}/");

        if (!$response['success']) {
            abort(404);
        }

        $product = $response['data'];

        return view('products.show', compact('product'));
    }

    /**
     * Show edit form for a product (simulated/fallback)
     */
    public function edit(string $id)
    {
        // Try to fetch product details from API
        $response = $this->api->withSessionToken()->get("/api/products/{$id}/");

        if ($response['success'] && isset($response['data'])) {
            $product = $response['data'];
        } else {
            // Fallback fake product for demonstration
            $product = [
                'id' => $id,
                'id_product' => 'PROD-FAKE-001',
                'name_product' => 'Producto de Ejemplo',
                'description' => 'Este es un producto de ejemplo creado para pruebas.',
                'price' => '199.99',
                'stock' => 10,
                'vendor_id' => session('user_id', 1),
                'tags' => ['demo', 'sample'],
            ];
        }

        return view('products.edit', compact('product'));
    }

    /**
     * Update a product (simulated)
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'id_product' => 'required|string|max:50',
            'name_product' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
        ]);

        // For now, simulate success and redirect back
        // In a real implementation we would call the API: $this->api->withSessionToken()->put("/api/products/{$id}/", $validated);
        return redirect()->route('products.add')->with('success', 'Producto actualizado (simulado)');
    }
}
