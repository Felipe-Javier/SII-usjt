<?php
require ("../../fpdf/fpdf.php");
include ("../clases/seguridad_usuario.php");

//$lista_asistencia = new lista_asistencia();
$seguridad_usuario = new seguridad_usuario();

$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Image("../img/logo-usjt.png",8,2,30);

$pdf->SetFont('Times','B',9);
$pdf->SetXY(140,5);
$pdf->Cell(50,5,"LISTA DE ASISTENCIA");

$pdf->SetFont('Times','B',9);
$pdf->SetXY(80,15);
$pdf->Cell(20,5,"Carrera:",0,0,"L");

$pdf->SetFont('Times','',9);
$pdf->SetXY(94,15);
$pdf->Cell(70,5,utf8_decode("Licenciatura en Ciencias Policiales"),0,0,"L");

$pdf->SetFont('Times','B',9);
$pdf->SetXY(80,20);
$pdf->Cell(20,5,"Profesor:",0,0,"L");

$pdf->SetFont('Times','',9);
$pdf->SetXY(94,20);
$pdf->Cell(70,5,utf8_decode("Vazquez Aguirre Jose Luis"),0,0,"L");

$pdf->SetFont('Times','B',9);
$pdf->SetXY(80,25);
$pdf->Cell(20,5,"Materia:",0,0,"L");

$pdf->SetFont('Times','',9);
$pdf->SetXY(94,25);
$pdf->Cell(70,5,utf8_decode("Inteligencia Emocional"),0,0,"L");

$pdf->SetFont('Times','B',9);
$pdf->SetXY(80,30);
$pdf->Cell(20,5,"Turno:",0,0,"L");

$pdf->SetFont('Times','',9);
$pdf->SetXY(92,30);
$pdf->Cell(70,5,"Vespertino",0,0,"L");

$pdf->SetFont('Times','B',9);
$pdf->SetXY(180,15);
$pdf->Cell(20,5,utf8_decode("Año:"),0,0,"L");

$pdf->SetFont('Times','',9);
$pdf->SetXY(188,15);
$pdf->Cell(70,5,"2020",0,0,"L");

$pdf->SetFont('Times','B',9);
$pdf->SetXY(180,20);
$pdf->Cell(20,5,"Mes:",0,0,"L");

$pdf->SetFont('Times','',9);
$pdf->SetXY(188,20);
$pdf->Cell(70,5,utf8_decode("Septiembre"),0,0,"L");

$pdf->SetFont('Times','B',9);
$pdf->SetXY(180,25);
$pdf->Cell(20,5,"Grupo:",0,0,"L");

$pdf->SetFont('Times','',9);
$pdf->SetXY(191,25);
$pdf->Cell(70,5,"10.1-LCP-MIX",0,0,"L");

$pdf->SetFont('Times','B',9);
$pdf->SetXY(180,30);
$pdf->Cell(20,5,"Modalidad:",0,0,"L");

$pdf->SetFont('Times','',9);
$pdf->SetXY(197,30);
$pdf->Cell(70,5,"Mixta",0,0,"L"); 

/* tabla */

$pdf->Ln();
$head = array('No.', 'Matricula', 'Nombre', 'L07', 'M08', 'M09','R','I','J','F','P');
$pdf->SetFont('Times', 'B', 8);
$pdf->SetXY(10,50);
foreach($head as $col){
    if($col != 'Matricula') {
        $pdf->Cell(30,7,$col,1,0,"C");
    } else {
        $pdf->Cell(100,7,$col,1,0,"C");
    }
}

$pdf->Output("F","../impresiones/Lista.pdf");

echo "Lista.pdf";
?>