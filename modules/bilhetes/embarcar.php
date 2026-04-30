<?php
include("../../config/db.php");

$id = $_GET['id'];

$conn->query("
UPDATE bilhetes 
SET status='embarcado'
WHERE id=$id
");

header("Location: listar.php");