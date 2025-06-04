<div class="infosub gral">
<?php
 $rid= $_POST['nrid'];
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM inventarios WHERE id_residente=:id");
    $count_query->bindParam(':id', $rid);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM inventarios WHERE id_residente=:id");
    $query->bindParam(':id', $rid);
    $query->execute(); ?>
    <?php 
    if ($numrows>0){  ?>
      <div class="">
        <table class="table" data-responsive="table" id="resultTable">
          <thead>
        <tr>
          <th class='text-center'>Fecha</th>
          <th class='text-center'>Descripción</th>
          <th class='text-center'>Cant.</th>
          <th class='text-center'>Modif.</th>
          <th class='text-center'>*</th>
        </tr>
        </thead>
        <?php
        for($i=0; $row = $query->fetch(); $i++){    
          $id_inv= $row['id_inventario'];      
          $medinv= $row['medicamento_inv'];
          $fechainv= $row['fecha_inv'];
          $talla= $row['talla_inv'];
          $unidad= $row['unidad_inv']; 
          $marca= $row['marca_inv']; 
          $cantidad= $row['cantidad_inv']; 
          ?>
          <tr>
  <td><?php 
$fecha = new DateTime($fechainv);
$cadfe = $fecha->format("d-M-Y");
echo $cadfe;  
?></td>
            <?php
$cquery= $db2->prepare("SELECT nombre_medica AS nm FROM medicamentos WHERE id_medica=:id");
$cquery->bindParam(':id', $medinv);
$cquery->execute();
for($i=0; $row = $cquery->fetch(); $i++){ $nm = $row['nm'];  ?>
            <td><?php echo $nm; ?></td> 
<?php   }  ?>
            <td class="textcenter"><?php echo  $cantidad; ?></td>
            <td>
                <div class="invopera">
                  <div class="qty_opera">
                    <input class="nputsopera ta_opera" id="ta_opera">
                  </div>
                  <div class="sel_opera">
                   <select class="nputs wh100" onchange="inve_live_up('inventarios', );">
                    <option disabled selected>Operación</option>
                    <option value="1">Sumar</option>
                    <option value="2">Restar</option>
                   </select>
                  </div>
                </div>
            </td>   
            <td class="textcenter"><a href="#" class='del' title='Eliminar' onclick="eliminarinv('<?php echo $id_inv; ?>', 'inventarios', 'id_inventario', '<?php echo $rid; ?>')"></a></td>
          </tr>
          <?php } ?>
        </table>
      </div>
<?php }
else {  echo "Sin captura de inventario";   } ?>
</div>