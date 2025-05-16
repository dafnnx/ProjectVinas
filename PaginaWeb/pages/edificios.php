  <div class="edicntrl">
    <div class="ediplus">
    <td><input class="npututil padd10" type="text" id="n_edificio" placeholder="Nuevo Edificio" required></td>   
    <td><input type="submit" class="btnutil padd10" id="saveedi" value="Guardar" onclick="save_edif('<?php echo $uid; ?>')" ></td>
    </div>
  </div>  
<div class="mapaedif" id="mapaedif">
	<?php include ("../ajax/load_edificios.php"); ?>	
</div>