<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['targ'];
	$ba= $_POST['result'];	
	$ca= date('Y-m-d');
	$da= explode("-",$aa);
	$ea= $da[0];
	$fa= $da[1];
	$xa= $_POST['operafin'];
switch ($fa) {
	case 'v':		$ga="ptiras_result";		break;
	case 'w':		$ga="pcalz_result";			break;
	case 'x':		$ga="toallsan_result";		break;
	case 'y':		$ga="aposito_result";		break;
	case 'z':		$ga="pre_result";			break;
}
	$coun= $db2->prepare("SELECT COUNT(*) AS numrows FROM dayresult WHERE id_residente=:idres AND fecha_result=:fc");
    $coun->bindParam(':fc', $ca);
    $coun->bindParam(':idres', $ea);
    $coun->execute();
    for($i=0; $row = $coun->fetch(); $i++){   $numrows = $row['numrows'];	}
if ($numrows>0){
$sql2 = ("UPDATE dayresult SET $ga=$xa WHERE id_residente=$ea AND fecha_result='$ca'");
$sav = $db2->prepare($sql2);
$sav->execute();
if($sav) {
	 echo "<span class='disponible'>Correcto.</span>";
  }  else   {   echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }
} else{
$sql2 = "INSERT INTO dayresult (id_residente, fecha_result, $ga) VALUES (:a, :b, :c)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$ea,':b'=>$ca,':c'=>$xa));
if($sav)
 { echo "<span class='disponible'> Correcto.</span>"; }
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
}		?>