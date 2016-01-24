<?php
    include('../conexion/db.php');
    require('../fpdf17/fpdf.php');
    $pdf=new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',16);
    $pdf->Image("../dist/img/ICONO2.png",10,8,10,10,'PNG');
    $pdf->Cell(60,10,'',0);
    $pdf->Cell(90,10,'Efood - Administracion',0);
    $pdf->ln(15);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(70,10,'',0);
    $pdf->Cell(90,10,'Ventas realizadas',0);
    $pdf->ln(30);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(30,10,'N. Venta',0);
    $pdf->Cell(70,10,'Cliente',0);
    $pdf->Cell(30,10,'Fecha',0);
    $pdf->Cell(30,10,'Total C.',0);
    $pdf->ln(8);

//Consulta a la BD
/*$pdf->SetFont('Arial','',12);
$ventas=pg_query("Select * form ventas ")
while ($ventas2=pg_fetch_row($ventas)) {
  $pdf->Cell(30,10,$ventas2['id'],0);
  $pdf->Cell(70,10,$ventas2['cliente'],0);
  $pdf->Cell(30,10,$ventas2['fecha'],0);
  $pdf->Cell(30,10,$ventas2['totalp'],0);
  $pdf->ln(8);

}*/
    $pdf->Output();
?>
