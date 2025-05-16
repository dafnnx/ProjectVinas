<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['idr'];
      $ba= $_POST['idt'];
      $ca= $_POST['fec'];
      $da= $_POST['hr'];
      
$valhropt= $da."opt_hinv";
if ($valhropt) {
    $cry= $db2->prepare("SELECT $valhropt AS valopt FROM hist_inventarios WHERE id_residente=$aa AND id_tratamiento=$ba AND fech_hinv='$ca' ");
    $cry->execute();
    for($i=0; $row = $cry->fetch(); $i++){    $valopt = $row['valopt'];       }
    echo $valopt;             }           ?>