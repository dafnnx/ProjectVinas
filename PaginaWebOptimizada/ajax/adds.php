<div class="subcapture mb30">
<?php
    $count_query= $db2->prepare("SELECT count(*) AS banos FROM banos_adds WHERE nom_edif=:nedif AND fecha_add=:today");
    $count_query->bindParam(':nedif', $nomedifs);
    $count_query->bindParam(':today', $today);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ $banos = $row['banos'];  }
if ($banos) {
    $ery= $db2->prepare("SELECT * FROM banos_adds WHERE nom_edif=:nedif AND fecha_add=:today");
    $ery->bindParam(':nedif', $nomedifs);
    $ery->bindParam(':today', $today);
    $ery->execute();
    for($i=0; $row = $ery->fetch(); $i++){   
      $guantesban = $row['guantes_add'];
      $thban = $row['th_add'];
      $papelban = $row['papel_add'];        ?>     
<div class="subprints">
            <div class="ribb">Baños</div>
<table class="minit">
  <tr>
    <td class="w50per">Guantes:</td>
    <td class="w50per"><input class="nputs" type="text" value="<?php echo $guantesban; ?>" onblur="add_live_up('banos_adds', this.value, '<?php echo $nomedifs;?>', 'guantes_add');"></td>
  </tr>
  <tr>
    <td class="w50per">TH:</td>
    <td class="w50per"><input class="nputs" type="text" value="<?php echo $thban; ?>" type="text" onblur="add_live_up('banos_adds', this.value, '<?php echo $nomedifs;?>', 'th_add');"></td>
  </tr>
  <tr>
    <td class="w50per">Papel:</td>
    <td class="w50per"><input  class="nputs" type="text" value="<?php echo $papelban; ?>" type="text" onblur="add_live_up('banos_adds', this.value, '<?php echo $nomedifs;?>', 'papel_add');"></td>
  </tr>
</table>
</div>
<?php  }   } else { ?>
<div class="subprints">
            <div class="ribb">Baños</div>
<table class="minit">
  <tr>
    <td class="w50per">Guantes:</td>
      <td class="w50per"><input  class="nputs" type="text" onblur="add_live_up('banos_adds', this.value, '<?php echo $nomedifs;?>', 'guantes_add');"></td>
  </tr>
  <tr>
    <td class="w50per">TH:</td>
    <td class="w50per"><input  class="nputs" type="text" onblur="add_live_up('banos_adds', this.value, '<?php echo $nomedifs;?>', 'th_add');"></td>
  </tr>
  <tr>
    <td class="w50per">Papel:</td>
    <td class="w50per"><input  class="nputs" type="text" onblur="add_live_up('banos_adds', this.value, '<?php echo $nomedifs;?>', 'papel_add');"></td>
  </tr>
</table>
</div>
<?php  } 
    $count_query= $db2->prepare("SELECT count(*) AS salas FROM sala_adds WHERE nom_edif=:nedif AND fecha_add=:today");
    $count_query->bindParam(':nedif', $nomedifs);
    $count_query->bindParam(':today', $today);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ $salas = $row['salas'];  }
if ($salas) {
    $ery= $db2->prepare("SELECT * FROM sala_adds WHERE nom_edif=:nedif AND fecha_add=:today");
    $ery->bindParam(':nedif', $nomedifs);
    $ery->bindParam(':today', $today);
    $ery->execute();
    for($i=0; $row = $ery->fetch(); $i++){   
      $guantessal = $row['guantes_add'];
      $thsal = $row['th_add'];
      $papelsal = $row['papel_add'];        ?>     
<div class="subprints">
            <div class="ribb">Baños</div>
<table class="minit">
  <tr>
    <td class="w50per">Guantes:</td>
    <td class="w50per"><input class="nputs" type="text" value="<?php echo $guantessal; ?>" onblur="add_live_up('sala_adds', this.value, '<?php echo $nomedifs;?>', 'guantes_add');"></td>
  </tr>
  <tr>
    <td class="w50per">TH:</td>
    <td class="w50per"><input class="nputs" type="text" value="<?php echo $thsal; ?>" type="text" onblur="add_live_up('sala_adds', this.value, '<?php echo $nomedifs;?>', 'th_add');"></td>
  </tr>
  <tr>
    <td class="w50per">Papel:</td>
    <td class="w50per"><input  class="nputs" type="text" value="<?php echo $papelsal; ?>" type="text" onblur="add_live_up('sala_adds', this.value, '<?php echo $nomedifs;?>', 'papel_add');"></td>
  </tr>
</table>
</div>
<?php  }   } else { ?>
<div class="subprints">
            <div class="ribb">Baños</div>
<table class="minit">
  <tr>
    <td class="w50per">Guantes:</td>
      <td class="w50per"><input  class="nputs" type="text" onblur="add_live_up('sala_adds', this.value, '<?php echo $nomedifs;?>', 'guantes_add');"></td>
  </tr>
  <tr>
    <td class="w50per">TH:</td>
    <td class="w50per"><input  class="nputs" type="text" onblur="add_live_up('sala_adds', this.value, '<?php echo $nomedifs;?>', 'th_add');"></td>
  </tr>
  <tr>
    <td class="w50per">Papel:</td>
    <td class="w50per"><input  class="nputs" type="text" onblur="add_live_up('sala_adds', this.value, '<?php echo $nomedifs;?>', 'papel_add');"></td>
  </tr>
</table>
</div>
<?php  } 
    $count_query= $db2->prepare("SELECT count(*) AS enfer FROM enfer_adds WHERE nom_edif=:nedif AND fecha_add=:today");
    $count_query->bindParam(':nedif', $nomedifs);
    $count_query->bindParam(':today', $today);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ $enfer = $row['enfer'];  }
if ($enfer) {
    $ery= $db2->prepare("SELECT * FROM enfer_adds WHERE nom_edif=:nedif AND fecha_add=:today");
    $ery->bindParam(':nedif', $nomedifs);
    $ery->bindParam(':today', $today);
    $ery->execute();
    for($i=0; $row = $ery->fetch(); $i++){  
      $papelenf = $row['papel_add'];        ?>     
<div class="subprints">
            <div class="ribb">Baños</div>
<table class="minit">
  <tr>
    <td class="w50per">Papel:</td>
    <td class="w50per"><input  class="nputs" type="text" value="<?php echo $papelenf; ?>" type="text" onblur="add_live_up('enfer_adds', this.value, '<?php echo $nomedifs;?>', 'papel_add');"></td>
  </tr>
</table>
</div>
<?php  }   } else { ?>
<div class="subprints">
            <div class="ribb">Baños</div>
<table class="minit">
  <tr>
    <td class="w50per">Papel:</td>
    <td class="w50per"><input  class="nputs" type="text" onblur="add_live_up('enfer_adds', this.value, '<?php echo $nomedifs;?>', 'papel_add');"></td>
  </tr>
</table>
</div>
<?php  } 
    $count_query= $db2->prepare("SELECT count(*) AS oficvis FROM oficvis_adds WHERE nom_edif=:nedif AND fecha_add=:today");
    $count_query->bindParam(':nedif', $nomedifs);
    $count_query->bindParam(':today', $today);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ $oficvis = $row['oficvis'];  }
if ($oficvis) {
    $ery= $db2->prepare("SELECT * FROM oficvis_adds WHERE nom_edif=:nedif AND fecha_add=:today");
    $ery->bindParam(':nedif', $nomedifs);
    $ery->bindParam(':today', $today);
    $ery->execute();
    for($i=0; $row = $ery->fetch(); $i++){  
      $papelofi = $row['papel_add'];        ?>     
<div class="subprints">
            <div class="ribb">Baños</div>
<table class="minit">
  <tr>
    <td class="w50per">Papel:</td>
    <td class="w50per"><input  class="nputs" type="text" value="<?php echo $papelofi; ?>" type="text" onblur="add_live_up('oficvis_adds', this.value, '<?php echo $nomedifs;?>', 'papel_add');"></td>
  </tr>
</table>
</div>
<?php  }   } else { ?>
<div class="subprints">
            <div class="ribb">Baños</div>
<table class="minit">
  <tr>
    <td class="w50per">Papel:</td>
    <td class="w50per"><input  class="nputs" type="text" onblur="add_live_up('oficvis_adds', this.value, '<?php echo $nomedifs;?>', 'papel_add');"></td>
  </tr>
</table>
</div>
<?php  } ?>
</div>