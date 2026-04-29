<?php include("../../config/db.php"); ?>
<?php include("../../includes/header.php"); ?>
<?php include("../../includes/sidebar.php"); ?>

<div class="container mt-4">

<h2>✈️ Gestão de Voos</h2>

<a href="adicionar.php" class="btn btn-success mb-3">+ Novo Voo</a>

<table class="table table-hover table-bordered shadow-sm">

<thead class="table-dark">
<tr>
    <th>ID</th>
    <th>Rota</th>
    <th>Data</th>
    <th>Hora Saída</th>
    <th>Hora Chegada</th>
    <th>Aeronave</th>
    <th>Status</th>
    <th>Ações</th>
</tr>
</thead>

<tbody>

<?php
$sql = "
SELECT v.*, r.origem, r.destino, a.modelo, a.matricula
FROM voos v
LEFT JOIN rotas r ON v.rota_id = r.id
LEFT JOIN aeronaves a ON v.aeronave_id = a.id
";

$result = $conn->query($sql);

while($row = $result->fetch_assoc()){

    // cores status
    $status = $row['status'];
    $cor = 'secondary';
    //success, warning, danger

    if($status == 'cancelado') $cor = 'danger';
    if($status == 'ativo') $cor = 'warning';
    if($status == 'concluido') $cor = 'success';

    echo "<tr>

        <td>{$row['id']}</td>

        <td>{$row['origem']} → {$row['destino']}</td>

        <td>{$row['data_voo']}</td>

        <td>{$row['hora_saida']}</td>

        <td>{$row['hora_chegada']}</td>

        <td>{$row['modelo']} ({$row['matricula']})</td>

        <td>
            <span class='badge bg-$cor text-uppercase'>
                $status
            </span>
        </td>

        <td>

            <a href='editar.php?id={$row['id']}' 
               class='btn btn-warning btn-sm'>✏️</a>

            <a href='cancelar.php?id={$row['id']}' 
               class='btn btn-danger btn-sm'
               onclick=\"return confirm('Cancelar este voo?')\">
               ✖
            </a>

        </td>

    </tr>";
}
?>

</tbody>
</table>

</div>

<?php include("../../includes/footer.php"); ?>