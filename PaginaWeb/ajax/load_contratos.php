<?php
$idr= $_POST['idr'];
    require_once ("../cn/connect2.php");
$today = new DateTime();
$td = $today->format("d-M-Y");

?>
<div class="separator"></div>
<div class="ribbon">CONTRATOS</div>
<div class="cont_board" id="selcontr">
        <input type="hidden" name="id_residente" value="<?php echo $idr;?>">
  <table class="infotabcontr cien">
      <tr>
        <td>Alta</td>
        <td>Inicio</td>
        <td>Fin</td>
        <td></td>
      </tr>
      <tr>
        <td>
          <input class="nputs w95per" type="text" value="<?php echo $td;?>"  readonly>
          <input class="nputs" type="hidden" name="alta_contrato" value="<?php echo date('d-m-Y');?>" readonly>
        </td>
        <td>
          <input class="nputs w95per" type="date" name="inicio_contrato" required>
        </td>
        <td>
          <input class="nputs w95per" type="date" name="fin_contrato" required>
        </td>
        <td>
          <input type="submit" id="savecontr" class="nputsave" value="Guardar" onclick="save_contract('<?php echo $idr;?>');"> 
        </td>
      </tr>
  </table>
</div>
<div class="cont_lst_lst" id="cont_lst_lst"></div>