<?php
include("../../config/db.php");
include("../../includes/header.php");
include("../../includes/sidebar.php");

$id = $_GET['id'];
$t = $conn->query("SELECT * FROM tripulantes WHERE id=$id")->fetch_assoc();
?>

<div class="container mt-4 d-flex justify-content-center">

<div class="card shadow p-4" style="width:600px">

<h3 class="text-center mb-4">✏️ Editar Tripulante</h3>

<form action="atualizar.php" method="POST">

<input type="hidden" name="id" value="<?= $t['id'] ?>">

<input type="text" name="nome" value="<?= $t['nome'] ?>" class="form-control mb-3">

<select name="funcao" class="form-control mb-3">
    <option <?= $t['funcao']=='Piloto'?'selected':'' ?>>Piloto</option>
    <option <?= $t['funcao']=='Copiloto'?'selected':'' ?>>Copiloto</option>
    <option <?= $t['funcao']=='Comissária'?'selected':'' ?>>Comissária</option>
</select>

<input type="number" name="horas_voo" value="<?= $t['horas_voo'] ?>" class="form-control mb-3">

<select name="status" class="form-control mb-3">
    <option value="ativo" <?= $t['status']=='ativo'?'selected':'' ?>>Ativo</option>
    <option value="inativo" <?= $t['status']=='inativo'?'selected':'' ?>>Inativo</option>
</select>

<button class="btn btn-primary">Atualizar</button>

</form>

</div>
</div>

<?php include("../../includes/footer.php"); ?>