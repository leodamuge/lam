<?php
include("../../config/db.php");

$nome = $_POST['nome'];
$doc = $_POST['documento'];
$voo_id = $_POST['voo_id'];
$preco = $_POST['preco'];

// criar passageiro
$conn->query("
INSERT INTO passageiros (nome, documento)
VALUES ('$nome','$doc')
");

$passageiro_id = $conn->insert_id;

// criar bilhete
$conn->query("
INSERT INTO bilhetes (voo_id, passageiro_id, preco)
VALUES ('$voo_id','$passageiro_id','$preco')
");

header("Location: listar.php");