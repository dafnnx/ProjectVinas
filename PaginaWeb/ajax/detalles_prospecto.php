<?php
	require_once ("../cn/connect2.php");	
        $rid =$_POST['id'];
        $uid =$_POST['uid'];
		$query=$db2->prepare("SELECT * FROM prospectos WHERE id_prospecto=:id");
		$query->bindParam(':id', $rid);
		$query->execute();	
				for($i=0; $row = $query->fetch(); $i++){
					$code= $row['id_prospecto'];
					$curp= $row['curp_prospecto'];
					$nss= $row['nss_prospecto'];
					$nombre= $row['nombre_prospecto'];
					$tipologia= $row['tipologia_prospecto'];
					$ecivil= $row['ecivil_prospecto'];
					$origen= $row['origen_prospecto'];
					$sexo= $row['sexo_prospecto'];
					$edad= $row['edad_prospecto'];
					$fnac= $row['fnac_prospecto'];					
          			$depen= $row['depen_prospecto'];
          			$img= $row['img_prospecto']; 
          			$area= $row['area_prospecto']; 
          			$seguimiento= $row['seguimiento_prospecto']; 
          			$tarifa= $row['tarifa_prospecto'];
          			$camina= $row['camina_prospecto'];
          			$come= $row['come_prospecto'];
          			$bana= $row['bana_prospecto'];
         			$viste= $row['viste_prospecto'];
         			$panales= $row['panales_prospecto'];
         			$observa= $row['observa_prospecto'];
         			$medio= $row['medio_prospecto'];
          			   }
require_once ("resipros1.php");
require_once ("resipros2.php"); ?>