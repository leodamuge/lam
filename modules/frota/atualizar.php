<?php
include("../../config/db.php");
session_start();
if($_SESSION['tipo'] != 'admin'){
    die("Acesso negado!");
}
$id = $_POST['id'];
$modelo = $_POST['modelo'];
$matricula = $_POST['matricula'];
$horas = $_POST['horas'];
$ciclos = $_POST['ciclos'];
$status = $_POST['status'];

$foto_sql = "";

// Se enviar nova foto
if(!empty($_FILES['foto']['name'])){

    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $novo_nome = uniqid() . "." . $ext;

    move_uploaded_file($_FILES['foto']['tmp_name'], "../../uploads/".$novo_nome);

    $foto_sql = ", foto='$novo_nome'";
}

$sql = "UPDATE aeronaves SET 
modelo='$modelo',
matricula='$matricula',
horas_voo='$horas',
ciclos='$ciclos',
status='$status'
$foto_sql
WHERE id=$id";

$conn->query($sql);

header("Location: listar.php");
?>