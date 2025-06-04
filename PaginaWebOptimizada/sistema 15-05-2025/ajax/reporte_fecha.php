<?php	
require_once ("../cn/connect2.php"); 	
		 $q1 =$_POST['q1']; 
         $q2 =$_POST['q2']; 
         $idr =$_POST['idr']; 
			$count_query= $db2->prepare("SELECT count(*) AS numrows FROM payconcept WHERE (fecha_pay BETWEEN :fin AND :ffi) AND id_residente=$idr AND status=2");
			$count_query->bindParam(':fin', $q1);
			$count_query->bindParam(':ffi', $q2);
			$count_query->execute();
			for($i=0; $row = $count_query->fetch(); $i++){
			$numrows = $row['numrows'];}
if ($numrows>0){
   				
		$query= $db2->prepare("SELECT * FROM payconcept WHERE (fecha_pay BETWEEN :fin AND :ffi) AND id_residente=$idr AND status=2 ORDER BY fecha_pay ASC");
		$query->bindParam(':fin', $q1);
		$query->bindParam(':ffi', $q2);
		$query->execute();	
include ("fecha.php"); 	
}	
	?>
	
<!--  <a href="ajax/ventas/exvtasfecha.php?fa=<?php echo $q1?>&fb=<?php echo $q2?>&idr=<?php echo $idr?>" target="_blank" ><div class="nputsave"> Generar Excel</div></a>  -->