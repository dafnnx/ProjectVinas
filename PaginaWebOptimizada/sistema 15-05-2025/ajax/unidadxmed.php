<?php
require_once ("../cn/connect2.php");
$numberofrecords = 10;

if(!isset($_POST['searchTerm'])){
   $stmt = $db2->prepare("SELECT * FROM unidades ORDER BY nombre_unidad LIMIT :limit");
   $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
   $stmt->execute();
   $lista_unidad = $stmt->fetchAll();

}else{

   $search = $_POST['searchTerm'];// Search text

   // Mostrar resultados
   $stmt = $db2->prepare("SELECT * FROM unidades WHERE nombre_unidad like :nombre ORDER BY nombre_unidad LIMIT :limit");
   $stmt->bindValue(':nombre', '%'.$search.'%', PDO::PARAM_STR);
   $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
   $stmt->execute();
   //Variable en array para ser procesado en el ciclo foreach
   $lista_unidad = $stmt->fetchAll();
}

$response = array();

// Leer los datos de MySQL
foreach($lista_unidad as $pro){
   $response[] = array(
      "id" => $pro['id_unidad'],
      "text" => $pro['nombre_unidad']
   );
}

echo json_encode($response);
exit();
?>