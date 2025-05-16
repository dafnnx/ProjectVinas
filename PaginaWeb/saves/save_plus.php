<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['targ'];
	$ba= $_POST['result'];	
	$ca= date('Y-m-d');
	$da= explode("-",$aa);
	$ea= $da[0];
	$fa= $da[1];
switch ($fa) {
	case 'a':		$ga="ptiras_closet";		break;
	case 'b':		$ga="pcalz_closet";			break;
	case 'c':		$ga="toallsan_closet";		break;
	case 'd':		$ga="aposito_closet";		break;
	case 'e':		$ga="pre_closet";			break;
}
	$coun= $db2->prepare("SELECT COUNT(*) AS numrows FROM closet WHERE id_residente=:idres AND fecha_closet=:fc");
    $coun->bindParam(':fc', $ca);
    $coun->bindParam(':idres', $ea);
    $coun->execute();
    for($i=0; $row = $coun->fetch(); $i++){   $numrows = $row['numrows'];	}
if ($numrows>0){
$sql2 = ("UPDATE closet SET $ga=$ba WHERE id_residente=$ea AND fecha_closet='$ca'");
$sav = $db2->prepare($sql2);
$sav->execute();
if($sav) {
	 echo "<span class='disponible'>Correcto.</span>";
  }  else   {   echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }
} else{
$sql2 = "INSERT INTO closet (id_residente, fecha_closet, $ga) VALUES (:a, :b, :c)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$ea,':b'=>$ca,':c'=>$ba));
if($sav)
 { echo "<span class='disponible'> Correcto.</span>"; }
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
}		?>