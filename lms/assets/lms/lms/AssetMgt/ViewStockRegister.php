<html>
<?php
	session_start();
	include("../db.php");
	include("../urlaccess.php");
	$print = $_POST['print'];
$dept = $_POST['dept'];
	$sql="select * from dept_no WHERE dept!='Central Stores'";
	$rs=execute($sql);
?>
<body>
<form method="post" action="DepartmentwiseStockRegister.php">
<table class=forumline align=center>
<tr><td colspan=4 class=head> Departmentwise Asset Register</td></tr>
<tr><td>Select Department</td>
<td>
<select name="dept">
<?php
	for($i=0;$i<rowcount($rs);$i++)
	{
		$r=fetcharray($rs,$i);
?>
<option value="<?=$r[dpt_id]?>"><?=$r["Dept"]?></option>
<?php
	}
?>
</select>
</td></tr>
<tr><td colspan=3 align=center><input type="submit" value="View Stock Register" class=bgbutton></td></tr>
</table>
</form>
</body>
</html>



