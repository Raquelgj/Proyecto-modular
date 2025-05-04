@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Carrito de compras</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(count($cart) > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $productId => $item)
                            <tr>
                                <td><img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" width="100"></td>
                                <td>{{ $item['name'] }}</td>
                                <td>
                                    <form action="{{ route('cart.update', $productId) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control" style="width: 60px;">
                                        <button type="submit" class="btn btn-warning btn-sm mt-2">Actualizar</button>
                                    </form>
                                </td>
                                <td>{{ number_format($item['price'], 2, ',', '.') }}€</td>
                                <td>{{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}€</td>
                                <td>
                                    <form action="{{ route('cart.remove', $productId) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <h3>Total:{{ number_format(array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, $cart)), 2, ',', '.') }}€</h3>

                <a href="{{ route('checkout.index') }}" class="btn btn-primary">Proceder al Pago</a>
            </div>
        @else
            <p>Tu carrito está vacío. Añade productos antes de comprar.</p>
        @endif
    </div>
@endsection
