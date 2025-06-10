@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pedido #{{ $order->id }}</h1>
    <p><strong>Fecha:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
    <p><strong>Estado:</strong> {{ $order->status }}</p>

    <h3>Productos:</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price, 2, ',', '.') }} €</td>
                <td>{{ number_format($item->quantity * $item->price, 2, ',', '.') }} €</td>
            </tr>
            @endforeach
        </tbody>
    </table>

<p><strong>Total: {{ number_format($total, 2, ',', '.') }}€</strong></p>


    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Volver a mis pedidos</a>
</div>
@endsection
