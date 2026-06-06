<html>
<head>
<title>Data Base Modification</title>
<style>
.size{
width:200px
}
</style>
</head>
<body>
<form method="post" name="frm" id="frm">
  <table width="85%" border="1" cellpadding="5" cellspacing="0" bordercolor="#E8E8E8" bgcolor="#FFFFCC" >
    <tr>
      <td width="25%">Table Manipulation </td>
      <td width="55%">&nbsp;</td>
      <td width="20%">&nbsp;</td>
    </tr>
    <tr>
      <td>Execute Query </td>
      <td><input name="txtUpdate" type="text" id="txtUpdate" size="100"></td>
      <td><input name="Tab" type="submit" class="size" value="Execute"></td>
    </tr>
    <tr>
      <td>Select Table</td>
      <td><input name="txtSelect" type="text" id="txtSelect" size="100"></td>
      <td><input name="Tab" type="submit" class="size" value="Select_table"></td>
    </tr>
    <tr>
      <td>List Table </td>
      <td>&nbsp;</td>
      <td><input name="Tab" type="submit" class="size" value="List_table"></td>
    </tr>
  </table>
</form>
<?php 
include("../db.php");
$result="";
$query="";
if(!empty($_POST['Tab']))
{
switch($_POST['Tab'])
	{
	case "Execute"		:	update();
								break;
	case "Select_table"	:	select();
								break;
	case "List_table"	:	listT();
								break;
	default :echo"Nothing selected";
	}
}
function update()
{
	$query=$_POST['txtUpdate'];
	echo $query."<br>";  
	$result = execute($query);
	if($result)	{ echo "Successfully executed"; } else { echo "error"; }
	mysql_close();
	exit();
}


function select()
{
	$query=$_POST['txtSelect'];
		echo $query."<br>";  
	$result = execute($query);
	while($resultall=fetcharray($result,MYSQL_BOTH))
	   {
			echo $resultall[0]."<br>";    
			echo $resultall[1]."<br>"; 
			echo $resultall[2]."<br>"; 
			echo $resultall[3]."<br>"; 
			echo $resultall[4]."<br>"; 
			echo $resultall[5]."<br>"; 
			echo $resultall[6]."<br>"; 
			echo $resultall[7]."<br>"; 
			echo $resultall[8]."<br>"; 
			echo $resultall[9]."<br>"; 
			echo $resultall[10]."<br>"; 
			echo $resultall[11]."<br>"; 
			echo $resultall[12]."<br>"; 
			echo $resultall[13]."<br>"; 
			echo $resultall[14]."<br>"; 
			echo $resultall[15]."<br>"; 
			echo $resultall[16]."<br>"; 
			echo $resultall[17]."<br>"; 
			echo $resultall[18]."<br>"; 
		}
mysql_close();
exit();
}
function listT()
{
$dbname = 'auctusacc';
$query = "SHOW TABLES FROM $dbname";
	$result = execute($query);
	while($resultall=fetcharray($result,MYSQL_BOTH))
	   {
			echo $resultall[0]."<br>";    
		}
mysql_close();
exit();
}

?>
<?php 

?>
</body>
</html>
