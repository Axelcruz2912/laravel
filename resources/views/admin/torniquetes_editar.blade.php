<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Torniquete</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('torniquetes') }}">Gestión de Torniquetes</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-pencil-square"></i> Editar Torniquete</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('actualizar_torniquete', $editar['id_torniquete']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-bold">Ubicación</label>
                        <input type="text" name="ubicacion" class="form-control" value="{{ $editar['ubicacion'] }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Estado</label>
                        <select name="estado" class="form-control">
                            <option value="Activo" {{ $editar['estado'] == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ $editar['estado'] == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tipo</label>
                        <input type="text" name="tipo" class="form-control" value="{{ $editar['tipo'] }}" required>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save"></i> Actualizar
                        </button>
                        <a href="{{ route('torniquetes') }}" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-x-circle"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
