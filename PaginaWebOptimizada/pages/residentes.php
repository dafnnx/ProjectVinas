<?php $uid= $_POST['uid'];
$perid= $_POST['perid'];
require_once ("../cn/connect2.php");
$cy= $db2->prepare("SELECT count(*) AS act FROM residentes WHERE status_residente=1");
$cy->execute();
	for($i=0; $row = $cy->fetch(); $i++){	$act = $row['act'];	 }
$cb= $db2->prepare("SELECT count(*) AS baj FROM residentes WHERE status_residente=2");
$cb->execute();
	for($i=0; $row = $cb->fetch(); $i++){	$baj = $row['baj'];	 }?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
</head>
	<body>
<div class="cntrls">
	<div class="upctrl">		
			<div class="icnsub pointer padd10 pac" title="Nuevo residente" id="res_nbtn" onclick="shownext('<?php echo $uid; ?>', '<?php echo $perid; ?>')"></div>	
			<div class="icnsub pointer padd10 sea" title="Buscar residentes" id="res_sbtn" onclick="showresi('<?php echo $uid; ?>')"></div>
			<div class="icnsub pointer padd10 sea" title="Buscar enseres" id="res_rbtn" onclick="showenseres('<?php echo $uid; ?>')"></div>	
			<div class="icnsub2">
				<div class="icnsub lbl textcenter" title="Total">Activos<br><?php echo $act; ?></div>
				<div class="icnsub lbl textcenter pointer" title="Bajas" id="res_bajas" onclick="showbajas('<?php echo $uid; ?>')">Bajas<br><?php echo $baj; ?></div>
			</div>
	</div>
	<div class="downctrl">
		<div class="lbl new left">Nuevo</div>
		<div class="lbl new left">Buscar</div>
		<div class="lbl new left">Enseres</div>	
		<div class="lbl new2 left">Información</div>	
	</div>
</div>
	<div class="contmargin" id="contmargin"></div>
	</body>
</html>

<?php
if ($uid=="1") {	}
else 	{	require_once ("../quotes.php");  }
?>