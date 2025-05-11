@extends('layouts.app')

@section('content')
<div class="container py-5 mt-5 pt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $producto->image) }}" alt="{{ $producto->name }}" class="img-fluid rounded">
        </div>
        <div class="col-md-6">
            <h2>{{ $producto->name }}</h2>
            <p class="fw-bold h4">{{ number_format($producto->price, 2, ',', '.') }} €</p>
            <p><strong>Stock:</strong> {{ $producto->stock }}</p>

            <form action="{{ route('cart.add', $producto->id) }}" method="POST" class="mt-auto">
                @csrf
                <label for="quantity">Cantidad:</label>
                <input
                    type="number"
                    name="quantity"
                    id="quantity"
                    value="1"
                    min="1"
                    max="{{ $producto->stock }}"
                    class="form-control w-25"
                    required>

                @error('stock')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror

                <button type="submit" class="custom-button w-50 mt-3">Añadir al carrito</button>
            </form>
            <br>
            <p>{{ $producto->description }}</p>
        </div>
    </div>
</div>
@endsection