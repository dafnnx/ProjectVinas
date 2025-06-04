<?php	
require_once ("../cn/connect2.php"); 	
		 $ta =$_POST['ta']; 
		 $fc =$_POST['fc']; 
		 $fr =$_POST['fr']; 
		 $sat =$_POST['sat']; 
		 $temp =$_POST['temp']; 
		 $gli =$_POST['gli']; 
		 $per =$_POST['percen_ing']; 
		 $can =$_POST['cant_liq']; 
		 $nom =$_POST['no_mic']; 
		 $noe =$_POST['no_evac']; 
		 $nop =$_POST['no_panal']; 
		 $vis =$_POST['visita']; 
		 $cai =$_POST['caida']; 
		 $dea =$_POST['deam']; 
		 $ban =$_POST['bano']; 
		 $buc =$_POST['bucal']; 
		 $ter =$_POST['terap']; 
		 $ori =$_POST['orient']; 
		 $q1 =$_POST['fi']; 
         $q2 =$_POST['ff']; 
         $q3 =$_POST['f3']; 
			$count_query= $db2->prepare("SELECT count(*) AS numrows FROM nota_enfermeria WHERE id_residente=:idr AND (fec_notaenfer BETWEEN :fin AND :ffi)");
			$count_query->bindParam(':idr', $q3);
			$count_query->bindParam(':fin', $q1);
			$count_query->bindParam(':ffi', $q2);
			$count_query->execute();
			for($i=0; $row = $count_query->fetch(); $i++){
			$numrows = $row['numrows'];}
if ($numrows>0){
   				
		$query= $db2->prepare("SELECT * FROM nota_enfermeria WHERE id_residente=:idr AND(fec_notaenfer BETWEEN :fin AND :ffi) ORDER BY fec_notaenfer ASC");
		$query->bindParam(':idr', $q3);
		$query->bindParam(':fin', $q1);
		$query->bindParam(':ffi', $q2);
		$query->execute();	
include ("xenferfecha.php"); 	
}	?>

<a href="reportes/exp_signos.php?idr=<?php echo $q3;?>&q1=<?php echo $q1;?>&q2=<?php echo $q2;?>&ta=<?php echo $ta;?>&fc=<?php echo $fc;?>&fr=<?php echo $fr;?>&sat=<?php echo $sat;?>&temp=<?php echo $temp;?>&gli=<?php echo $gli;?>&per=<?php echo $per;?>&can=<?php echo $can;?>&nom=<?php echo $nom;?>&noe=<?php echo $noe;?>&nop=<?php echo $nop;?>&vis=<?php echo $vis;?>&cai=<?php echo $cai;?>&dea=<?php echo $dea;?>&ban=<?php echo $ban;?>&buc=<?php echo $buc;?>&ter=<?php echo $ter;?>&ori=<?php echo $ori;?>"><div class="nputsave"> Generar PDF</div></a>