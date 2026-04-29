<?php include("../../config/db.php"); ?>
<?php include("../../includes/header.php"); ?>
<?php include("../../includes/sidebar.php"); ?>

<?php
$voos = $conn->query("
SELECT v.id, r.origem, r.destino, v.data_voo
FROM voos v
JOIN rotas r ON v.rota_id = r.id
WHERE v.status='ativo'
");
?>

<div class="container mt-4">

<h2>🎟️ Venda de Bilhete</h2>

<form action="salvar.php" method="POST">

<div class="mb-3">
<label>Passageiro</label>
<input type="text" name="nome" class="form-control" required>
</div>

<div class="mb-3">
<label>Documento</label>
<input type="text" name="documento" class="form-control">
</div>

<div class="mb-3">
<label>Voo</label>
<select name="voo_id" class="form-control" required>

<?php while($v = $voos->fetch_assoc()){ ?>
<option value="<?= $v['id'] ?>">
<?= $v['origem'] ?> → <?= $v['destino'] ?> (<?= $v['data_voo'] ?>)
</option>
<?php } ?>

</select>
</div>

<div class="mb-3">
<label>Preço (MZN)</label>
<input type="number" name="preco" class="form-control" required>
</div>

<button class="btn btn-success">Emitir Bilhete</button>

</form>

</div>
<?php include("../../includes/footer.php"); ?>