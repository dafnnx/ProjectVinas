<?php
require_once ("../cn/connect2.php");	
$idRegistros = $_POST['ids_array'];
$sta = "baja";
$rid = $_POST['tgtrid'];
$mot = $_POST['mot'];
$per = $_POST['per'];
$fecbaja= date('d-m-Y');
foreach ($idRegistros as $Registro) {

	$result = $db2->prepare("UPDATE ropa_residente SET status_ropa='baja' WHERE id_rresidente= $Registro");
	$result->execute();


	try { $result;
if ($result) {
	$sql2 = "INSERT INTO hist_ropastatus (id_rresidente, status_ropastatus, motivo_ropastatus, fecha_ropastatus, persona_ropastatus) VALUES (:a, :b, :c, :d, :e)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$Registro,':b'=>$sta,':c'=>$mot,':d'=>$fecbaja,':e'=>$per));
} else { }
	 }
catch (PDOException $e) 
{
    echo 'Error: ' . $e->getMessage();
    exit();
}

} 

?>