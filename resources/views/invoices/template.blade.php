<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura {{ $invoiceNumber }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h1>Factura {{ $invoiceNumber }}</h1>
    <p>Fecha: {{ $invoiceDate->format('d/m/Y') }}</p>
    <h2>Datos del Cliente</h2>
    <p>Nombre: {{ $order->user->name }}</p>
    <p>Dirección: {{ $order->address }}, {{ $order->city }}, {{ $order->postal_code }}, {{ $order->country }}</p>

    <h2>Detalles del Pedido</h2>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price, 2, ',', '.') }} €</td>
                <td>{{ number_format($item->price * $item->quantity, 2, ',', '.') }} €</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total: {{ number_format($order->total_price, 2, ',', '.') }} €</h3>
</body>
</html>
