<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header("Location: /lam_erp/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>ERP LAM</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/lam_erp/assets/css/style.css" rel="stylesheet">
</head>
<body>