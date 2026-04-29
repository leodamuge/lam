<?php include("../../config/db.php"); ?>
<?php include("../../includes/header.php"); ?>
<?php include("../../includes/sidebar.php"); 
    include("../../includes/auto_update_voos.php");?>

<div class="container mt-4">

<h2>👨‍✈️ Tripulação</h2>

<a href="adicionar.php" class="btn btn-success mb-3">+ Novo Tripulante</a>

<table class="table table-bordered table-hover shadow-sm">

<thead class="table-dark">
<tr>
    <th>ID</th>
    <th>Nome</th>
    <th>Função</th>
    <th>Horas de Voo</th>
    <th>Status</th>
    <th>Ações</th>
</tr>
</thead>

<tbody>

<?php
$result = $conn->query("SELECT * FROM tripulantes");

while($row = $result->fetch_assoc()){

    $cor = ($row['status'] == 'ativo') ? 'success' : 'danger';

    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['nome']}</td>
        <td>{$row['funcao']}</td>
        <td>{$row['horas_voo']}</td>

        <td>
            <span class='badge bg-$cor'>{$row['status']}</span>
        </td>

        <td>
            <a href='editar.php?id={$row['id']}' class='btn btn-warning btn-sm'>✏️</a>
            <a href='eliminar.php?id={$row['id']}' 
               class='btn btn-danger btn-sm'
               onclick=\"return confirm('Eliminar este tripulante?')\">
               🗑️
            </a>
        </td>
    </tr>";
}
?>

</tbody>
</table>

</div>

<?php include("../../includes/footer.php"); ?>