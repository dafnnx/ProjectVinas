<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['idr'];
	$ba= $_POST['idt'];
	$ca= $_POST['fec'];
	$da= $_POST['hr'];
	$ea= $_POST['incv'];
	$fa= $_POST['vr'];

$tgt= $da.$fa."_hinv";

$sql2 = "UPDATE hist_inventarios SET $tgt='$ea' WHERE id_residente=$aa AND id_tratamiento=$ba AND fech_hinv='$ca' ";
$sav = $db2->prepare($sql2);
$sav->execute();	?>