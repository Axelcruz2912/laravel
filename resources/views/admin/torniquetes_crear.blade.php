<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Torniquete</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('torniquetes') }}">Gestión de Torniquetes</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0"><i class="bi bi-door-open"></i> Crear Nuevo Torniquete</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('guardar_torniquete') }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="ubicacion" class="form-label fw-bold">Ubicación</label>
                            <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
                        </div>

                        <div class="col-md-6">
                            <label for="estado" class="form-label fw-bold">Estado</label>
                            <select class="form-select select2" id="estado" name="estado" required>
                                <option value="">Seleccione un estado</option>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="tipo" class="form-label fw-bold">Tipo</label>
                            <select class="form-select select2" id="tipo" name="tipo" required>
                                <option value="">Seleccione un tipo</option>
                                <option value="Entrada">Entrada</option>
                                <option value="Salida">Salida</option>
                            </select>
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-save"></i> Registrar Torniquete
                            </button>
                            <a href="{{ route('torniquetes') }}" class="btn btn-outline-secondary px-4">
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
