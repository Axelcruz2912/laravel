<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfica de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            text-align: center;
        }
        .chart-container {
            width: 80%;
            margin: auto;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand mx-auto" href="#">Usuarios</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Gráfica de Usuarios</h2>
        <div class="chart-container">
            <canvas id="usuariosChart"></canvas>
        </div>

        <!-- Botón de Regresar -->
        <div class="mt-4">
                    <a href="{{ route('usuarios') }}" class="btn btn-secondary">Volver</a>
            </button>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const labels = {!! $labels !!};  // Cargar etiquetas desde Laravel
            const data = {!! $data !!};  // Cargar datos desde Laravel

            const ctx = document.getElementById("usuariosChart").getContext("2d");
            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Cantidad de Usuarios",
                        data: data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 206, 86, 0.5)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        });
    </script>

</body>
</html>
