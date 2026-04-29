<?php
include("../../config/db.php");
include("../../includes/header.php");
include("../../includes/sidebar.php");
if($_SESSION['tipo'] != 'admin'){
    die("Acesso negado!");
}
$id = $_GET['id'];

$result = $conn->query("SELECT * FROM aeronaves WHERE id=$id");
$row = $result->fetch_assoc();
?>

<div class="container mt-4 d-flex justify-content-center">

<div class="card shadow p-4" style="width: 700px; border-radius:15px;">

<h3 class="mb-4 text-center">✈️ Editar Aeronave</h3>

<form action="atualizar.php" method="POST" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<div class="row">

<div class="col-md-6 mb-3">
<label>Modelo</label>
<input type="text" name="modelo" class="form-control" value="<?php echo $row['modelo']; ?>">
</div>

<div class="col-md-6 mb-3">
<label>Matrícula</label>
<input type="text" name="matricula" class="form-control" value="<?php echo $row['matricula']; ?>">
</div>

<div class="col-md-6 mb-3">
<label>Horas de Voo</label>
<input type="number" name="horas" class="form-control" value="<?php echo $row['horas_voo']; ?>">
</div>

<div class="col-md-6 mb-3">
<label>Ciclos</label>
<input type="number" name="ciclos" class="form-control" value="<?php echo $row['ciclos']; ?>">
</div>

<div class="col-md-12 mb-3">
<label>Status</label>
<select name="status" class="form-control">
    <option value="operacional" <?php if($row['status']=='operacional') echo 'selected'; ?>>Operacional</option>
    <option value="manutencao" <?php if($row['status']=='manutencao') echo 'selected'; ?>>Manutenção</option>
    <option value="parado" <?php if($row['status']=='parado') echo 'selected'; ?>>Parado</option>
</select>
</div>

<div class="col-md-12 mb-3">
<label>Nova Foto (opcional)</label>
<input type="file" name="foto" class="form-control">
</div>

<div class="col-md-12 text-center mb-3">
<?php if($row['foto']){ ?>
    <img src="../../uploads/<?php echo $row['foto']; ?>" width="150" style="border-radius:10px;">
<?php } ?>
</div>

</div>

<div class="d-flex justify-content-between">
<a href="listar.php" class="btn btn-secondary">Voltar</a>
<button class="btn btn-primary">Atualizar</button>
</div>

</form>

</div>
</div>

<?php include("../../includes/footer.php"); ?>