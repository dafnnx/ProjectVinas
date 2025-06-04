<?php 
	  require_once ("../cn/connect2.php");
	  $idr= $_POST['idr'];	
	  $uid= $_POST['uid'];	  
	  	$query=$db2->prepare("SELECT * FROM residentes WHERE id_residente=:id");
		$query->bindParam(':id', $idr);
		$query->execute();	
				for($i=0; $row = $query->fetch(); $i++){
					$curp= $row['curp_residente'];
					$nss= $row['nss_residente'];
					$nombre= $row['nombre_residente'];
					$tipologia= $row['tipologia_residente'];
					$ecivil= $row['ecivil_residente'];
					$habitacion= $row['habitacion_residente'];
					$origen= $row['origen_residente'];
					$sexo= $row['sexo_residente'];
					$edad= $row['edad_residente'];
					$cama= $row['cama_residente'];
					$fnac= $row['fnac_residente'];
					$ingreso= $row['ingreso_residente'];
					$ultingreso= $row['ultingreso_residente'];
          			$apodo= $row['apodo_residente'];
          			$depen= $row['depen_residente'];
          			$img= $row['img_residente'];
        }
$fnmed = new DateTime($fnac);
$fmed = $fnmed->format("d-M-Y");
$fnmed2 = new DateTime($ingreso);
$fmed2 = $fnmed2->format("d-M-Y");
$fnmed3 = new DateTime($ultingreso);
$fmed3 = $fnmed3->format("d-M-Y");

$nt = $db2->prepare("SELECT area_personal AS areap FROM personal WHERE id_personal=(SELECT id_personal AS idp FROM users WHERE user_id=:uid)");
$nt->bindParam(':uid', $uid);
$nt->execute();  
for($i=0; $row = $nt->fetch(); $i++){    $areap=$row['areap'];    } ?>
<div class="gastosmain">
	<?php 
	include ("resihistless.php"); 
	?>
</div>