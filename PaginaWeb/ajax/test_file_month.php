<?php
	require_once ("../cn/connect2.php");
	$idpa= $_POST['idpa']; 
	$file = $idpa.".".pdf;
if (file_exists("../reportesmonth/".$file)) {	unlink("../reportesmonth/".$file);  }