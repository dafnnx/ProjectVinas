<?php
  $eid= $_POST['eid'];
  $nom= $_POST['nom']; 
?>
  <div class="edicntrl">    
    <div class="ediplus">
    <td><input class="npututil padd10" type="text" id="n_piso" placeholder="Nuevo Piso" required></td>   
    <td><input type="submit" class="btnutil padd10" id="savepiso" value="Guardar" onclick="save_piso('<?php echo $eid ?>', '<?php echo $nom ?>');"></td>  
    <div class="back" onclick="show('utils');" title="Regresar" ></div>
  </div>  
<div class="mapaedif" id="mapapiso">
<?php include ("../ajax/load_pisos.php"); ?>
</div>
</div>