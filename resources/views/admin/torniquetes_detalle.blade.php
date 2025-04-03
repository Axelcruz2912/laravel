<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Torniquete</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Sistema de Torniquetes</a>
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
            <div class="card-header bg-success text-white">
                <h2 class="mb-0">Detalle del Torniquete</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr><th>ID</th><td>{{ $detalle['id_torniquete'] }}</td></tr>
                    <tr><th>Ubicación</th><td>{{ $detalle['ubicacion'] }}</td></tr>
                    <tr><th>Estado</th><td>{{ $detalle['estado'] }}</td></tr>
                    <tr><th>Tipo</th><td>{{ $detalle['tipo'] }}</td></tr>
                </table>
                <a href="{{ route('torniquetes') }}" class="btn btn-secondary mb-3">Volver</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
