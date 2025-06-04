<?php 
 require_once ("../cn/connect2.php");
$idr= $_POST['idr'];
$rid= $_POST['rid'];
    $_qry= $db2->prepare("SELECT nombre_ropa AS nom_r FROM ropa_residente WHERE id_rresidente=:idr");
    $_qry->bindParam(':idr', $idr);
    $_qry->execute();
    for($i=0; $row = $_qry->fetch(); $i++){  $nom_r = $row['nom_r'];  }  ?>
<div class="textcenter"> 
  Dar de baja <strong><?php echo $nom_r; ?></strong>:</br></br>
  <input type="text" class="nputs stabtn" name="motivo_ense_single" placeholder="Motivo de salida" >
  <div class="separator"></div>
  <input type="text" class="nputs stabtn" name="persona_ense_single" placeholder="Persona" >
  <div class="separator"></div>
<div class="nputsave stabtn" onclick="enseres_sta_single('<?php echo $idr; ?>', '<?php echo $rid; ?>');">Aceptar</div>
</br>
 </div>
  <div class="separator"></div>
 <div class="sendans" id="ensedown_answ"></div>
</div>
<script type="text/javascript" src="js/utils.js"></script>