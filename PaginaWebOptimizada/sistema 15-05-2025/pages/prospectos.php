<?php $uid= $_POST['uid'];
$perid= $_POST['perid'];?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
</head>
	<body>
<div class="cntrls">
	<div class="upctrl">		
			<div class="icnsub pointer padd10 pac" title="Nuevo prospecto" id="pros_nbtn" onclick="shownextpros('<?php echo $uid; ?>', '<?php echo $perid; ?>')"></div>	
			<div class="icnsub pointer padd10 sea" title="Buscar residentes" id="pros_sbtn" onclick="showpros('<?php echo $uid; ?>')"></div>
	</div>
	<div class="downctrl">
		<div class="lbl new left">Nuevo</div>
		<div class="lbl new left">Buscar</div>
	</div>
</div>
	<div class="contmargin" id="contmargin"></div>
	</body>
</html>

<?php
if ($uid=="1") {	}
else 	{	require_once ("../quotes11.php");  }
?>