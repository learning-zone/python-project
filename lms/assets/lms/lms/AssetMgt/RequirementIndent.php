<?php

session_start();

include("../db.php");

include("../urlaccess.php");

$dept = $_POST['dept'];

$agroup = $_POST['agroup'];

$adesc = $_POST['adesc'];

$qty = $_POST['qty'];

$user = $_POST['user'];

$college = $_POST['college'];

if($user=='')

{

	header("Location:login.php");

}

else

{

	$p_th=$_SERVER['SCRIPT_NAME'];

	$qry=execute("select * from usermenu where username='$user' and access='Yes' and linkpath='$p_th'");

	if(rowcount($qry)==0)

	{

		header("Location:login.php");

	}

}

?>

<html>

<head><title>Add / Requirement Details</title>

<script language="JavaScript">

	function RefreshMe()

	{

		document.frm.action="RequirementIndent.php";

		document.frm.submit();

	}



</script>

<body>

<form name="frm" method="post" action="InsRequirementIndent.php">

<table class=forumline align=center width="55%">

<tr><td Class="head" align=center colspan=2>Add Requirement Details</td></tr>

<tr><td >Department</td>

<td>

<select name="dept">

<option vlaue="-1">Select Department</option>

<?php

	$sql=execute("select * from dept_no");



	for($i=0;$i<rowcount($sql);$i++)

	{

		$r=fetcharray($sql,$i);

		if($dept==$r[dpt_id])

		{

		echo "<option value=$r[dpt_id] selected>$r[Dept]</option>";

		}

		else

		{

			echo "<option value=$r[dpt_id]>$r[Dept]</option>";

		}

	}

?>

</select>

</td></tr>



<tr><td>Asset Group</td>

<td><select name="agroup" onChange="RefreshMe()">

<option value="-1">Select Asset Group</option>

<?php

	$sql1=execute("select * from asset_sub_group");



	for($j=0;$j<rowcount($sql1);$j++)

	{

		$r1=fetcharray($sql1,$j);



		if($agroup==$r1[id])

		{

			echo "<option value=$r1[id] selected>$r1[asset_subgroup_name]</option>";

		}

		else

		{

			echo "<option value=$r1[id]>$r1[asset_subgroup_name]</option>";

		}

	}

?>

</select>

</td></tr>

<?php

	if($agroup<>'')

	{

?>

<tr><td>Asset Name</td>

<td><select name="adesc" onChange="RefreshMe()">

<option value="-1">Select Asset Name</option>

<?php

	$sql1=execute("select * from asset_master where asset_group_id=$agroup");



	for($j=0;$j<rowcount($sql1);$j++)

	{

		$r1=fetcharray($sql1,$j);



		if($adesc==$r1[id])

		{

			echo "<option value=$r1[id] selected>$r1[asset_name]</option>";

		}

		else

		{

			echo "<option value=$r1[id]>$r1[asset_name]</option>";

		}

	}

?>

</select>

</td></tr>

<?php

}

?>

<tr><td>Quantity</td><td><input type="text" name="qty" size="6"></td></tr>

</table>
<div align=center><input type="submit" value="Save Details" class=bgbutton></div>
<input type="hidden" name="user" value="<?=$user?>">

<input type="hidden" name="college" value="emist">

</form>

</body>

</html>

