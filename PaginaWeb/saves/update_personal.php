<?php
require_once ("../cn/connect2.php");
require_once("../libraries/password_compatibility_library.php");
	$id= $_POST['id_personal'];
	$ca= $_POST['nombre_personal'];
	$da= $_POST['sexo_personal'];
	$ea= $_POST['fnac_personal'];	
	$fa= $_POST['nss_personal'];
	$ga= $_POST['username_personal'];
	$ha= $_POST['ecivil_personal'];
	$ia= $_POST['ingreso_personal'];
	$ja= $_POST['curp_personal'];
	$ka= $_POST['mail_personal'];
	$la= $_POST['area_personal'];
	$ma= $_POST['origen_personal'];
	$na= $_POST['rfc_personal'];
	$oa= $_POST['edad_personal'];
if(isset($_POST["subarea_personal"]))
		{	$pa= $_POST['subarea_personal'];  }	
	$qa= $_POST['username_personal'];
	$pp= $_POST['pass_personal'];
if(isset($_POST["permisos_personal"]))
		{	$ra=implode(",",$_POST["permisos_personal"]);  }
	$pass = password_hash($pp, PASSWORD_DEFAULT);
	$ced= $_POST['cedula_personal'];
	$dat= date('Y-m-d');
	$tel= $_POST['tel_personal'];
$sql2 = "UPDATE personal SET nombre_personal='$ca', sexo_personal='$da', fnac_personal='$ea', nss_personal='$fa', username_personal='$ga', ecivil_personal='$ha', ingreso_personal='$ia', curp_personal='$ja', mail_personal='$ka', area_personal='$la', origen_personal='$ma', rfc_personal='$na', edad_personal='$oa', subarea_personal='$pa', permisos_personal='$ra', cedula_personal='$ced', tel_personal='$tel' WHERE id_personal=$id";
$sav = $db2->prepare($sql2);
$sav->execute();
if($sav) {
		$count_query= $db2->prepare("SELECT count(*) AS numrows FROM users WHERE id_personal=:id");
		$count_query->bindValue(':id', $id);
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){		$numrows = $row['numrows'];			}
if ($numrows>0){
	if ($pp>0) {
		$sl2 = "UPDATE users SET user_name='$qa', user_password_hash='$pass' WHERE id_personal=$id";
		$sav1 = $db2->prepare($sl2);
		$sav1->execute();	
				} else {
		$sl2 = "UPDATE users SET user_name='$qa' WHERE id_personal=$id";
		$sav1 = $db2->prepare($sl2);
		$sav1->execute();
							}	
		  } 
				else {	
		$sql3 = "INSERT INTO users (firstname, user_name, user_password_hash, date_added, id_personal) VALUES (:a, :b, :c, :d, :e)";
		$sav2 = $db2->prepare($sql3);
		$sav2->execute(array(':a'=>$id,':b'=>$ga,':c'=>$pass,':d'=>$dat,':e'=>$id));		}
		 }
			?>