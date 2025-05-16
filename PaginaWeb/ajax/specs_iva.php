<?php
$id=$_POST['id'];
$nom=$_POST['nom'];
	require_once ("../cn/connect2.php"); 	

	$q1=$db2->prepare("SELECT * FROM ieps WHERE id_iva=:id");
	$q1->bindParam(':id', $id);
    $q1->execute();
    for($i=0; $row = $q1->fetch(); $i++){
          $periep= $row['percent_ieps'];
          $appiep= $row['app_ieps'];
      }

    $q2=$db2->prepare("SELECT * FROM isr WHERE id_iva=:id");
	$q2->bindParam(':id', $id);
    $q2->execute();
    for($i=0; $row = $q2->fetch(); $i++){
          $perisr= $row['percent_isr'];
          $appisr= $row['app_isr'];
      }

    $q3=$db2->prepare("SELECT * FROM ret WHERE id_iva=:id");
	$q3->bindParam(':id', $id);
    $q3->execute();
    for($i=0; $row = $q3->fetch(); $i++){
          $perret= $row['percent_ret'];
          $appret= $row['app_ret'];
      }

    $q4=$db2->prepare("SELECT * FROM iiva WHERE id_iva=:id");
	$q4->bindParam(':id', $id);
    $q4->execute();
    for($i=0; $row = $q4->fetch(); $i++){
          $periiva= $row['percent_iiva'];
          $appiiva= $row['app_iiva'];
      }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="varsiva">
		<div class="minirbn"><?php echo $nom; ?></div>
			<div class="maxirbn" id="saveiva">
<input type="hidden" value="<?php echo $id; ?>" name="id_iva">	
				<div class="minirbn dflex">
						<div class="linepart"></div>
						<div class="linepart">Porcentaje</div>
						<div class="linepart">Aplica</div>
				</div>
				<div class="linex dflex">
						<div class="linepart2">I.E.P.S</div>
								<div class="linepart2">
									<input class="nputs w95per" name="percent_ieps" value="<?php echo $periep; ?>">
								</div>
						<div class="linepart2">
								<select class="nputs w95per"  name="app_ieps">
									<option disabled selected><?php echo $appiep; ?></option>
									<option>Precio base</option>
									<option>No aplica</option>
								</select>
						</div>
				</div>
				<div class="linex dflex">
						<div class="linepart2">ISR</div>
								<div class="linepart2">
									<input class="nputs w95per" name="percent_isr" value="<?php echo $perisr; ?>">
								</div>
						<div class="linepart2">
								<select class="nputs w95per" name="app_isr">
									<option disabled selected><?php echo $appisr; ?></option>
									<option>Precio base</option>
									<option>No aplica</option>
								</select>
						</div>
				</div>
				<div class="linex dflex">
						<div class="linepart2">RET. IVA</div>
								<div class="linepart2">
									<input class="nputs w95per" name="percent_ret" value="<?php echo $perret; ?>">
								</div>
						<div class="linepart2">
								<select class="nputs w95per" name="app_ret">
									<option disabled selected><?php echo $appret; ?></option>
									<option>Precio base</option>
									<option>No aplica</option>
								</select>
						</div>
				</div>
				<div class="linex dflex">
						<div class="linepart2">IVA</div>
								<div class="linepart2">
									<input class="nputs w95per" name="percent_iiva" value="<?php echo $periiva; ?>">
								</div>
						<div class="linepart2">
								<select class="nputs w95per" name="app_iiva">
									<option disabled selected><?php echo $appiiva; ?></option>
									<option>Precio base</option>
									<option>No aplica</option>
								</select>
						</div>
				</div>
				<div class="linex dflex">
				<button class="nputsave" onclick="upiva()">Guardar</button>
				</div>
			</div>
	</div>
</body>
</html>