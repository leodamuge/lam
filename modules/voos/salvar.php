<?php
include("../../config/db.php");

$rota_id = $_POST['rota_id'];
$data = $_POST['data_voo'];
$aeronave_id = $_POST['aeronave_id'];
$saida = $_POST['hora_saida'];
$chegada = $_POST['hora_chegada'];
$tripulantes = $_POST['tripulantes'];

// verificar status da aeronave
$res = $conn->query("SELECT status FROM aeronaves WHERE id='$aeronave_id'");
$status = $res->fetch_assoc()['status'];

if($status != 'operacional'){
    die("Aeronave não está disponível para voo!");
}

// 🚫 1. Conflito de aeronave
$conflito_aviao = $conn->query("
SELECT * FROM voos 
WHERE aeronave_id = '$aeronave_id'
AND data_voo = '$data'
AND (
    ('$saida' BETWEEN hora_saida AND hora_chegada)
    OR ('$chegada' BETWEEN hora_saida AND hora_chegada)
)
");

if($conflito_aviao->num_rows > 0){
    die("Aeronave já está em outro voo nesse horário!");
}

// 🚫 2. Conflito de tripulação
foreach($tripulantes as $trip_id){

    $conflito_trip = $conn->query("
    SELECT v.* FROM voos v
    JOIN escala_tripulacao e ON v.id = e.voo_id
    WHERE e.tripulante_id = '$trip_id'
    AND v.data_voo = '$data'
    AND (
        ('$saida' BETWEEN v.hora_saida AND v.hora_chegada)
        OR ('$chegada' BETWEEN v.hora_saida AND v.hora_chegada)
    )
    ");

    if($conflito_trip->num_rows > 0){
        die("Tripulante já está escalado em outro voo nesse horário!");
    }
}

// ✔️ Inserir voo
$conn->query("
INSERT INTO voos (rota_id, data_voo, aeronave_id, hora_saida, hora_chegada)
VALUES ('$rota_id','$data','$aeronave_id','$saida','$chegada')
");

$voo_id = $conn->insert_id;

// ✔️ Salvar tripulação
foreach($tripulantes as $trip_id){
    $conn->query("
    INSERT INTO escala_tripulacao (voo_id, tripulante_id)
    VALUES ('$voo_id','$trip_id')
    ");
}

header("Location: listar.php");
?>