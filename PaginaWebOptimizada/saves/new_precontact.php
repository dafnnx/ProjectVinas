<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['resic_cont'];
	$ba= date('Y-m-d');
	$ca= $_POST['nombre_contacto'];
	$da= $_POST['parent_contacto'];	
	$ea= $_POST['fnac_contacto'];
	$fa= $_POST['edad_contacto'];
	$ga= $_POST['dir_contacto'];
	$ha= $_POST['mpo_contacto'];
	$ia= $_POST['cp_contacto'];
	$ja= $_POST['tela_contacto'];
	$ka= $_POST['telb_contacto'];
	$la= $_POST['telc_contacto'];
	$ma= $_POST['mail_contacto'];
	$na= $_POST['user_id'];
$sql2 = "INSERT INTO contactos (id_prospecto, alta_contacto, nombre_contacto, parent_contacto, fnac_contacto, edad_contacto, dir_contacto, mpo_contacto, cp_contacto, tela_contacto, telb_contacto, telc_contacto, mail_contacto, user_id) VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i, :j, :k, :l, :m, :n)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$aa,':b'=>$ba,':c'=>$ca,':d'=>$da,':e'=>$ea,':f'=>$fa,':g'=>$ga,':h'=>$ha,':i'=>$ia,':j'=>$ja,':k'=>$ka,':l'=>$la,':m'=>$ma,':n'=>$na));
if($sav)
 { echo "$aa"; } 
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
?>