<?php
include("../../config/db.php");

$modelo = $_POST['modelo'];
$matricula = $_POST['matricula'];
$horas = $_POST['horas'];
$ciclos = $_POST['ciclos'];
$status = $_POST['status'];

$foto_nome = $_FILES['foto']['name'];
$foto_tmp = $_FILES['foto']['tmp_name'];
$foto_size = $_FILES['foto']['size'];

$ext = strtolower(pathinfo($foto_nome, PATHINFO_EXTENSION));
$permitidas = ['jpg','jpeg','png','jfif'];

if(!in_array($ext, $permitidas)){
    die("Formato inválido!");
}

if($foto_size > 2 * 1024 * 1024){
    die("Imagem muito grande!");
}

// Nome único
$novo_nome = uniqid() . "." . $ext;
$caminho = "../../uploads/" . $novo_nome;

move_uploaded_file($foto_tmp, $caminho);

$sql = "INSERT INTO aeronaves (modelo, matricula, horas_voo, ciclos, status, foto)
VALUES ('$modelo','$matricula','$horas','$ciclos','$status','$novo_nome')";

$conn->query($sql);

header("Location: listar.php");
?>