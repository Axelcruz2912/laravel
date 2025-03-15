<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Acceso</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Detalle del Acceso</h2>
        <ul class="list-group">
            <li class="list-group-item"><strong>ID:</strong> {{ $acceso['id_acceso'] }}</li>
            <li class="list-group-item"><strong>ID Usuario:</strong> {{ $acceso['id_usuario'] }}</li>
            <li class="list-group-item"><strong>ID Torniquete:</strong> {{ $acceso['id_torniquete'] }}</li>
            <li class="list-group-item"><strong>Fecha y Hora:</strong> {{ $acceso['fecha_hora'] }}</li>
            <li class="list-group-item"><strong>Estado:</strong> {{ $acceso['estado'] }}</li>
        </ul>
        <a href="{{ route('accesos') }}" class="btn btn-secondary mt-3">Volver</a>
    </div>
</body>
</html>
