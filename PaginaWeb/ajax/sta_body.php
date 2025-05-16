<?php 
 require_once ("../cn/connect2.php");
$rid= $_POST['rid'];
    $_qry= $db2->prepare("SELECT nombre_residente AS nom_r FROM residentes WHERE id_residente=:rid");
    $_qry->bindParam(':rid', $rid);
    $_qry->execute();
    for($i=0; $row = $_qry->fetch(); $i++){  $nom_r = $row['nom_r'];  }  ?>
<div class="textcenter"> 
  Dar de baja todos los enseres de:</br>
   <strong><?php echo $nom_r; ?></strong>
  </br>
  <input type="text" class="nputs stabtn" name="motivo_ense" placeholder="Motivo de salida" >
  <div class="separator"></div>
  <input type="text" class="nputs stabtn" name="persona_ense" placeholder="Persona" >
  <div class="separator"></div>
<div class="nputsave stabtn" onclick="enseres_sta('<?php echo $rid; ?>');">Aceptar</div>
</br>
 </div>
  <div class="separator"></div>
 <div class="sendans" id="ensedown_answ"></div>
</div>
<script type="text/javascript" src="js/utils.js"></script>