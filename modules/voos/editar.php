<?php
include("../../config/db.php");
include("../../includes/header.php");
include("../../includes/sidebar.php");

$id = $_GET['id'];

// buscar voo atual
$voo = $conn->query("
SELECT * FROM voos WHERE id=$id
")->fetch_assoc();

// dados para selects
$rotas = $conn->query("SELECT id, origem, destino FROM rotas");
$aeronaves = $conn->query("SELECT id, modelo, matricula FROM aeronaves WHERE status='operacional'");
?>

<div class="container mt-4 d-flex justify-content-center">

<div class="card shadow p-4" style="width:750px; border-radius:15px;">

<h3 class="text-center mb-4">✏️ Editar Voo</h3>

<form action="atualizar.php" method="POST">

<input type="hidden" name="id" value="<?= $voo['id'] ?>">

<div class="row">

<!-- ROTA -->
<div class="col-md-12 mb-3">
    <label>Rota</label>
    <select name="rota_id" class="form-control" required>

        <?php while($r = $rotas->fetch_assoc()){ ?>
            <option value="<?= $r['id'] ?>"
                <?= ($r['id'] == $voo['rota_id']) ? 'selected' : '' ?>>

                <?= $r['origem'] ?> → <?= $r['destino'] ?>
            </option>
        <?php } ?>

    </select>
</div>

<!-- DATA -->
<div class="col-md-6 mb-3">
    <label>Data do Voo</label>
    <input type="date" name="data_voo"
           value="<?= $voo['data_voo'] ?>"
           class="form-control" required>
</div>

<!-- HORA SAÍDA -->
<div class="col-md-6 mb-3">
    <label>Hora de Saída</label>
    <input type="time" name="hora_saida"
           value="<?= $voo['hora_saida'] ?>"
           class="form-control" required>
</div>

<!-- HORA CHEGADA -->
<div class="col-md-6 mb-3">
    <label>Hora de Chegada</label>
    <input type="time" name="hora_chegada"
           value="<?= $voo['hora_chegada'] ?>"
           class="form-control" required>
</div>

<!-- AERONAVE -->
<div class="col-md-6 mb-3">
    <label>Aeronave</label>
    <select name="aeronave_id" class="form-control" required>

        <?php while($a = $aeronaves->fetch_assoc()){ ?>
            <option value="<?= $a['id'] ?>"
                <?= ($a['id'] == $voo['aeronave_id']) ? 'selected' : '' ?>>

                <?= $a['modelo'] ?> - <?= $a['matricula'] ?>
            </option>
        <?php } ?>

    </select>
</div>

<!-- STATUS -->
<div class="col-md-12 mb-3">
    <label>Status</label>
    <select name="status" class="form-control">

        <option value="ativo" 
            <?= ($voo['status']=='ativo')?'selected':'' ?>>
            Ativo
        </option>

        <option value="concluido"
            <?= ($voo['status']=='concluido')?'selected':'' ?>>
            Concluído
        </option>

        <option value="cancelado"
            <?= ($voo['status']=='cancelado')?'selected':'' ?>>
            Cancelado
        </option>

    </select>
</div>

</div>

<div class="d-flex justify-content-between">
    <a href="listar.php" class="btn btn-secondary">Voltar</a>
    <button class="btn btn-primary">Atualizar Voo</button>
</div>

</form>

</div>
</div>

<?php include("../../includes/footer.php"); ?>