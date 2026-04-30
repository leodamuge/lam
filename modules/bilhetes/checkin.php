<?php
include("../../config/db.php");

$id = $_GET['id'];

// atualizar status + hora
$conn->query("
UPDATE bilhetes 
SET status='checkin', hora_embarque = NOW()
WHERE id=$id
");

header("Location: listar.php");