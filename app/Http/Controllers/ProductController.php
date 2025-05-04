<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Mostrar productos por categoría.
     *
     * @param  int  $categoryId
     * @return \Illuminate\View\View
     */
    public function index()
{
    // Obtener todas las categorías
    $categorias = Category::all();

    // Pasar las categorías a la vista (en este caso, `welcome` es la vista principal)
    return view('welcome', compact('categorias'));
}
public function showByCategory($categoryId)
{
    // Obtén la categoría
    $category = Category::findOrFail($categoryId);

    // Obtén los productos que pertenecen a esta categoría
    $productos = $category->products; // Asegúrate de que `products` esté definido como una relación en el modelo Category

    // Devuelve la vista con los productos
    return view('layouts.productos.index', compact('productos'));
}

}

