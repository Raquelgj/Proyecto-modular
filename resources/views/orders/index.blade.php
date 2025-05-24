@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mis Pedidos</h1>

    @if($orders->count())
    <table class="table">
        <thead>
            <tr>
                <th>ID Pedido</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ number_format($order->total_price, 2, ',', '.') }} €</td>
                <td>{{ $order->status_text }}</td>

                <td>
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-success">Ver Detalle</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

   {{ $orders->links() }}
    @else
    <p>No tienes pedidos realizados.</p>
    @endif
</div>
@endsection