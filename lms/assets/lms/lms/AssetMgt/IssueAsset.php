<html>

<?php

session_start();

include("../db.php");

include("../urlaccess.php");

$flag = $_POST['flag'];

$dept = $_POST['dept'];

$group = $_POST['group'];

$subgroup = $_POST['subgroup'];

$check_id = $_POST['check_id'];

$igroup = $_POST['igroup'];

$ExistingQuantity = $_POST['ExistingQuantity'];

$quantity = $_POST['quantity'];

$location_no = $_POST['location_no'];

$submit1 = $_POST['submit1'];

$Delete = $_POST['Delete'];

$igroup = $_POST['igroup'];
print_r($_POST);

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

<Script language="JavaScript">

/*function SaveDetails()

{

	if(document.MyFrm.quantity.value=="" || document.MyFrm.quantity.value<=0) 

	{

		alert("Enter the Valid Quantity Number");

		document.MyFrm.quantity.focus();

		return false;

	}

	if(document.MyFrm.quantity.value > document.MyFrm.ExistingQuantity.value)

	{

		//alert("rrr")

		alert("Requested Asset Quantity is More Than The Alloted Quantity");

		document.MyFrm.quantity.focus();

		return false;

	}*/
	function reloadMe()
	{
	
		
		document.frm.action="IssueAsset.php";
		document.frm.submit();
		
	}
	

function SaveDetails()

	{

	document.MyFrm.action="SaveAssetIssueDetails.php";

	document.MyFrm.submit();

}



function RefreshMe(val)

{

	document.MyFrm.flag.value=val;

	document.MyFrm.action="IssueAsset.php";

	document.MyFrm.submit();

}

function validate()

{

	x=parseInt(document.MyFrm.ExistingQuantity.value);

	y=parseInt(document.MyFrm.quantity.value);

	if(x==0)

	{

		alert("Cannot Add Since Existing Quantity is Nil");

		return false;

	}

	else if(y==0)

	{

		alert("Entered Quantity is zero");

		document.MyFrm.quantity.focus();

		return false;

	}

	else if(y>x)

	{

		alert("Issue Qty cannot be more than Existing Qty");

		document.MyFrm.quantity.focus();

		return false;

	}

	else

	{

		document.MyFrm.submit();

		return true;

	}

}

</script>

<body>

<?php

if(isset($Delete))

{

	$flag=0;

	while( list(,$Value) = each($check_id) )

	{

		$asset_id = $Value;

		$sqlstr="delete from asset_details_temp where id=$asset_id";

		execute($sqlstr);

	}

}

if(isset($submit1))

{

	$brcb;

		$rnlk=execute("Select MAX(item_code) from individual_asset_details where dept_id='$dept'");

	$rtd=fetcharray($rnlk);

$mxno=$rtd[0];

 $nrkjt=substr($mxno,5,9);

 $nrkj=$nrkjt+1;

	for($j=0;$j<$quantity;$j++)

	{

		$newno=$nrkj;

/*if($newno<9999)

	{

	$kkk="000".$newno;

	}

	else if($newno<999)

	{

	$kkk="000".$newno;

	}

	else if($newno<99)

	{

	$kkk="00".$newno;

	}

	else if($newno<9)

	{

	$kkk="0".$newno;

	}*/

	if($newno<10)

	{

	$kkk="0000".$newno;

	}

	else if($newno<100)

	{

	$kkk="000".$newno;

	}

	else if($newno<1000)

	{

	$kkk="00".$newno;

	}

	else if($newno<10000)

	{

	$kkk="0".$newno;

	}

$rjk=execute("Select dept_code from dept_no where dpt_id='$dept'");

$rtnmo=fetcharray($rjk);

$mka=$rtnmo[0];

//echo $mka;

$brcb=A.$mka.$kkk;

//echo $brcb;

	$quan=$quantity/$quantity;

	//echo $quan;

	$flag=0;

	$sql1="insert into asset_details_temp(asset_id,quantity,location_id,dept_id,asset_no)";

	//$sql1="insert into asset_details(asset_id,quantity,location_id,dept_id,asset_no)";

	$sql1.=" values($igroup,$quan,$location_no,$dept,'$brcb')";

	execute($sql1) or die("error");

	//echo $sql1;

$brcb=$brcb+1;



$rnlk=$rnlk+1;

$nrkj=$nrkj+1;

}

//echo "<font color='red' size='3'><b>All Asset Details Entered successfully!..</b></font>";

}



?>

<form name="MyFrm" >

<input type="hidden" name="flag" value="<?=$flag?>">

<?php

if($flag==1)

{

	execute("delete from asset_details_temp");

}

?>

<table class=forumline align=center>

<tr><td colspan=2 align=center Class="head">Issue Assets to Department</td></tr>

<!--<tr><td>Select College</td><td><select name="college" onChange="RefreshMe(0)">

<option value=0>Select College</option>-->

<?php

/*$sql=execute("select * from asset_college ");

for($i=0;$i<rowcount($sql);$i++)

{

	$r=fetcharray($sql,$i);

	if($college==$r[col_id])

	{

		echo "<option value=$r[col_id] selected>$r[coll_name]</option>";

	}

	else

	{

		echo "<option value=$r[col_id]>$r[coll_name]</option>";

	}

}*/

?>

<!--</select></td></tr>-->



<tr><td >Select Department</td>

<td width="30"><select name="dept" onChange="reloadMe()">

<option value="-1">Select Department</option>

<?php

$sql=execute("select * from dept_no where Dept<>'Central Stores'") or die(error_description());

//$sql=execute("select * from dept_no ") or die(error_description());

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

</select></td></tr>

<tr><td>Select Asset Group</td><td><select name="group" onChange="reloadMe()">

	<option value=0>Select Asset Group</option>

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

	</td></tr>

	<tr><td>Select Asset SubGroup</td><td><select name="subgroup" onChange="reloadMe()">

	<option value=0>Select Asset Subgroup</option>

	<?php

	if($subgroup=='0')

	$s = "selected";

	else

	$s="";

	//echo "select * from asset_sub_group where asset_group_id='$group'";

	$sql1=execute("select * from asset_sub_group where asset_group_id='$group'");

	for($j=0;$j<rowcount($sql1);$j++)

	{

		$r1=fetcharray($sql1,$j);

		if($r1[id]=='0')

		{

			echo "<option value='0' $s>--- select ---</option>";						

		}

		else

		{

			$sql1=execute("select * from asset_sub_group where asset_group_id='$r1[asset_subgroup_name]'");			

			if($r1[asset_subgroup_name] == $subgroup)

			{

				echo "<option value=$r1[id] selected>$r1[asset_subgroup_name]</option>";

			}

			else

			{

				echo "<option value=$r1[id]>$r1[asset_subgroup_name]</option>";

			}

		}

		/*

		if($subgroup==$r1[id])

		{

			echo "<option value=$r1[id] selected>$r1[asset_subgroup_name]</option>";

		}

		else

		{

			echo "<option value=$r1[id]>$r1[asset_subgroup_name]</option>";

		}

		*/

	}

	?>

	</select>

	</td></tr>

</table>

<table class=forumline align=center>

<?php

if(isset($submit1))

{

	$rnlk=execute("Select MAX(item_code) from individual_asset_details where dept_id='$dept'");

$rtd=fetcharray($rnlk);

$mxno=$rtd[0];

//echo $mxno;



 $nrkj=substr($mxno,5,9);

//echo $nrkj;

//$newno=0;

$newno=$nrkj+1;

if($newno<9999)

	{

	$kkk="0000".$newno;

	}

	else if($newno<999)

	{

	$kkk="000".$newno;

	}

	else if($newno<99)

	{

	$kkk="00".$newno;

	}

	else if($newno<9)

	{

	$kkk="0".$newno;

	}

if($igroup!='')

	{

$rjk=execute("Select dept_code from dept_no where dpt_id='$dept'");

$rtnmo=fetcharray($rjk);

$mka=$rtnmo[0];

//echo $mka;

$brcb=A.$mka.$kkk;

//echo $brcb;

	}

}



$sql=execute("select * from asset_details_temp");

$rcount=rowcount($sql);

if($rcount>=1)

{

	?>

	<tr><td Class="rowpic">Select</td><td Class="rowpic">Asset Name</td><td Class="rowpic">Asset Numbers</td><td Class="rowpic">Location</td><!--<td Class="rowpic">Quantity</td>--></tr>

	<?php

	for($i=0;$i<rowcount($sql);$i++)

	{

		$r=fetcharray($sql,$i);



		?>

		<tr><td><input type="checkbox" name="check_id[]" value="<?=$r[id]?>"></td>

		<?php

		$isql=execute("select * from asset_master where id=$r[asset_id] and  asset_group_id='$group'") or die(error_description());

		$irs=fetcharray($isql);

		?>

		<td><?=$irs["asset_name"]?></td>

		

		<td><?=$r["asset_no"]?></td>

		<?php

		$lsql=execute("select * from location_master where id=$r[location_id]") or die(error_description());

		$lrs=fetcharray($lsql);

		?>

		<td><?=$lrs["location"]?></td><!--<td><?=$r["quantity"]?></td>--></tr>

		<?php

	}

	?>

	<tr><td colspan=5 align=center><input type="submit" value="Delete" name="Delete" type="del" class=bgbutton></td></tr>

	</table>

	<?php

}

?>

<table class=forumline align=center >

<tr><td Class="rowpic">Asset Name</td><td Class="rowpic">Existing Quantity</td>

<td Class="rowpic">Issue Quantity</td><td Class="rowpic">Location</td></tr>

<?//echo ("select distinct a.id,a.asset_name from asset_master a,individual_asset_details b,dept_no c where a.id=b.asset_id and b.dept_id=c.dpt_id and c.Dept='Central Stores'"); 



//echo "select distinct a.id,a.asset_name from asset_master a,individual_asset_details b,dept_no c where a.id=b.asset_id and b.dept_id=c.dpt_id and c.Dept='Central Stores'";



//echo ("select distinct a.id,a.asset_name from asset_master a,individual_asset_details b,dept_no c where a.id=b.asset_id and b.dept_id=c.dpt_id and c.Dept='Central Stores'");

//echo ("select distinct a.id,a.asset_name from asset_master a,individual_asset_details b,dept_no c where a.id=b.asset_id and b.dept_id=c.dpt_id and c.Dept='Central Stores'");

?>

<tr><td><select name="igroup" onChange="reloadMe()">

<option value="">Select Asset </option>

<?php

$ISQL=execute("select distinct a.id,a.asset_name from asset_master a,individual_asset_details b,dept_no c where a.id=b.asset_id and b.dept_id=c.dpt_id and c.Dept='Central Stores'");



for($i=0;$i<rowcount($ISQL);$i++)

{

	$IRS=fetcharray($ISQL,$i);

	if($igroup==$IRS[id])

	{

		echo "<option value=$IRS[id] selected>$IRS[asset_name]</option>";

	}

	else

	{

		echo "<option value=$IRS[id]>$IRS[asset_name]</option>";

	}

}

?>

</select></td>

<td>

<?php

if($igroup<>'')

{

	$QSQL=execute("select sum(quantity) as quantity from asset_details_temp where asset_id=$igroup and dept_id=$dept") ;

	$QRS=fetcharray($QSQL);

	if(rowcount($QSQL)==0)

	{

		$IssueQty=0;

	}

	else

	{

		$IssueQty=$QRS["quantity"];

	}

	$QSQL1=execute("select a.* from individual_asset_details a,dept_no b where a.asset_id=$igroup and a.dept_id=b.dpt_id and b.Dept='Central Stores'");

	if(rowcount($QSQL1)==0)

	{

		$SOH=0;

		$ExistingQuantity=0;

	}

	else

	{

		$SOH=rowcount($QSQL1);

		$ExistingQuantity=$SOH-$IssueQty;

	}

}

?>

<?=$ExistingQuantity?>

<input type="hidden" name="ExistingQuantity" value="<?=$ExistingQuantity?>"></td>

<td><input type="text" name="quantity" size="3"></td>

<td><select name="location_no">

<?php

//$LSQL=execute("select * from location_master where location<>'Central Stores' and dept_id=$dept");

$LSQL=execute("select * from location_master where dept_id=$dept");

for($L=0;$L<rowcount($LSQL);$L++)

{

	$LRS=fetcharray($LSQL,$L);

	?>

	<option value="<?=$LRS[id]?>"><?=$LRS["location"]?></option>

	<?php

}

?>

</select></td></tr>

<tr><td colspan=6 align=center><input type="submit" value="Add Details" name="submit1"  class=bgbutton ></td></tr>

</table>

<div align=center>

<input type="button" value="Issue To Dept" onClick="SaveDetails()" class='bgbutton'>

</div>

</form>

</body>

</html>

