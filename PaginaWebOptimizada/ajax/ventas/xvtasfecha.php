<?php 
require_once ("connect2.php"); 	
require_once ("../vendor/autoload.php");
$fec=date('Y-m-d');  
$fa =$_GET['fa'];
$fb =$_GET['fb'];
		$qery= $db2->prepare("SELECT nombre_residente AS nr from residentes WHERE id_residente=$idr");
		$qery->execute();	
				for($i=2; $row = $qery->fetch(); $i++){ $nr=$row['nr']; }

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
 
$spreadsheet = new Spreadsheet();
$Excel_writer = new Csv($spreadsheet);
 
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet();
 
$activeSheet->setCellValue('A1', 'Clave');
$activeSheet->setCellValue('B1', 'Cliente');
$activeSheet->setCellValue('C1', 'Fecha de elaboracion');
$activeSheet->setCellValue('D1', 'Numero de almacen cabecera');
$activeSheet->setCellValue('E1', 'Observaciones');
$activeSheet->setCellValue('F1', 'Clave de vendedor');
$activeSheet->setCellValue('G1', 'Su pedido');
$activeSheet->setCellValue('H1', 'Precio');
$activeSheet->setCellValue('I1', 'Desc. 1');
$activeSheet->setCellValue('J1', 'Desc. 2');
$activeSheet->setCellValue('K1', 'Desc. 3');
$activeSheet->setCellValue('L1', 'Comision');
$activeSheet->setCellValue('M1', 'Clave de esquema de impuestos');
$activeSheet->setCellValue('N1', 'Clave del articulo');
$activeSheet->setCellValue('O1', 'Cantidad');
$activeSheet->setCellValue('P1', 'I.E.P.S.');
$activeSheet->setCellValue('Q1', 'Impuesto 2');
$activeSheet->setCellValue('R1', 'Impuesto 3');
$activeSheet->setCellValue('S1', 'I.V.A.');
$activeSheet->setCellValue('T1', 'Numero de almacen partidas');
$activeSheet->setCellValue('U1', 'Observaciones de partida');
		$query= $db2->prepare("SELECT * FROM payconcept WHERE (fecha_pay BETWEEN :fin AND :ffi) AND status=2");
		$query->bindParam(':fin', $fa);
		$query->bindParam(':ffi', $fb);
		$query->execute();	
				for($i=2; $row = $query->fetch(); $i++){
						$id_pay=$row['id_pay'];
						$fecha=$row['fecha_pay'];
						$idconcepto=$row['idconcept_pay'];
						$concepto=$row['concept_pay'];
						$debe=$row['debe_pay'];
						$idr=$row['id_residente'];							
						$qty=$row['cantidad_pay'];
						$id_venta=$row['sale_id'];							
						$iva=$row['iva_pay'];	
						if ($iva) {  $debiv=$debe+$iva;  }
						else { $debiv= $debe;}
	$activeSheet->setCellValue('A'.$i , $id_pay);		
	$activeSheet->setCellValue('B'.$i , $idr); 
	$activeSheet->setCellValue('C'.$i , $fecha);   
	$activeSheet->setCellValue('D'.$i , "N/A");		 
	$activeSheet->setCellValue('E'.$i , "N/A");	
	$activeSheet->setCellValue('F'.$i , "N/A");		
	$activeSheet->setCellValue('G'.$i , "N/A"); 
	$activeSheet->setCellValue('H'.$i , $debe);   
	$activeSheet->setCellValue('I'.$i , "N/A");		 
	$activeSheet->setCellValue('J'.$i , "N/A");	
	$activeSheet->setCellValue('K'.$i , "N/A");		
	$activeSheet->setCellValue('L'.$i , "N/A"); 
	$activeSheet->setCellValue('M'.$i , "N/A");   
	$activeSheet->setCellValue('N'.$i , $concepto);		 
	$activeSheet->setCellValue('O'.$i , $qty);	
	$activeSheet->setCellValue('P'.$i , "N/A");		
	$activeSheet->setCellValue('Q'.$i , "N/A"); 
	$activeSheet->setCellValue('R'.$i , "N/A");   
	$activeSheet->setCellValue('S'.$i , $iva);		 
	$activeSheet->setCellValue('T'.$i , "N/A");	
	$activeSheet->setCellValue('U'.$i , "N/A");	
}

$filename = 'Conceptos '.$nr.' del '.$fa.' al '.$fb.'.csv';
 
header('Content-Type: application/text-csv');
header('Content-Disposition: attachment;filename='. $filename);
header('Cache-Control: max-age=0');
$Excel_writer->save('php://output');
?>