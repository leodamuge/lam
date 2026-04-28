<?php
$host = "localhost:3306";
$user = "root";
$pass = "leodmg";
$db = "lam_erp";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}
?>