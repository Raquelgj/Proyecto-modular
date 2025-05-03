@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Compra realizada con éxito</h1>
        <p>Gracias por tu compra. Tu pedido ha sido procesado.</p>

        <h3>Detalles del pedido:</h3>
        <p><strong>Pedido ID:</strong> {{ $order->id }}</p>
        <p><strong>Total:</strong> ${{ $order->total_price }}</p>
        <p><strong>Estado:</strong> {{ ucfirst($order->status) }}</p>

        <a href="{{ route('cart.index') }}" class="btn btn-primary">Volver al carrito</a>
    </div>
@endsection
