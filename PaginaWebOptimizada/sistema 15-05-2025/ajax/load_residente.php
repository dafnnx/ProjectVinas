<script type="text/javascript" src="js/modal.js"></script>
<?php
$rid= $_POST['rid'];
require_once ("../cn/connect2.php");
$query=$db2->prepare("SELECT * FROM residentes WHERE id_residente=:id");
$query->bindParam(':id', $rid);
$query->execute();	
				for($i=0; $row = $query->fetch(); $i++){
					$code= $row['id_residente'];
          $curp= $row['curp_residente'];
          $nss= $row['nss_residente'];
          $nombre= $row['nombre_residente'];
          $tipologia= $row['tipologia_residente'];
          $ecivil= $row['ecivil_residente'];
          $habitacion= $row['habitacion_residente'];
          $origen= $row['origen_residente'];
          $sexo= $row['sexo_residente'];
          $edad= $row['edad_residente'];
          $cama= $row['cama_residente'];
          $fnac= $row['fnac_residente'];
          $ingreso= $row['ingreso_residente'];
          $ultingreso= $row['ultingreso_residente'];
          $apodo= $row['apodo_residente'];
          $depen= $row['depen_residente'];
          $img= $row['img_residente'];
          $sae= $row['cte_sae'];
          $tarifa= $row['tarifa_residente']; 
          $alergia= $row['alergia_residente']; 
          $patologia= $row['patologia_residente']; 
          $rcp= $row['rcp_residente'];
        }		?>
  <div id="upfresi">
<table class="infotab" > 
<tr>
    <td>Código *</td>
    <td><input class="nputs" type="text" name="code_residente" value="<?php echo $code; ?>" readonly></td>
    <td>Curp</td>
    <td><input class="nputs w120" type="text" name="curp_residente" value="<?php echo $curp; ?>"></td>
    <td>Sexo</td>
    <td>
       <select class="nputs smw" name="sexo_residente">
          <option value="<?php echo $sexo; ?>"><?php echo $sexo; ?></option>
          <option value="hombre">Hombre</option>
          <option value="mujer">Mujer</option>
        </select> 
    </td>
    <td>F. Nacimiento</td>
    <td><input class="nputs" type="date" name="fnac_residente" value="<?php echo $fnac; ?>" onchange="calage(this.value, 'residente')" autocomplete="off"></td>
  </tr>
  <tr>
    <td>Nombre *</td>
    <td><input class="nputs" type="text" name="nombre_residente" value="<?php echo $nombre; ?>" ></td>
    <td>N.S.S.</td>
    <td><input class="nputs w120" type="text" name="nss_residente" value="<?php echo $nss; ?>"></td>
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
    <td><input class="nputs" type="date" name="ingreso_residente" value="<?php echo $ingreso; ?>"></td>
  </tr>
  <tr>
    <td>Cama</td>
    <td><input class="nputs w150" type="text" name="cama_residente" value="<?php echo $cama; ?>" autocomplete="off"><div class="bedbtn" id="mdbed" onclick="mdledit(modbed, 'bedclose')"></div></td>
    <td>Origen</td>
    <td><input class="nputs w120" type="text" name="origen_residente" value="<?php echo $origen; ?>" ></td>
    <td>Estancia</td>
    <td>
      <select class="nputs smw" name="tipologia_residente">
          <option value="<?php echo $tipologia; ?>"><?php echo $tipologia; ?></option>
          <option value="completa">Completa</option>
          <option value="parcial">Parcial</option>
      </select> 
    </td>
    <td>U. Ingreso</td>
    <td><input class="nputs" type="date" name="ultingreso_residente" value="<?php echo $ultingreso; ?>" ></td>
  </tr>
  <tr>
    <td>Apodo</td>
    <td><input class="nputs" type="text" name="apodo_residente" value="<?php echo $apodo; ?>"></td>
    <td>Habitación</td>
    <td><input class="nputs w120" type="text" name="habitacion_residente" value="<?php echo $habitacion; ?>"></td>
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
    <td><input class="nputs w110" type="text" name="edad_residente" id="edad_residente" value="<?php echo $edad; ?>"></td>
  </tr>
  <tr>
    <td>Alergias</td>
    <td><input class="nputs" type="text" name="alergia_residente" value="<?php echo $alergia; ?>" autocomplete="off"></td>
    <td>Patologias
      <!--Tarifa-->        
    </td>
    <td>
      <input class="nputs w120" type="text" name="patologia_residente" value="<?php echo $patologia; ?>" autocomplete="off">
      <!--<input class="nputs w120" type="text" name="tarifa_residente" value="<?php echo $tarifa; ?>">-->
    </td>
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
      <input type="submit" class="nputsave" id="saveupresi" value="Actualizar" onclick="updateresi(<?php echo $rid; ?>);">
  </tr>
</table>
    </div>
<?php include ("modal_bededit.php"); ?>