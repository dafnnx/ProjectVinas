<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['super_fecha'];
	if(isset($_POST["hours"]))
		{	$ba=implode(",",$_POST["hours"]);  }
	$ca= $_POST['super_ids'];
		{	$xa=explode(",",$ca);  }

$aColumns = array('id_residente');
		if ( $xa != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
				for ( $j=0 ; $j<count($xa) ; $j++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$xa[$j]."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ")";
		}


		$count_query= $db2->prepare("SELECT *  FROM residentes $sWhere");
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
		$nomresi = $row['nombre_residente'];

  echo $nomresi; 

}
?> 