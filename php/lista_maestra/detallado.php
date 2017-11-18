<?php 
include('../recursos/fpdf/fpdf.php');
include("../../conexion/conexion.php");
session_start();

$id = $_GET['id'];

/**
* 
*/
class PDF extends FPDF
{
	var $widths;
  	var $aligns;

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
    	$this->SetFont('Arial','B',20);
    	$this->Image('../../Assets/img/PDVSAlogo.png',5,10,60,20);
    	$this->Ln();
		  $this->Multicell(0,20,'Registro detallado','','C');
		  $this->Ln();
  }
  function footer()
  {
    $this->SetFont('Arial','B',10);
    $this->SetY(200);
    $this->Cell(160,5,$this->PageNo()."/{nb}",0,0,'R');
    $this->Cell(150,5,"Usuario: ". $_SESSION['nombre'],0,0,'R');
    $this->Ln();
    $this->Cell(160,5,"",0,0,'R');
    $this->Cell(150,5,date('d-m-Y'),0,0,'R');
    
  }

	
}

$sql = "SELECT registros_total.codpdvsa, registros_total.descripcion, registros_total.rev, registros_total.fecha_rev, registros_total.status, disciplina.disciplina, fases.fase FROM registros_total, disciplina, fases WHERE registros_total.id='$id' AND registros_total.disciplina = disciplina.simbolo AND registros_total.fases = fases.codigo";
$query = $mysqli->query($sql);

$result = $query->fetch_array();



$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Arial','',10);

/**
| Codigo PDVSA | DB050702-XY1D3-GD19004 ACTUALIZADO | Descripcion: | DESIGN BASIS AND CRITERIA |
|
*/
$pdf->SetWidths([
	'40',
	'140',
	
]);
$pdf->SetAligns(['C','C']);
$pdf->Row([
	'Codigo PDVSA:',
	$result['codpdvsa']
]);
$pdf->SetWidths([
	'40',
	'140',
	
]);
$pdf->SetAligns(['C','C']);
$pdf->Row([
	'Descripcion:',
	$result['descripcion']
]);

/**
| FASE | zxc | 
|
*/
$pdf->SetWidths([
	'40',
	'140',
]);
$pdf->SetAligns(['C','C']);
$pdf->Row([
	'Fase:',
	$result['fase'],
]);
/**
| Disciplina: | asd |
|
*/
$pdf->SetWidths([
	'40',
	'140',
]);
$pdf->SetAligns(['C','C']);
$pdf->Row([
	'Disciplina:',
	$result['disciplina']
]);
/**
| Rev | 1 | Fecha de Rev: | 1/11/2017 | Status: | ACTIVO
|
*/
$pdf->SetWidths([
	'20',
	'20',
	'35',
	'40',
	'25',
	'40'
]);
$pdf->SetAligns([
	'C',
	'C',
	'C',
	'C',
	'C',
	'C'
]);
$pdf->Row([
	'Rev:',
	$result['rev'],
	'Fecha:',
	date('d/m/Y',strtotime($result['fecha_rev'])),
	'Estatus:',
	$result['status']
]);
$pdf->output();
 ?>