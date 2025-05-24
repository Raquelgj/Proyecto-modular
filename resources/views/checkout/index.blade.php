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

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- FORMULARIO de dirección y confirmación de pedido -->
    <form method="POST" action="{{ route('checkout.process') }}">
        @csrf

        <!-- Paso 2: Dirección de Envío -->
        <h2>Dirección de Envío</h2>
        <div class="mb-3">
            <label for="address" class="form-label">Dirección</label>
            <input type="text" name="address" id="address" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">Ciudad</label>
            <input type="text" name="city" id="city" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="postal_code" class="form-label">Código Postal</label>
            <input type="text" name="postal_code" id="postal_code" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="country" class="form-label">País</label>
            <input type="text" name="country" id="country" class="form-control" required>
        </div>

        <!-- Paso 3: Método de Pago -->
        <h2>Método de Pago</h2>
        <div class="mb-3">
            <select name="payment_method" class="form-select" required>
                <option value="">Selecciona un método de pago</option>
                <option value="card">Tarjeta de crédito</option>
                <option value="paypal">PayPal</option>
                <option value="cod">Pago contra reembolso</option>
            </select>
        </div>

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
        </div>

        <button type="submit" class="btn btn-success">Confirmar Pedido</button>
    </form>
</div>
@endsection
