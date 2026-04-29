<?php
include("../../config/db.php");

$id = $_GET['id'];

// em vez de apagar, melhor prática: marcar como cancelado
$conn->query("UPDATE voos SET status='cancelado' WHERE id=$id");

header("Location: listar.php");
?>