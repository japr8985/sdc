<?php
include('../recursos/fpdf/fpdf.php');
include("../../conexion/conexion.php");
session_start();
/*-----------------------------------------
|
| CLASE PARA GENERAR LOS PDF
|-------------------------------------------*/
class PDF extends FPDF
{
  var $widths;
  var $aligns;
  var $disciplina;

  function SetWidths($w)
  {
      //Set the array of column widths
      $this->widths=$w;
  }

  function SetAligns($a)
  {
      //Set the array of column alignments
      $this->aligns=$a;
  }

  function Row($data)
  {
      //Calculate the height of the row
      $nb=0;
      for($i=0;$i<count($data);$i++)
          $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
      $h=5*$nb;
      //Issue a page break first if needed
      $this->CheckPageBreak($h);
      //Draw the cells of the row
      for($i=0;$i<count($data);$i++)
      {
          $w=$this->widths[$i];
          $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
          //Save the current position
          $x=$this->GetX();
          $y=$this->GetY();
          //Draw the border
          $this->Rect($x,$y,$w,$h);
          //Print the text
          $this->MultiCell($w,5,$data[$i],0,$a);
          //Put the position to the right of the cell
          $this->SetXY($x+$w,$y);
      }
      //Go to the next line
      $this->Ln($h);
  }
  function RowNoBorder($data)
  {
      //Calculate the height of the row
      $nb=0;
      for($i=0;$i<count($data);$i++)
          $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
      $h=5*$nb;
      //Issue a page break first if needed
      $this->CheckPageBreak($h);
      //Draw the cells of the row
      for($i=0;$i<count($data);$i++)
      {
          $w=$this->widths[$i];
          $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
          //Save the current position
          $x=$this->GetX();
          $y=$this->GetY();
          //Draw the border
          //$this->Rect($x,$y,$w,$h);
          //Print the text
          $this->MultiCell($w,5,$data[$i],0,$a);
          //Put the position to the right of the cell
          $this->SetXY($x+$w,$y);
      }
      //Go to the next line
      $this->Ln($h);
  }
  function CheckPageBreak($h)
  {
      //If the height h would cause an overflow, add a new page immediately
      if($this->GetY()+$h>$this->PageBreakTrigger)
          $this->AddPage($this->CurOrientation);
  }

  function NbLines($w,$txt)
  {
      //Computes the number of lines a MultiCell of width w will take
      $cw=&$this->CurrentFont['cw'];
      if($w==0)
          $w=$this->w-$this->rMargin-$this->x;
      $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
      $s=str_replace("\r",'',$txt);
      $nb=strlen($s);
      if($nb>0 and $s[$nb-1]=="\n")
          $nb--;
      $sep=-1;
      $i=0;
      $j=0;
      $l=0;
      $nl=1;
      while($i<$nb)
      {
          $c=$s[$i];
          if($c=="\n")
          {
              $i++;
              $sep=-1;
              $j=$i;
              $l=0;
              $nl++;
              continue;
          }
          if($c==' ')
              $sep=$i;
          $l+=$cw[$c];
          if($l>$wmax)
          {
              if($sep==-1)
              {
                  if($i==$j)
                      $i++;
              }
              else
                  $i=$sep+1;
              $sep=-1;
              $j=$i;
              $l=0;
              $nl++;
          }
          else
              $i++;
      }
      return $nl;
    }
  function header(){
    $this->SetFont('Arial','B',10);
    $w = array(150,157);
    $a = array('L','R');
    $this->SetWidths($w);
    $this->SetAligns($a);
    $header = array(
      $this->Image('../../Assets/img/PDVSAlogo.png',10,10,100,20),
      ''//$this->PageNo()."/{nb}"
    );
    $this->RowNoBorder($header);
    $this->SetFont('Arial','B',24);
    $this->Multicell(0,10,utf8_decode('Reporte de registros según su'),'','C');
    $this->Multicell(0,5,utf8_decode('fase y disciplina'),'','C');
    $this->SetFont('Arial','B',10);
    $this->Ln();$this->Ln();$this->Ln();
    if ($this->disciplina != 'N/A') {
      $this->SetFont('Arial','BU',10);
      $this->MultiCell(0,5,$this->disciplina);
      $this->Ln();
      $this->header_table();
    }
    else{
      $this->SetFont('Arial','BU',10);
      $this->MultiCell(0,5,"Leyenda");
      $this->Ln();
    }

  }
  function setDisiciplina($disc){
    $this->disciplina = $disc;
  }

  function header_table(){
    $this->SetFont('Arial','B',10);
    $w = array(48,120,10,22,45,16,35,30);
    unset($this->aligns);
    $this->SetAligns(['C','C','C','C','C','C','C','C']);
    $this->SetWidths($w);
    $row = array(
      'Cod. PDVSA',
      utf8_decode('Descripción'),
      'REV',
      'Fecha',
      'Cod. Cliente',
      'Status',
      'Disciplina',
      'Fase'
    );
    $this->Row($row);
    unset($this->aligns);
  }

  function footer()
  {
    
    $this->SetFont('Arial','B',10);
    $this->SetY(200);
    $this->Cell(160,5,$this->PageNo()."/{nb}",0,0,'R');
    /*$this->Cell(150,5,"Usuario: ". $_SESSION['nombre'],0,0,'R');
    $this->Ln();
    $this->Cell(160,5,"",0,0,'R');
    $this->Cell(150,5,date('d-m-Y'),0,0,'R');*/
    
  }

}
/*----------------------------------------
|
| SELECCION DE TODAS LAS DISCIPLINAS
|----------------------------------------*/
//
$sql_disciplinas = "SELECT * from disciplina ORDER BY disciplina ASC";
$disciplinas = $mysqli->query($sql_disciplinas);
/*-----------------------------------------
|
|SELECCION DE LOS REGISTROS DE LA LISTA MAESTRA
|             STATUS=ACTIVO
|-------------------------------------------*/
$sql = "SELECT  codpdvsa,descripcion,rev,
  fecha_rev as fecha,codcliente as CodCliente,status,disciplina,fases
  FROM registros_total WHERE status ='ACTIVO' and ORDER BY disciplina ASC";

$query = $mysqli->query($sql);
/*-----------------------------------------
|
|   GENERANDO PDF DE LA LISTA MAESTRA
|-------------------------------------------*/
$pdf = new PDF('L','mm','LEGAL');
$pdf->AliasNbPages();

while ($disciplina = $disciplinas->fetch_array()) {
  $pdf->setDisiciplina($disciplina[0]);
  $pdf->AddPage();
  $pdf->SetFont('Arial','',10);

  /*-----------------------------------------
  |
  |SELECCION DE LOS REGISTROS DE LA LISTA MAESTRA
  |             STATUS=ACTIVO
  |-------------------------------------------*/
  $sql = "SELECT  codpdvsa,descripcion,rev,
    fecha_rev as fecha,codcliente as CodCliente,status,disciplina, fases.fase as fases
    FROM registros_total, fases WHERE  registros_total.fases = fases.codigo and status ='ACTIVO' and  disciplina ='".$disciplina[1]."' ORDER BY disciplina ASC";

  $registros = $mysqli->query($sql);

  while ($registro = $registros->fetch_object()) {

    $w = array(48,120,10,22,45,16,35,30);
    $pdf->SetWidths($w);
    //FORMATEANDO FECHA
    if (!is_null($registro->fecha)) {
      $fecha = new DateTime($registro->fecha);
      $fecha = $fecha->format('d-m-Y');
    }
    else
      $fecha = '';

    $pdf->SetFont('Arial','',8);
    $row = array(
      $registro->codpdvsa,
      $registro->descripcion,
      $registro->rev,
      $fecha,
      $registro->CodCliente,
      $registro->status,
      strtoupper($disciplina[0]),
      $registro->fases,
    );
    $pdf->Row($row);
  }

}

/*----------------------------------------------
| Generando leyenda
|
| Nombre de disciplina # Registros
|                      # de registros por fase
|
|-----------------------------------------------*/
$pdf->setDisiciplina('N/A');
$pdf->AddPage();

$sql_disciplinas = "SELECT * from disciplina ORDER BY disciplina ASC";
$disciplinas = $mysqli->query($sql_disciplinas);
$w = array(20,20,20);
$pdf->SetWidths($w);


while ($d = $disciplinas->fetch_object()) {
  $pdf->setDisiciplina('N/A');

  /*-----------------------------
  |   DISCIPLINA
  |-----------------------------*/
  $pdf->SetFont('Arial','BU',12);
  $pdf->MultiCell(0,7,$d->disciplina);
  $pdf->SetFont('Arial','',10);
  /*-----------------------------
  |   CANTIDAD DE REGISTROS ACTIVOS SEGUN SU FASE
  |-----------------------------*/
  $sql_fases = "SELECT * FROM fases";
  $fases_query = $mysqli->query($sql_fases);


    while ($f = $fases_query->fetch_array()) {
      $sql = "SELECT count(id) FROM registros_total WHERE disciplina = '$d->simbolo' and fases = '$f[0]' and status = 'ACTIVO'";
      $num_fases = $mysqli->query($sql);
      $num = $num_fases->fetch_array();
      $pdf->Cell(50,5,$f[1].': '.$num[0]);
    }
    $pdf->Ln();
  /*-----------------------------
  |   CANTIDAD DE REGISTROS ACTIVOS SEGUN LA DISCIPLINA
  |-----------------------------*/
  $sql1 = "SELECT id FROM registros_total where disciplina = '$d->simbolo' and status = 'ACTIVO'";
  $result = $mysqli->query($sql1);
  $pdf->SetFont('Arial','B',10);
  $pdf->MultiCell(0,5,'Total: '.$result->num_rows);
  $pdf->Ln();



}
$pdf->SetXY(120,180);
$pdf->Cell(0,5,"Usuario: ". $_SESSION['nombre'],0,0,'R');
$pdf->Ln();
$pdf->Cell(160,5,"",0,0,'R');
$pdf->Cell(0,5,date('d-m-Y'),0,0,'R');
$pdf->Output();

?>
