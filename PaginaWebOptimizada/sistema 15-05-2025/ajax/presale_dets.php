<?php
$sid=$_POST['sid'];
$uid=$_POST['uid'];
$idr=$_POST['idr'];
require_once ("../cn/connect2.php"); 
    
        $res=$db2->prepare("SELECT nombre_residente AS nres FROM residentes WHERE id_residente=:idr");
        $res->bindParam(':idr', $idr);
        $res->execute();  
        for($i=0; $row = $res->fetch(); $i++){       $nres= $row['nres'];    } 
?>
  <div class="ribbon">Ventas de <?php echo $nres; ?></div>
  <div class="separator"></div>
      <div class="">
        <table class="table" data-responsive="table" id="resultTable">
          <thead>
        <tr>
          <th class='text-center'>*</th>
          <th class='text-center'>Nombre</th>   
          <th class='text-center'>Fecha</th>
          <th class='text-center w60'>Cant.</th>
          <th class='text-center w60'>Precio</th>
          <th class='text-center w60'>Iva</th>
          <th class='text-center w60'>Tot. iva</th> 
          <th class='text-center'>Total</th> 
          <th class='text-center'>**</th> 
          <th class='text-center'>Status</th>
        </tr>
        </thead>
        <?php
        $query=$db2->prepare("SELECT *  FROM payconcept  WHERE sale_id=:id AND status=3");
        $query->bindParam(':id', $sid);
        $query->execute();  
        for($i=0; $row = $query->fetch(); $i++){
          
                  $idcp= $row['id_pay'];
                  $idm= $row['idconcept_pay'];
                  $concepto= $row['concept_pay'];
                  $fecha= $row['fecha_pay']; 
                  $qty= $row['cantidad_pay'];
                  $debe= $row['debe_pay'];
                  $iva= $row['iva_pay'];

          /*          $total= ($debe)+($iva); */

        $ry=$db2->prepare("SELECT nombre_iva AS niva FROM iva WHERE id_iva=(SELECT iva_medica AS ivm FROM medicamentos WHERE id_id_medica=:idm)");
        $ry->bindParam(':idm', $idm);
        $ry->execute();  
        for($i=0; $row = $ry->fetch(); $i++){  $niva= $row['niva'];  }      ?>
          <tr>
            <td><div class="del" onclick="delpool('<?php echo $idcp; ?>', '<?php echo $sid; ?>', '<?php echo $uid; ?>', '<?php echo $idr; ?>')" title='Eliminar'></div></td>

            <td><?php echo $concepto; ?></td> 

            <td class="textcenter"><?php echo $fecha; ?></td>

            <td class="w60 textcenter"><?php echo $qty; ?></td>



            <td class="w60"> <input id="<?php echo $idcp; ?>" value="<?php echo $debe; ?>" onkeyup="calc(this.id, this.value, '<?php echo $idm; ?>', '<?php echo $qty; ?>', '<?php echo $niva; ?>')" class="nputs mar5 w60 textcenter"></td>
 <?php         
        if ($niva) { ?>   <td class="textcenter"><?php echo $niva; ?> %</td>
        <?php    }  else { ?> <td class="textcenter">N/A</td> <?php  }   ?>



            <td class="w60"> <input id="<?php echo $idcp; ?>-tiva" value="<?php echo $iva; ?>" class="nputsdwn mar5 w60 textcenter" readonly>  </td>

            <td class="w60"> <input id="<?php echo $idcp; ?>-tot" value="<?php echo $debe; ?>" class="nputsdwn mar5 w60 textcenter" readonly>  </td>

            <td class="textcenter"><a class='icnplus' title='Guardar' onclick="add('<?php echo $sid; ?>', '<?php echo $uid; ?>', '<?php echo $idr; ?>', '<?php echo $idcp; ?>', '<?php echo $qty; ?>');" ></a></td>
            <td class="textcenter"><?php   if ($debe) { echo "Correcto"; } else {  echo "N/E"; }  ?>   </td> 
          </tr>
        <?php  }  ?>
        </table>
      </div>
      <button class="nputsave" onclick="cerrar('<?php echo $sid; ?>', '<?php echo $uid; ?>', '<?php echo $idr; ?>');">Cerrar</button>