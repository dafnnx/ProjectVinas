<?php  $rid= $_POST['nrid'];
       $sta= "1";
 require_once ("../cn/connect2.php");
    $count_= $db2->prepare("SELECT count(*) AS numrows FROM tratamientos WHERE id_residente=:rid AND status_tratamiento=:sta");
    $count_->bindParam(':rid', $rid);
    $count_->bindParam(':sta', $sta);
    $count_->execute();
    for($i=0; $row = $count_->fetch(); $i++){    $numrows = $row['numrows'];        }
if ($numrows>0){
    $count_query= $db2->prepare("SELECT DISTINCT id_tratamiento FROM tratamientos WHERE id_residente=:rid AND status_tratamiento=:sta");
    $count_query->bindParam(':rid', $rid);
    $count_query->bindParam(':sta', $sta);
    $count_query->execute();   ?>  
<div class="miniseparator"></div> 
<div class="">
              <table class="table" data-responsive="table" id="resultTable">
                <thead>
                <tr>
                    <th class='text-center w60'>Id</th>  
                    <th class='text-center w60'>Descripción</th>                                   
                </tr>
                </thead>
                <?php
                for($i=0; $row = $count_query->fetch(); $i++){
                        $idt = $row['id_tratamiento']; 
                        $obs = $row['observa_tratamiento'];                 ?>
                    <tr>
                        <td><?php echo $idt; ?>
                            <div class="">aaaa</div>
                        </td>
                        <td><?php echo $obs; ?></td>                                                           
                    </tr>
                    <?php   }   ?>
              </table>
</div> 
<?php   } else {  echo "No hay tratamientos activos";   }   ?>