<?php
require_once ("../cn/connect2.php");
$numberofrecords = 10;

if(!isset($_POST['searchTerm'])){
   $stmt = $db2->prepare("SELECT * FROM mmarcas ORDER BY nombre_mmarca LIMIT :limit");
   $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
   $stmt->execute();
   $lista_marca = $stmt->fetchAll();

}else{

   $search = $_POST['searchTerm'];// Search text

   // Mostrar resultados
   $stmt = $db2->prepare("SELECT * FROM mmarcas WHERE nombre_mmarca like :nombre ORDER BY nombre_mmarca LIMIT :limit");
   $stmt->bindValue(':nombre', '%'.$search.'%', PDO::PARAM_STR);
   $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
   $stmt->execute();
   //Variable en array para ser procesado en el ciclo foreach
   $lista_marca = $stmt->fetchAll();

}

$response = array();

// Leer los datos de MySQL
foreach($lista_marca as $pro){
   $response[] = array(
      "id" => $pro['nombre_mmarca'],
      "text" => $pro['nombre_mmarca']
   );
}

echo json_encode($response);
exit();
?>