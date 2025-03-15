<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Acceso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('accesos') }}">Gestión de Accesos</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-pencil-square"></i> Editar Registro de Acceso</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('accesos.update', $acceso['id_acceso']) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <!-- Selección de Usuario -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Usuario</label>
                            <select name="id_usuario" class="form-select select2" required>
                                @foreach($usuarios as $usuario)
                                <option value="{{ $usuario['id_usuario'] }}"
                                    {{ $acceso['id_usuario'] == $usuario['id_usuario'] ? 'selected' : '' }}>
                                    {{ $usuario['nombre'] }} ({{ $usuario['email'] }})
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Selección de Torniquete -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Torniquete</label>
                            <select name="id_torniquete" class="form-select select2" required>
                                @foreach($torniquetes as $torniquete)
                                <option value="{{ $torniquete['id_torniquete'] }}"
                                    {{ $acceso['id_torniquete'] == $torniquete['id_torniquete'] ? 'selected' : '' }}>
                                    {{ $torniquete['ubicacion'] }} (ID: {{ $torniquete['id_torniquete'] }})
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Estado del Acceso -->
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Estado del Acceso</label>
                            <select name="estado" class="form-select" required>
                                <option value="Permitido" {{ $acceso['estado'] == 'Permitido' ? 'selected' : '' }} class="text-success">
                                    Permitido
                                </option>
                                <option value="Denegado" {{ $acceso['estado'] == 'Denegado' ? 'selected' : '' }} class="text-danger">
                                    Denegado
                                </option>
                            </select>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-save"></i> Guardar Cambios
                            </button>
                            <a href="{{ route('accesos') }}" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-x-circle"></i> Cancelar
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
                theme: 'bootstrap-5'
            });
        });
    </script>
</body>
</html>
