<?php
require ("../../fpdf/fpdf.php");
include ("../clases/seguridad_usuario.php");

//$lista_asistencia = new lista_asistencia();
$seguridad_usuario = new seguridad_usuario();

$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Image("../img/logo-usjt.png",8,10,30);

$pdf->SetFont('Times','B',9);
$pdf->SetXY(140,5);
$pdf->Cell(50,5,"LISTA DE ASISTENCIA");

$pdf->SetFont('Times','B',9);
$pdf->SetXY(80,14);
$pdf->Cell(20,5,"Carrera:",0,0,"L");

$pdf->SetFont('Times','',9);
$pdf->SetXY(94,14);
$pdf->Cell(70,5,utf8_decode("Licenciatura en Ciencias Policiales"),0,0,"L");

$pdf->SetFont('Times','B',9);
$pdf->SetXY(80,19);
$pdf->Cell(20,5,"Profesor:",0,0,"L");

$pdf->SetFont('Times','',9);
$pdf->SetXY(94,19);
$pdf->Cell(70,5,utf8_decode("Vazquez Aguirre Jose Luis"),0,0,"L");

$pdf->SetFont('Times','B',9);
$pdf->SetXY(80,24);
$pdf->Cell(20,5,"Materia:",0,0,"L");

$pdf->SetFont('Times','',9);
$pdf->SetXY(94,24);
$pdf->Cell(70,5,utf8_decode("Inteligencia Emocional"),0,0,"L");

$pdf->SetFont('Times','B',9);
$pdf->SetXY(80,29);
$pdf->Cell(20,5,"Turno:",0,0,"L");

$pdf->SetFont('Times','',9);
$pdf->SetXY(92,29);
$pdf->Cell(70,5,"Vespertino",0,0,"L");

$pdf->SetFont('Times','B',9);
$pdf->SetXY(180,14);
$pdf->Cell(20,5,utf8_decode("Año:"),0,0,"L");

$pdf->SetFont('Times','',9);
$pdf->SetXY(188,14);
$pdf->Cell(70,5,"2020",0,0,"L");

$pdf->SetFont('Times','B',9);
$pdf->SetXY(180,19);
$pdf->Cell(20,5,"Mes:",0,0,"L");

$pdf->SetFont('Times','',9);
$pdf->SetXY(188,19);
$pdf->Cell(70,5,utf8_decode("Septiembre"),0,0,"L");

$pdf->SetFont('Times','B',9);
$pdf->SetXY(180,24);
$pdf->Cell(20,5,"Grupo:",0,0,"L");

$pdf->SetFont('Times','',9);
$pdf->SetXY(191,24);
$pdf->Cell(70,5,"10.1-LCP-MIX",0,0,"L");

$pdf->SetFont('Times','B',9);
$pdf->SetXY(180,29);
$pdf->Cell(20,5,"Modalidad:",0,0,"L");

$pdf->SetFont('Times','',9);
$pdf->SetXY(197,29);
$pdf->Cell(70,5,"Mixta",0,0,"L"); 

/* tabla */

$pdf->SetFont('Times','',11);
$pdf->SetXY(243,36);
$pdf->SetFillColor(210, 210, 210);
$pdf->Cell(32.5,5,"Totales",1,0,"C",true);

$pdf->SetFont('Times','',10);
$pdf->SetXY(93.5,36);
$pdf->SetFillColor(210, 210, 210);
$pdf->Cell(149.5,5,"Nomenclatura: / = Falta, R = Retardo, I = Injustificado, J = Justificado, Punto(.) = Presente",1,0,"C",true);

$pdf->Ln();
$head = array('No.', 'Matricula', 'Nombre','01','02','03','04','07', '08', '09','10','11','14','15','16','17','18','21','22','23','24','25','28','29','30','31','R','I','J','F','P'); // '01','02','03','04','07', '08', '09','10','11','14','15','16','17','18','21','22','23','24','25','28','29','30','31','R','I','J','F','P'
$pdf->SetFont('Times', 'B', 9);
$pdf->SetXY(4,41);
$pdf->SetFillColor(210, 210, 210);
foreach($head as $col){
    if($col == 'Nombre') {
        $pdf->Cell(65,5,$col,1,0,"C",true);
    } else if($col == 'Matricula') {
        $pdf->Cell(18,5,$col,1,0,"C",true);
    } else if($col == 'No.') {
        $pdf->Cell(6.5,5,$col,1,0,"C",true);
    } else {
        $pdf->Cell(6.5,5,$col,1,0,"C",true);
    }
}

$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','*','*','/','*','*', '*', '/','*','*','*','*','*','*','*','R','*','/','*','*','*','R','R','*','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,46);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
/*$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,49.5);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,53);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,56.5);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,60);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,63.5);//
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,67);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,70.5);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,74);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,77.5);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,81);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,84.5);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,88);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,91.5);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,95);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,98.5);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,102);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,105.5);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,109);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,112.5);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,116);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,119.5);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,123);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,126.5);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,130);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,133.5);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,137);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
};
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,140.5);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
};
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,144);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,147.5);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,151);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,154.5);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,158);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,161.5);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,165);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,168.5);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,172);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,175.5);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,179);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('1', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,182.5);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '1') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}
$pdf->Ln();
$head = array('40', '190104005', 'Alvarez Salazar Sergio Manuel Jacques','o','o','/','o','o', 'o', '/','o','o','o','o','o','o','o','R','o','/','o','o','o','R','R','o','3','0','0','3','17');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY(4,186);
foreach($head as $col){
    if($col == 'Alvarez Salazar Sergio Manuel Jacques') {
        $pdf->Cell(65,3.5,utf8_decode($col),1,0,"C");
    } else if($col == '190104005') {
        $pdf->Cell(18,3.5,$col,1,0,"C");
    } else if($col == '40') {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    } else {
        $pdf->Cell(6.5,3.5,$col,1,0,"C");
    }
}*/


$pdf->Output("F","../impresiones/Lista.pdf");

echo "Lista.pdf";
?>