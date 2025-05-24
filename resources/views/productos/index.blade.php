@extends('layouts.app')

@section('content')
<div class="container py-5"> <!-- Añade container para márgenes automáticos y padding vertical -->
   
    <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $categoria->name }}</li>
  </ol>
</nav>


    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        @foreach ($productos as $producto)
        <div class="col">
            <div class="card h-100"> <!-- h-100 para igualar la altura de todas las tarjetas -->
                <a href="{{ route('producto.show', $producto->id) }}">
                    <img src="{{ asset('storage/' . $producto->image) }}" alt="{{ $producto->name }}" class="card-img-top img-fluid" style="object-fit: contain; max-height: 300px;">
                </a>

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $producto->name }}</h5>
                    <p class="fw-bold">{{ number_format($producto->price, 2, ',', '.') }} €</p>

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
                            class="form-control w-50 mb-3"
                            required>

                        <button type="submit" class="custom-button w-100">Añadir al carrito</button>
                    </form>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection