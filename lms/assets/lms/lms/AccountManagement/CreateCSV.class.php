<?php
class CreateCSV{
/*include("../db.php");
$ins=$_SESSION['ins'];
$ledger=$_SESSION['ld'];
$bd1=$_SESSION['bdt1'];
$bd2=$_SESSION['bdt2']
$ins=$_SESSION['ins'];
$org=$_SESSION['org'];
$tp=$_SESSION['type'];*/
	function create($sql, $isPrintFieldName = false, $isQuoted = true){

		$q = execute($sql) or die("Error: ".mysql_error());
		
		$csv = $head = $ctn = '';
		$hasPrintHead = false;

		while($r = mysql_fetch_assoc($q)){
			
			if(!$hasPrintHead && $isPrintFieldName == true){
				$csv_value = array();
				foreach($r as $field => $value){
					$csv_value[] = $field;
				}
				$hasPrintHead = true;
				$csv .= implode(',', $csv_value)."\n";
			}
			
			//Print the content...
			$aOpts_text = $csv_value = array();
			foreach($r as $field => $value){
				$csv_value[] = $isQuoted == true ? '"'.$value.'"' : $value;
			}
			$csv .= implode(',', $csv_value)."\n";
		}
		return $csv;
	}
}
?>