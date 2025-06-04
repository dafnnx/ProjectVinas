<?php
require_once ("../cn/connect2.php");
      $id= $_POST['id_iva'];
	$aa= $_POST['percent_ieps'];
      $ba= $_POST['app_ieps'];
      $ca= $_POST['percent_isr'];
      $da= $_POST['app_isr'];
      $ea= $_POST['percent_ret'];
      $fa= $_POST['app_ret'];
      $ga= $_POST['percent_iiva'];
      $ha= $_POST['app_iiva'];
$sql2 = "INSERT INTO ieps (id_iva, percent_ieps, app_ieps) VALUES (:a, :b, :c)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$id, ':b'=>$aa, ':c'=>$ba));

$sql2 = "INSERT INTO isr (id_iva, percent_isr, app_isr) VALUES (:a, :b, :c)";
$sav2 = $db2->prepare($sql2);
$sav2->execute(array(':a'=>$id, ':b'=>$ca, ':c'=>$da));

$sql2 = "INSERT INTO ret (id_iva, percent_ret, app_ret) VALUES (:a, :b, :c)";
$sav3 = $db2->prepare($sql2);
$sav3->execute(array(':a'=>$id, ':b'=>$ea, ':c'=>$fa));

$sql2 = "INSERT INTO iiva (id_iva, percent_iiva, app_iiva) VALUES (:a, :b, :c)";
$sav4 = $db2->prepare($sql2);
$sav4->execute(array(':a'=>$id, ':b'=>$ga, ':c'=>$ha));

?>