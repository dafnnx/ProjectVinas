<div class="info gral">
  <div class="gralmain">
      <div class="paycnt">
        <div class="btnmainfull">CONTACTOS</div>
      </div>
  </div>
    <div class="gralfull">
    <div class="gralmidshow">
      <div id="upfrcont">
<table class="infotab">  
  <input type="hidden" name="user_id" value="<?php echo $uid ?>">
  <input type="hidden" name="resic_cont" id="resic_cont" value="<?php echo $rid; ?>">
  <tr>
    <td>Nombre *</td>
    <td><input class="nputs w213" type="text" id="n_cont" name="nombre_contacto" required autocomplete="off"></td>    
    <td>Dirección</td>
    <td><input class="nputs" type="text" name="dir_contacto" autocomplete="off"></td>  
    <td>Teléfono</td>
    <td><input class="nputs w130" type="text" name="tela_contacto" autocomplete="off"></td>  
    <td>F. Nacimiento</td>
    <td><input class="nputs w100" type="date" name="fnac_contacto" onchange="calage(this.value, 'contacto')" autocomplete="off"></td>            
  </tr>
  <tr>
    <td>Parentezco *</td>
    <td><input class="nputs w213" type="text" id="p_cont" name="parent_contacto" required autocomplete="off"></td>     
    <td>C.P.</td>
    <td><input class="nputs" type="number" name="cp_contacto" autocomplete="off"></td>
    <td>Tel (fijo)</td>
    <td><input class="nputs w130" type="text" name="telb_contacto" autocomplete="off"></td>     
    <td>Edad</td>
    <td><input class="nputs w100" type="number" name="edad_contacto" id="edad_contacto"></td>
  </tr>
   <tr>
    <td>Email</td>
    <td><input class="nputs w213" type="mail" name="mail_contacto" autocomplete="off"></td>   
    <td>Municipio</td>
    <td><input class="nputs" type="text" name="mpo_contacto"></td>
    <td>Tel (móvil)</td>
    <td><input class="nputs w130" type="text" name="telc_contacto" autocomplete="off"></td>
    <td></td>
    <td>
      <input type="submit" class="nputsave" value="Añadir" onclick="newcontact('<?php echo $rid; ?>');">
    </td>  
  </tr>
</table>
      </div>    
<div class="ldcntup">
  <div class="tbldata" id="resict"></div>
</div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $("#upimg").on('click', function() {
        var pro_id = $("#resic_cont").val();
if (pro_id>0) {
    var formData = new FormData();
        var files = $('#image')[0].files[0];
        var files2 = $("#image").val().replace(/.*(\/|\\)/, '');
        formData.append('file',files);
        $.ajax({
            url: './saves/uploadpros.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {            
    if (response != 0) {
              $.ajax({
              async: true,
              type: "POST",
              url:'./saves/upload2pros.php',
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
    title: '¡No hay residente seleccionado!',
    showConfirmButton: false,
    timer: 1500
  })

}     
    });
});
</script>