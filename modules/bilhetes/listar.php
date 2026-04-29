<?php include("../../config/db.php"); ?>
<?php include("../../includes/header.php"); ?>
<?php include("../../includes/sidebar.php"); 
include("../../includes/auto_update_voos.php");?>

<div class="container mt-4">

<h2>🎟️ Bilhetes</h2>

<a href="adicionar.php" class="btn btn-success mb-3">+ Novo Bilhete</a>

<table class="table table-bordered">

<tr>
<th>Passageiro</th>
<th>Voo</th>
<th>Preço</th>
</tr>

<?php
$sql = "
SELECT b.*, p.nome, v.id as voo
FROM bilhetes b
JOIN passageiros p ON b.passageiro_id = p.id
JOIN voos v ON b.voo_id = v.id
";

$res = $conn->query($sql);

while($row = $res->fetch_assoc()){
    echo "<tr>
        <td>{$row['nome']}</td>
        <td>Voo #{$row['voo']}</td>
        <td>{$row['preco']} MZN</td>
    </tr>";
}
?>

</table>

</div>
<?php include("../../includes/footer.php"); ?>