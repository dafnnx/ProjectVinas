<?php
require_once ("../cn/connect2.php");
$numberofrecords = 10;

if(!isset($_POST['searchTerm'])){
   $stmt = $db2->prepare("SELECT * FROM envases ORDER BY nombre_envase LIMIT :limit");
   $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
   $stmt->execute();
   $lista_envase = $stmt->fetchAll();

}else{

   $search = $_POST['searchTerm'];// Search text

   // Mostrar resultados
   $stmt = $db2->prepare("SELECT * FROM envases WHERE nombre_envase like :nombre ORDER BY nombre_envase LIMIT :limit");
   $stmt->bindValue(':nombre', '%'.$search.'%', PDO::PARAM_STR);
   $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
   $stmt->execute();
   //Variable en array para ser procesado en el ciclo foreach
   $lista_envase = $stmt->fetchAll();
}

$response = array();

// Leer los datos de MySQL
foreach($lista_envase as $pro){
   $response[] = array(
      "id" => $pro['id_envase'],
      "text" => $pro['nombre_envase']
   );
}

echo json_encode($response);
exit();
?>