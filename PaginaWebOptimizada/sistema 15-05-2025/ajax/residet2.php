<div class="info gral">
  <div class="gralmain">
      <div class="paycnt">
        <div class="btnmain pointer" onclick="mainshow('gral2', loadcontact('<?php echo $rid; ?>'))">CONTACTOS</div>
        <div class="btnmain pointer" onclick="mainshow('gral3', ens_list('<?php echo $rid; ?>'))">ENSERES</div>
        <div class="btnmain pointer" onclick="mainshow('gral4', loadinv('<?php echo $rid; ?>'))">MEDICAMENTOS</div>
        <div class="btnmain pointer" onclick="mainshow('gral5', showhide('upfrtr', 'listfrtr', 'movsfrtr', 'histfrtr', 'list', '<?php echo $rid; ?>'))">TRATAMIENTOS</div>
        <div class="btnmain pointer" onclick="mainshow('gral6', thelist('<?php echo $rid; ?>'))">ARCHIVOS</div>
      </div>
  </div>
    <div class="gralfull">
    <div class="gralmid" id="gral2">
      <div id="upfrcont">
<table class="infotab">  
  <input type="hidden" name="user_id" value="<?php echo $uid ?>">
  <input type="hidden" name="resic_cont" value="<?php echo $rid; ?>">
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
<?php 
require_once ("residet3.php");
require_once ("residet4.php");
require_once ("residet5.php");
require_once ("residet6.php");
 ?>
</div>