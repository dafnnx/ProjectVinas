<?php
  $rid= $_POST['rid'];
  $nor= $_POST['nor'];
  $pid= $_POST['pid']; 
?>
  <div class="edicntrl">    
    <div class="ediplus">
    <td><input class="npututil padd10" type="text" id="n_bed" placeholder="Nueva cama" required></td>   
    <td><input type="submit" class="btnutil padd10" value="Guardar" onclick="save_bed('<?php echo $rid ?>');"></td>  
    <div class="back" onclick="set_piso('<?php echo $pid; ?>');" title="Regresar" ></div>
  </div>  
<div class="mapaedif" id="mapapiso">
<?php include ("../ajax/load_beds.php"); ?>
</div>