<?php
require('../fpdf/fpdf.php');
include("../config/db.php");

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial','B',14);
$pdf->Cell(190,10,'Relatorio de Aeronaves - LAM',0,1,'C');

$result = $conn->query("SELECT * FROM aeronaves");

while($row = $result->fetch_assoc()){

    $pdf->SetFont('Arial','',10);

    $pdf->Cell(100,10,
        $row['modelo']." - ".$row['matricula']." - ".$row['horas_voo']."h",
        0,0
    );

    // IMAGEM
    if(!empty($row['foto']) && file_exists("../uploads/".$row['foto'])){
        $pdf->Image("../uploads/".$row['foto'], 150, $pdf->GetY(), 30);
    }

    $pdf->Ln(25);
}

$pdf->Output();
?>