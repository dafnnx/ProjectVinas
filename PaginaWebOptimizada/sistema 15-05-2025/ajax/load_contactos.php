<div class="info gral">
<?php
 $rid= $_POST['nrid'];
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM contactos WHERE id_residente=:id");
    $count_query->bindParam(':id', $rid);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM contactos WHERE id_residente=:id");
    $query->bindParam(':id', $rid);
    $query->execute(); ?>
    <?php 
    if ($numrows>0){  ?>
      <div class="">
        <table class="table" data-responsive="table" id="resultTable">
          <thead>
        <tr>
          <th class='text-center'>Fav</th>
          <th class='text-center'>Nombre</th>
          <th class='text-center'>Parentezco</th>
          <th class='text-center'>Teléfono</th>
          <th class='text-center'>Fijo</th>
          <th class='text-center'>Móvil</th>
          <th class='text-center'>Email</th>
        </tr>
        </thead>
        <?php
        for($i=0; $row = $query->fetch(); $i++){
          $idc= $row['id_contacto'];
          $nombre= $row['nombre_contacto'];
          $parent= $row['parent_contacto'];
          $tela= $row['tela_contacto'];
          $telb= $row['telb_contacto'];
          $telc= $row['telc_contacto'];
          $email= $row['mail_contacto'];  
          $fav= $row['fav_contacto'];   
          ?>
          <tr>
            <td>              
              <input type="checkbox" class="ed_input" name="fav_contacto" <?php if ($fav) echo "checked"; ?> onclick="r_live_up_chk('<?php echo $idc; ?>', '<?php echo $fav; ?>', '<?php echo $rid; ?>');">
            </td>
            <td>
              <input type="text" class="ed_input w230" name="c1" contenteditable="true" onblur="r_live_up('<?php echo $idc; ?>', 'nombre_contacto', this.value, 'contactos', 'id_contacto', '<?php echo $nombre; ?>');" value="<?php echo $nombre; ?>">
            </td> 
            <td>
              <input type="text" class="ed_input w80" name="c2" contenteditable="true" onblur="r_live_up('<?php echo $idc; ?>', 'parent_contacto', this.value, 'contactos', 'id_contacto', '<?php echo $parent; ?>');" value="<?php echo $parent; ?>">
            </td> 
            <td>
              <input type="text" class="ed_input w120" name="c3" contenteditable="true" onblur="r_live_up('<?php echo $idc; ?>', 'tela_contacto', this.value, 'contactos', 'id_contacto', '<?php echo $tela; ?>');" value="<?php echo $tela; ?>">
            </td> 
            <td>
              <input type="text" class="ed_input w120" name="c4" contenteditable="true" onblur="r_live_up('<?php echo $idc; ?>', 'telb_contacto', this.value, 'contactos', 'id_contacto', '<?php echo $telb; ?>');" value="<?php echo $telb; ?>">
            </td> 
            <td>
              <input type="text" class="ed_input w120" name="c5" contenteditable="true" onblur="r_live_up('<?php echo $idc; ?>', 'telc_contacto', this.value, 'contactos', 'id_contacto', '<?php echo $telc; ?>');" value="<?php echo $telc; ?>">
            </td> 
            <td>              
              <input type="text" class="ed_input" name="c6" contenteditable="true" onblur="r_live_up('<?php echo $idc; ?>', 'mail_contacto', this.value, 'contactos', 'id_contacto', '<?php echo $email; ?>');" value="<?php echo $email; ?>">
            </td>      
          </tr>
          <?php } ?>
        </table>
      </div>
<?php } 
else {  echo "Sin captura de contactos";   }?>
</div>