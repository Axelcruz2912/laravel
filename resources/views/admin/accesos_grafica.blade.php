<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfica de Torniquetes</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            text-align: center;
        }
        .chart-container {
            width: 80%;
            max-width: 600px;
            margin: auto;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand mx-auto" href="#">Gráfica de Accesos</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Gráfica de Accesos</h2>

        <div class="chart-container">
            <canvas id="estadosChart"></canvas>
        </div>

        <div class="chart-container">
            <canvas id="torniquetesChart"></canvas>
        </div>

        <!-- Botón de Volver -->
        <div class="mt-4">
            <a href="{{ route('accesos') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Verificar si hay datos antes de renderizar las gráficas
            const estadosLabels = @json($estadosLabels);
            const estadosData = @json($estadosData);
            const torniquetesLabels = @json($torniquetesLabels);
            const torniquetesData = @json($torniquetesData);

            if (estadosLabels.length && estadosData.length) {
                new Chart(document.getElementById('estadosChart'), {
                    type: 'doughnut',
                    data: {
                        labels: estadosLabels,
                        datasets: [{
                            label: 'Accesos',
                            data: estadosData,
                            backgroundColor: ['#4CAF50', '#44f3ae']
                        }]
                    }
                });
            }

            if (torniquetesLabels.length && torniquetesData.length) {
                new Chart(document.getElementById('torniquetesChart'), {
                    type: 'bar',
                    data: {
                        labels: torniquetesLabels,
                        datasets: [{
                            label: 'Total de Accesos',
                            data: torniquetesData,
                            backgroundColor: '#44f3ae'
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { stepSize: 1 }
                            }
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>