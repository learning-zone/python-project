<html>

<head>

<title>Asset Group Master</title>

<script language="JavaScript">
function adddata()
{

	if(document.form1.assetgroup_name.value=="" || document.form1.asset_abbr.value=="")
	{
		alert("Please enter Names ..!!")
	}
	else
	{
		document.form1.action="AlterAssetGroup.php?Types=Add";
		document.form1.submit();
	}
 }

function EditClick()

{

	document.form1.action="AlterAssetGroup.php?Types=Mod";

	document.form1.submit();

}
function deldata()
{
	document.form1.action="AlterAssetGroup.php?Types=Del";
	document.form1.submit();
}
function Add()

{

	document.form1.action="AddAssetGroupDetails.php?Types=Add";

	document.form1.submit();

}


var KEY_LEFT=268762961;

var KEY_RIGHT=268762963;

function check(e)

{

	var charCode = (navigator.appName == "Netscape") ? e.which : e.keyCode

	status = charCode // see ASCII character value!



	if((charCode>=48 && charCode<=57)||(charCode>=96 && charCode<=105)||(charCode==8)||(charCode==9)||(charCode==45)||(charCode==46)||(charCode>=35 && charCode<=40))

	{

	  return true;

	}

	else

	{

	alert("Please make sure entries are numbers only.");

	document.addasset.depreciation_rate.value="";

	return false;	  

	}

}

function checkit(e)

{

	var charCode = (navigator.appName == "Netscape") ? e.which : e.keyCode

	status = charCode // see ASCII character value!



	if (charCode > 31 && (charCode < 65 || charCode > 91 )  && charCode!=KEY_LEFT && charCode!=KEY_RIGHT ) 

	{

		if((charCode >= 65456 && charCode <= 65465) )

		{

			return true;

		}

		else

		{

			if((charCode == 37) || (charCode == 39)|| (charCode == 46) || (charCode==190)||(charCode==32))

			{

				return true;

			}

			else

			{

				alert("Please make sure entries are alphapets only.")

					document.addasset.assetgroup_name.value=="";

					document.addasset.asset_abbr.value=="";

					

				return false;

			}

		}

	}

	return true

}

</script>

</head>

<body>

<?php
session_start();

include("../db.php");

$Types = $_POST['Types'];

$assetgroup_name = $_POST['assetgroup_name'];

$asset_abbr=$_POST['asset_abbr'];

$Add=$_POST['Add'];

$id = $_POST['id'];

$msg=$_GET['msg'];
if($_GET['msg'])
{
?>
<script>


alert("<?=$msg?>");
</script>	

<?php
}
$assetgroupname=$_POST['assetgroupname'];

$assetabr=$_POST['assetabr'];
?>

<form name="addasset" method="post" action="AddAssetGroupDetails.php">
<br>
<table align=center class=forumline width='50%'>

<tr>

   <td Class=head align=center colspan=4>Add Asset Group Details</td>

</tr>

<tr>

<td Class="rowpic" align="center">Asset Group Name</td>

<td Class="rowpic" align="center">Asset Abbreviation</td>

</tr>



<tr>

<td Class="cbody" align="center"><input type="text" size="25" name="assetgroup_name" value="<?php echo $assetgroup_name?>" onKeyDown="return checkit(event)"></td>

<td Class="cbody" align="center"><input type="text" size="25" name="asset_abbr" onKeyDown="return checkit(event)" value=""></td>

</tr>



</table><br>
<div align="center">
	<input type="submit" name="Add" value="ADD" class='bgbutton'></div>

</form>

<?php

$query="select * from asset_group where status=1";

$result=execute($query);

$rowcount=rowcount($result);

if($rowcount!=0)

{

	?>

	<form method=post id=form1 name=form1>

	<table class=forumline align=center width='50%'>

	<tr>

	<td Class=head align=center colspan=4>Modify Asset Group Details</td>

	</tr>



	<tr>

	<td Class="rowpic" align="center">Select</td>

	<td Class="rowpic" align="center">Asset Group Name</td>

	<td Class="rowpic" align="center">Asset Abbreviation</td>

	</tr>

	<?php

	for($i=0;$i<$rowcount;$i++)

	{

		$r=fetcharray($result,$i);

		?>

		<tr>

		<td Class="cbody" align="center"><input type="checkbox" name="id[]" Value="<?php echo $r["id"]?>"></td>

		<td Class="cbody" align="center"><input type="text" size=25 name="assetgroupname<?php echo $r["id"]?>" value="<?php echo $r["assetgroupname"]?>"></td>

		<td Class="cbody" align="center"><input type="text" size=25 name="assetabr<?php echo $r["id"]?>" value="<?php echo $r["abbrevation"]?>"></td>

		</tr>

		<?php

	}

	?>

	

	</table><br>
    <div align="center">

	<input type="button" onClick="EditClick()" value="MODIFY" class='bgbutton'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class='bgbutton' value="DELETE" onClick="deldata()">

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

