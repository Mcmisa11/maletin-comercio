<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte General</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; }
        h1 { color: #1e3a8a; border-bottom: 2px solid #1e3a8a; padding-bottom: 5px; }
        h2 { color: #333; margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f3f4f6; color: #333; font-weight: bold; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <h1>Reporte General del Sistema</h1>
    <p><strong>Fecha de generación:</strong> {{ date('d/m/Y H:i:s') }}</p>

    <h2>1. Resumen de Productos</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $prod)
                <tr>
                    <td>{{ $prod->nombre }}</td>
                    <td>Bs {{ number_format($prod->precio, 2) }}</td>
                    <td>{{ $prod->stock }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>2. Ventas Aprobadas</h2>
    <table>
        <thead>
            <tr>
                <th>ID Orden</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
                <tr>
                    <td>#{{ $venta->id }}</td>
                    <td>{{ $venta->user->name }}</td>
                    <td>{{ $venta->created_at->format('d/m/Y') }}</td>
                    <td class="text-right">Bs {{ number_format($venta->total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>