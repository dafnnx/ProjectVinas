<?php 
  $pid= $_POST['id'];
require_once ("../cn/connect2.php");

    $query=$db2->prepare("SELECT * FROM personal WHERE id_personal=:id");
    $query->bindParam(':id', $pid);
    $query->execute();
    for($i=0; $row = $query->fetch(); $i++){
          $nss= $row['nss_personal'];
          $nombre= $row['nombre_personal'];
          $user= $row['username_personal'];
          $ecivil= $row['ecivil_personal'];
          $origen= $row['origen_personal'];
          $sexo= $row['sexo_personal'];
          $edad= $row['edad_personal'];
          $fnac= $row['fnac_personal'];
          $ingreso= $row['ingreso_personal']; 
          $curp= $row['curp_personal']; 
          $mail= $row['mail_personal']; 
          $area= $row['area_personal'];
          $subarea= $row['subarea_personal'];
          $rfc= $row['rfc_personal'];
          $permisos= $row['permisos_personal'];
          $img= $row['img_personal'];
          if(isset($permisos))
                {       $perms=explode(",",$permisos);  }
          $cedula= $row['cedula_personal'];
          $sta= $row['status_personal'];
          $tel= $row['tel_personal'];
     };
?>
<div class="info gral">
  <div class="gralfull">
          <div class="gralmain" >
  <div id="uppersonal">
    <input type="hidden" name="id_personal" value="<?php echo $pid; ?>">


      <div class="nfosper">
<div class="nfo1per">
    <div class="gralpersonal">
<table class="infotab" >  
  <tr>    
    <td>N.S.S.</td>
    <td><input class="nputs w110" type="text" name="nss_personal" value="<?php echo $nss; ?>"></td>
    <td>Nombre *</td>
    <td><input class="nputs w280" type="text" id="nombre_personal" value="<?php echo $nombre; ?>"  name="nombre_personal"></td>
    <td>Sexo</td>
    <td>
        <select class="nputs smw2" name="sexo_personal">
  <option disabled selected value="<?php echo $sexo; ?>"><?php echo $sexo; ?></option>
  <option value="hombre">Hombre</option>
  <option value="mujer">Mujer</option>
        </select>  
    </td>     
    <td>F. Nac.</td>
    <td><input class="nputs w100" type="date" value="<?php echo $fnac; ?>" onchange="calage(this.value, 'personal')" name="fnac_personal" ></td>
  </tr>
  <tr>
    <td>Origen</td>
    <td><input class="nputs w110" type="text" value="<?php echo $origen; ?>" name="origen_personal"></td>   
   <?php if ($sta=="2") { ?>      <td><div class="genbtn">Generar<div></td>      <?php  }
   else { ?> <td class="poin" onclick="gen_us_pass();"><div class="genbtn">Generar<div></td> <?php } ?>   
    <td>
      <input class="nputs w135" type="number" value="<?php echo $user; ?>" name="username_personal" id="per_usr" placeholder="Usuario" readonly >
      <input class="nputs w135" type="number" name="pass_personal" id="per_pass" placeholder="Password" readonly  >
    </td>
     <td>E. civil</td>
    <td>
        <select class="nputs smw2" name="ecivil_personal">
  <option disabled selected value="<?php echo $ecivil; ?>"><?php echo $ecivil; ?></option>
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
    <td><input class="nputs w100" type="date" name="ingreso_personal" value="<?php echo $ingreso; ?>"></td>
    </tr>
    <tr>
    <td>R.F.C.</td>
    <td><input class="nputs w110" type="text" name="rfc_personal" value="<?php echo $rfc; ?>"></td>
    <td>Email</td>
    <td><input class="nputs w280" type="mail" name="mail_personal" value="<?php echo $mail; ?>"></td>
    <td>Area</td>
    <td>
        <select class="nputs smw2" name="area_personal" id="area_personal" onchange="sub_area(this.value)">
  <option disabled selected value="<?php echo $area; ?>"><?php echo $area; ?></option>
  <option value="Enfermeria">Enfermería</option>
  <option value="Administracion">Administración</option>
  <option value="S. Generales">S. Generales</option>
  <option value="Mantenimiento">Mantenimiento</option>
  <option value="Rehabilitación">Rehabilitación</option>
  <option value="Medico">Medico</option>
        </select>  
    </td>       
    <td>Cédula</td>
    <td><input class="nputs w100" type="text" name="cedula_personal" value="<?php echo $cedula; ?>"></td>     
    </tr>
  <tr>
    <td>Edad</td>
    <td><input class="nputs w110" type="text" value="<?php echo edad($fnac); ?>" name="edad_personal" id="edad_personal"></td>
    <td>Curp</td>
    <td><input class="nputs w280" type="text" value="<?php echo $curp; ?>" name="curp_personal"></td>    
    <td></td>
    <td>
      <div id="s_area" name="subarea_personal"></div>
      <input type="hidden" name="subarea_personal" id="sap">
    </td> 
    <td>Teléfono</td>
    <td><input class="nputs w100" type="number" value="<?php echo $tel; ?>" name="tel_personal" ></td>      
  </tr>
</table>
</div>
</div>
<div class="nfo2per">
  <div class="nfo2per" id="nfo2per">  
<form method="post" action="javascript:;" enctype="multipart/form-data">
    <label class="input-personalizado">
  <?php
if (isset($img)){ ?>
          <img class="card-img-top" src="per_imgs/<?php echo $img; ?>">
<?php } else { ?> 
           <img class="card-img-top" src="per_imgs/no.png"> 
<?php } ?>     
        <div class="card-body">
      <input type="file" class="input-file" name="image" id="image">
            </div>
      <input type="button" id="upimg" class="nputsave" value="Actualizar">
    </label>  
</form> 
</div>
</div>
      </div>


<!--  <div class="docscheck"></div>   -->
<?php include('permisosedit.php');  ?>
</div>
<button type="submit" class="nputsave" id="upperbtn" onclick="update_personal('<?php echo $pid; ?>');" >Actualizar</button>
<!--  <div class="ldcntup padtop10px"> -->
            <div class="trtbl">
        <div class="" id="perso_contracts"></div>
            </div>    
<!--</div>  -->
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

 <script type="text/javascript">
  $(document).ready(function() {
    $("#upimg").on('click', function() {
        var pro_id = $("[name='id_personal']").val();
if (pro_id>0) {
        var formData = new FormData();
        var files = $('#image')[0].files[0];
        var files2 = $("#image").val().replace(/.*(\/|\\)/, '');
        formData.append('file',files);
        $.ajax({
            url: './saves/uploadper.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {            
    if (response != 0) {
              $.ajax({
              async: true,
              type: "POST",
              url:'./saves/upload2per.php',
              data: {pro_id:pro_id, files2:files2},
              })
                    $(".card-img-top").attr("src", response);
    } else {          
      Swal.fire({
            icon: 'warning',
            title: 'Formato de imagen incorrecto!',
            showConfirmButton: true,
          })     } }
        });
    return false;
}
else {
    Swal.fire({
    icon: 'error',
    title: '¡No hay personal seleccionado!',
    showConfirmButton: false,
    timer: 1500
    })

}        
    });
});
</script>