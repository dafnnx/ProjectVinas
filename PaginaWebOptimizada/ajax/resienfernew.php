<div class="info gral">
  <div class="gralmini">
    <div class="paycnt">
      <div class="btnpay pointer" onclick="showhide('newnoteenfer', 'expeenfer', 'cons', '<?php echo $idr;?>');">+ NOTA ENFERMERIA</div>
      <div class="btnpay pointer" onclick="showhide('expeenfer', 'newnoteenfer', 'mens', '<?php echo $idr;?>');">EXPEDIENTE</div>
    </div>
<div class="dpnone" id="newnoteenfer">
  <div class="miniseparator"></div>
<div id="selnotaenfer">
    <input type="hidden" name="id_residente" value="<?php echo $idr; ?>"> 
    <input type="hidden" name="id_usuario" value="<?php echo $uid; ?>">    
SIGNOS VITALES <input type="datetime-local" class="nputs fight" name="fec_notaenfer">
    <table>
     <tr>
      <td>TA:</td><td><input type="text" class="nputs w50" name="ta_notaenfer"></td>
      <td>FC:</td><td><input type="text" class="nputs w50" name="fc_notaenfer"></td>
      <td>FR:</td><td><input type="text" class="nputs w50" name="fr_notaenfer"></td>
      <td>SAT O2:</td><td><input type="text" class="nputs w50" name="sat_notaenfer"></td>
      <td>TEMPERATURA:</td><td><input type="text" class="nputs w50" name="temp_notaenfer"></td>
      <td>GLICEMIA:</td><td><input type="text" class="nputs w50" name="gli_notaenfer"></td>
     </tr>
    </table>
<div class="separator"></div>
INGESTAS Y LIQUIDOS
    <table>
     <tr>
      <td>PORCENTAJE DE COMIDA INGERIDA:</td><td><input type="text" class="nputs w50" name="percen_ing_notaenfer" ></td>
      <td>CANT. DE LIQUIDOS CONSUMIDOS POR TURNO:</td><td><input type="text" class="nputs w50" name="cant_liq_notaenfer" ></td>
     </tr>
    </table>
<div class="separator"></div>
MICCIONES Y EVACUACIONES
    <table>
     <tr>
      <td># DE MICCIONES:</td><td><input type="text" class="nputs w50" name="no_mic_notaenfer" ></td>
      <td># DE EVACUACIONES:</td><td><input type="text" class="nputs w50" name="no_evac_notaenfer" ></td>
      <td># DE PAÑALES UTILIZADOS:</td><td><input type="text" class="nputs w50" name="no_panal_notaenfer" ></td>
     </tr>
    </table>
<div class="separator"></div>
    <table>
     <tr>
      <td>VISITA MEDICA:</td><td>
        <select class="nputs" name="visita_notaenfer">
          <option value="" selected></option>
          <option value="Si" >Si</option>
          <option value="No">No</option>
        </select>
      </td>
      <td>CAIDA:</td><td>
        <select class="nputs" name="caida_notaenfer">
          <option value="" selected></option>
          <option value="Si">Si</option>
          <option value="No">No</option>
        </select>
      </td>
      <td>DEAMBULO:</td><td>
        <select class="nputs" name="deam_notaenfer">
          <option value="" selected></option>
          <option value="Si">Si</option>
          <option value="No">No</option>
        </select>
      </td>
      <td>BAÑO:</td><td>
        <select class="nputs" name="bano_notaenfer">
          <option value="" selected></option>
          <option value="Si">Si</option>
          <option value="No">No</option>
        </select>
      </td>
      <td>ASEO BUCAL</td><td>
        <select class="nputs" name="bucal_notaenfer">
          <option value="" selected></option>
          <option value="Si">Si</option>
          <option value="No">No</option>
        </select>
      </td>
      <td>TERAPIA FISICA:</td><td>
        <select class="nputs" name="terap_notaenfer">
          <option value="" selected></option>
          <option value="Si">Si</option>
          <option value="No">No</option>
        </select>
      </td>
     </tr>
    </table>
<div class="separator"></div>
EVENTUALIDADES DEL TURNO
<select class="nputs" name="turno_notaenfer">
  <option selected disabled>Turno</option>
  <option value="Matutino">Matutino</option>
  <option value="Vespertino">Vespertino</option>
  <option value="Nocturno">Nocturno</option>
</select>
<textarea class="tarea95new" rows="7" name="evens_turno_notaenfer"> </textarea>
</div>
<button type="submit" class="nputsave" id="savenotaenfer" onclick="save_notaenfer();" >Guardar</button>      
</div>
<div id="expeenfer" class="dpnone">
  <div id="resiexpes"></div>
</div>
  </div>
</div>