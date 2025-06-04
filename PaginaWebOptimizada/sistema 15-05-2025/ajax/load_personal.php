<div class="gral">
<?php
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM personal");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM personal ORDER BY id_personal DESC");
    $query->execute(); ?>
    <?php 
    if ($numrows>0){  ?>
      <div class="">
        <table class="table" data-responsive="table" id="resultTable">
          <thead>
        <tr>
          <th class='text-center'>Código</th>
          <th class='text-center'>Nombre</th>
          <th class='text-center'>Email</th>
          <th class='text-center'>Edad</th>
          <th class='text-center'>F. Nac</th>
          <th class='text-center'>F. Ingreso</th>
          <th class='text-center'>Acciones</th>
        </tr>
        </thead>
        <?php
        for($i=0; $row = $query->fetch(); $i++){
          $id= $row['id_personal'];
          $nombre= $row['nombre_personal'];
          $email= $row['mail_personal'];
          $edad= $row['edad_personal'];
          $fnac= $row['fnac_personal'];
          $ingreso= $row['ingreso_personal']; 

$fna = new DateTime($fnac);
$fnaf = $fna->format("d-M-Y");

$fin = new DateTime($ingreso);
$finf = $fin->format("d-M-Y");
          ?>
          <tr>
            <td><?php echo $id; ?></td> 
            <td><?php echo $nombre; ?></td> 
            <td><?php echo $email; ?></td> 
            <td><?php echo $edad; ?></td> 
            <td><?php echo $fnaf; ?></td> 
            <td><?php echo $finf; ?></td>   
            <td>
              <a href="#" class='del' title='Eliminar' onclick="eliminar('<?php echo $id; ?>', 'personal', 'id_personal')"></a>
              <a href="#" class='det' title='Contratos' onclick="dets_perso('<?php echo $id; ?>', '<?php echo $nombre; ?>')"></a>
            </td>   
          </tr>
          <?php } ?>
        </table>
      </div>
<?php } ?>
</div>