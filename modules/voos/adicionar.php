<?php include("../../config/db.php"); ?>
<?php include("../../includes/header.php"); ?>
<?php include("../../includes/sidebar.php");?>
<?php 
$rotas = $conn->query("SELECT id, origem, destino FROM rotas");

$aeronaves = $conn->query("SELECT id, modelo, matricula FROM aeronaves WHERE status='operacional'");

$tripulantes = $conn->query("SELECT id, nome, funcao FROM tripulantes WHERE status='ativo'");
?>

<div class="container mt-4 d-flex justify-content-center">

<div class="card shadow p-4" style="width:700px; border-radius:15px;">

<h3 class="text-center mb-4">✈️ Criar Voo</h3>

<form action="salvar.php" method="POST">

<div class="row">

<!-- ROTA -->
<div class="col-md-12 mb-3">
    <label>Rota</label>
    <select name="rota_id" class="form-control" required>
        <option value="">Selecione a rota</option>

        <?php while($r = $rotas->fetch_assoc()){ ?>
            <option value="<?= $r['id'] ?>">
                <?= $r['origem'] ?> → <?= $r['destino'] ?>
            </option>
        <?php } ?>
    </select>
</div>

<!-- DATA VOO -->
<div class="col-md-6 mb-3">
    <label>Data do Voo</label>
    <input type="date" name="data_voo" class="form-control" required>
</div>

<!-- HORA SAÍDA -->
<div class="col-md-6 mb-3">
    <label>Hora de Saída</label>
    <input type="time" name="hora_saida" class="form-control" required>
</div>

<!-- HORA CHEGADA -->
<div class="col-md-6 mb-3">
    <label>Hora de Chegada</label>
    <input type="time" name="hora_chegada" class="form-control" required>
</div>

<!-- AERONAVE -->
<div class="col-md-12 mb-3">
    <label>Aeronave</label>
    <select name="aeronave_id" class="form-control" required>
        <option value="">Selecione a aeronave</option>

        <?php while($a = $aeronaves->fetch_assoc()){ ?>
            <option value="<?= $a['id'] ?>">
                <?= $a['modelo'] ?> - <?= $a['matricula'] ?>
            </option>
        <?php } ?>
    </select>
</div>

<!-- TRIPULANTES -->
<div class="col-md-12 mb-3">
    <label>Tripulantes</label>
    <select name="tripulantes[]" class="form-control" multiple required>

        <?php while($t = $tripulantes->fetch_assoc()){ ?>
            <option value="<?= $t['id'] ?>">
                <?= $t['nome'] ?> (<?= $t['funcao'] ?>)
            </option>
        <?php } ?>

    </select>
    <small class="text-muted">Segure CTRL para selecionar múltiplos</small>
</div>

</div>

<button class="btn btn-primary">Criar Voo</button>

</form>

</div>
</div>

<?php include("../../includes/footer.php"); ?>