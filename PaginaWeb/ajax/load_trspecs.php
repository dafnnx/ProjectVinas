<?php
$idt= $_POST['idt'];
    require_once ("../cn/connect2.php");
    $query=$db2->prepare("SELECT * FROM tratamientos WHERE id_tratamiento=:id");
    $query->bindParam(':id', $idt);
    $query->execute();

for($i=0; $row = $query->fetch(); $i++){
          $fini= $row['fecha_ini'];
          $ffin= $row['fecha_fin'];          
          $medt= $row['med_tratamiento'];
          $siet= $row['siet_tratamiento'];
          $och= $row['och_tratamiento'];
          $trce= $row['trce_tratamiento'];
          $dieco= $row['dieco_tratamiento'];
          $vtuno= $row['vtuno_tratamiento'];
        }
    $cy= $db2->prepare("SELECT nombre_medica AS nmed FROM medicamentos WHERE id_medica=:id");
    $cy->bindParam(':id', $medt);
    $cy->execute();
    for($i=0; $row = $cy->fetch(); $i++){    $nmed = $row['nmed']; }   ?>
<div class="specscont">
    <div class="cont100 textcenter dblock"><?php echo $nmed; ?></div>
    <div class="cont100">
      <div class="subcont40 textcenter">Día</div>
      <div class="subcont60"><input class="nputsspecs w100per" type="date" min="<?php echo $fini; ?>" max="<?php echo $ffin; ?>"></td></div>
    </div>    
    <div class="contups"></div>
</div>