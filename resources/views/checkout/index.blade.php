@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Checkout</h1>

        <!-- Paso 1: Revisión del carrito -->
        <h2>Tu carrito:</h2>
        @if(count($cartItems) > 0)
            <div class="table-responsive mb-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                            <tr>
                                <td><img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" width="80"></td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>{{ number_format($item['price'], 2, ',', '.') }}€</td>
                                <td>{{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}€</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h3>Total: {{ number_format($totalPrice, 2, ',', '.') }}€</h3>
            </div>
        @else
            <p>Tu carrito está vacío. Añade productos antes de comprar.</p>
        @endif

        <!-- Mostrar mensaje de éxito si se ha realizado un pedido correctamente -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Paso 2: Dirección de Envío (placeholder) -->
        <h2>Dirección de Envío</h2>
        <p><em>Aquí iría el formulario para introducir la dirección de envío.</em></p>

        <!-- Paso 3: Método de Pago (placeholder) -->
        <h2>Método de Pago</h2>
        <p><em>Aquí iría la selección del método de pago.</em></p>

        <!-- Paso 4: Confirmar Pedido -->
        <h2>Resumen del Pedido</h2>
        <div class="alert alert-info">
            <p><strong>Productos:</strong></p>
            <ul>
                @foreach ($cartItems as $item)
                    <li>{{ $item['name'] }} (x{{ $item['quantity'] }}) - {{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}€</li>
                @endforeach
            </ul>
            <p><strong>Total:</strong> {{ number_format($totalPrice, 2, ',', '.') }}€</p>
            <p><strong>Dirección:</strong> (a completar)</p>
            <p><strong>Método de pago:</strong> (a completar)</p>
        </div>
<form method="POST" action="{{ route('checkout.process') }}">
    @csrf
    <button type="submit" class="btn btn-success">Confirmar Pedido</button>
    <p class="text-muted mt-2"><small>Completa dirección y método de pago para habilitar esta acción.</small></p>
</form>

    </div>
@endsection
