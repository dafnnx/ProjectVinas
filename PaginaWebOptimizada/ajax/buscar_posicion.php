<?php
 require_once ("../cn/connect2.php");
 	$ideds =$_POST['ideds'];
 	$nomedifs =$_POST['nomedifs'];
 	$idpis =$_POST['idpis'];
 	$nompis =$_POST['nompis']; 
  $today= date('Y-m-d');  ?>
<div class="captitle">
  <div class="capname"></div>
  <div class="capupp">Closet</div>
  <div class="capupp fl20">Surtir 
 <?php
    $eq=$db2->prepare("SELECT COUNT(*) AS sday FROM dayscant WHERE fecha_days=:td");
    $eq->bindParam(':td', $today);
    $eq->execute();
    for($i=0; $row = $eq->fetch(); $i++){   $sday=$row['sday'];    }

    if ($sday>0) {
        $qey=$db2->prepare("SELECT num_days AS numd FROM dayscant WHERE fecha_days=:td");
        $qey->bindParam(':td', $today);
        $qey->execute();
    for($i=0; $row = $qey->fetch(); $i++){ $numd=$row['numd'];   }  } ?>

    <select class="nputs" onchange="set_days(this.value);" id="surdays">
      <option value="<?php echo $numd;?>" selected><?php echo $numd;?></option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
      <option value="10">10</option>
    </select> días
  </div>
</div> 
 <?php	
  include("posi_titulos.php");
	$coun= $db2->prepare("SELECT DISTINCT apodo_residente AS apr, id_residente AS idr FROM residentes WHERE SUBSTRING_INDEX(cama_residente, '-', 1)=:nomedifs AND SUBSTRING_INDEX(SUBSTRING_INDEX(cama_residente, '-', 2), '-', -1)=:nompis");
    $coun->bindParam(':nomedifs', $nomedifs);
    $coun->bindParam(':nompis', $nompis);
    $coun->execute();
    for($i=0; $row = $coun->fetch(); $i++){    
      $nomres = $row['apr'];
      $idres = $row['idr'];	?>
    <div class="capture">
    	<div class="capname h100per">
        <div class="divsave">
        <div onclick="mdlhisto(modhisto, 'histoclose', <?php echo $idres;?>)"><?php echo $nomres; ?></div>
        </div>
        <div class="tblres">
  <?php
    $qe=$db2->prepare("SELECT COUNT(*) AS nrc FROM closet WHERE id_residente=:id AND fecha_closet=:td");
    $qe->bindParam(':id', $idres);
    $qe->bindParam(':td', $today);
    $qe->execute();
    for($i=0; $row = $qe->fetch(); $i++){   $nrc=$row['nrc'];    }

      if ($nrc>0) {
        $query=$db2->prepare("SELECT * FROM closet WHERE id_residente=:id AND fecha_closet=:td");
    $query->bindParam(':id', $idres);
    $query->bindParam(':td', $today);
    $query->execute();
    for($i=0; $row = $query->fetch(); $i++){ ?>
      <input class="indivcl" id="<?php echo $idres;?>-ashow" value="<?php echo  $row['ptiras_closet'];?>" readonly>
      <input class="indivcl" id="<?php echo $idres;?>-bshow" value="<?php echo  $row['pcalz_closet'];?>" readonly>
      <input class="indivcl" id="<?php echo $idres;?>-cshow" value="<?php echo  $row['toallsan_closet'];?>" readonly>
      <input class="indivcl" id="<?php echo $idres;?>-dshow" value="<?php echo  $row['aposito_closet'];?>" readonly>
      <input class="indivcl" id="<?php echo $idres;?>-eshow" value="<?php echo  $row['pre_closet'];?>" readonly>
  <?php   } }
  else { ?>
      <input class="indivcl" id="<?php echo $idres;?>-ashow" value="0" readonly>
      <input class="indivcl" id="<?php echo $idres;?>-bshow" value="0" readonly>
      <input class="indivcl" id="<?php echo $idres;?>-cshow" value="0" readonly>
      <input class="indivcl" id="<?php echo $idres;?>-dshow" value="0" readonly>
      <input class="indivcl" id="<?php echo $idres;?>-eshow" value="0" readonly>

<?php   }  ?>    
      </div>
      <div class="tblres">
  <?php
    $qe2=$db2->prepare("SELECT COUNT(*) AS nrs FROM surtir WHERE id_residente=:id AND fecha_surtir=:td");
    $qe2->bindParam(':id', $idres);
    $qe2->bindParam(':td', $today);
    $qe2->execute();
    for($i=0; $row = $qe2->fetch(); $i++){   $nrs=$row['nrs'];    }

      if ($nrs>0) {
        $query=$db2->prepare("SELECT * FROM surtir WHERE id_residente=:id AND fecha_surtir=:td");
    $query->bindParam(':id', $idres);
    $query->bindParam(':td', $today);
    $query->execute();
    for($i=0; $row = $query->fetch(); $i++){ ?>
      <input class="indivcl" id="<?php echo $idres;?>-vshow" value="<?php echo  $row['ptiras_surtir'];?>" readonly>
      <input class="indivcl" id="<?php echo $idres;?>-wshow" value="<?php echo  $row['pcalz_surtir'];?>" readonly>
      <input class="indivcl" id="<?php echo $idres;?>-xshow" value="<?php echo  $row['toallsan_surtir'];?>" readonly>
      <input class="indivcl" id="<?php echo $idres;?>-yshow" value="<?php echo  $row['aposito_surtir'];?>" readonly>
      <input class="indivcl" id="<?php echo $idres;?>-zshow" value="<?php echo  $row['pre_surtir'];?>" readonly>
  <?php   } }
  else { ?>
      <input class="indivcl" id="<?php echo $idres;?>-vshow" value="0" readonly>
      <input class="indivcl" id="<?php echo $idres;?>-wshow" value="0" readonly>
      <input class="indivcl" id="<?php echo $idres;?>-xshow" value="0" readonly>
      <input class="indivcl" id="<?php echo $idres;?>-yshow" value="0" readonly>
      <input class="indivcl" id="<?php echo $idres;?>-zshow" value="0" readonly>

<?php   }  ?>    
      </div>
      <div class="tblres">
        <?php
    $qe2=$db2->prepare("SELECT COUNT(*) AS nrs FROM dayresult WHERE id_residente=:id AND fecha_result=:td");
    $qe2->bindParam(':id', $idres);
    $qe2->bindParam(':td', $today);
    $qe2->execute();
    for($i=0; $row = $qe2->fetch(); $i++){   $nrs=$row['nrs'];    }

      if ($nrs>0) {
        $query=$db2->prepare("SELECT * FROM dayresult WHERE id_residente=:id AND fecha_result=:td");
    $query->bindParam(':id', $idres);
    $query->bindParam(':td', $today);
    $query->execute();
    for($i=0; $row = $query->fetch(); $i++){ ?>
      <input class="indivcl fwei6" id="<?php echo $idres;?>-vres" value="<?php echo  $row['ptiras_result'];?>" readonly>
      <input class="indivcl fwei6" id="<?php echo $idres;?>-wres" value="<?php echo  $row['pcalz_result'];?>" readonly>
      <input class="indivcl fwei6" id="<?php echo $idres;?>-xres" value="<?php echo  $row['toallsan_result'];?>" readonly>
      <input class="indivcl fwei6" id="<?php echo $idres;?>-yres" value="<?php echo  $row['aposito_result'];?>" readonly>
      <input class="indivcl fwei6" id="<?php echo $idres;?>-zres" value="<?php echo  $row['pre_result'];?>" readonly>
  <?php   } }
  else { ?>
      <input class="indivcl fwei6" id="<?php echo $idres;?>-vres" value="0" readonly>
      <input class="indivcl fwei6" id="<?php echo $idres;?>-wres" value="0" readonly>
      <input class="indivcl fwei6" id="<?php echo $idres;?>-xres" value="0" readonly>
      <input class="indivcl fwei6" id="<?php echo $idres;?>-yres" value="0" readonly>
      <input class="indivcl fwei6" id="<?php echo $idres;?>-zres" value="0" readonly>

<?php   }  ?>  
      </div>
        <input class="divsave" placeholder="Vacio">
    	</div>

<?php  
include("closet.php");
include("mid.php");
include("surtir.php"); ?>
    </div>
<?php	}
    if ($nompis=="Planta Baja") {	
include("adds.php");
      } else {	}  ?> 
<script type="text/javascript" src="js/selector.js"></script>
<?php include ("modal_histo.php"); ?>