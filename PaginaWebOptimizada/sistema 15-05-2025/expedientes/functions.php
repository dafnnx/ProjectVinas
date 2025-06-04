<?php require_once('../cn/connect2.php'); ?>
<?php
function eliminar ($id){
              global $db2;
              $del = $db2->prepare("DELETE * FROM sesion WHERE id_sesion=:id");
              $del->bindParam(':id', $id);
              $del->execute();  
              return($del->fetchAll());    }

function loadpac($id){
              global $db2;
              $pac = $db2->prepare("SELECT * FROM pacientes WHERE id_paciente=:id");
              $pac->bindParam(':id', $id);
              $pac->execute();
              return($pac->fetchAll());   }

function loadexpe($id){
              global $db2;
              $pac = $db2->prepare("SELECT * FROM rc WHERE id_paciente=:id");
              $pac->bindParam(':id', $id);
              $pac->execute();
              return($pac->fetchAll());   }

function loadexcs($idcs){
              global $db2;
              $pac = $db2->prepare("SELECT * FROM cs WHERE id_cs=:id");
              $pac->bindParam(':id', $idcs);
              $pac->execute();
              return($pac->fetchAll());   }

function loadpics($ids){
              global $db2;
              $pic = $db2->prepare("SELECT * FROM photo WHERE id_sesion=$ids");
              $pic->bindParam(':ids', $ids);
              $pic->execute();
              return($pic->fetchAll());   }

function tratinfo($id){
              global $db2;
              $pac = $db2->prepare("SELECT * FROM tratamiento WHERE id_paciente=:id");
              $pac->bindParam(':id', $id);
              $pac->execute();
              return($pac->fetchAll());   }

function sesinfo($id){
              global $db2;
              $pac = $db2->prepare("SELECT * FROM sesion WHERE id_paciente=:id");
              $pac->bindParam(':id', $id);
              $pac->execute();
              return($pac->fetchAll());   }

function sesdata($ids){
              global $db2;
              $pac = $db2->prepare("SELECT * FROM sesion WHERE id_sesion=:id");
              $pac->bindParam(':id', $ids);
              $pac->execute();
              return($pac->fetchAll());   }

function loadelian($id){
              global $db2;
              $pac = $db2->prepare("SELECT * FROM san_elian WHERE id_paciente=:id and sesion='inicio'");
              $pac->bindParam(':id', $id);
              $pac->execute();
              return($pac->fetchAll());   }

function loadelian2($id){
              global $db2;
              $pac = $db2->prepare("SELECT * FROM san_elian WHERE id_paciente=:id and sesion='termino'");
              $pac->bindParam(':id', $id);
              $pac->execute();
              return($pac->fetchAll());   }

function loadelian3($id){
              global $db2;
              $pac = $db2->prepare("SELECT * FROM san_elian WHERE id_paciente=:id and sesion='1mes'");
              $pac->bindParam(':id', $id);
              $pac->execute();
              return($pac->fetchAll());   }

function loadelian4($id){
              global $db2;
              $pac = $db2->prepare("SELECT * FROM san_elian WHERE id_paciente=:id and sesion='2mes'");
              $pac->bindParam(':id', $id);
              $pac->execute();
              return($pac->fetchAll());   }

function loadelian5($id){
              global $db2;
              $pac = $db2->prepare("SELECT * FROM san_elian WHERE id_paciente=:id and sesion='3mes'");
              $pac->bindParam(':id', $id);
              $pac->execute();
              return($pac->fetchAll());   }

function loadusr($id){
              global $db2;
              $usr = $db2->prepare("SELECT * FROM users WHERE user_id=:id");
              $usr->bindParam(':id', $id);
              $usr->execute();
              return($usr->fetchAll());   }

function loadpac_i($id){
              global $db2;
              $pac_i = $db2->prepare("SELECT userPic FROM pacientes WHERE id_paciente=:id");
              $pac_i->bindParam(':id', $id);
              $pac_i->execute();
              return($pac_i->fetchAll());   }

function loadusr_i($id){
              global $db2;
              $usr_i = $db2->prepare("SELECT userPic FROM users WHERE user_id=:id");
              $usr_i->bindParam(':id', $id);
              $usr_i->execute();
              return($usr_i->fetchAll());   }

function slct_pac(){
              global $db2;
              $slctp = $db2->prepare("SELECT * FROM pacientes ORDER BY nombre_paciente ASC");
              $slctp->bindParam(':nombre_paciente', $nombre_paciente);
              $slctp->execute();
              return($slctp->fetchAll()); }

function nosesion($id){
              global $db2;
              $invo = $db2->prepare("SELECT MAX(no_sesion)+1 as no_sesion FROM sesion WHERE id_paciente=:id ORDER BY no_sesion  DESC LIMIT 1");
              $invo->bindParam(':id', $id);
              $invo->execute();
              return($invo->fetchAll()); }
?>