<?php
	require_once ("../cn/connect2.php");	
        $rid =$_POST['id'];
        $uid =$_POST['uid'];
		$query=$db2->prepare("SELECT * FROM residentes WHERE id_residente=:id");
		$query->bindParam(':id', $rid);
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
          			$sae= $row['cte_sae'];
          			$tarifa= $row['tarifa_residente']; 
          			$alergia= $row['alergia_residente']; 
          			$patologia= $row['patologia_residente']; 
          			$rcp= $row['rcp_residente'];       }
require_once ("residet1.php");
require_once ("residet2.php");
require_once ("residet3.php");
require_once ("residet4.php");
require_once ("residet5.php"); ?>