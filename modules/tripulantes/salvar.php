<?php
include("../../config/db.php");

$nome = $_POST['nome'];
$funcao = $_POST['funcao'];
$horas = $_POST['horas_voo'];
$status = $_POST['status'];

$conn->query("
INSERT INTO tripulantes (nome, funcao, horas_voo, status)
VALUES ('$nome','$funcao','$horas','$status')
");

header("Location: listar.php");