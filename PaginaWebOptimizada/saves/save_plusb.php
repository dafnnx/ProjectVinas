<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['targ'];
	$ba= $_POST['result'];	
	$ca= date('Y-m-d');
	$da= explode("-",$aa);
	$ea= $da[0];
	$fa= $da[1];
	$xa= $_POST['opera'];
switch ($fa) {
	case 'v':		$ga="ptiras_surtir";		break;
	case 'w':		$ga="pcalz_surtir";			break;
	case 'x':		$ga="toallsan_surtir";		break;
	case 'y':		$ga="aposito_surtir";		break;
	case 'z':		$ga="pre_surtir";			break;
}
	$coun= $db2->prepare("SELECT COUNT(*) AS numrows FROM surtir WHERE id_residente=:idres AND fecha_surtir=:fc");
    $coun->bindParam(':fc', $ca);
    $coun->bindParam(':idres', $ea);
    $coun->execute();
    for($i=0; $row = $coun->fetch(); $i++){   $numrows = $row['numrows'];	}
if ($numrows>0){
$sql2 = ("UPDATE surtir SET $ga=$xa WHERE id_residente=$ea AND fecha_surtir='$ca'");
$sav = $db2->prepare($sql2);
$sav->execute();
if($sav) {
	 echo "<span class='disponible'>Correcto.</span>";
  }  else   {   echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }
} else{
$sql2 = "INSERT INTO surtir (id_residente, fecha_surtir, $ga) VALUES (:a, :b, :c)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$ea,':b'=>$ca,':c'=>$xa));
if($sav)
 { echo "<span class='disponible'> Correcto.</span>"; }
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
}		?>