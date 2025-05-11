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
    $categorias = Category::all();
    $featuredProducts = Product::where('featured', true)->take(6)->get();

    return view('dashboard', compact('categorias', 'featuredProducts'));
});



Route::get('/dashboard', function () {
    $categorias = Category::all();  // Obtener todas las categorías
    return view('dashboard', compact('categorias'));  
})->name('dashboard');


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
Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/{producto}/add', [CartController::class, 'add'])->name('cart.add');





// Ruta para mostrar la página de éxito después de la compra
Route::get('/checkout/success/{orderId}', [CheckoutController::class, 'showSuccessPage'])->name('checkout.success');



Route::get('/categoria/{id}', [ProductController::class, 'showByCategory'])->name('productos.categoria');


Route::get('/categoria/{categoryId}', [ProductController::class, 'showByCategory'])->name('products.category');


// ruta formulario de contáctanos

Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');


// productos destacados


Route::get('/dashboard', function () {
    $featuredProducts = Product::where('featured', true)->get();
    return view('dashboard', compact('featuredProducts'));
})->name('dashboard');


//  información del producto

Route::get('/producto/{id}', [\App\Http\Controllers\ProductController::class, 'show'])->name('producto.show');

// barra de busqueda

Route::get('/buscar', [App\Http\Controllers\ProductController::class, 'buscar'])->name('productos.buscar');


require __DIR__.'/auth.php';
