<?php require_once ("../cn/connect2.php");?>
<div class="info gral">
<div class="gralfull">
          <div class="gralmain" >
<div class="grala">
 <div class="nfo1sub" id="sresi">
  <form method="POST" id="selresi">
<table class="infotab" >  
  <input type="hidden" name="user_id" value="<?php echo $uid ?>">      
<tr>    
    <td>Código *</td>
    <?php 
    $coun= $db2->prepare("SELECT MAX(id_residente) AS idr FROM residentes ORDER BY id_residente DESC LIMIT 1");
    $coun->execute();
    for($i=0; $row = $coun->fetch(); $i++){ 
     $idr= $row['idr'];
     if   ($idr==NULL)    { $idr=0; } $idr2=$idr+1;     ?>
    <td><input class="nputs" type="text" name="id_residente" value="<?php echo $idr2 ?>" disabled readonly ></td>
  <?php } ?>
    <td>Curp</td>
    <td><input class="nputs w120" type="text" name="curp_residente" autocomplete="off"></td>
    <td>Sexo</td>
    <td>
        <select class="nputs smw" name="sexo_residente">
          <option disabled selected>Seleccionar</option>
          <option value="hombre">Hombre</option>
          <option value="mujer">Mujer</option>
        </select>  
    </td>     
    <td>F. Nacimiento</td>
    <td><input class="nputs w100" type="date" name="fnac_residente" onchange="calage(this.value, 'residente')" autocomplete="off"></td>
</tr>
<tr>
    <td>Nombre *</td>
    <td><input class="nputs" type="text" name="nombre_residente" required autocomplete="off"></td>      
    <td>N.S.S.</td>
    <td><input class="nputs w120" type="text" name="nss_residente" autocomplete="off"></td>
     <td>E. civil</td>
    <td>
        <select class="nputs smw" name="ecivil_residente">
  <option disabled selected>Seleccionar</option>
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
    <td><input class="nputs w100" type="date" name="ingreso_residente" autocomplete="off"></td>
</tr>
<tr>
    <td>Cama</td>
    <td><input class="nputs w150" type="text" name="cama_residente" autocomplete="off"><div class="bedbtn" id="mdbed" onclick="mdl(modbed, 'bedclose')"></div></td>  
    <td>Origen</td>
    <td><input class="nputs w120" type="text" name="origen_residente" autocomplete="off"></td>
    <td>Estancia</td>
    <td>
        <select class="nputs smw" name="tipologia_residente">
  <option disabled selected>Seleccionar</option>
  <option value="completa">Completa</option>
  <option value="parcial">Parcial</option>
        </select>  
    </td>       
    <td>U. Ingreso</td>
    <td><input class="nputs w100" type="date" name="ultingreso_residente" autocomplete="off"></td>
</tr>
<tr>    
    <td>Apodo</td>
    <td><input class="nputs" type="text" name="apodo_residente" autocomplete="off"></td>
    <td>Habitación</td>
    <td><input class="nputs w120" type="text" name="habitacion_residente" autocomplete="off"></td>    
    <td>Dependencia</td>
    <td>
        <select class="nputs smw" name="depen_residente">
  <option disabled selected>Seleccionar</option>
  <option value="leve">Leve</option>
  <option value="moderada">Moderada</option>
  <option value="alta">Alta</option>
        </select> 
    </td>
    <td>Edad</td>
    <td><input class="nputs w100" type="number" name="edad_residente" id="edad_residente" autocomplete="off"></td>  
</tr>
<tr>
    <td>Alergias</td>
    <td>
      <input class="nputs" type="text" name="alergia_residente" autocomplete="off">
<!--
    <div class="dpflex">
      <div class="distclass cpoint" onclick="mdl(modale, 'aleclose', load_rales('<?php echo $idr2 ?>'))">Alergias</div>
      <div class="distclass cpoint" onclick="mdl(modpat, 'patclose', load_rpats('<?php echo $idr2 ?>'))">Patologías</div>
    </div>
-->
    </td>
    <td>Patologias
      <!--Tarifa-->        
      </td>
    <td>
      <input class="nputs w120" type="text" name="patologia_residente" autocomplete="off">
      <!--<input class="nputs w120" type="number" step="any" name="tarifa_residente" autocomplete="off">--></td>
    <td>RCP</td>
    <td>
      <select class="nputs smw" name="rcp_residente">
        <option disabled selected>Seleccionar</option>
        <option value="Si">Si</option>
        <option value="No">No</option>
      </select> 
    </td>
    <td></td>
    <td>
      <input type="hidden" name="bedid">
      <input type="submit" class="nputsave" id="saveresi" value="Guardar">
</tr>
</table>
</form>
</div> 
<?php 
include ("modal_bed.php");
include ("modal_ale.php");
include ("modal_pat.php");      ?>
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
<div class="spt">
            <div class="card-body">
              <input type="file" class="input-file" name="image" id="image">
            </div>
              <input type="button" id="upimg" class="nputsave" value="Subir">
    </label>  
</div>            
  </form> 
    </div>
          </div>
</div>
</div>
<input type="hidden" id="resic_id">