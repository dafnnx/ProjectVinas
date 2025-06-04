<?php
  $pid= $_POST['pid'];
  $nop= $_POST['nop']; 
  $eid= $_POST['eid']; 
?>
  <div class="edicntrl">    
    <div class="ediplus">
    <td><input class="npututil padd10" type="text" id="n_room" placeholder="Nueva habitación" required></td>   
    <td><input type="submit" class="btnutil padd10" id="saveroom" value="Guardar" onclick="save_room('<?php echo $pid ?>');"></td>  
    <div class="back" onclick="set_edif('<?php echo $eid; ?>');" title="Regresar" ></div>
  </div>  
<div class="mapaedif" id="mapapiso">
<?php include ("../ajax/load_rooms.php"); ?>
</div>
</div> 