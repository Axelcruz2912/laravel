<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Detalle del Usuario</h2>
        <table class="table table-bordered">
            <tr><th>ID</th><td>{{ $detalle['id_usuario'] }}</td></tr>
            <tr><th>Nombre</th><td>{{ $detalle['nombre'] }}</td></tr>
            <tr><th>Email</th><td>{{ $detalle['email'] }}</td></tr>
            <tr><th>Teléfono</th><td>{{ $detalle['telefono'] }}</td></tr>
            <tr><th>Tipo de Usuario</th><td>{{ $detalle['tipo_usuario'] }}</td></tr>
        </table>
        <a href="{{ route('usuarios') }}" class="btn btn-secondary">Volver</a>
    </div>
</body>
</html>
