<?php $uid= $_POST['uid'];
$perid= $_POST['perid'];
require_once ("../cn/connect2.php");
$cy= $db2->prepare("SELECT count(*) AS nrs FROM residentes");
$cy->execute();
	for($i=0; $row = $cy->fetch(); $i++){	$nrs = $row['nrs'];	 }

$que1=$db2->prepare("SELECT count(*) AS bajs FROM hist_status WHERE status_status=1");
$que1->execute();	
	for($i=0; $row = $que1->fetch(); $i++){		$bajs= $row['bajs'];  }?>
<!DOCTYPE html>
<html>
<head>
</head>
	<body>
<div class="cntrls">
	<div class="upctrl">		
			<div class="icnsub pointer padd10 pac" title="Nuevo residente" id="res_nbtn" onclick="shownext('<?php echo $uid; ?>', '<?php echo $perid; ?>')"></div>	
			<div class="icnsub pointer padd10 sea" title="Buscar" id="res_sbtn" onclick="showresi('<?php echo $uid; ?>')"></div>
			<div class="icnsub pointer padd10 sea" title="Buscar" id="res_sbtn" onclick="showenseres('<?php echo $uid; ?>')"></div>	
			<div class="icnsub2">
				<div class="icnsub lbl textcenter" title="Total">Activos<br><?php echo $nrs; ?></div>
				<div class="icnsub lbl textcenter" title="Bajas">Bajas<br><?php echo $bajs; ?></div>
			</div>
	</div>
	<div class="downctrl">
		<div class="lbl new left">Nuevo</div>
		<div class="lbl new left">Buscar</div>
		<div class="lbl new left">Enser</div>	
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