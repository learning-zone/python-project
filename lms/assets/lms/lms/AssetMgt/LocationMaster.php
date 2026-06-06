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

$location_name = $_POST['location_name'];

$dept1 = $_POST['dept1'];

		}





if($_GET)

{

	$location_name = $_GET['location_name'];

	$dept = $_GET['dept'];	

}



?>

<head><title>Location Master</title>

<script language="JavaScript">
function deldata()
{
	document.form1.action="AlterLocationMaster.php?Types=Del";
	document.form1.submit();
}

function EditClick()

{

	document.form1.action="AlterLocationMaster.php?Types=Mod";

	document.form1.submit();

}

</script>

</head>

<body background="../bg.gif">
<form Name="addasset" action="AddLocationDetails.php" method="POST">
<br>
<table class=forumline align=center width="60%">
<tr><td Class="head" colspan="4" align="center">Add Location Details</td></tr>
<tr><td Class="rowpic" align="center">Location Name</td><td Class="rowpic" align="center">Department</td></tr>

<tr>

<td Class="cbody" align="center"><input type="text" size="45" name="location_name"></td>

<td Class="cbody" align="center">

<select name="dept">

<?php

$dsql=execute("select * from dept_no");

for($i=0;$i<rowcount($dsql);$i++)

{

	$d_rs=fetcharray($dsql,$i);

	?>

	<option value="<?=$d_rs[dpt_id]?>"><?=$d_rs[Dept]?></option>

	<?php

}

?>

</select>

</td>

</tr>



</table>
<br>
<div align=center><input type="submit" value="ADD" class=bgbutton></div>
</form>
<?php

$query="select * from location_master where status='1'";

$result=execute($query);

$rowcount=rowcount($result);

if($rowcount!=0)

{

	?>

	<form method="post" id="form1" name="form1">

	<table class="forumline" align="center" width="60%"><tr><td Class="head" colspan=5 align='center' >Location Details</td></tr>



	<tr><td align='center' Class="rowpic">Select</td><td align='center' Class="rowpic"><b>Location Name</b></td><td align=center Class="rowpic"><b>Department</b></td></tr>

	<?php

	for($i=0;$i<$rowcount;$i++)

	{

		$r=fetcharray($result,$i);

		//echo "<br>".$r[dept_id];

		?>

		<tr><td Class="cbody" align="center"><input type="checkbox" name="id[]" Value="<?=$r["id"]?>"></td>

		<td Class="cbody" align="center"><input type="text" size=45 name="location_name<?=$r["id"]?>" value="<?=$r["location"]?>"></td>

		<?php

		?>

		<td Class="cbody">

		<select name="dept1<?=$r["id"]?>">

		<option value="">Select</option>

		<?

		$var1=execute("Select * from  dept_no");

		for($k=0;$k<rowcount($var1);$k++)

		{  	

			$var2=fetcharray($var1,$k);

			if($r[dept_id]==$var2[ dpt_id ])

				echo "<option value='$var2[dpt_id]' selected> $var2[Dept] </option>";

			else

				echo "<option value='$var2[dpt_id]' > $var2[Dept] </option>";

		}
		?>

		</select></td>

		<?php

	}

	?>

	

	</table><br>
<div align=center><input type="button" onClick="EditClick()" value="MODIFY" name="Mod" class=bgbutton>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class='bgbutton' value="DELETE" name="Del" onClick="deldata()">

	</div>
	</form>

	<?php

}

else

{

	echo "<p align=\"left\"><b><font color=\"red\" face=\"Arial\">No Records Present</font></b></p>";

}

?>



</body>

</html>