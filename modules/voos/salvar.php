<?php
include("../../config/db.php");

$data = $_POST['data_voo'] ?? null;
$saida = $_POST['hora_saida'] ?? null;
$chegada = $_POST['hora_chegada'] ?? null;

$rota_id = $_POST['rota_id'] ?? null;
$aeronave_id = $_POST['aeronave_id'] ?? null;
$tripulantes = $_POST['tripulantes'] ?? [];

// verificar status da aeronave
$res = $conn->query("SELECT status FROM aeronaves WHERE id='$aeronave_id'");
$status = $res->fetch_assoc()['status'];

if($status != 'operacional'){
    die("Aeronave não está disponível para voo!");
}

// 🚫 1. Conflito de aeronave
$conflito_aviao = $conn->query("
SELECT id FROM voos 
WHERE aeronave_id = '$aeronave_id'
AND status = 'ativo'
AND data_voo = '$data'
AND (hora_saida < '$chegada' AND hora_chegada > '$saida')
");

if($conflito_aviao && $conflito_aviao->num_rows > 0){
    die("❌ Aeronave já está em outro voo ATIVO nesse horário!");
}

// 🚫 2. Conflito de tripulação
if(empty($tripulantes) || empty($data) || empty($saida) || empty($chegada)){
    die("Dados insuficientes para validar tripulação!");
}

foreach($tripulantes as $trip_id){

    $trip_id = intval($trip_id);

    $conflito_trip = $conn->query("
        SELECT v.id 
        FROM voos v
        JOIN escala_tripulacao e ON v.id = e.voo_id
        WHERE e.tripulante_id = '$trip_id'
        AND v.status = 'ativo'
        AND v.data_voo = '$data'
        AND (v.hora_saida < '$chegada' AND v.hora_chegada > '$saida')
    ");

    if($conflito_trip && $conflito_trip->num_rows > 0){
        die("❌ Tripulante já está em outro voo ATIVO nesse horário!");
    }
}

// ✔️ Inserir voo
$conn->query("INSERT INTO voos 
(rota_id, data_voo, hora_saida, hora_chegada, aeronave_id,status)
VALUES
('$rota_id', '$data', '$saida', '$chegada', '$aeronave_id','ativo')");

// ✔️ Salvar tripulação
$voo_id = $conn->insert_id;

if(!empty($tripulantes)){
    foreach($tripulantes as $t){
        $conn->query("INSERT INTO escala_tripulacao (voo_id, tripulante_id)
        VALUES ('$voo_id', '$t')");
    }
}

$conn->query("
UPDATE aeronaves 
SET status='ocupado'
WHERE id = $aeronave_id
");

header("Location: listar.php");
?>