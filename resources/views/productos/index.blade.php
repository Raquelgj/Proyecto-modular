@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4"> <!-- Usamos grid de Bootstrap -->
            @foreach ($productos as $producto)
                <div class="col">
                    <div class="card" style="width: 18rem;"> <!-- Bootstrap card -->
                        <img src="{{ asset('storage/products/' . $producto->image) }}" alt="{{ $producto->name }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body text-dark">
                            <h5 class="card-title">{{ $producto->name }}</h5>
                            <p class="card-text">{{ $producto->description }}</p>
                            <p class="font-semibold">{{ $producto->price }} €</p>
                            <form action="{{ route('cart.add', $producto->id) }}" method="POST">
                    @csrf  <!-- Token CSRF para proteger la solicitud -->
                    <button type="submit" class="btn btn-primary w-100">Añadir al carrito</button>
                </form>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
