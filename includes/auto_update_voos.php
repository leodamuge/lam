<?php
$dataAtual = date("Y-m-d");
$horaAtual = date("H:i:s");

// buscar voos ativos que já passaram da hora
$voos = $conn->query("
SELECT * FROM voos
WHERE status='ativo'
AND data_voo = '$dataAtual'
AND hora_chegada <= '$horaAtual'
");

while($voo = $voos->fetch_assoc()){

    $voo_id = $voo['id'];

    // calcular duração (em horas)
    $inicio = strtotime($voo['hora_saida']);
    $fim = strtotime($voo['hora_chegada']);
    $duracao = ($fim - $inicio) / 3600;

    // atualizar status do voo
    $conn->query("UPDATE voos SET status='concluido' WHERE id=$voo_id");

    // libertar aeronave
    $conn->query("
    UPDATE aeronaves 
    SET status='operacional' 
    WHERE id = {$voo['aeronave_id']}
    ");

    // atualizar horas dos tripulantes
    $tripulantes = $conn->query("
    SELECT tripulante_id FROM escala_tripulacao
    WHERE voo_id = $voo_id
    ");

    while($t = $tripulantes->fetch_assoc()){

        $conn->query("
        UPDATE tripulantes
        SET horas_voo = horas_voo + $duracao
        WHERE id = {$t['tripulante_id']}
        ");
    }
}
?>