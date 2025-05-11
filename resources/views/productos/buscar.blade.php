@extends('layouts.app')

@section('content')
<div class="container py-5 mt-5">
    <h2>Resultados de búsqueda para: "{{ $query }}"</h2>

    @if ($productos->isEmpty())
        <p>No se encontraron productos.</p>
    @else
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            @foreach ($productos as $producto)
                <div class="col">
                    <div class="card h-100">
                          <a href="{{ route('producto.show', $producto->id) }}">
                    <img src="{{ asset('storage/' . $producto->image) }}" alt="{{ $producto->name }}" class="card-img-top img-fluid" style="object-fit: contain; max-height: 300px;">

                </a>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $producto->name }}</h5>
                            <p class="fw-bold">{{ number_format($producto->price, 2, ',', '.') }} €</p>
                            <form action="{{ route('cart.add', $producto->id) }}" method="POST" class="mt-auto">
                                @csrf
                                <button type="submit" class="custom-button w-100">Añadir al carrito</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
