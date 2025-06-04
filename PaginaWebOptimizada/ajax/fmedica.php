<?php
require_once ("../cn/connect2.php");
$numberofrecords = 10;

if(!isset($_POST['searchTerm'])){
   $stmt = $db2->prepare("SELECT * FROM medicamentos ORDER BY nombre_medica LIMIT :limit");
   $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
   $stmt->execute();
   $lista_medica = $stmt->fetchAll();

}else{

   $search = $_POST['searchTerm'];// Search text

   // Mostrar resultados
   $stmt = $db2->prepare("SELECT * FROM medicamentos WHERE nombre_medica LIKE :nombre OR barras_medica LIKE :nombre ORDER BY nombre_medica LIMIT :limit");
   $stmt->bindValue(':nombre', '%'.$search.'%', PDO::PARAM_STR);
   $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
   $stmt->execute();
   //Variable en array para ser procesado en el ciclo foreach
   $lista_medica = $stmt->fetchAll();
}

$response = array();

// Leer los datos de MySQL
foreach($lista_medica as $pro){
$idm=$pro['id_medica'];
$barras=$pro['barras_medica'];
$nombre=$pro['nombre_medica'];
$envase=$pro['envase_medica'];
$unidad=$pro['unidad_medica'];
$qty=$pro['qtyind_medica'];
   $count_query= $db2->prepare("SELECT nombre_envase AS ne FROM envases WHERE id_envase='$envase'");
   $count_query->execute();
   for($i=0; $row = $count_query->fetch(); $i++){ $ne= $row['ne'] ;   }

   $ct_q= $db2->prepare("SELECT nombre_unidad AS nu FROM unidades WHERE id_unidad='$unidad'");
   $ct_q->execute();
   for($i=0; $row = $ct_q->fetch(); $i++){ $nu= $row['nu'] ;   }

   $quer=$db2->prepare("SELECT DISTINCT id_activo AS ida FROM rel_act_med WHERE id_medica='$idm'");
   $quer->execute();
   for($i=0; $row = $quer->fetch(); $i++){   $ida= $row['ida']; 
   $qer=$db2->prepare("SELECT nombre_activo AS na FROM activos WHERE id_activo=$ida");
   $qer->execute();
   for($i=0; $row = $qer->fetch(); $i++){    $na= $row['na'];      }  
    }     

   $response[] = array(
      "id" => $idm,
      "text" => array ($barras." - ".$nombre." - ". $ne." - ".$nu." - ".$na." - ".$qty),     
   );
}

echo json_encode($response);
exit();
?>