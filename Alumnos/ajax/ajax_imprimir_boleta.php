<?php
  require ("../../fpdf/fpdf.php");
  include ("../clases/boleta_calificaciones.php");

  $boleta_calificaciones = new boleta_calificaciones();

  $Matricula = '';
  $result = false;
  $count = 0;
  $output = '';
  $num_filas = 0;
  $suma = 0;
  $promedio = 0.00;

  if(isset($_POST) && !empty($_POST)) {
    $Matricula = strval($_POST['Matricula']);
    $IdCiclo = intval($_POST['IdCiclo']);

    $result = $boleta_calificaciones->consultar_calificaciones($Matricula, $IdCiclo);

    $count = $result->columnCount();
    if ($count > 0) {
      $rowh=$result->fetchObject();
      $pdf = new FPDF();
      $pdf->AddPage();
      $pdf->Image("../img/logo-usjt.png",8,2,40);

      $pdf->SetFont('Times','B',9);
      $pdf->SetXY(70,5);
      $pdf->Cell(97,5,"UNIVERSIDAD DE SEGURIDAD Y JUSTICIA DE TAMAULIPAS",0,0,"C");
      $pdf->SetXY(93,12);
      $pdf->Cell(49,5,"BOLETA DE CALIFICACIONES",0,0,"C");

      $pdf->SetFont('Times','B',9);
      $pdf->SetXY(50,23);
      $pdf->Cell(18,5,"ALUMNO:",0,0,"L");

      $pdf->SetFont('Times','',9);
      $pdf->SetXY(69,23);
      $pdf->Cell(73,5,$rowh->ALUMNO,0,0,"L");

      $pdf->SetFont('Times','B',9);
      $pdf->SetXY(147,23);
      $pdf->Cell(23,5,"MATRICULA:",0,0,"L");

      $pdf->SetFont('Times','',9);
      $pdf->SetXY(171,23);
      $pdf->Cell(30,5,$rowh->MATRICULA,0,0,"L");      

      $pdf->SetFont('Times','B',9);
      $pdf->SetXY(50,30);
      $pdf->Cell(29,5,"CUATRIMESTRE:",0,0,"L");

      $pdf->SetFont('Times','',9);
      $pdf->SetXY(80,30);
      $pdf->Cell(62,5,$rowh->CUATRIMESTRE." ".$rowh->CICLOESCOLAR,0,0,"L");

      $pdf->SetFont('Times','B',9);
      $pdf->SetXY(171,23);
      $pdf->SetXY(147,30);
      $pdf->Cell(23,5,"MODALIDAD:",0,0,"L");

      $pdf->SetFont('Times','',9);
      $pdf->SetXY(171,30);
      $pdf->Cell(30,5,$rowh->MODALIDAD,0,0,"L");

      $pdf->SetFont('Times','B',9);
      $pdf->SetXY(20,40);
      $pdf->Cell(19,5,"CARRERA:",0,0,"L");

      $pdf->SetFont('Times','',9);
      $pdf->SetXY(40,40);
      $pdf->Cell(161,5,$rowh->CARRERA,0,0,"L");

      $result_2 = $boleta_calificaciones->consultar_calificaciones($Matricula, $IdCiclo);

      $pdf->Ln();
      $head = array('CLAVE', 'MATERIA', 'CURSO', 'CALIFICACION');
      $pdf->SetFont('Times', 'B', 9);
      $pdf->SetXY(10,50);
      foreach($head as $col) {
        if ($col != 'MATERIA') {
          $pdf->Cell(30,7,$col,1,0,"C");
        } else {
          $pdf->Cell(100,7,$col,1,0,"C");
        }
      }
      $pdf->Ln();

      while ($rowb = $result_2->fetchObject()) {
        $data = array($rowb->CLAVE, $rowb->MATERIA, $rowb->CURSO, $rowb->FINAL);
        $pdf->SetFont('Times', '', 9);
        foreach($data as $col) {
          if ($col != $rowb->MATERIA) {
            $pdf->Cell(30,7,$col,1,0,"C");
          } else {
            $pdf->Cell(100,7,$col,1,0,"C");
          }
        }
        $pdf->Ln();
        $num_filas++;
        $suma = $suma+intval($rowb->FINAL);
      }

      $promedio = doubleval($suma / $num_filas);
      $prom = array('PROMEDIO FINAL:', round($promedio,2));
      foreach($prom as $col_prom) {
        if ($col_prom != 'PROMEDIO FINAL:') {
          $pdf->SetFont('Times', '', 9);
          $pdf->Cell(30,7,$col_prom,1,0,"C");
        } else {
          $pdf->SetFont('Times', 'B', 9);
          $pdf->Cell(160,7,$col_prom,1,0,"R");
        }
      }

      $pdf->Ln();
      $fecha_emision = date('d-m-Y H:i:s');
      $fecha = array('FECHA DE EMISION:', $fecha_emision);
      foreach($fecha as $col_fech) {
        if ($col_fech != 'FECHA DE EMISION:') {
          $pdf->SetFont('Times', '', 9);
          $pdf->Cell(95,7,$col_fech,0,0,"L");
        } else {
          $pdf->SetFont('Times', 'B', 9);
          $pdf->Cell(95,7,$col_fech,0,0,"R");
        }
      }
      
      $pdf->Output("F","../impresiones/Boleta de calificaciones - ".$rowh->MATRICULA.".pdf");

      echo "Boleta de calificaciones - ".$rowh->MATRICULA.".pdf";
    } else {
      $output .= 'No se ha podido generar el documento';
      echo $output;
    }
  } else {
    $output = 'Ingrese la matricula para ver los periodos disponibles';
    echo $output;
    exit;
  }
?>