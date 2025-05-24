
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>¡Pedido Realizado con Éxito!</h1>
        <p>Gracias por tu compra. Tu pedido ha sido recibido y se encuentra en proceso.</p>

        <h2>Resumen del Pedido</h2>
        <div class="alert alert-info">
            <p><strong>ID del Pedido:</strong> #{{ $order->id }}</p>
            <p><strong>Total:</strong> {{ number_format($order->total_price, 2, ',', '.') }}€</p>
            <p><strong>Estado:</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Productos:</strong></p>
            <ul>
                @foreach ($order->items as $item)
                    <li>{{ $item->product->name }} (x{{ $item->quantity }}) - {{ number_format($item->price * $item->quantity, 2, ',', '.') }}€</li>
                @endforeach
            </ul>
        </div>
        
       <a href="{{ route('dashboard') }}" class="btn btn-primary">Volver a la tienda</a>

    </div>
@endsection
