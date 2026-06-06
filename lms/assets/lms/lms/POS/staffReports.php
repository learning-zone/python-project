<html>
<head><script LANGUAGE="JavaScript">
function prn()
{
	pr1.style.display = "none";
	window.print();
}
</script>
</head>
<body>
<?php

include('ps_pagination.php');
require('includes/functions.php'); 
require('includes/dbconnect.php'); 
$queryStatement = "SELECT * FROM USERS ORDER BY FIRST_NAME ASC";
$paramValues = "status=".$status;
$pager = new PS_Pagination($con, $queryStatement, 25, 5, $paramValues);
$pager->setDebug(true);
$searchProductQuery = $pager->paginate();
if($searchProductQuery){
?>
<div>
<table class="boxtable" width="60%" border="0" align="center">
<a href="generateReceipt.php"><b>Back</b></a> 
<tr bgcolor="#3C74E6">
<td colspan="5" nowrap align="center">
<font style="font:normal 10px verdana; color:#FFFFFF"><b>STAFFS REPORT</b></font>
</td>
</tr><tr bgcolor="#3C74E6">
<td width="5%"><font style="font:normal 10px verdana; color:#FFFFFF"><b>ID</b></font></td>
<td width="20%"><font style="font:normal 10px verdana; color:#FFFFFF"><b>Name</b></font></td>
<td width="10%"><font style="font:normal 10px verdana; color:#FFFFFF"><b>Phone</b></font></td>
<td width="15%"><font style="font:normal 10px verdana; color:#FFFFFF"><b>Email</b></font></td>
<td width="25%"><font style="font:normal 10px verdana; color:#FFFFFF"><b>Address</b></font></td>
</tr>
<?php
$i = 0;
while ($row = mysql_fetch_array($searchProductQuery, MYSQL_ASSOC)) {
$i++;
$bcolor = '#FFFFFF';
if($i%2 == 0){
$bcolor = '#C3D9FF';
}
print "<tr bgcolor=".$bcolor.">";
print "<td><font style='font:normal 9px verdana'>&nbsp;".$i ."</font></td> \n";
print "<td><font style='font:normal 9px verdana'>&nbsp;".$row["FIRST_NAME"] .' ' .$row["LAST_NAME"].  "</font></td> \n";
print "<td><font style='font:normal 9px verdana'>&nbsp;".$row["PHONE"] . "</font></td> \n";
print "<td><font style='font:normal 9px verdana'>&nbsp;".$row["EMAIL"] . "</font></td> \n";
print "<td><font style='font:normal 9px verdana'>&nbsp;".$row["ADDRESS"] . "</font></td> \n";
?>	
<?php
print "</tr>";
}}
mysql_free_result($searchProductQuery);
?>
</form>
<tr><td colspan="8" width="100%">&nbsp;</td></tr>
<tr><td colspan="8" width="100%">&nbsp;</td>
</table><tr></div>

</table>
	<br>

<div id=pr1 align=center><INPUT TYPE="SUBMIT" class=bgbutton NAME="print" VALUE="PRINT " onclick='prn()'>

</div>
</body>
</html>	  