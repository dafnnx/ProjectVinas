<div class="indind">
        <div class="indxm speciline cpoint" onclick="viewpan('<?php echo $idt; ?>');">
                <div class="indic"><?php echo $j++; ?></div>  
<?php   $cym= $db2->prepare("SELECT cantidad_inv AS cinv FROM inventarios WHERE id_residente=:rid AND medicamento_inv=:medt");
        $cym->bindParam(':rid', $rid);
        $cym->bindParam(':medt', $medt);
        $cym->execute();
        for($i=0; $row = $cym->fetch(); $i++){
        $cinv= $row['cinv'];   ?>
                <div class="indic fwei6"><?php echo $cinv; ?></div>   
<?php } ?>             
        </div>
        <div class="indxmain">
<div class="panview" id="panview<?php echo $idt; ?>">       
<div class='dettrata fleftmar' title='Editar' onclick="mdledit(modedit, 'editclose', '<?php echo $idt; ?>','<?php echo $rid; ?>')"></div>
<div class='modtrata fleftmar' title='Actualizar' onclick="mdlmodif(modmodif, 'modifclose', '<?php echo $idt; ?>','<?php echo $rid; ?>')"></div>
<a class='deltrat fleftmar' title='Eliminar' onclick="eliminartrata('<?php echo $idt; ?>', 'tratamientos', 'id_tratamiento', '<?php echo $rid; ?>')"></a>

                </div>
<div class="tblspecialdat">
        <div class="speci1dat speciline"><?php echo $finif; ?></div>
        <div class="speci1dat speciline"><?php echo $ffinef; ?></div>
<?php
    $cy= $db2->prepare("SELECT nombre_medica AS nmed FROM medicamentos WHERE id_medica=:id");
    $cy->bindParam(':id', $medt);
    $cy->execute();
    for($i=0; $row = $cy->fetch(); $i++){
    $nmed = $row['nmed']; ?>

        <div class="speci2dat speciline"><?php echo $nmed; ?></div>
<?php } ?>
        <div class="speci3dat speciline"><input type="checkbox" name="d1" <?php if (in_array("1", $dias)) echo "checked"; ?> onclick="javascript: return false;"></div>
        <div class="speci3dat speciline"><input type="checkbox" name="d2" <?php if (in_array("2", $dias)) echo "checked"; ?> onclick="javascript: return false;"></div>
        <div class="speci3dat speciline"><input type="checkbox" name="d3" <?php if (in_array("3", $dias)) echo "checked"; ?> onclick="javascript: return false;"></div>
        <div class="speci3dat speciline"><input type="checkbox" name="d4" <?php if (in_array("4", $dias)) echo "checked"; ?> onclick="javascript: return false;"></div>
        <div class="speci3dat speciline"><input type="checkbox" name="d5" <?php if (in_array("5", $dias)) echo "checked"; ?> onclick="javascript: return false;"></div>
        <div class="speci3dat speciline"><input type="checkbox" name="d6" <?php if (in_array("6", $dias)) echo "checked"; ?> onclick="javascript: return false;"></div>
        <div class="speci3dat speciline"><input type="checkbox" name="d7" <?php if (in_array("7", $dias)) echo "checked"; ?> onclick="javascript: return false;"></div>
        <div class="speci1dat speciline"><input type="checkbox" name="variante_tratamiento" <?php if ( $varit) echo "checked"; ?> onclick="javascript: return false;"></div>
        <div class="speci3dat speciline"><?php echo $diat; ?></div>
        <div class="speci3dat speciline"><?php echo $siet; ?></div>
        <div class="speci3dat speciline"><?php echo $och; ?></div>
        <div class="speci3dat speciline"><?php echo $trce; ?></div>
        <div class="speci3dat speciline"><?php echo $dieco; ?></div>
        <div class="speci3dat speciline"><?php echo $vtuno; ?></div>        
</div>
<div class="tblspecialdat">
        <div class="speci4dat speciline" title="<?php echo $observa; ?>"><?php echo $observa;?></div>
        <div class="speci1dat speciline"><?php echo $pauta; ?></div>
        <div class="speci1dat speciline"><?php echo $tipom; ?></div>
<?php  
    $cy2= $db2->prepare("SELECT nombre_via AS nvia FROM vias WHERE id_via=:id");
    $cy2->bindParam(':id', $viam);
    $cy2->execute();
    for($i=0; $row = $cy2->fetch(); $i++){
$nvia = $row['nvia']; ?>
        <div class="speci1dat speciline"><?php echo $nvia; ?></div>
<?php }  
    $cy3= $db2->prepare("SELECT nombre_unidad AS nuni FROM unidades WHERE id_unidad=:id");
    $cy3->bindParam(':id', $unim);
    $cy3->execute();
    for($i=0; $row = $cy3->fetch(); $i++){
$nuni = $row['nuni']; ?>
        <div class="speci1dat speciline"><?php echo $nuni; ?></div>
<?php } ?>
        <div class="speci1dat speciline">Patología</div>
</div>
        </div>
</div>