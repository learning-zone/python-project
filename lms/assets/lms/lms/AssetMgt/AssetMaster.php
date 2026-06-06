<?php

session_start();

include("../db.php");

include("../urlaccess.php");

$Types = $_POST['Types'];

//print_r($_GET);

if($_POST)

	{

	$id = $_POST['id'];

	$asset_name = $_POST['asset_name'];

	$asset_sub_group = $_POST['asset_sub_group'];
	
	$group = $_POST['group'];
	
	$subgroup = $_POST['subgroup'];
	
	$assetcode = $_POST['assetcode'];

	}

	if($_GET)

{

	$asset_name = $_GET['asset_name'];

	$assetgroup = $_GET['assetgroup'];
	$group = $_GET['group'];
	
	$subgroup = $_GET['subgroup'];
	$id = $_GET['id'];
$assetcode = $_GET['assetcode'];
	$asset_name = $_GET['asset_name'];

	$asset_sub_group = $_GET['asset_sub_group'];

	

}

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
<html>
<head><title>Asset Master</title>

<script language="JavaScript">
function reloadMe()
	{
	//alert("hello");
		
		document.addasset.action="AssetMaster.php";
		document.addasset.submit();
		
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
/*function RefreshMe(val)

{
	alert("hello");

	//document.frm.flag.value=val;

	document.frm.action="AssetMaster.php";

	document.frm.submit();

}*/
function deldata()
{
	document.form1.action="AlterAssetMaster.php?Types=Del";
	document.form1.submit();
}


function EditClick()

{

	document.form1.action="AlterAssetMaster.php?Types=Mod";

	document.form1.submit();

 }
 function Add()

{

	document.form1.action="AddAssetMasterDetails.php?Types=Add";

	document.form1.submit();
	//alert("Inserted Successfully");

 }

</script>

</head>



<body background="../bg.gif">

<?php

$query="select * from asset_master where status='1'";

$result=execute($query);

$rowcount=rowcount($result);

if($rowcount>0)

{

	?>

	

	<?php

}

else

{

	echo "<p align=\"left\"><b><font color=\"red\" face=\"Arial\">No Records Present</font></b></p>";

}

?>

<form name="addasset" action="AddAssetMasterDetails.php" method="GET">
<br>

<table class=forumline align="center" width="50%">
<tr>

   <td Class=head align='center' colspan=4>Asset Master Details</td>

</tr>
<tr>

<td Class="rowpic" align="center">Asset Group Name</td>

<td Class="rowpic" align="center">Asset Sub Group Name</td>

<td Class="rowpic" align="center">Asset Code</td>

<td Class="rowpic" align="center">Asset Name</td>

</tr>



<tr>



<td align="center"><select name="group" onChange="reloadMe()">

	<option value=0>Select</option>

	<?php

	$sql1=execute("select * from asset_group");

	for($j=0;$j<rowcount($sql1);$j++)

	{

		$r1=fetcharray($sql1,$j);

		if($group==$r1[id])

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
    
<td align="center"><select name="subgroup" onChange="reloadMe()">

	<option value=0>Select</option>

	<?php
    //echo "select * from asset_sub_group where asset_group_id='$group'";
	$sql1=execute("select * from asset_sub_group where asset_group_id='$group'");

	for($j=0;$j<rowcount($sql1);$j++)

	{

		$r1=fetcharray($sql1,$j);

		if($subgroup==$r1[id])

		{

			echo "<option value=$r1[id] selected>$r1[asset_subgroup_name]</option>";

		}

		else

		{

			echo "<option value=$r1[id]>$r1[asset_subgroup_name]</option>";

		}

	}

	?>

	</select></td>
    <td Class="cbody" align="center"><input type="text" size="5"  name="assetcode"></td>
    <td align="center"><input type="text" name="asset_name"></td>

</tr>
</table><br>
<div align="center">
<input type="submit" value="ADD" class="bgbutton"  name="Add" onClick="validate()"></div>

</form>

<form method="post" id="form1" name="form1">
<?
	   //$SQL="select * from asset_master where status='1' AND `asset_group_id`=$group";
	  // $resultSelect=execute($SQL) or die(mysql_error());
	   //$rowCount=rowcount($resultSelect);
	   //if($rowCount==0)
	   //{
		  // die("<center>No Records Found !!!</center>");
	  // }
	
?>
<BR>

	<table class=forumline align="center" width="50%"><tr><td Class=head colspan=4 align=center>Add Asset Master Details</td></tr>



	<tr><td align="center" Class="rowpic">Select</td>
    
    <td align="center" Class="rowpic"><b>Asset Sub Group</b></td>

	<td align="center" Class="rowpic"><b>Asset Name</b></td>

	<td align="center" Class="rowpic"><b>Asset Code</b></td>

	</tr>

	<?php

	for($i=0;$i<$rowcount;$i++)

	{

		$r=fetcharray($result,$i);
		   //while($r=fetcharray($resultSelect))
	     // {

		?>

		<tr><td align="center"><input type="checkbox" name="id[]" Value="<?=$r[id]?>"></td>
        
        <td align="center"><select name="asset_sub_group<?=$r[id]?>">

		<?php

		$rsql=execute("select * from asset_sub_group where status='1' ");

		for($j=0;$j<rowcount($rsql);$j++)

		{

			$rsq=fetcharray($rsql,$j);



			if(($r[asset_group_id])==$rsq[id])

			{

				echo "<option value=$rsq[id] selected>$rsq[asset_subgroup_name]</option>";

			}

			else

			{

				echo "<option value=$rsq[id]>$rsq[asset_subgroup_name]</option>";

			}

		}

		?>

		</select></td>

		<td align="center"><input type="text" name="asset_name<?=$r[id]?>" value="<?=$r['asset_name']?>"></td>

		<td Class="cbody" align="center"><input type="text" size="4" maxlength="5" name="assetcode<?=$r[id]?>" value="<?=$r[assetcode]?>"></td>

		</tr>

		<?php

	}

	?>
    </table><br>
     <div align="center">
     <input type="button" onClick="EditClick()" value="MODIFY" name="Mod" class='bgbutton'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class='bgbutton' value="DELETE" onClick="deldata()">

	</div>
	</form>




</body>

</html>