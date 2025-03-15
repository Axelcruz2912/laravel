<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Torniquete</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Detalle del Torniquete</h2>
        <a href="{{ route('torniquetes') }}" class="btn btn-secondary mb-3">Volver</a>

        <table class="table table-bordered">
            <tr><th>ID</th><td>{{ $detalle['id_torniquete'] }}</td></tr>
            <tr><th>Ubicación</th><td>{{ $detalle['ubicacion'] }}</td></tr>
            <tr><th>Estado</th><td>{{ $detalle['estado'] }}</td></tr>
            <tr><th>Tipo</th><td>{{ $detalle['tipo'] }}</td></tr>
        </table>
    </div>
</body>
</html>
