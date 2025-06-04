<?php
require_once ("../cn/connect2.php");
$numberofrecords = 10;

if(!isset($_POST['searchTerm'])){
   $stmt = $db2->prepare("SELECT * FROM patologias ORDER BY nombre_patologia LIMIT :limit");
   $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
   $stmt->execute();
   $lista_patologia = $stmt->fetchAll();

}else{

   $search = $_POST['searchTerm'];// Search text

   // Mostrar resultados
   $stmt = $db2->prepare("SELECT * FROM patologias WHERE nombre_patologia like :nombre ORDER BY nombre_patologia LIMIT :limit");
   $stmt->bindValue(':nombre', '%'.$search.'%', PDO::PARAM_STR);
   $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
   $stmt->execute();
   //Variable en array para ser procesado en el ciclo foreach
   $lista_patologia = $stmt->fetchAll();
}

$response = array();

// Leer los datos de MySQL
foreach($lista_patologia as $pro){
   $response[] = array(
      "id" => $pro['id_patologia'],
      "text" => $pro['nombre_patologia']
   );
}

echo json_encode($response);
exit();
?>