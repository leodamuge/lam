<?php
require("../../lib/fpdf/fpdf.php");
include("../../config/db.php");

$pdf = new FPDF();
$pdf->AddPage();

// ===== TÍTULO =====
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'Relatorio de Aeronaves - LAM',0,1,'C');
$pdf->Ln(5);

$pdf->SetFont('Arial','',10);
$pdf->Cell(0,8,'Gerado em: '.date('d/m/Y H:i'),0,1,'R');
// ===== CABEÇALHO DA TABELA =====
$pdf->SetFont('Arial','B',10);

$pdf->SetFillColor(200,200,200);

$pdf->Cell(30,10,'Modelo',1,0,'C',true);
$pdf->Cell(35,10,'Matricula',1,0,'C',true);
$pdf->Cell(25,10,'Horas',1,0,'C',true);
$pdf->Cell(30,10,'Status',1,0,'C',true);
$pdf->Cell(70,10,'Foto',1,1,'C',true);

// ===== DADOS =====
$result = $conn->query("SELECT * FROM aeronaves");

$pdf->SetFont('Arial','',9);

while($row = $result->fetch_assoc()){

    // guardar posição Y atual
    $y = $pdf->GetY();

    // altura padrão da linha
    $altura = 20;

    // ===== TEXTO =====
    $pdf->Cell(30,$altura,$row['modelo'],1);
    $pdf->Cell(35,$altura,$row['matricula'],1);
    $pdf->Cell(25,$altura,$row['horas_voo']." h",1);

    // STATUS com texto formatado
    $status = strtoupper($row['status']);
    $pdf->Cell(30,$altura,$status,1);

    // ===== FOTO =====
    $xFoto = $pdf->GetX();
    $pdf->Cell(70,$altura,'',1); // célula vazia para borda

    if(!empty($row['foto']) && file_exists("../../uploads/".$row['foto'])){
        $pdf->Image("../../uploads/".$row['foto'], $xFoto+5, $y+2, 25);
    }

    $pdf->Ln();
}
$pdf->Ln(5);
$pdf->Cell(0,10,'Total de Aeronaves: '.$result->num_rows,0,1);
$pdf->Output();
?>