@extends('layouts.app')

@section('content')
    <div class="container my-4">
        <h1 class="mb-4">Carrito de compras</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(count($cart) > 0)
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead class="table-light">
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
                                <td style="width: 110px;">
                                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="img-fluid" style="max-height: 80px;">
                                </td>
                                <td>{{ $item['name'] }}</td>
                                <td style="min-width: 100px;">
                                    <form action="{{ route('cart.update', $productId) }}" method="POST" class="d-flex flex-column align-items-start gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm" style="width: 70px;">
                                        <button type="submit" class="btn btn-success btn-sm px-3">Actualizar</button>
                                    </form>
                                </td>
                                <td style="min-width: 80px;">{{ number_format($item['price'], 2, ',', '.') }}€</td>
                                <td style="min-width: 90px;">{{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}€</td>
                                <td style="min-width: 90px;">
                                    <form action="{{ route('cart.remove', $productId) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm px-3">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4">
                <h3>Total: {{ number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)), 2, ',', '.') }}€</h3>
                <a href="{{ route('checkout.index') }}" class="btn btn-success btn-lg mt-3 mt-md-0 px-4">Proceder al Pago</a>
            </div>
        @else
            <p>Tu carrito está vacío. Añade productos antes de comprar.</p>
        @endif
    </div>
@endsection
