<?php include("../../config/db.php"); ?>

<form action="salvar.php" method="POST" class="container mt-4">
    <h2>Criar Voo</h2>

    <!-- Selecionar rota -->
    <select name="rota_id" class="form-control mb-2">
        <?php
        $rotas = $conn->query("SELECT * FROM rotas");
        while($r = $rotas->fetch_assoc()){
            echo "<option value='{$r['id']}'>{$r['origem']} → {$r['destino']}</option>";
        }
        ?>
    </select>

    <input type="date" name="data_voo" class="form-control mb-3">

    <h4>Selecionar Tripulação</h4>

    <?php
    $trip = $conn->query("SELECT * FROM tripulantes");
    while($t = $trip->fetch_assoc()){
        echo "
        <div>
            <input type='checkbox' name='tripulantes[]' value='{$t['id']}'>
            {$t['nome']} ({$t['funcao']})
        </div>";
    }
    ?>
    <h4>Aeronave</h4>
<select name="aeronave_id" class="form-control mb-2">
<?php
$aeronaves = $conn->query("SELECT * FROM aeronaves WHERE status='operacional'");
while($a = $aeronaves->fetch_assoc()){
    echo "<option value='{$a['id']}'>{$a['modelo']} - {$a['matricula']}</option>";
}
?>
</select>

<h4>Horário</h4>
<input type="time" name="hora_saida" class="form-control mb-2">
<input type="time" name="hora_chegada" class="form-control mb-3">

    <button class="btn btn-primary mt-3">Criar Voo</button>
</form>