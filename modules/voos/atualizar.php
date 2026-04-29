<?php
include("../../config/db.php");
session_start();
if($_SESSION['tipo'] != 'admin'){
    die("Acesso negado!");
}
$id = $_POST['id'];
$rota_id = $_POST['rota_id'];
$data = $_POST['data_voo'];
$saida = $_POST['hora_saida'];
$chegada = $_POST['hora_chegada'];
$aeronave_id = $_POST['aeronave_id'];
$status = $_POST['status'];

$conn->query("
UPDATE voos SET 
rota_id='$rota_id',
data_voo='$data',
hora_saida='$saida',
hora_chegada='$chegada',
aeronave_id='$aeronave_id',
status='$status'
WHERE id=$id
");
header("Location: listar.php");
?>