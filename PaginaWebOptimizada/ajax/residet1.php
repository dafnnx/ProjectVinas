<script type="text/javascript" src="js/age.js"></script>
<script type="text/javascript" src="js/img.js"></script>
<script type="text/javascript" src="js/modal.js"></script>
<div class="info gral">
<div class="gralmain">
  <div class="grala">
    <div class="nfo1sub" id="sresi">
  <div id="upfresi">
    <input type="hidden" id="resic_id" value="<?php echo $rid; ?>" >
    <table class="infotab" id="gral1">  
  <tr>
    <td>Código *</td>
    <td><input class="nputs" type="text" name="code_residente" value="<?php echo $rid; ?>" readonly autocomplete="off"></td>
    <td>Curp</td>
    <td><input class="nputs w120" type="text" name="curp_residente" value="<?php echo $curp; ?>" autocomplete="off"></td>
    <td>Sexo</td>
    <td>
       <select class="nputs smw" name="sexo_residente">
          <option value="<?php echo $sexo; ?>"><?php echo $sexo; ?></option>
          <option value="hombre">Hombre</option>
          <option value="mujer">Mujer</option>
        </select> 
    </td>
    <td>F. Nacimiento</td>
    <td><input class="nputs w110" type="date" name="fnac_residente" value="<?php echo $fnac; ?>" onchange="calage(this.value, 'residente')" autocomplete="off"></td>
  </tr>
  <tr>
    <td>Nombre *</td>
    <td><input class="nputs" type="text" name="nombre_residente" value="<?php echo $nombre; ?>" autocomplete="off"></td>    
    <td>N.S.S.</td>
    <td><input class="nputs w120" type="text" name="nss_residente" value="<?php echo $nss; ?>" autocomplete="off"></td>
    <td>E. civil</td>
    <td>
      <select class="nputs smw" name="ecivil_residente">
          <option value="<?php echo $ecivil; ?>"><?php echo $ecivil; ?></option>
          <option value="Casado/a">Casado/a</option>
          <option value="Divorciado/a">Divorciado/a</option>
          <option value="Pareja de hecho">Pareja</option>
          <option value="Separado/a">Separado/a</option>
          <option value="Sin especificar">N/E</option>
          <option value="Soltero/a">Soltero/a</option>
          <option value="Viudo/a">Viudo/a</option>>
        </select> 
    </td>
    <td>F. Ingreso</td>
    <td><input class="nputs w110" type="date" name="ingreso_residente" value="<?php echo $ingreso; ?>" autocomplete="off"></td>
  </tr>
  <tr>
    <td>Cama</td>
    <td><input class="nputs w150" type="text" name="cama_residente" value="<?php echo $cama; ?>" autocomplete="off"><div class="bedbtn" id="mdbed" onclick="mdl(modbed, 'bedclose')"></div></td>
    <td>Origen</td>
    <td><input class="nputs w120" type="text" name="origen_residente" value="<?php echo $origen; ?>" autocomplete="off"></td>
    <td>Estancia</td>
    <td>
        <select class="nputs smw" name="tipologia_residente">
          <option value="<?php echo $tipologia; ?>"><?php echo $tipologia; ?></option>
          <option value="completa">Completa</option>
          <option value="parcial">Parcial</option>
        </select> 
    </td>
    <td>U. Ingreso</td>
    <td><input class="nputs w110" type="date" name="ultingreso_residente" value="<?php echo $ultingreso; ?>" autocomplete="off"></td>
  </tr>
  <tr>
    <td>Apodo</td>
    <td><input class="nputs" type="text" name="apodo_residente" value="<?php echo $apodo; ?>" autocomplete="off"></td>
    <td>Habitación</td>
    <td><input class="nputs w120" type="text" name="habitacion_residente" value="<?php echo $habitacion; ?>" autocomplete="off"></td>
    <td>Dependencia</td>
    <td>
        <select class="nputs smw" name="depen_residente">
  <option value="<?php echo $depen; ?>"><?php echo $depen; ?></option>
  <option value="leve">Leve</option>
  <option value="moderada">Moderada</option>
  <option value="alta">Alta</option>
        </select> 
    </td>
    <td>Edad</td>
    <td><input class="nputs w110" type="text" name="edad_residente" id="edad_residente" value="<?php echo edad($fnac); ?>" autocomplete="off"></td>
  </tr>
  <tr>
    <td>Alergias</td>
    <td>
      <input class="nputs" type="text" name="alergia_residente" value="<?php echo $alergia; ?>" autocomplete="off">
    <!--  
      <div class="dpflex">
      <div class="distclass cpoint" onclick="mdl(modaleedit, 'aleeditclose', load_rales('<?php echo $rid; ?>'))">Alergias</div>
      <div class="distclass cpoint" onclick="mdl(modpatedit, 'pateditclose', load_rpats('<?php echo $rid; ?>'))">Patologías</div>
    </div>
    -->
    </td>
    <td>Patologias
      <!--Tarifa-->   
      </td>
    <td>
      <input class="nputs w120" type="text" name="patologia_residente" value="<?php echo $patologia; ?>" autocomplete="off">
      <!--<input class="nputs w120" type="text" name="tarifa_residente" value="<?php echo $tarifa; ?>" autocomplete="off">--></td>
    <td>RCP</td>
    <td>
      <select class="nputs smw" name="rcp_residente">
        <option value="<?php echo $rcp; ?>"><?php echo $rcp; ?></option>
        <option value="Si">Si</option>
        <option value="No">No</option>
      </select> 
    </td>
    <td></td>
    <td>
      <input type="hidden" name="bedid">
      <input type="submit" class="nputsave" id="saveupresi" value="Actualizar" onclick="updateresi('<?php echo $rid; ?>');">
  </tr>
    </table>
  </div>
</div>
</div>
      <div class="gralb" id="resimg">
  <form method="post" action="javascript:;" enctype="multipart/form-data">
    <label class="input-personalizado">
  <?php
if (isset($img)){ ?>
          <img class="card-img-top" src="resi_imgs/<?php echo $img; ?>">
<?php } else { ?> 
           <img class="card-img-top" src="resi_imgs/no.png"> 
<?php } ?>     
        <div class="card-body">
      <input type="file" class="input-file" name="image" id="image">
            </div>
      <input type="button" id="upimg" class="nputsave" value="Subir">
    </label>  
  </form> 
      </div>   
    </div>
</div>
<?php 
include ("modal_bededit.php");
include ("modal_aleedit.php");
include ("modal_patedit.php");  ?>


<?php
function edad($fecha_nacimiento)  {
    $nacimiento = new DateTime($fecha_nacimiento);
    $ahora = new DateTime(date("Y-m-d"));
    $diferencia = $ahora->diff($nacimiento);
    return $diferencia->format("%y"); }
 ?>