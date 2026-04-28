<?php
include("config/db.php");
include("includes/header.php");
include("includes/sidebar.php");

// Horas de voo por aeronave
$dados = $conn->query("SELECT modelo, horas_voo FROM aeronaves");

$modelos = [];
$horas = [];

while($row = $dados->fetch_assoc()){
    $modelos[] = $row['modelo'];
    $horas[] = $row['horas_voo'];
}

// Status
$statusQuery = $conn->query("SELECT status, COUNT(*) as total FROM aeronaves GROUP BY status");

$statusLabels = [];
$statusValores = [];

while($row = $statusQuery->fetch_assoc()){
    $statusLabels[] = $row['status'];
    $statusValores[] = $row['total'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="/lam/assets/css/style.css" rel="stylesheet">
    <style>
        canvas {
    background: white;
    padding: 15px;
    border-radius: 10px;
}
    </style>
</head>
<body>


<div class="container mt-4">
    <h2 id="dmg">📊 Dashboard ERP - LAM</h2>

    <div class="row">
        <div class="col-md-6">
            <canvas id="graficoHoras"></canvas>
        </div>

        <div class="col-md-6">
            <canvas id="graficoStatus"></canvas>
        </div>
    </div>
</div>

</body>
</html>
<?php
var_dump($modelos);
var_dump($horas);
?>
    <script>
// Dados do PHP
const modelos = <?php echo json_encode($modelos); ?>;
const horas = <?php echo json_encode($horas); ?>;

const statusLabels = <?php echo json_encode($statusLabels); ?>;
const statusValores = <?php echo json_encode($statusValores); ?>;

// Gráfico de barras
new Chart(document.getElementById('graficoHoras'), {
    type: 'bar',
    data: {
        labels: modelos,
        datasets: [{
            label: 'Horas de Voo',
            data: horas
        }]
    }
});

// Gráfico de pizza
new Chart(document.getElementById('graficoStatus'), {
    type: 'pie',
    data: {
        labels: statusLabels,
        datasets: [{
            data: statusValores
        }]
    }
});

</script>