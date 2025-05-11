<?php

// app/Http/Controllers/CartController.php

// app/Http/Controllers/CartController.php

// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product; 


class CartController extends Controller
{
   // app/Http/Controllers/CartController.php

 public function addToCart(Request $request, $productId)
{
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    $product = Product::findOrFail($productId);
    $quantity = $request->input('quantity');

    if ($quantity > $product->stock) {
        return redirect()->back()->withErrors(['stock' => 'No hay suficiente stock disponible.']);
    }

    $cart = session()->get('cart', []);

    if (isset($cart[$productId])) {
        $newQuantity = $cart[$productId]['quantity'] + $quantity;

        if ($newQuantity > $product->stock) {
            return redirect()->back()->withErrors(['stock' => 'No hay suficiente stock disponible.']);
        }

        $cart[$productId]['quantity'] = $newQuantity;
    } else {
        $cart[$productId] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image ?? 'default.jpg',
            'quantity' => $quantity,
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
public function add($id)
    {
        $producto = Product::find($id);
        
        // Verifica si el producto existe
        if (!$producto) {
            return redirect()->back()->with('error', 'Producto no encontrado');
        }

        // Obtén el carrito de la sesión
        $cart = session()->get('cart', []);
        
        // Si el producto ya está en el carrito, incrementa la cantidad
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $producto->name,
                'price' => $producto->price,
                'quantity' => 1,
                'image' => $producto->image,
            ];
        }

        // Guarda el carrito en la sesión
        session()->put('cart', $cart);

        // Redirige al usuario con un mensaje de éxito
        return redirect()->back()->with('success', 'Producto añadido al carrito');
    }
}


