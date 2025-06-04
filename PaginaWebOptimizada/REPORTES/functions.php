<?php require_once('../cn/connect2.php'); 
function loadres($id){
              global $db2;
              $pac = $db2->prepare("SELECT * FROM residentes WHERE id_residente=:id");
              $pac->bindParam(':id', $id);
              $pac->execute();
              return($pac->fetchAll());   }

function loadexpe($id){
              global $db2;
              $pac = $db2->prepare("SELECT * FROM nota_medica WHERE id_notamed=:id");
              $pac->bindParam(':id', $id);
              $pac->execute();
              return($pac->fetchAll());   }

function loadtrt($id){
              global $db2;
              $pac = $db2->prepare("SELECT * FROM tratamientos WHERE id_tratamiento=:id");
              $pac->bindParam(':id', $id);
              $pac->execute();
              return($pac->fetchAll());   }

function loadmedi($id){
              global $db2;
              $pacmed = $db2->prepare("SELECT * FROM medicamentos WHERE id_medica=:id");
              $pacmed->bindParam(':id', $id);
              $pacmed->execute();
              return($pacmed->fetchAll());   }

function loadvia($id){
              global $db2;
              $pacvia = $db2->prepare("SELECT * FROM vias WHERE id_via=:id");
              $pacvia->bindParam(':id', $id);
              $pacvia->execute();
              return($pacvia->fetchAll());   }

function loadunidad($id){
              global $db2;
              $pacuni = $db2->prepare("SELECT * FROM unidades WHERE id_unidad=:id");
              $pacuni->bindParam(':id', $id);
              $pacuni->execute();
              return($pacuni->fetchAll());   }

function loadconcepts($q1, $q2, $idr){
              global $db2;             
              $query= $db2->prepare("SELECT * FROM payconcept WHERE (fecha_pay BETWEEN :fin AND :ffi) AND id_residente=:idr AND status=2");
              $query->bindParam(':fin', $q1);
              $query->bindParam(':ffi', $q2);
              $query->bindParam(':idr', $idr);
              $query->execute();  
              return($query->fetchAll());   }

function loadpay($id){
   global $db2;
   $pac = $db2->prepare("SELECT * FROM payconcept WHERE id_pay=:id");
   $pac->bindParam(':id', $id);
   $pac->execute();
   return($pac->fetchAll());   }

function loadpaymonth($id){
   global $db2;
   $pac = $db2->prepare("SELECT * FROM tarifas WHERE id_tarifa=:id");
   $pac->bindParam(':id', $id);
   $pac->execute();
   return($pac->fetchAll());   }

function loadclient($id){
   global $db2;
   $pac2 = $db2->prepare("SELECT * FROM clientes WHERE id_cliente=:id");
   $pac2->bindParam(':id', $id);
   $pac2->execute();
   return($pac2->fetchAll());   }

function check_ticket(){ 
   global $db2;
   $check_t = $db2->prepare("SELECT * FROM ticket WHERE id_ticket=1");
   $check_t->execute();
   return($check_t->fetchAll()); }
?>