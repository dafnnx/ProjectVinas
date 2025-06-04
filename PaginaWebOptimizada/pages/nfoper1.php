<?php require_once ("../cn/connect2.php");?>
<div class="info gral">
<div class="gralfull">
          <div class="gralmain" >
  <div id="selpersonal">
      <div class="nfosper">
<div class="nfo1per">
    <div class="gralpersonal">
<table class="infotab" >  
  <input type="hidden" name="user_id" value="<?php echo $uid ?>">
  <tr>    
    <td>N.S.S.</td>
    <td><input class="nputs w110" type="text" name="nss_personal"></td>
    <td>Nombre *</td>
    <td><input class="nputs w280" type="text" id="nombre_personal" name="nombre_personal" required></td>
    <td>Sexo</td>
    <td>
        <select class="nputs smw2" name="sexo_personal">
  <option disabled selected></option>
  <option value="hombre">Hombre</option>
  <option value="mujer">Mujer</option>
        </select>  
    </td>     
    <td>F. Nac.</td>
    <td><input class="nputs w100" type="date" onchange="calage(this.value, 'personal')" name="fnac_personal" ></td>
  </tr>
  <tr>
    <td>Origen</td>
    <td><input class="nputs w110" type="text" name="origen_personal"></td>    
    <td class="poin" onclick="gen_us_pass();"><div class="genbtn">Generar<div></td>
    <td>
      <input class="nputs w135" type="number" name="username_personal" id="per_usr" placeholder="Usuario" >
      <input class="nputs w135" type="text" name="pass_personal" id="per_pass" placeholder="Password" >
    </td>
     <td>E. civil</td>
    <td>
        <select class="nputs smw2" name="ecivil_personal">
  <option disabled selected></option>
  <option value="Casado/a">Casado/a</option>
  <option value="Divorciado/a">Divorciado/a</option>
  <option value="Pareja de hecho">Pareja</option>
  <option value="Separado/a">Separado/a</option>
  <option value="Sin especificar">N/E</option>
  <option value="Soltero/a">Soltero/a</option>
  <option value="Viudo/a">Viudo/a</option>
        </select>  
    </td> 
    <td>F. Ingreso</td>
    <td><input class="nputs w100" type="date" name="ingreso_personal" ></td>
    </tr>
    <tr>
    <td>R.F.C.</td>
    <td><input class="nputs w110" type="text" name="rfc_personal"></td>
    <td>Email</td>
    <td><input class="nputs w280" type="mail" name="mail_personal"></td>
    <td>Area</td>
    <td>
        <select class="nputs smw2" name="area_personal" id="area_personal" onchange="sub_area(this.value)">
  <option disabled selected></option>
  <option value="Enfermeria">Enfermería</option>
  <option value="Administracion">Administración</option>
  <option value="S. Generales">S. Generales</option>
  <option value="Mantenimiento">Mantenimiento</option>
  <option value="Rehabilitación">Rehabilitación</option>
  <option value="Medico">Medico</option>
        </select>  
    </td>       
    <td>Cédula</td>
    <td><input class="nputs w100" type="text" name="cedula_personal" ></td>     
    </tr>
  <tr>
    <td>Edad</td>
    <td><input class="nputs w110" type="text" name="edad_personal" id="edad_personal"></td>
    <td>Curp</td>
    <td><input class="nputs w280" type="text" name="curp_personal"></td>    
    <td></td>
    <td>
      <div id="s_area" name="subarea_personal"></div>
      <input type="hidden" name="subarea_personal" id="sap">
    </td> 
    <td>Teléfono</td>
    <td><input class="nputs w100" type="number" name="tel_personal" ></td>
  </tr>
</table>
</div>
</div>
<div class="nfo2per" id="nfo2per">  
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
    </label>  
</form> 
</div>
      </div>
<!--  <div class="docscheck"></div>   -->
<?php include('permisos.php');  ?>
</div>
<button type="submit" class="nputsave" onclick="check_personal();" >Guardar</button>
          </div>
</div>
</div>