<?php include("../../config/db.php"); ?>
<?php include("../../includes/header.php"); ?>
<?php include("../../includes/sidebar.php"); ?>
<?php include("../../includes/auto_update_voos.php"); ?>

<div class="container mt-4">

<h2>🎟️ Bilhetes</h2>

<a href="adicionar.php" class="btn btn-success mb-3">+ Novo Bilhete</a>

<table class="table table-bordered">

<tr>
<th>Passageiro</th>
<th>Voo</th>
<th>Preço</th>
<th>PDF</th>
<th>Status</th>
<th>Check-in</th>
<th>Hora Embarque</th>
</tr>

<?php
$sql = "
SELECT 
    b.*, 
    p.nome, 
    r.origem, 
    r.destino, 
    v.data_voo
FROM bilhetes b
JOIN passageiros p ON b.passageiro_id = p.id
JOIN voos v ON b.voo_id = v.id
JOIN rotas r ON v.rota_id = r.id
";

$res = $conn->query($sql);

while($row = $res->fetch_assoc()){

    // STATUS
    $status = $row['status'];
    $cor = 'secondary';

    if($status == 'emitido') $cor = 'warning';
    if($status == 'checkin') $cor = 'primary';
    if($status == 'embarcado') $cor = 'success';

    echo "<tr>

        <td>{$row['nome']}</td>

        <td>
            {$row['origem']} → {$row['destino']} 
            <br>
            <small>{$row['data_voo']}</small>
        </td>

        <td>{$row['preco']} MZN</td>

        <td>
            <a href='pdf.php?id={$row['id']}' 
               class='btn btn-danger btn-sm' target='_blank'>
               📄 PDF
            </a>
        </td>

        <td>
            <span class='badge bg-$cor text-uppercase'>
                {$row['status']}
            </span>
        </td>

        <td>";
        $agora = time();
        $dataHoraVoo = strtotime($row['data_voo'] . ' ' . $row['hora_saida']);
        // BOTÃO CHECK-IN / EMBARQUE
echo "<td>";

if($status == 'emitido'){

    if($agora < $dataHoraVoo){
        echo "<a href='checkin.php?id={$row['id']}' 
              class='btn btn-primary btn-sm'>
              Fazer Check-in
              </a>";
    } else {
        echo "<span class='text-danger'>Check-in encerrado</span>";
    }

}
elseif($status == 'checkin'){
    echo "<a href='embarcar.php?id={$row['id']}' 
          class='btn btn-success btn-sm'>
          Embarcar
          </a>";
}
else{
    echo "<span class='text-success'>✔ Embarcado</span>";
}

echo "</td>";

    echo "</td>

        <td>";

        // HORA EMBARQUE
        if(!empty($row['hora_embarque'])){
            echo $row['hora_embarque'];
        } else {
            echo "-";
        }

    echo "</td>

    </tr>";
}
?>

</table>

</div>

<?php include("../../includes/footer.php"); ?>