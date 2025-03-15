<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfica de Torniquetes</title>
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

    <h2>Gráfica de Torniquetes</h2>
    <div class="chart-container">
        <canvas id="torniquetesChart"></canvas>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const labels = {!! $labels !!};  // Cargar etiquetas desde Laravel
            const data = {!! $data !!};  // Cargar datos desde Laravel

            const ctx = document.getElementById("torniquetesChart").getContext("2d");
            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Cantidad de Torniquetes",
                        data: data,
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(255, 159, 64, 0.5)'
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
