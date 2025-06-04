<?php
$rid= $_POST['rid'];
require_once ("../cn/connect2.php");
$query=$db2->prepare("SELECT * FROM prospectos WHERE id_prospecto=:id");
$query->bindParam(':id', $rid);
$query->execute();	
				for($i=0; $row = $query->fetch(); $i++){
					$code= $row['id_prospecto'];
          $curp= $row['curp_prospecto'];
          $nss= $row['nss_prospecto'];
          $nombre= $row['nombre_prospecto'];
          $tipologia= $row['tipologia_prospecto'];
          $ecivil= $row['ecivil_prospecto'];
          $origen= $row['origen_prospecto'];
          $sexo= $row['sexo_prospecto'];
          $edad= $row['edad_prospecto'];
          $fnac= $row['fnac_prospecto'];
          $depen= $row['depen_prospecto'];
          $img= $row['img_prospecto'];
          $sta= $row['status_prospecto'];  
          $area= $row['area_prospecto'];
          $seguimiento= $row['seguimiento_prospecto'];
          $tarifa= $row['tarifa_prospecto'];
          $camina= $row['camina_prospecto'];
          $come= $row['come_prospecto'];
          $bana= $row['bana_prospecto'];
          $viste= $row['viste_prospecto'];
          $panales= $row['panales_prospecto'];
          $observa= $row['observa_prospecto'];
          $medio= $row['medio_prospecto'];
        }		?>
  <div id="upfpros">
    <input type="hidden" name="id_prospecto" value="<?php echo $rid; ?>">
<table class="infotab" > 
<tr>
    <td>Código *</td>
    <td><input class="nputs" type="text" name="code_prospecto" value="<?php echo $code; ?>" readonly></td>
    <td>Curp</td>
    <td><input class="nputs w120" type="text" name="curp_prospecto" value="<?php echo $curp; ?>"></td>
    <td>Sexo</td>
    <td>
       <select class="nputs smw" name="sexo_prospecto">
          <option value="<?php echo $sexo; ?>" selected><?php echo $sexo; ?></option>
          <option value="Hombre">Hombre</option>
          <option value="Mujer">Mujer</option>
        </select> 
    </td>
    <td>F. Nacimiento</td>
    <td><input class="nputs" type="date" name="fnac_prospecto" value="<?php echo $fnac; ?>" onchange="calage(this.value, 'prospecto')" autocomplete="off"></td>
</tr>
<tr>
    <td>Nombre *</td>
    <td><input class="nputs" type="text" name="nombre_prospecto" value="<?php echo $nombre; ?>" ></td>
    <td>N.S.S.</td>
    <td><input class="nputs w120" type="text" name="nss_prospecto" value="<?php echo $nss; ?>"></td>
    <td>E. civil</td>
    <td>
      <select class="nputs smw" name="ecivil_prospecto">
          <option value="<?php echo $ecivil; ?>" selected><?php echo $ecivil; ?></option>
  <option value="Casado/a">Casado/a</option>
  <option value="Divorciado/a">Divorciado/a</option>
  <option value="Pareja">Pareja</option>
  <option value="Separado/a">Separado/a</option>
  <option value="N/E">N/E</option>
  <option value="Soltero/a">Soltero/a</option>
  <option value="Viudo/a">Viudo/a</option>
      </select> 
    </td>
    <td>Seguimiento</td>
    <td><input class="nputs w110" type="date" name="seguimiento_prospecto" value="<?php echo $seguimiento; ?>"></td>
  </tr>
  <tr>
   <td>Area</td>
    <td>
      <select class="nputs smw" name="area_prospecto">
          <option value="<?php echo $area; ?>" selected><?php echo $area; ?></option>
          <option >Edificio 1 - Planta Baja</option>
          <option >Edificio 1 - Planta Alta</option>
          <option >Edificio 2 - Planta Baja</option>
          <option >Edificio 2 - Planta Alta</option>
      </select> 
    </td>
    <td>Origen</td>
    <td><input class="nputs w120" type="text" name="origen_prospecto" value="<?php echo $origen; ?>" ></td>
    <td>Estancia</td>
    <td>
      <select class="nputs smw" name="tipologia_prospecto">
          <option value="<?php echo $tipologia; ?>" selected><?php echo $tipologia; ?></option>
          <option value="Completa">Completa</option>
          <option value="Parcial">Parcial</option>
      </select> 
    </td>
    <td>Edad</td>
    <td><input class="nputs w110" type="text" name="edad_prospecto" id="edad_prospecto" value="<?php echo $edad; ?>"></td>
  </tr>
  <tr>
    <td>Tarifa</td>
    <td><input class="nputs" type="number" step="any" name="tarifa_prospecto" value="<?php echo $tarifa; ?>"></td> 
    <td></td>
    <td></td>
    <td>Dependencia</td>
    <td>
      <select class="nputs smw" name="depen_prospecto">
          <option value="<?php echo $depen; ?>" selected><?php echo $depen; ?></option>
          <option value="Leve">Leve</option>
          <option value="Moderada">Moderada</option>
          <option value="Alta">Alta</option>
      </select> 
    </td>
    <td></td>
    <td>
      
    </td>
  </tr>
</table>

<div class="miniseparator"></div>
<div class="addmeds">
        <div class="msaic">Camina solo:</div> <div class="msaic">Come solo</div> <div class="msaic">Baña solo</div> <div class="msaic">Viste solo</div> <div class="msaic">Pañales</div>    
</div>
<div class="addmeds">
        <div class="msaic">
        <select class="nputs smw" name="camina_prospecto">
          <option value="<?php echo $camina; ?>" selected><?php echo $camina; ?></option>
          <option value="Si">Si</option>
          <option value="No">No</option>
        </select>  
        </div> 
        <div class="msaic">
          <select class="nputs smw" name="come_prospecto">
          <option value="<?php echo $come; ?>" selected><?php echo $come; ?></option>
          <option value="Si">Si</option>
          <option value="No">No</option>
        </select> 
        </div> 
        <div class="msaic">
          <select class="nputs smw" name="bana_prospecto">
          <option value="<?php echo $bana; ?>" selected><?php echo $bana; ?></option>
          <option value="Si">Si</option>
          <option value="No">No</option>
        </select> 
        </div> 
        <div class="msaic">
          <select class="nputs smw" name="viste_prospecto">
          <option value="<?php echo $viste; ?>" selected><?php echo $viste; ?></option>
          <option value="Si">Si</option>
          <option value="No">No</option>
        </select> 
        </div> 
        <div class="msaic">
          <select class="nputs smw" name="panales_prospecto">
          <option value="<?php echo $panales; ?>" selected><?php echo $panales; ?></option>
          <option value="Si">Si</option>
          <option value="No">No</option>
        </select> 
        </div>    
</div>
  <div class="separator"></div>
<div class="addmeds w980">
            <textarea class="tarea95new" name="observa_prospecto" placeholder="Observaciones..."><?php echo $observa; ?></textarea>
</div>
  <div class="miniseparator"></div>
<div class="addmeds w980">
            <textarea class="tarea95new" name="medio_prospecto" placeholder="Como se entero de Las Viñas..."><?php echo $medio; ?></textarea>
</div>
  <div class="miniseparator"></div>
<input type="submit" class="nputfull" id="saveupresi" value="Actualizar" onclick="updatepros(<?php echo $rid; ?>);">

    </div>
<?php include ("modal_bededit.php"); ?>