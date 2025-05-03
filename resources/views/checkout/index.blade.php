@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Checkout</h1>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h2>Tu carrito:</h2>
        <ul>
            @foreach ($cartItems as $item)
                <li>
                    <strong>{{ $item['name'] }}</strong> (x{{ $item['quantity'] }}) - ${{ $item['price'] }}
                </li>
            @endforeach
        </ul>

        <h3>Total: ${{ $totalPrice }}</h3>

        <!-- Formulario de pago -->
        <form method="POST" action="{{ route('checkout.process') }}">
            @csrf
            <button type="submit" class="btn btn-primary">Confirmar pedido</button>
        </form>
    </div>
@endsection
