<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Sistema de Usuarios</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Usuarios</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Configuración</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-info text-white">
                <h2 class="mb-0">Detalle del Usuario</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr><th>ID</th><td>{{ $detalle['id_usuario'] }}</td></tr>
                    <tr><th>Nombre</th><td>{{ $detalle['nombre'] }}</td></tr>
                    <tr><th>Email</th><td>{{ $detalle['email'] }}</td></tr>
                    <tr><th>Teléfono</th><td>{{ $detalle['telefono'] }}</td></tr>
                    <tr><th>Tipo de Usuario</th><td>{{ $detalle['tipo_usuario'] }}</td></tr>
                </table>
                <a href="{{ route('usuarios') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
