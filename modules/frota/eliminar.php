<?php
include("../../config/db.php");
session_start();
if($_SESSION['tipo'] != 'admin'){
    die("Acesso negado!");
}
$id = $_GET['id'];

$conn->query("DELETE FROM aeronaves WHERE id=$id");

header("Location: listar.php");
?>