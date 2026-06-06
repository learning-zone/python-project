<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
	<!--
		div.Divactive {	
			border-bottom: 1px dotted #6699CC;		
			color: #000;
			font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
			font-size: 13px;
			background: #CDBAE9;
			padding-left: 5%;
			min-height: 22px;
		}
		div.Divsubmenu {
			border-bottom: 1px dotted #6699CC;
			color: #000;
			font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
			font-size: 13px;
			background-color: #E4DAF4;
			padding-left: 5%;
			min-height: 22px;
		}
		-->
	</style>
</head>
<body>
<?php
session_start();
include("db1.php");

$user = $_SESSION['user'];
$per00 = $_SESSION['per00'];
$module = $_SESSION['module'];
$_DATABASE_= $_SESSION['_DATABASE_'];

$PHP_SELF = $_SERVER['PHP_SELF'];
$REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];

$LinkName = $_REQUEST["q"];





		$LastId=fetcharray(execute("SELECT `module` FROM `log` ORDER BY id DESC LIMIT 1"));
		
		$linkDet=fetcharray(execute("SELECT * FROM `links` WHERE id='$LinkName'"));
		
		//echo "<br>LinkName :".$LinkName;
		//echo "<br>LastId :".$LastId[module];
		/*if($LastId[module]){
				
			$linkDetOld=fetcharray(execute("SELECT * FROM `links` WHERE id=$LastId[module]"));	*/
								   
		?>
		<!--<a href="../test.php?linkpath=<?=$linkDetOld[linkpath]?><?=$linkDetOld[parameter]?>&linkname=<?=$linkDetOld[linkname]?>&Display_name=<?=$linkDetOld[Display_name]?>&linkID=<?=$linkDetOld[id]?>" title='<?=$linkDetOld[linkname]?>' class='topictitle3'>
        <div class="Divsubmenu"><?=$linkDetOld[Display_name]?></div></a>-->
        <?php
       // }
		//else{
		?>
		
		<a href="../test.php?linkpath=<?=$linkDet[linkpath]?><?=$linkDet[parameter]?>&linkname=<?=$linkDet[linkname]?>&Display_name=<?=$linkDet[Display_name]?>&linkID=<?=$linkDet[id]?>" title='<?=$linkDet[linkname]?>' class='topictitle3'>
        <div class="Divactive"><?=$linkDet[Display_name]?></div></a>
        <?php	
		//}
	?>	
	</body>
</html>