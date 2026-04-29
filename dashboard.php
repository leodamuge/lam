<?php
include("config/db.php");
include("includes/header.php");
include("includes/sidebar.php");

$totalAeronaves = $conn->query("SELECT COUNT(*) as total FROM aeronaves")->fetch_assoc()['total'];

$totalVoos = $conn->query("SELECT COUNT(*) as total FROM voos")->fetch_assoc()['total'];

$totalTripulantes = $conn->query("SELECT COUNT(*) as total FROM tripulantes")->fetch_assoc()['total'];

$manutencao = $conn->query("SELECT COUNT(*) as total FROM aeronaves WHERE status='manutencao'")->fetch_assoc()['total'];

// Dados - Horas de voo
$dados = $conn->query("SELECT modelo, horas_voo FROM aeronaves");

$modelos = [];
$horas = [];

while($row = $dados->fetch_assoc()){
    $modelos[] = $row['modelo'];
    $horas[] = $row['horas_voo'];
}

// Dados - Status
$statusQuery = $conn->query("SELECT status, COUNT(*) as total FROM aeronaves GROUP BY status");

$statusLabels = [];
$statusValores = [];

while($row = $statusQuery->fetch_assoc()){
    $statusLabels[] = $row['status'];
    $statusValores[] = $row['total'];
}
?>

<div class="container mt-4">
    <h2>📊 Dashboard ERP - LAM</h2>
<div class="row mb-4">

    <div class="col-md-3">
        <div class="card shadow-sm text-center p-3">
            <h6>Total Aeronaves</h6>
            <h2 class="text-primary"><?php echo $totalAeronaves; ?></h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm text-center p-3">
            <h6>Total Voos</h6>
            <h2 class="text-success"><?php echo $totalVoos; ?></h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm text-center p-3">
            <h6>Tripulação</h6>
            <h2 class="text-dark"><?php echo $totalTripulantes; ?></h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm text-center p-3">
            <h6>Aeronaves em manutenção</h6>
            <h2 class="text-danger"><?php echo $manutencao; ?></h2>
        </div>
    </div>

</div>
    <div class="row">
        <div class="col-md-6">
            <canvas id="graficoHoras"></canvas>
        </div>

        <div class="col-md-6">
            <canvas id="graficoStatus"></canvas>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function(){

    const modelos = <?php echo json_encode($modelos ?? []); ?>;
    const horas = <?php echo json_encode($horas ?? []); ?>;

    const statusLabels = <?php echo json_encode($statusLabels ?? []); ?>;
    const statusValores = <?php echo json_encode($statusValores ?? []); ?>;

    // Verificação (evita gráfico vazio quebrar)
    if(modelos.length === 0){
        document.getElementById('graficoHoras').outerHTML = "<p>Sem dados de aeronaves</p>";
    } else {
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
    }

    if(statusLabels.length === 0){
        document.getElementById('graficoStatus').outerHTML = "<p>Sem dados de status</p>";
    } else {
        new Chart(document.getElementById('graficoStatus'), {
            type: 'pie',
            data: {
                labels: statusLabels,
                datasets: [{
                    data: statusValores
                }]
            }
        });
    }

});
</script>

<style>
canvas {
    background: white;
    padding: 15px;
    border-radius: 10px;
}
</style>