<?php	
require_once ("../cn/connect2.php"); 	
		 $q1 =$_POST['q1']; 
         $q2 =$_POST['q2']; 
			$count_query= $db2->prepare("SELECT count(*) AS numrows FROM payconcept WHERE (fecha_pay BETWEEN :fin AND :ffi) AND status=2");
			$count_query->bindParam(':fin', $q1);
			$count_query->bindParam(':ffi', $q2);
			$count_query->execute();
			for($i=0; $row = $count_query->fetch(); $i++){
			$numrows = $row['numrows'];}
if ($numrows>0){
			$amount = $db2->prepare("SELECT SUM(debe_pay) AS am, SUM(iva_pay) AS iv FROM payconcept WHERE (fecha_pay BETWEEN :fin AND :ffi) AND status=2");
			$amount->bindParam(':fin', $q1);
			$amount->bindParam(':ffi', $q2);
   			$amount->execute();  
   			for($i=0; $row = $amount->fetch(); $i++){ 
   				$subtot=$row['am'];
   				$iva=$row['iv']; 					}

   				if ($iva) {  $tot= $subtot+$iva;}
   				else {	$tot=$subtot; }
   				
		$query= $db2->prepare("SELECT * FROM payconcept WHERE (fecha_pay BETWEEN :fin AND :ffi) AND status=2");
		$query->bindParam(':fin', $q1);
		$query->bindParam(':ffi', $q2);
		$query->execute();	
include ("xfecha.php"); 	
}	
	?>
<a href="ajax/ventas/xvtasfecha.php?fa=<?php echo $q1?>&fb=<?php echo $q2?>" target="_blank" ><div class="nputsave"> Generar Excel</div></a>