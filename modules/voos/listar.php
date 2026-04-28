<?php include("../../config/db.php"); ?>

<h2>Voos</h2>

<?php
$voos = $conn->query("
SELECT v.*, r.origem, r.destino, a.modelo, a.matricula
FROM voos v
JOIN rotas r ON v.rota_id = r.id
JOIN aeronaves a ON v.aeronave_id = a.id
");

while($v = $voos->fetch_assoc()){

    echo "<div class='card mb-3 p-3'>";
    echo "<h4>{$v['origem']} → {$v['destino']}</h4>";
    echo "<p>Aeronave: {$v['modelo']} ({$v['matricula']})</p>";
    echo "<p>Hora: {$v['hora_saida']} - {$v['hora_chegada']}</p>";

    // tripulação
    $trip = $conn->query("
    SELECT t.nome, t.funcao
    FROM escala_tripulacao e
    JOIN tripulantes t ON e.tripulante_id = t.id
    WHERE e.voo_id = {$v['id']}
    ");

    echo "<strong>Tripulação:</strong><br>";

    while($t = $trip->fetch_assoc()){
        echo "- {$t['nome']} ({$t['funcao']})<br>";
    }

    echo "</div>";
}
?>