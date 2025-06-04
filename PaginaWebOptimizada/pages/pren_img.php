<?php
 require_once ("../cn/connect2.php");
$idr= $_POST['idr'];
$nom= $_POST['nom'];
$img= $_POST['img'];
$ida= $_POST['ida'];
$rid= $_POST['rid']; ?>
<div class="ropa_detail_cont">
<div class="pic_ropas">
<!--	<div class="img_ropa">  -->
<form method="post" action="javascript:;" enctype="multipart/form-data">
    <label class="input-personalizado">
	<input type="hidden" id="id_r" value="<?php echo $idr; ?>">
<?php
if (isset($img)){ ?>
          <img class="card-img-top2" src="prenda_imgs/<?php echo $img; ?>">
<?php } else { ?> 
           <img class="card-img-top2" src="prenda_imgs/no.png"> 
<?php } ?>
<div class="spt2">
            <div class="card-body">
            <input type="file" class="input-file" name="imagepre" id="imagepre">
            </div>
    <input type="button" id="upprenda" onclick="uppr();" class="nputsave" value="Subir">
    </label>
 <!--     </div>  -->
 </form> 	
   </div>   
</div>
<div class="pic_status">
<div class="rupstasta" id="save_ropastat">
            <div class="rupsta">
      <div class="w100per dpflex">
            <input type="hidden" name="idr_ropastatus" value="<?php echo $idr; ?>">
<select class="nputs w20per marr5md" id="status_ropastatus" name="status_ropastatus">
          <option disabled selected>Selecciona status</option>
          <option value="activo">Activo</option>
          <option value="baja">Baja</option>
</select>  
            <input type="text" id="motivo_ropastatus" name="motivo_ropastatus" class="nputs w80per marr5md" placeholder="Motivo">
            
      </div>
      <div class="w100per dpflex">
            <input type="date" id="fecha_ropastatus" name="fecha_ropastatus" class="nputs w20per marr5ed" placeholder="Fecha">
            <input type="text" id="persona_ropastatus" name="persona_ropastatus" class="nputs w80per marr5ed" placeholder="Persona">
      </div>
            </div>            
      <div class="rupsave ropaplus pointer" onclick="save_ropasta('<?php echo $idr; ?>');"></div>
</div>
<div class="rstalist w100per" id="rstalist">
</div>
</div>
</div>