<?php
require("../../lib/fpdf/fpdf.php");
include("../../config/db.php");

$id = $_GET['id'];

// buscar dados do bilhete
$sql = "
SELECT 
    b.*, 
    p.nome, p.documento,
    r.origem, r.destino,
    v.data_voo, v.hora_saida, v.hora_chegada
FROM bilhetes b
JOIN passageiros p ON b.passageiro_id = p.id
JOIN voos v ON b.voo_id = v.id
JOIN rotas r ON v.rota_id = r.id
WHERE b.id = $id
";

$row = $conn->query($sql)->fetch_assoc();

// criar PDF
$pdf = new FPDF();
$pdf->AddPage();

// ====== TÍTULO ======
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'LAM - Bilhete de Embarque',0,1,'C');

$pdf->Ln(5);

// ====== DADOS ======
$pdf->SetFont('Arial','',12);

$pdf->Cell(100,8,"Passageiro: ".$row['nome'],0,1);
$pdf->Cell(100,8,"Documento: ".$row['documento'],0,1);

$pdf->Ln(5);

// ====== VOO ======
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,8,"Detalhes do Voo",0,1);

$pdf->SetFont('Arial','',12);

$pdf->Cell(100,8,"Rota: ".$row['origem']." → ".$row['destino'],0,1);
$pdf->Cell(100,8,"Data: ".$row['data_voo'],0,1);
$pdf->Cell(100,8,"Saida: ".$row['hora_saida'],0,1);
$pdf->Cell(100,8,"Chegada: ".$row['hora_chegada'],0,1);

$pdf->Ln(5);

// ====== PREÇO ======
$pdf->Cell(100,8,"Preco: ".$row['preco']." MZN",0,1);

$pdf->Ln(10);

// ====== RODAPÉ ======
$pdf->SetFont('Arial','I',10);
$pdf->Cell(0,10,"Obrigado por voar com a LAM",0,1,'C');

// gerar
$pdf->Output("I","bilhete.pdf");