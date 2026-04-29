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
$stmt = $conn->prepare("
SELECT id FROM voos
WHERE aeronave_id = ?
AND data_voo = ?
AND (hora_saida < ? AND hora_chegada > ?)
");

$stmt->bind_param("isss", $aeronave_id, $data, $chegada, $saida);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows > 0){
    die("❌ Aeronave escalada para este horário!");
}

if($saida >= $chegada){
    die("Hora de saída deve ser menor que a de chegada!");
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
        AND v.data_voo = '$data'
        AND (v.hora_saida < '$chegada' AND v.hora_chegada > '$saida')
    ");

    if($conflito_trip && $conflito_trip->num_rows > 0){
        die("❌ Conflito: um tripulante já está escalado nesse horário!");
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

header("Location: listar.php");
?>