<?php 
require_once ("connect2.php"); 	
require_once ("../vendor/autoload.php");
$fec=date('Y-m-d');  
$fa =$_GET['fa'];
$fb =$_GET['fb'];
$idr =$_GET['idr'];

		$qery= $db2->prepare("SELECT nombre_residente AS nr from residentes WHERE id_residente=$idr");
		$qery->execute();	
				for($i=2; $row = $qery->fetch(); $i++){ $nr=$row['nr']; }

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
 
$spreadsheet = new Spreadsheet();
$Excel_writer = new Csv($spreadsheet);
 
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet();
 
$activeSheet->setCellValue('A1', 'TICKET');
$activeSheet->setCellValue('B1', 'FECHA');
$activeSheet->setCellValue('C1', 'CONCEPTO');
$activeSheet->setCellValue('D1', 'CANTIDAD');
$activeSheet->setCellValue('E1', 'TOTAL');
		$query= $db2->prepare("SELECT * FROM payconcept WHERE (fecha_pay BETWEEN :fin AND :ffi) AND id_residente=$idr AND status=2");
		$query->bindParam(':fin', $fa);
		$query->bindParam(':ffi', $fb);
		$query->execute();	
				for($i=2; $row = $query->fetch(); $i++){
						$id_venta=$row['sale_id'];
						$fecha=$row['fecha_pay'];
						$concepto=$row['concept_pay'];
						$qty=$row['cantidad_pay'];	
						$debe=$row['debe_pay'];	
	$activeSheet->setCellValue('A'.$i , $id_venta);		
	$activeSheet->setCellValue('B'.$i , $fecha); 
	$activeSheet->setCellValue('C'.$i , $concepto);   
	$activeSheet->setCellValue('D'.$i , $qty);		 
	$activeSheet->setCellValue('E'.$i , $debe);	
}

$amount = $db2->prepare("SELECT sum(debe_pay) as am FROM payconcept WHERE (fecha_pay BETWEEN :fin AND :ffi)  AND id_residente=$idr AND status=2");
			$amount->bindParam(':fin', $fa);
			$amount->bindParam(':ffi', $fb);
   			$amount->execute();  
   			for($i=2; $row = $amount->fetch(); $i++){ 	
   			$activeSheet->setCellValue('F'.$i , $row['am']);}

$filename = 'Conceptos '.$nr.' del '.$fa.' al '.$fb.'.csv';
 
header('Content-Type: application/text-csv');
header('Content-Disposition: attachment;filename='. $filename);
header('Cache-Control: max-age=0');
$Excel_writer->save('php://output');
?>