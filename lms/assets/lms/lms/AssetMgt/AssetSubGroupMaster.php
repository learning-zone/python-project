<html>
<?php

	session_start();

	include("../db.php");

	include("../urlaccess.php");

	$Types = $_POST['Types']; 

$msg=$_GET['msg'];
if($_GET['msg'])
{
?>
<script>
alert("<?=$msg?>");
</script>	
<?php
}
	if($_POST)

	{

		$id = $_POST['id'];

		$assetsubgroupname = $_POST['assetsubgroupname'];

		

		$asset_sub_group = $_POST['asset_sub_group'];

	}

	if($_GET)

{

	$assetsubgroupname = $_GET['assetsubgroupname'];

	$assetcode = $_GET['assetcode'];

	$asset_sub_group_id = $_GET['asset_sub_group_id'];

}

	

?>

<head><title>Asset Group Master</title>

<script language="JavaScript">
function EditClick()

{

	document.form1.action="AlterAssetSubGroup.php?Types=Mod";

	document.form1.submit();

}


function validate()

{

	var a;

	a=document.addasset.assetcode.value;



	if(a.length==0)

	{

		alert("Asset Code cannot be NULL!!");

		document.addasset.assetcode.focus();

	}

	else

	{

		document.addasset.submit();

	}

}
function Add()

{

	document.addasset.action="AddAssetSubGroupDetails.php?Types=Add";

	document.addasset.submit();

}



</script>

</head>

<body background="../bg.gif">

<?php
$msg=$_GET['msg'];
if($_GET['msg'])
{
?>
<script>
alert("<?=$msg?>");
</script>	
<?php
}


?>

<form Name="addasset" action="AddAssetSubGroupDetails.php" method="POST">
<br>
<table class=forumline align=center width='50%'>
<tr>

   <td Class=head align=center colspan=4>Asset Sub Group Details</td>

</tr>

<tr><td Class="rowpic" align="center">Asset Sub Group Name</td>

<td Class="rowpic" align="center">Asset Group Name</td>

</tr>

<tr>

<td Class="cbody" align="center"><input type="text" size="25" name="assetsubgroupname"></td>



<td Class="cbody" align="center">

<select name="asset_sub_group_id">

<?php

	$sql22=execute("select * from asset_group order by assetgroupname");



	for($l=0;$l<rowcount($sql22);$l++)

	{

		$r2=fetcharray($sql22,$l);



		echo "<option value=$r2[id]>$r2[assetgroupname]</option>";

	}

?>

</select>

</td>
</tr>
</table><br>
<div align="center">
<input type="submit" value="ADD" onClick="validate()" class='bgbutton' name="Add"></div>
</form>
<?php
$query="select * from asset_sub_group where status=1";

$result=execute($query);

$rowcount=rowcount($result);

if($rowcount!=0)

{

?>




<form method="post" id="form1" name="form1">
<br>
<table class=forumline align="center" width='50%'>
<tr><td Class=head colspan=5 align="center" >Add Asset Group Details</td></tr>

<tr><td align="center" Class="rowpic">Select</td><td align=center Class="rowpic"><b>Asset Group Name</b></td>


<td align="center" Class="rowpic"><b>Asset Group</b></td>

</tr>

<?php

for($i=0;$i<$rowcount;$i++)

{

$r=fetcharray($result,$i);

?>

<tr><td Class="cbody" align="center"><input type="checkbox" name="id[]" Value="<?=$r[id]?>"></td>

<td Class="cbody" align="center"><input type="text" size=25 name="assetsubgroupname<?=$r[id]?>" value="<?=$r[asset_subgroup_name]?>"></td>



<td><select name="asset_sub_group<?=$r[id]?>">

<?php

	$sql11=execute("select * from asset_group where status=1 order by assetgroupname");



	for($k=0;$k<rowcount($sql11);$k++)

	{

		$r1=fetcharray($sql11,$k);



		if($r[asset_group_id]==$r1[id])

		{

			echo "<option value=$r1[id] selected>$r1[assetgroupname]</option>";

		}

		else

		{

			echo "<option value=$r1[id]>$r1[assetgroupname]</option>";

		}

	}

?>

</select>

</td>

</tr>

<?php

}

?>





</table><br>
<div align="center">
	<input type="button" value="MODIFY" class='bgbutton' onClick="EditClick()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class='bgbutton' value="DELETE" onClick="deldata()"></div>

</form>

<?php

}



?>



</body>

</html>

