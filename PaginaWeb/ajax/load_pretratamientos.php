<div class="infosub gral">
        <div class="trlimit">
<?php
 $rid= $_POST['nrid'];
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM tratamientos WHERE id_residente=:id AND status_tratamiento=2");
    $count_query->bindParam(':id', $rid);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM tratamientos WHERE id_residente=:id AND status_tratamiento=2");
    $query->bindParam(':id', $rid);
    $query->execute(); ?>
    <?php 
    if ($numrows>0){ 
 $j=1;
        for($i=0; $row = $query->fetch(); $i++){
          $idt= $row['id_tratamiento'];
          $fini= $row['fecha_ini'];
          $ffin= $row['fecha_fin'];  
          $medt= $row['med_tratamiento'];
          $viam= $row['via_medicamento'];
          $unim= $row['unidad_medicamento'];
          $semm= $row['semana_tratamiento'];
          if(isset($semm))
                {       $dias=explode(",",$semm);  }
          $varit= $row['variante_tratamiento'];
          $totl= $row['total_tratamiento'];
          $diat= $row['dia_tratamiento'];
          $siet= $row['siet_tratamiento'];
          $och= $row['och_tratamiento'];
          $trce= $row['trce_tratamiento'];
          $dieco= $row['dieco_tratamiento'];
          $vtuno= $row['vtuno_tratamiento'];
          $pauta= $row['pauta_tratamiento'];
          $observa= $row['observa_tratamiento'];
          $patolo= $row['patolo_tratamiento'];
          $tipom= $row['tipom_tratamiento'];
          $status= $row['status_tratamiento'];  

$finife = new DateTime($fini);
$finif = $finife->format("d-M-Y");

$ffinf = new DateTime($ffin);
$ffinef = $ffinf->format("d-M-Y");
               ?>
<div class="indind bgtbl tblline">
        <div class="indxm speciline">
                <?php echo $j++;  ?>
<div class="delpret" onclick="eliminarpret('<?php echo $idt; ?>', 'tratamientos', 'id_tratamiento', '<?php echo $rid; ?>');"></div>
  <!--              <select name="status_trata" class="nputs" onchange="sta_trata(this.value, '<?php echo $idt; ?>','<?php echo $rid; ?>');">
                        <option disabled selected><?php echo $status; ?></option>
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                </select>
   -->
        </div>
        <div class="indxmain">
<div class="tblspecialdat">
        <div class="speci1dat speciline"><?php echo $finif; ?></div>
        <div class="speci1dat speciline"><?php echo $ffinef; ?></div>
<?php
    $cy= $db2->prepare("SELECT nombre_medica AS nmed FROM medicamentos WHERE id_medica=:id");
    $cy->bindParam(':id', $medt);
    $cy->execute();
    for($i=0; $row = $cy->fetch(); $i++){
    $nmed = $row['nmed']; ?>

        <div class="speci2dat speciline"><?php echo $nmed; ?></div>
<?php } ?>
        <div class="speci3dat speciline"><input type="checkbox" <?php if (in_array("1", $dias)) echo "checked"; ?> onclick="javascript: return false;"></div>
        <div class="speci3dat speciline"><input type="checkbox" <?php if (in_array("2", $dias)) echo "checked"; ?> onclick="javascript: return false;"></div>
        <div class="speci3dat speciline"><input type="checkbox" <?php if (in_array("3", $dias)) echo "checked"; ?> onclick="javascript: return false;"></div>
        <div class="speci3dat speciline"><input type="checkbox" <?php if (in_array("4", $dias)) echo "checked"; ?> onclick="javascript: return false;"></div>
        <div class="speci3dat speciline"><input type="checkbox" <?php if (in_array("5", $dias)) echo "checked"; ?> onclick="javascript: return false;"></div>
        <div class="speci3dat speciline"><input type="checkbox" <?php if (in_array("6", $dias)) echo "checked"; ?> onclick="javascript: return false;"></div>
        <div class="speci3dat speciline"><input type="checkbox" <?php if (in_array("7", $dias)) echo "checked"; ?> onclick="javascript: return false;"></div>
        <div class="speci1dat speciline variantbtn" onclick="mdlvari(modvariant, 'variantclose', '<?php echo $varit; ?>')" title="<?php echo $varit; ?>"><?php echo $varit; ?></div>
        <div class="speci3dat speciline"><?php echo $diat; ?></div>
        <div class="speci3dat speciline"><?php echo $siet; ?></div>
        <div class="speci3dat speciline"><?php echo $och; ?></div>
        <div class="speci3dat speciline"><?php echo $trce; ?></div>
        <div class="speci3dat speciline"><?php echo $dieco; ?></div>
        <div class="speci3dat speciline"><?php echo $vtuno; ?></div>        
</div>
<div class="tblspecialdat">
        <div class="speci4dat speciline" title="<?php echo $observa; ?>"><?php echo $observa; ?></div>
        <div class="speci1dat speciline"><?php echo $pauta; ?></div>
        <div class="speci1dat speciline"><?php echo $tipom; ?></div>
<?php  
    $cy2= $db2->prepare("SELECT nombre_via AS nvia FROM vias WHERE id_via=:id");
    $cy2->bindParam(':id', $viam);
    $cy2->execute();
    for($i=0; $row = $cy2->fetch(); $i++){
$nvia = $row['nvia']; ?>
        <div class="speci1dat speciline"><?php echo $nvia; ?></div>
<?php }  
    $cy3= $db2->prepare("SELECT nombre_unidad AS nuni FROM unidades WHERE id_unidad=:id");
    $cy3->bindParam(':id', $unim);
    $cy3->execute();
    for($i=0; $row = $cy3->fetch(); $i++){
$nuni = $row['nuni']; ?>
        <div class="speci1dat speciline"><?php echo $nuni; ?></div>
<?php } ?>
        <div class="speci1dat speciline">Patología</div>
</div>
        </div>
                </div>
<?php } }
else {          } ?>
        </div>
</div>
<?php include ("modal_variant.php"); ?>
<script type="text/javascript">
function mdlvari(msta, mclo, vari){
        $('#variante_tratamiento').val(vari);
        var span = document.getElementById(mclo);
        msta.style.display = "block";
        span.onclick = function() {
        msta.style.display = "none";
}
}
</script>