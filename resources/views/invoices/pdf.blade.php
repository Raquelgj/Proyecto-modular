<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Factura {{ $invoice->invoice_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 20px;
        }

        h1,
        h2,
        h3 {
            margin-bottom: 10px;
        }

        p {
            margin: 4px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <h1>Factura {{ $invoice->invoice_number }}</h1>
    <p><strong>Fecha:</strong> {{ $invoice->invoice_date->format('d/m/Y') }}</p>
    <h2>Datos del Vendedor</h2>
    <p><strong>Nombre:</strong> Aquatethys</p>
    <p><strong>Dirección:</strong> Calle Brida 2, Málaga, 29649, España </p>
    <p><strong>NIF:</strong> 790336036l</p>

    <h2>Datos del Cliente</h2>
    <p><strong>Nombre:</strong> {{ $invoice->order?->user?->name ?? 'No disponible' }}</p>
    <p><strong>Dirección:</strong> {{ $invoice->order->address }}, {{ $invoice->order->city }}, {{ $invoice->order->postal_code }}, {{ $invoice->order->country }}</p>

    <h2>Detalles del Pedido</h2>
    <h3>Total: {{ number_format($invoice->order->total_price, 2, ',', '.') }} €</h3>
</body>

</html>
