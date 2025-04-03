<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">👥 Gestión de Usuarios</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door"></i> Inicio</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('usuarios') }}"><i class="bi bi-people"></i> Usuarios</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('torniquetes') }}"><i class="bi bi-door-closed"></i> Torniquetes</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('accesos') }}"><i class="bi bi-shield-check"></i> Accesos</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
            <h1 class="h2 mb-0 text-dark"><i class="bi bi-list-task"></i> Lista de Usuarios</h1>
            <div class="d-flex gap-2">
                <a href="{{ route('crear_usuario') }}" class="btn btn-success btn-sm">
                    <i class="bi bi-plus-circle"></i> Crear Usuario
                </a>
                <a href="{{ route('usuarios.grafica', ['buscar' => request('buscar')]) }}" class="btn btn-info btn-sm">
                    <i class="bi bi-bar-chart"></i> Gráficas
                </a>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title mb-3"><i class="bi bi-upload text-primary"></i> Importar datos</h5>
                        <form action="{{ route('importar.usuarios') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group input-group-sm">
                                <input type="file" name="archivo" class="form-control" accept=".xlsx,.xls" required>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-arrow-up-circle"></i> Subir
                                </button>
                            </div>
                            <small class="text-muted mt-1 d-block">Formatos permitidos: .xlsx, .xls</small>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title mb-3"><i class="bi bi-download text-success"></i> Exportar datos</h5>
                        <form action="{{ route('usuarios.export') }}" method="GET">
                            <input type="hidden" name="buscar" value="{{ request('buscar') }}">
                            <button type="submit" class="btn btn-success w-100 btn-sm">
                                <i class="bi bi-file-earmark-excel"></i> Exportar a Excel
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4 border-0">
            <div class="card-body p-3">
                <form action="{{ route('usuarios') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="buscar" class="form-control form-control-sm" placeholder="Buscar por nombre, email, teléfono o tipo" value="{{ request('buscar') }}">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="bi bi-search"></i> Buscar
                        </button>
                        <a href="{{ route('usuarios') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th class="text-center">Tipo</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                        <tr>
                            <td class="text-center fw-semibold">#{{ $usuario['id_usuario'] }}</td>
                            <td>{{ $usuario['nombre'] }}</td>
                            <td>{{ $usuario['email'] }}</td>
                            <td>{{ $usuario['telefono'] }}</td>
                            <td class="text-center">{{ ucfirst($usuario['tipo_usuario']) }}</td>
                            <td class="text-center">
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('detalle_usuario', $usuario['id_usuario']) }}" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Ver detalle">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('editar_usuario', $usuario['id_usuario']) }}" class="btn btn-sm btn-outline-warning" data-bs-toggle="tooltip" title="Editar registro">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('eliminar_usuario', $usuario['id_usuario']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Eliminar registro" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $usuarios->links('pagination::bootstrap-5') }}
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>