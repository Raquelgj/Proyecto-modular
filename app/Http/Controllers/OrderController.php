<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Asegurar que solo usuarios autenticados puedan acceder
    public function __construct()
    {
        $this->middleware('auth');
    }

   
public function index()
{

    $orders = Auth::user()->orders()->with('orderItems')->latest()->paginate(10);


    foreach ($orders as $order) {
        $order->total = $order->orderItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });
    }

    return view('orders.index', compact('orders'));
}

    // Detalle / factura de un pedido concreto
   public function show(Order $order)
{
    if ($order->user_id !== Auth::id()) {
        abort(403, 'No tienes permiso para ver este pedido.');
    }

    $order->load('orderItems.product');

    // Calcula el total del pedido
    $total = $order->orderItems->sum(function ($item) {
        return $item->quantity * $item->price;
    });

    return view('orders.show', compact('order', 'total'));
}

}
