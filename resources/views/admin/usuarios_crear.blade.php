<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('usuarios') }}">Gestión de Usuarios</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0"><i class="bi bi-person-plus"></i> Crear Nuevo Usuario</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('guardar_usuario') }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label fw-bold">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label fw-bold">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="col-md-6">
                            <label for="telefono" class="form-label fw-bold">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" required>
                        </div>

                        <div class="col-md-12">
                            <label for="tipo_usuario" class="form-label fw-bold">Tipo de Usuario</label>
                            <select class="form-select select2" id="tipo_usuario" name="tipo_usuario" required>
                                <option value="">Seleccione un tipo</option>
                                <option value="admin">Admin</option>
                                <option value="visitante">Visitante</option>
                                <option value="alumno">Alumno</option>
                            </select>
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-save"></i> Guardar Usuario
                            </button>
                            <a href="{{ route('usuarios') }}" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-arrow-left"></i> Volver al Listado
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Seleccione una opción',
                width: '100%',
                theme: 'bootstrap-5',
                minimumResultsForSearch: 5
            });
        });
    </script>
</body>
</html>
