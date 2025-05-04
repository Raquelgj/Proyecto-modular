<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Models\Category;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    $categorias = Category::all();  // Obtener todas las categorías
    return view('dashboard', compact('categorias'));  // Pasar las categorías a la vista
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/productos', function () {
    $productos = Product::all();
    return view('productos.index', compact('productos'));
})->name('productos.index');



// rutas carrito compra
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add'); // Asegúrate de tener esta ruta


// rutas cuando el usuario decide realizar la compra
Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');



Route::patch('/cart/{productId}/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{productId}/remove', [CartController::class, 'remove'])->name('cart.remove');



// Ruta para mostrar la página de éxito después de la compra
Route::get('/checkout/success/{orderId}', [CheckoutController::class, 'showSuccessPage'])->name('checkout.success');





Route::get('/categoria/{categoryId}', [ProductController::class, 'showByCategory'])->name('products.category');


// ruta formulario de contáctanos

Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');


require __DIR__.'/auth.php';
