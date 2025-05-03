<?php

// app/Http/Controllers/CartController.php

// app/Http/Controllers/CartController.php

// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product; // Asegúrate de incluir el modelo de Product

class CartController extends Controller
{
   // app/Http/Controllers/CartController.php

   public function addToCart($productId)
{
    $product = Product::findOrFail($productId);

    $cart = session()->get('cart', []);

    if (isset($cart[$productId])) {
        $cart[$productId]['quantity']++;
    } else {
        $cart[$productId] = [
            'id' => $product->id,  // Asegúrate de agregar el ID del producto
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image ?? 'default.jpg',
            'quantity' => 1,
        ];
    }

    session()->put('cart', $cart);

    return redirect()->route('cart.index')->with('success', 'Producto añadido al carrito.');
}

// Actualizar cantidad en el carrito
public function update(Request $request, $productId)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$productId])) {
        $cart[$productId]['quantity'] = $request->input('quantity', 1);
        session()->put('cart', $cart);
    }

    return redirect()->route('cart.index')->with('success', 'Cantidad actualizada.');
}

// Eliminar producto del carrito
public function remove($productId)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$productId])) {
        unset($cart[$productId]);
        session()->put('cart', $cart);
    }

    return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito.');
}


    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }
    public function showCart()
{
    $cart = session('cart', []);  // Obtenemos el carrito desde la sesión o un arreglo vacío
    return view('cart.index', compact('cart'));  // Pasamos el carrito a la vista
}

}


