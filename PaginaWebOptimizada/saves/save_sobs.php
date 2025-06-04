<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['idres'];
	$ba= $_POST['obs'];	
	$ca= date('Y-m-d');
	$coun= $db2->prepare("SELECT COUNT(*) AS numrows FROM surtir WHERE id_residente=:idres AND fecha_surtir=:fc");
    $coun->bindParam(':fc', $ca);
    $coun->bindParam(':idres', $aa);
    $coun->execute();
    for($i=0; $row = $coun->fetch(); $i++){   $numrows = $row['numrows'];	}
if ($numrows>0){
$sql2 = ("UPDATE surtir SET observa_surtir='$ba' WHERE id_residente=$aa");
$sav = $db2->prepare($sql2);
$sav->execute();
if($sav) {
	 echo "<span class='disponible'>Correcto.</span>";
  }  else   {   echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }
} else{
$sql2 = "INSERT INTO surtir (id_residente, fecha_surtir, observa_surtir) VALUES (:a, :b, :c)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$aa,':b'=>$ca,':c'=>$ba));
if($sav)
 { echo $ba; }
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
}		?>