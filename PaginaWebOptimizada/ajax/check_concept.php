<?php 
require_once ("../cn/connect2.php");
    $uid = $_POST['uid'];
    if ($uid) {        
		$count_query= $db2->prepare("SELECT count(*) AS numrows FROM payconcept WHERE user_id=:uid  AND status=1");
        $count_query->bindParam(':uid', $uid);
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){		$numrows = $row['numrows'];   }    
    echo $numrows;
    }
?>