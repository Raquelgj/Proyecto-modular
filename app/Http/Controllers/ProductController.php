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
}public function showByCategory($categoryId)
{
    // Obtiene la categoría junto con los productos asociados
    $categoria = Category::with('products')->findOrFail($categoryId);

    // Pasa la categoría y los productos a la vista
    $productos = $categoria->products;

    return view('productos.index', compact('productos', 'categoria'));
}
public function store(Request $request)
{
    // Validar los datos recibidos
    $validated = $request->validate([
        'name' => 'required',
        'description' => 'nullable',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'category_id' => 'required|exists:categories,id',  // Validamos que la categoría exista
    ]);

    // Crear un nuevo producto
    $product = new Product();
    $product->name = $validated['name'];
    $product->description = $validated['description'];
    $product->price = $validated['price'];
    $product->stock = $validated['stock'];
    $product->category_id = $validated['category_id'];  // Asignamos la categoría
    $product->save();  // Guardamos el producto en la base de datos

    // Redirigir o retornar a una vista
    return redirect()->route('products.index')->with('success', 'Producto creado exitosamente');
}
public function show($id)
{
    $producto = Product::findOrFail($id);
    return view('productos.show', compact('producto'));
}
public function buscar(Request $request)
{
    $query = $request->input('q');

    $productos = Product::where('name', 'LIKE', '%' . $query . '%')->get();

    return view('productos.buscar', compact('productos', 'query'));
}


}




