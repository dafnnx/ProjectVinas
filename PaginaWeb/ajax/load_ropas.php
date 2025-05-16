<?php
 $ida= $_POST['ida'];
 $rid= $_POST['rid'];
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM ropa_residente WHERE id_armario=:id");
    $count_query->bindParam(':id', $ida);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM ropa_residente WHERE id_armario=:id");
    $query->bindParam(':id', $ida);
    $query->execute(); 
    if ($numrows>0){  ?>
      <div class="">
        <table class="table" data-responsive="table" id="resultTable">
          <thead>
        <tr>
          <th class='text-center'>Nombre</th>
          <th class='text-center'>talla</th>
          <th class='text-center'>Marca</th>
          <th class='text-center'>Color</th>
          <th class='text-center'>Observaciones</th>
          <th class='text-center'>Status</th>
          <th class='text-center'>Acción</th>
        </tr>
        </thead>
        <?php
        for($i=0; $row = $query->fetch(); $i++){
          $idr= $row['id_rresidente'];
          $nombre= $row['nombre_ropa'];
          $talla= $row['talla_ropa'];
          $mmarca= $row['marca_ropa'];
          $color= $row['color_ropa'];
          $observa= $row['observa_ropa'];
          $img= $row['img_ropa'];
          ?>
          <tr>
<?php
if ($nombre=="N/A") { ?>
            <td>N/A</td>
<?php } else { 
      $pn= $db2->prepare("SELECT nombre_ropa AS nr FROM ropa WHERE id_ropa=:nom");
      $pn->bindParam(':nom', $nombre);
      $pn->execute();
      for($i=0; $row = $pn->fetch(); $i++){ ?>
            <td><?php echo $row['nr']; ?></td> 
<?php } }
if ($talla=="N/A") { ?>
            <td>N/A</td>
<?php } else { 
      $tn= $db2->prepare("SELECT nombre_talla AS nt FROM tallas WHERE id_talla=:tall");
      $tn->bindParam(':tall', $talla);
      $tn->execute();
      for($i=0; $row = $tn->fetch(); $i++){ ?>
            <td><?php echo $row['nt']; ?></td> 
<?php } }
if ($mmarca=="N/A") { ?>
            <td>N/A</td>
<?php } else { 
      $tn= $db2->prepare("SELECT nombre_mmarca AS nm FROM mmarcas WHERE id_mmarca=:mar");
      $tn->bindParam(':mar', $mmarca);
      $tn->execute();
      for($i=0; $row = $tn->fetch(); $i++){ ?>
            <td><?php echo $row['nm']; ?></td> 
<?php } } ?>
            <td><input type="color" name="ense3" disabled value="<?php echo $color; ?>" title="Color"></td> 
            <td>
<input type="text" name="ense4" class="ed_input w100per" contenteditable="true" onblur="r_live_up('<?php echo $idr; ?>', 'observa_ropa', this.value, 'ropa_residente', 'id_rresidente', '<?php echo $observa; ?>');" value="<?php echo $observa; ?>" title="<?php echo $observa; ?>">
            </td>   
            <td style="text-align: center;">
<?php       $querym=$db2->prepare("SELECT status_ropastatus AS irsta FROM hist_ropastatus WHERE id_ropastatus=(SELECT MAX(id_ropastatus) AS idrs FROM hist_ropastatus WHERE id_rresidente=:idr)");
            $querym->bindParam(':idr', $idr);
            $querym->execute(); 
            for($i=0; $row = $querym->fetch(); $i++){    echo $row['irsta'];    } ;     
?>   
            </td>        
            <td>
<a href="#" class='del' title='Eliminar' onclick="eliminarenser('<?php echo $idr; ?>', 'ropa_residente', 'id_rresidente', '<?php echo $ida; ?>', '<?php echo $rid; ?>')"></a>
<div class='det' title='Agregar detalles' onclick="prenimg('<?php echo $idr; ?>', '<?php echo $nombre?>', '<?php echo $img; ?>', '<?php echo $ida; ?>', '<?php echo $rid; ?>' )"></div>
            </td>    
          </tr>
          <?php } ?>
        </table>
      </div>
<?php }
else {  echo "Sin captura de enseres";   } 
/*  include ("modal_ropastatus.php"); */ ?>

<!--
<script type="text/javascript">
$(document).ready(function(){
   $("#ssta").select2({
      ajax: {
        url: "./ajax/sstaropa.php",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
           return {
              searchTerm: params.term // search term
           };
        },
        processResults: function (response) {
           return {
              results: response
           };
        },
        cache: true
      }
   });
});
</script>

-->