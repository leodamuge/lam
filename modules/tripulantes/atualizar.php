<?php
include("../../config/db.php");

$id = $_POST['id'];

$conn->query("
UPDATE tripulantes SET
nome='{$_POST['nome']}',
funcao='{$_POST['funcao']}',
horas_voo='{$_POST['horas_voo']}',
status='{$_POST['status']}'
WHERE id=$id
");

header("Location: listar.php");