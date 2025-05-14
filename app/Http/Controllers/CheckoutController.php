<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;  
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function showCheckoutForm()
    {
        $cartItems = session()->get('cart', []);

        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
        }

        $totalPrice = $this->calculateTotal($cartItems);

        return view('checkout.index', compact('cartItems', 'totalPrice'));
    }

    public function processCheckout(Request $request)
    {
        $cartItems = session('cart', []);
        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
        }

        $totalPrice = $this->calculateTotal($cartItems);

        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $totalPrice,
            'status' => 'pendiente',
        ]);

        foreach ($cartItems as $productId => $item) {
            $order->items()->create([
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('checkout.success', ['orderId' => $order->id])->with('success', 'Pedido realizado con éxito.');
    }

    public function showSuccessPage($orderId)
    {
        $order = Order::with('items.product')->findOrFail($orderId);
        return view('checkout.success', compact('order'));
    }

    public function calculateTotal($cartItems)
    {
        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }
}
