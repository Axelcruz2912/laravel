<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('usuarios') }}">Gestión de Usuarios</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-person-circle"></i> Editar Usuario</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('actualizar_usuario', $editar['id_usuario']) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-bold">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $editar['nombre'] }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $editar['email'] }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label fw-bold">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $editar['telefono'] }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="tipo_usuario" class="form-label fw-bold">Tipo de Usuario</label>
                        <select class="form-select" id="tipo_usuario" name="tipo_usuario" required>
                            <option value="admin" {{ $editar['tipo_usuario'] == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="visitante" {{ $editar['tipo_usuario'] == 'visitante' ? 'selected' : '' }}>Visitante</option>
                            <option value="alumno" {{ $editar['tipo_usuario'] == 'alumno' ? 'selected' : '' }}>Alumno</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Guardar Cambios
                        </button>
                        <a href="{{ route('usuarios') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
