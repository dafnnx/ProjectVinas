<div class="gralmain">  
      <div class="paycnt">
        <div class="btnmainfull" >CONTACTOS</div>
      </div>
  </div>
    <div class="gralfull">
    <div class="gralmidshow" >
 <form id="selprecont" method="POST">
<table class="infotab"> 
  <input type="hidden" name="saved_idrcontpros" id="saved_idrcontpros">  
  <input type="hidden" name="user_id" value="<?php echo $uid ?>">  
  <tr>
    <td>Nombre *</td>
    <td><input class="nputs w213" type="text" name="nombre_contacto" required autocomplete="off"></td>    
    <td>Dirección</td>
    <td><input class="nputs" type="text" name="dir_contacto" autocomplete="off"></td>  
    <td>Teléfono</td>
    <td><input class="nputs w130" type="text" name="tela_contacto" autocomplete="off"></td>      
    <td>F. Nacimiento</td>
    <td><input class="nputs w100" type="date" name="fnac_contacto" onchange="calage(this.value, 'contacto')" autocomplete="off"></td>     
  </tr>
  <tr>
    <td>Parentezco *</td>
    <td><input class="nputs w213" type="text" name="parent_contacto" required autocomplete="off"></td>     
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
    <td><input class="nputs" type="text" name="mpo_contacto" autocomplete="off"></td>
    <td>Tel (móvil)</td>
    <td><input class="nputs w130" type="text" name="telc_contacto" autocomplete="off"></td>
    <td></td>
    <td>
      <input type="submit" class="nputsave" id="saveprecont" value="Añadir">
    </td>  
  </tr>
</table>
</form>
<div class="ldcntup">
  <div class="tbldata" id="resict"></div>
</div>
    </div>
  </div>  