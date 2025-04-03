<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Acceso</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Sistema de Accesos</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Detalle del Acceso</h2>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>ID:</strong> {{ $acceso['id_acceso'] }}</li>
                    <li class="list-group-item"><strong>ID Usuario:</strong> {{ $acceso['id_usuario'] }}</li>
                    <li class="list-group-item"><strong>ID Torniquete:</strong> {{ $acceso['id_torniquete'] }}</li>
                    <li class="list-group-item"><strong>Fecha y Hora:</strong> {{ $acceso['fecha_hora'] }}</li>
                    <li class="list-group-item"><strong>Estado:</strong> {{ $acceso['estado'] }}</li>
                </ul>
                <a href="{{ route('accesos') }}" class="btn btn-secondary mt-3">Volver</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
