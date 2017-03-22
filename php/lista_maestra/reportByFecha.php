<?php
include('../recursos/fpdf/fpdf.php');
include("../../conexion/conexion.php");

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
      $this->PageNo()."/{nb}"
    );
    $this->RowNoBorder($header);
    $this->Ln();$this->Ln();$this->Ln();$this->Ln();
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
  }

}
$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
$sql = "SELECT
  registros_total.codpdvsa,
  registros_total.descripcion,
  registros_total.rev,
  registros_total.fecha_rev AS fecha,
  registros_total.codcliente AS CodCliente,
  registros_total.STATUS,
  disciplina.disciplina AS disciplina,
  registros_total.fases
FROM
  registros_total, disciplina
WHERE STATUS = 'ACTIVO' 
	AND fecha_rev >= '$desde' 
	AND fecha_rev <= '$hasta'
	AND registros_total.disciplina = disciplina.simbolo
ORDER BY
  registros_total.disciplina ASC";
  //echo $sql;
 $result = $mysqli->query($sql);

$pdf = new PDF('L','mm','LEGAL');
$pdf->SetFont('Arial','',12);
$pdf->AddPage();
$pdf->AliasNbPages();
$w = array(48,120,10,22,45,16,35,30);
$pdf->SetWidths($w);

//$result->fetch_object();

while ($registro = $result->fetch_object()) {

	
    $pdf->SetFont('Arial','',8);
    $fecha = new DateTime($registro->fecha);
    $fecha = $fecha->format('d-m-Y');
    $row = array(
      $registro->codpdvsa,
      $registro->descripcion,
      $registro->rev,
      $fecha,
      $registro->CodCliente,
      $registro->STATUS,
      strtoupper($registro->disciplina),
      $registro->fases,
    );
    $pdf->Row($row);
  }
  

$pdf->Output();
?>