<?php
include("../../config/db.php");

$id = $_GET['id'];

// buscar dados do voo
$sql = "
SELECT v.data_voo, v.hora_saida
FROM bilhetes b
JOIN voos v ON b.voo_id = v.id
WHERE b.id = $id
";

$voo = $conn->query($sql)->fetch_assoc();

$agora = time();
$dataHoraVoo = strtotime($voo['data_voo'] . ' ' . $voo['hora_saida']);

// BLOQUEIO REAL
if($agora >= $dataHoraVoo){
    die("❌ Check-in encerrado. O voo já partiu.");
}

// continuar check-in
$conn->query("
UPDATE bilhetes 
SET status='checkin', hora_embarque = NOW()
WHERE id=$id
");

header("Location: listar.php");