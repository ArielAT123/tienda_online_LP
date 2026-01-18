<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private ApiService $api;

    public function __construct(ApiService $api)
    {
        $this->api = $api;
    }

    /**
     * Show cart contents
     * API: POST /api/ventas/cart/ with { user_id }
     * Response: { items: [{product, quantity, price, subtotal}] }
     */
    public function index()
    {
        $userId = session('user_id');
        
        $response = $this->api->post('/api/ventas/cart/', ['user_id' => $userId]);
        
        $cart = [];
        $error = null;
        $total = 0;
        
        if ($response['success']) {
            $cart = $response['data']['items'] ?? $response['data'] ?? [];
            
            // Calculate total from items if available
            if (is_array($cart)) {
                foreach ($cart as $item) {
                    $total += (float)($item['subtotal'] ?? ($item['price'] * ($item['quantity'] ?? 1)));
                }
            }
        } else {
            $error = $response['error'];
        }

        // Try to get total from API endpoint as backup
        if ($total == 0 && !empty($cart)) {
            $totalResponse = $this->api->get("/api/ventas/cart/total/?user_id={$userId}");
            if ($totalResponse['success'] && isset($totalResponse['data']['total'])) {
                $total = (float)$totalResponse['data']['total'];
            }
        }

        return view('cart.index', compact('cart', 'total', 'error'));
    }

    /**
     * Add item to cart
     * API: POST /api/ventas/cart/add/ with { user_id, product_id, quantity }
     */
    public function addItem(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        $userId = session('user_id');
        $validated['user_id'] = $userId;

        $response = $this->api->post('/api/ventas/cart/add/', $validated);

        if ($response['success']) {
            return redirect('/carrito')->with('success', '¡Producto agregado al carrito!');
        }

        return back()->withErrors(['error' => $response['error']]);
    }

    /**
     * Get cart total (AJAX endpoint)
     * API: GET /api/ventas/cart/total/?user_id={user_id}
     */
    public function getTotal()
    {
        $userId = session('user_id');
        $response = $this->api->get("/api/ventas/cart/total/?user_id={$userId}");

        return response()->json([
            'success' => $response['success'],
            'total' => $response['data']['total'] ?? 0
        ]);
    }

    /**
     * Process checkout
     * API: POST /api/ventas/checkout/ with { user_id }
     */
    public function checkout()
    {
        $userId = session('user_id');
        
        if (!$userId) {
            return redirect()->route('auth.login.show')->with('info', 'Debes iniciar sesión para completar tu compra');
        }

        $response = $this->api->post('/api/ventas/checkout/', ['user_id' => $userId]);

        if ($response['success']) {
            $order = $response['data']['order'] ?? $response['data'];
            return view('cart.confirmation', [
                'order' => $order,
                'message' => $response['data']['message'] ?? 'Compra realizada exitosamente'
            ]);
        }

        return redirect('/carrito')->withErrors(['error' => $response['error'] ?? 'Error al procesar el pago']);
    }
}
