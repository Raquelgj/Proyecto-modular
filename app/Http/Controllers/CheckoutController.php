<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;  // Asegúrate de que esté importado
use App\Models\OrderItem;  // Importa el modelo OrderItem


class CheckoutController extends Controller
{
    public function showCheckoutForm()
{
    // Obtén los productos del carrito
    $cartItems = session()->get('cart', []);
    
    // Si el carrito está vacío, redirige al usuario
    if (empty($cartItems)) {
        return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
    }

    // Calcula el total del carrito
    $totalPrice = array_sum(array_column($cartItems, 'price'));

    // Retorna la vista con los productos y el precio total
    return view('checkout.index', compact('cartItems', 'totalPrice'));
}
public function processCheckout(Request $request)
{
    // Verifica si el usuario está autenticado
    $userId = auth()->check() ? auth()->id() : null;

    // Obtén los productos del carrito
    $cartItems = session()->get('cart', []);

    // Si el carrito está vacío, redirige al usuario
    if (empty($cartItems)) {
        return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
    }

    // Calcula el total del carrito
    $totalPrice = array_sum(array_column($cartItems, 'price'));

    // Crea un nuevo pedido
    $order = Order::create([
        'user_id' => $userId,
        'total_price' => $totalPrice,
        'status' => 'pending',  // Estado inicial del pedido
    ]);

    // Guarda los productos en la tabla order_items
    foreach ($cartItems as $item) {
        // Verifica que el 'id' existe en el item
        if (isset($item['id'])) {
            $order->items()->create([
                'product_id' => $item['id'],  // Usa 'id' aquí
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        } else {
            // Si no se encuentra el 'id', puedes devolver un error o hacer un manejo adecuado
            return redirect()->route('cart.index')->with('error', 'Producto no encontrado en el carrito.');
        }
    }

    // Vacía el carrito de la sesión
    session()->forget('cart');

    // Redirige a una página de éxito
    return redirect()->route('checkout.success', $order->id)->with('success', 'Pedido realizado con éxito.');
}

public function showSuccessPage($orderId)
{
    // Puedes obtener el pedido desde la base de datos si es necesario
    $order = Order::findOrFail($orderId);

    return view('checkout.success', compact('order'));
}

}
