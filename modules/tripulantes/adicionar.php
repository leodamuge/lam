<?php include("../../includes/header.php"); ?>
<?php include("../../includes/sidebar.php"); ?>

<div class="container mt-4 d-flex justify-content-center">

<div class="card shadow p-4" style="width:600px">

<h3 class="text-center mb-4">👨‍✈️ Novo Tripulante</h3>

<form action="salvar.php" method="POST">

<div class="mb-3">
<label>Nome</label>
<input type="text" name="nome" class="form-control" required>
</div>

<div class="mb-3">
<label>Função</label>
<select name="funcao" class="form-control">
    <option>Piloto</option>
    <option>Copiloto</option>
    <option>Comissária</option>
</select>
</div>

<div class="mb-3">
<label>Horas de Voo</label>
<input type="number" name="horas_voo" class="form-control">
</div>

<div class="mb-3">
<label>Status</label>
<select name="status" class="form-control">
    <option value="ativo">Ativo</option>
    <option value="inativo">Inativo</option>
</select>
</div>

<button class="btn btn-primary">Salvar</button>

</form>

</div>
</div>

<?php include("../../includes/footer.php"); ?>