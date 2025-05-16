                <div class="cmap overf">                      
<div class="infosub gral">
        <div class="trlimit">
<?php
 $rid= $_POST['nrid'];
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM tratamientos WHERE id_residente=:id");
    $count_query->bindParam(':id', $rid);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM tratamientos WHERE id_residente=:id ORDER BY id_tratamiento DESC");
    $query->bindParam(':id', $rid);
    $query->execute(); 
      if ($numrows>0)   {   
         include 'ltrats_text.php';    
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
if ($fini) {
    $finife = new DateTime($fini);
    $finif = $finife->format("d-M-Y");
}

if ($ffin) {
    $ffinf = new DateTime($ffin);
    $ffinef = $ffinf->format("d-M-Y");
}  

if ($status==2) {
  include 'ltratsy_body.php';  
}
else {

include 'ltrats_body.php';   
}
         }
                                }  else {  echo "No hay tratamientos activos";  } ?>
        </div>  
</div>
                </div>
<?php 
include ("modal_variant.php");
include ("modal_editt.php");
include ("modal_modif.php");
include ("ltrats_scripts.php"); ?>