<div class="info gral">
<div class="gralshort">
  <div class="grala">
    <div class="nfomedsub" id="sresi">
    <table class="infotabview" id="gral1">  
  <tr>
    <td>Código</td>
    <td><input class="nputs" type="text" name="code" value="<?php echo $idr; ?>" readonly></td>
    <td>Curp</td>
    <td><input class="nputs w120" type="text" name="curp" value="<?php echo $curp; ?>" readonly></td>
    <td>Sexo</td>
    <td><input class="nputs smwfix" type="text" name="sex" value="<?php echo $sexo; ?>" readonly></td>
    <td>F. Nacimiento</td>
    <td><input class="nputs w110" type="text" name="bdate" value="<?php echo $fmed; ?>" readonly></td>
  </tr>
  <tr>
    <td>Nombre</td>
    <td><input class="nputs" type="text" name="name" value="<?php echo $nombre; ?>" readonly></td>
    <td>N.S.S.</td>
    <td><input class="nputs w120" type="text" name="name" value="<?php echo $nss; ?>" readonly></td>
    <td>E. civil</td>
    <td><input class="nputs smwfix" type="text" name="civil" value="<?php echo $ecivil; ?>" readonly></td>
    <td>F. Ingreso</td>
    <td><input class="nputs w110" type="text" name="inn" value="<?php echo $fmed2; ?>" readonly></td>
  </tr>
  <tr>
    <td>Apodo</td>
    <td><input class="nputs" type="text" name="nick" name="apodo_residente" value="<?php echo $apodo; ?>" readonly></td>
    <td>Origen</td>
    <td><input class="nputs w120" type="text" name="origen" name="origen_residente" value="<?php echo $origen; ?>" readonly></td>
    <td>Estancia</td>
    <td><input class="nputs smwfix" type="text" name="kind" value="<?php echo $tipologia; ?>" readonly></td>
    <td>U. Ingreso</td>
    <td><input class="nputs w110" type="text" name="linn" name="ultingreso_residente" value="<?php echo $fmed3; ?>" readonly></td>
  </tr>
  <tr>
    <td>Cama</td>
    <td><input class="nputs" type="text" name="bed" value="<?php echo $cama; ?>" readonly></td>
    <td>Habitación</td>
    <td><input class="nputs w120" type="text" name="room" value="<?php echo $habitacion; ?>" readonly></td>
    <td>Dependencia</td>
    <td><input class="nputs smwfix" type="text" name="depen" value="<?php echo $depen; ?>" readonly></td>
    <td>Edad</td>
    <td><input class="nputs w110" type="text" name="age" name="edad_residente" value="<?php echo edad($fmed); ?>" readonly></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
    </table>
</div>
</div>
      <div class="gralb" id="resimg">
  <form method="post" action="javascript:;" enctype="multipart/form-data">
  <?php
if (isset($img)){ ?>
          <img class="card-img-top" src="resi_imgs/<?php echo $img; ?>">
<?php } else { ?> 
           <img class="card-img-top" src="resi_imgs/no.png"> 
<?php } ?>
  </form> 
    </div>
</div>
</div>

<?php
function edad($fecha_nacimiento)  {
    $nacimiento = new DateTime($fecha_nacimiento);
    $ahora = new DateTime(date("Y-m-d"));
    $diferencia = $ahora->diff($nacimiento);
    return $diferencia->format("%y"); }
 ?>