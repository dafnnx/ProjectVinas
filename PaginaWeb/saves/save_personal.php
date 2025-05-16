<?php
require_once ("../cn/connect2.php");
require_once("../libraries/password_compatibility_library.php");
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
	$qa= $_POST['user_id'];
	$pp= $_POST['pass_personal'];
if(isset($_POST["permisos_personal"]))
		{	$ra=implode(",",$_POST["permisos_personal"]);  }
	$pass = password_hash($pp, PASSWORD_DEFAULT);
	$ced = $_POST['cedula_personal'];
	$sta = "1";
	$tel = $_POST['tel_personal'];
$sql2 = "INSERT INTO personal (nombre_personal, sexo_personal, fnac_personal, nss_personal, username_personal, ecivil_personal, ingreso_personal, curp_personal, mail_personal, area_personal, origen_personal, rfc_personal, edad_personal, subarea_personal, user_id, permisos_personal, cedula_personal, status_personal, tel_personal) VALUES (:c, :d, :e, :f, :g, :h, :i, :j, :k, :l, :m, :n, :o, :p, :q, :r, :s, :t, :u)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':c'=>$ca,':d'=>$da,':e'=>$ea,':f'=>$fa,':g'=>$ga,':h'=>$ha,':i'=>$ia,':j'=>$ja,':k'=>$ka,':l'=>$la,':m'=>$ma,':n'=>$na,':o'=>$oa,':p'=>$pa ,':q'=>$qa,':r'=>$ra,':s'=>$ced,':t'=>$sta,':u'=>$tel));
if($sav) {
 $idp = $db2->lastInsertId(); 
 $dat= date('Y-m-d');	
		$sql3 = "INSERT INTO users (firstname, user_name, user_password_hash, date_added, id_personal) VALUES (:a, :b, :c, :d, :e)";
		$sav2 = $db2->prepare($sql3);
		$sav2->execute(array(':a'=>$idp,':b'=>$ga,':c'=>$pass,':d'=>$dat,':e'=>$idp));
echo $idp;
  }  else   {   echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }	?>

