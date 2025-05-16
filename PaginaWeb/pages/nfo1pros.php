<?php require_once ("../cn/connect2.php");?>
<div class="info gral dpflex">
<div class="gralfull">
          <div class="gralmain" >
<div class="grala">
 <div class="nfo1sub" id="sresi">
  <form method="POST" id="selpros">
<table class="infotab" >  
  <input type="hidden" name="user_id" value="<?php echo $uid ?>">      
  <tr>    
    <td>Código *</td>
    <?php 
    $coun= $db2->prepare("SELECT MAX(id_prospecto) AS idpros FROM prospectos ORDER BY id_prospecto DESC LIMIT 1");
    $coun->execute();
    for($i=0; $row = $coun->fetch(); $i++){ 
     $idpros= $row['idpros'];
     if   ($idpros==NULL)    { $idpros=0; } $idpros2=$idpros+1;     ?>
    <td><input class="nputs" type="text" name="id_prospecto" value="<?php echo $idpros2 ?>" disabled readonly ></td>
  <?php } ?>
    <td>Curp</td>
    <td><input class="nputs w120" type="text" name="curp_prospecto" autocomplete="off"></td>
    <td>Sexo</td>
    <td>
        <select class="nputs smw" name="sexo_prospecto">
          <option disabled selected>Seleccionar</option>
          <option value="hombre">Hombre</option>
          <option value="mujer">Mujer</option>
        </select>  
    </td>     
    <td>F. Nacimiento</td>
    <td><input class="nputs w110" type="date" name="fnac_prospecto" onchange="calage(this.value, 'prospecto')" autocomplete="off"></td>
  </tr>
  <tr>
    <td>Nombre *</td>
    <td><input class="nputs" type="text" name="nombre_prospecto" required autocomplete="off"></td>  
    <td>N.S.S.</td>
    <td><input class="nputs w120" type="text" name="nss_prospecto" autocomplete="off"></td>
     <td>E. civil</td>
    <td>
        <select class="nputs smw" name="ecivil_prospecto">
  <option disabled selected>Seleccionar</option>
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
    <td><input class="nputs w110" type="date" name="seguimiento_prospecto"></td>  
  </tr>
  <tr>
    <td>Area</td>
    <td>
      <select class="nputs smw" name="area_prospecto">
  <option disabled selected>Seleccionar</option>
  <option >Edificio 1 - Planta Baja</option>
  <option >Edificio 1 - Planta Alta</option>
  <option >Edificio 2 - Planta Baja</option>
  <option >Edificio 2 - Planta Alta</option>
      </select> 
    </td>  
    <td>Origen</td>
    <td><input class="nputs w120" type="text" name="origen_prospecto" autocomplete="off"></td>
    <td>Estancia</td>
    <td>
        <select class="nputs smw" name="tipologia_prospecto">
  <option disabled selected>Seleccionar</option>
  <option value="completa">Completa</option>
  <option value="parcial">Parcial</option>
        </select>  
    </td>
    <td>Edad</td>
    <td><input class="nputs w110" type="number" name="edad_prospecto" id="edad_prospecto" autocomplete="off"></td>         
  </tr>
  <tr>      
  <td>Tarifa</td>
    <td><input class="nputs" type="number" step="any" name="tarifa_prospecto" autocomplete="off"></td>  
  <td></td>
  <td></td> 
  <td>Dependencia</td>
    <td>
        <select class="nputs smw" name="depen_prospecto">
  <option disabled selected>Seleccionar</option>
  <option value="leve">Leve</option>
  <option value="moderada">Moderada</option>
  <option value="alta">Alta</option>
        </select> 
    </td>
    <td></td>
    <td></td>  
  </tr>
</table>
<div class="miniseparator"></div>
<div class="addmeds">
        <div class="msaic">Camina solo:</div> <div class="msaic">Come solo</div> <div class="msaic">Baña solo</div> <div class="msaic">Viste solo</div> <div class="msaic">Pañales</div>    
</div>
<div class="addmeds">
        <div class="msaic">
        <select class="nputs smw" name="camina_prospecto">
          <option disabled selected>Seleccionar</option>
          <option value="Si">Si</option>
          <option value="No">No</option>
        </select>  
        </div> 
        <div class="msaic">
          <select class="nputs smw" name="come_prospecto">
          <option disabled selected>Seleccionar</option>
          <option value="Si">Si</option>
          <option value="No">No</option>
        </select> 
        </div> 
        <div class="msaic">
          <select class="nputs smw" name="bana_prospecto">
          <option disabled selected>Seleccionar</option>
          <option value="Si">Si</option>
          <option value="No">No</option>
        </select> 
        </div> 
        <div class="msaic">
          <select class="nputs smw" name="viste_prospecto">
          <option disabled selected>Seleccionar</option>
          <option value="Si">Si</option>
          <option value="No">No</option>
        </select> 
        </div> 
        <div class="msaic">
          <select class="nputs smw" name="panales_prospecto">
          <option disabled selected>Seleccionar</option>
          <option value="Si">Si</option>
          <option value="No">No</option>
        </select> 
        </div>    
</div>
  <div class="separator"></div>
<div class="addmeds w980">
            <textarea class="tarea95new" name="observa_prospecto" placeholder="Observaciones..."></textarea>
</div>
  <div class="miniseparator"></div>
<div class="addmeds w980">
            <textarea class="tarea95new" name="medio_prospecto" placeholder="Como se entero de Las Viñas..."></textarea>
</div>
  <div class="miniseparator"></div>
<input type="submit" class="nputfull" id="savepros" value="Guardar">
</form>
</div> 
</div>
        <div class="gralb" id="resimg">
<form method="post" action="javascript:;" enctype="multipart/form-data">
  <label class="input-personalizado">
 <?php
if (isset($img)){ ?>
          <img class="card-img-top" src="pros_imgs/<?php echo $img; ?>">
<?php } else { ?> 
           <img class="card-img-top" src="pros_imgs/no.png"> 
<?php } ?>
<div class="spt">
            <div class="card-body">
              <input type="file" class="input-file" name="image" id="image">
            </div>
              <input type="button" id="upimg" class="nputsave" value="Subir">
</div> 
    </label>
</form>  
    </div>
          </div>
</div>
</div>
<input type="hidden" id="resicpros_id">