<?php

session_start();

include("../db.php");

include("../urlaccess.php");

$flag = $_POST['flag'];

$college = $_POST['college'];

$adate=$_POST['adate'];

$dept = $_POST['dept'];

$location = $_POST['location'];

$group = $_POST['group'];

$subgroup = $_POST['subgroup'];

$agroup = $_POST['agroup'];

$bropt = $_POST['bropt'];

$purchase_value = $_POST['purchase_value'];

$depreciated_value = $_POST['depreciated_value'];

$billno = $_POST['billno'];

$descript = $_POST['descript'];

$qtyies = $_POST['qtyies'];

$PurDay = $_POST['PurDay'];

$PurMonth = $_POST['PurMonth'];

$PurYear = $_POST['PurYear'];

$vendor = $_POST['vendor'];

$quantity = $_POST['quantity'];

$AddDetails = $_POST['AddDetails'];

$Today=explode("-",date("d-m-Y"));

$tfdate=explode('/',$adate);

$fdate=$tfdate[2]."-".$tfdate[1]."-".$tfdate[0];


if($flag=='')

{

	$flag=1;

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

<head>
<?php
$act=$_REQUEST['act'];
$msg=$_REQUEST['msg'];
if($_GET['msg']!='')
{
	?>
    <script language="javascript">
	alert("<?=$msg?>");
    </script>
    <?php
}
?>

<Script language="Javascript">
/*function add()

{
	if(document.frm.location.value==0)

	{

		alert("Please Select The Location...! ");

		return false;

	}

	document.frm.action="InsOldAssets.php?Types=Add";

	document.frm.submit();

}
*/
function SaveDetails()

{
	if(document.frm.location.value==0)

	{

		alert("Please Select The Location...! ");

		return false;

	}
	document.frm.action="InsOldAssets.php";

	document.frm.submit();

}

function RefreshMe(val)

{

	document.frm.flag.value=val;

	document.frm.action="OldAssets.php";

	document.frm.submit();

}
function moddata()
{
	document.frm.action="AlterOldAssets.php?Types=Mod";
	document.frm.submit();
}
function deldata()
{
	document.frm.action="AlterOldAssets.php?Types=Del";
	document.frm.submit();
}

</Script>

<script language="JavaScript" src="gen_validatorv2.js" type="text/javascript"></script>
<script language="javascript" src="cal2.js"></script>
<script language="javascript" src="cal_conf2.js"></script>
</head>

<body>

<?php

if($Delete)

{

	$flag=0;

	while( list(,$Value) = each($check_id) )

	{

		$id = $Value;

		$sqlstr="delete from individual_asset_details_temp where id=$id";

		execute($sqlstr);

	}

}

//echo "Select MAX(item_code) from individual_asset_details where dept_id='$dept'";

if(isset($AddDetails))

{

	if($purchase_value=="")

	{

		die("<b>Please Fill Blank Fields..!</b>");

	}

		$brcb;

		$rnlk=execute("Select MAX(item_code) from individual_asset_details where dept_id='$dept'");

		//echo "Select MAX(item_code) from individual_asset_details where dept_id='$dept'";

	$rtd=fetcharray($rnlk);

$mxno=$rtd[0];

 $nrkjt=substr($mxno,5,9);

 $nrkj=$nrkjt+1;

 $tbum=$descript;

for($j=0;$j<$quantity;$j++)

	{

		$newno=$nrkj;

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

	



	$flag=0;

	//$purchasedate=$PurYear."-".$PurMonth."-".$PurDay;

	if($bropt=="NO")

		{

		$sbmu='0000';

		}

		else

		{

			$sbmu=$tbum;

		}

		

	$sql2="insert into individual_asset_details(asset_id,item_code,";

		$sql2.=" unitprice,location_id,dept_id,date_of_purchase,current_value,asset_status_id,";

		$sql2.=" status,conditions,AssetStatus,vendor,billno,item_description,quantity) ";

		$sql2.=" values($agroup,'$brcb',$purchase_value,$location,$dept,";

		$sql2.=" '$fdate','$depreciated_value',6,'false','Working','Old',$vendor,'$billno','$sbmu','$quantity')";
		
		//echo $sql2;
		execute($sql2);

		echo "<font size='3'><center><b>Asset Numbers are : $brcb </b><br> ";

		if($bropt=='YES')

		{

			echo "<font size='3'><center><b>Respective Bar Code No : $tbum </b><br></font>";

		}



$brcb=$brcb+1;



$rnlk=$rnlk+1;

$nrkj=$nrkj+1;

$tbum=$tbum+1;

//$sbmu=$sbmu+1;

}
//echo $sql2;
echo "<font size='3'><center><b>All Asset Details Entered successfully!..</b></font>";

}



?>

<form method="post" name="frm">

<input type="hidden" name="flag" value="<?=$flag?>">

<?php

if($flag==1)

{

	execute("delete from individual_asset_details_temp");

}

?>
<br>
<table class=forumline align=center width="50%">

<tr><td Class="head" align=center colspan=2>Add Existing Assets</td></tr>

<tr><td>Select Campus</td><td align="center"><select name="college" onChange="RefreshMe(0)" style="width:200px">

<option value=0>Select</option>

<?php

//$sql=execute("select * from asset_college ");

$sql=execute("select * from college ");

for($i=0;$i<rowcount($sql);$i++)

{

	$r=fetcharray($sql,$i);

	if($college==$r[col_id])

	{

		echo "<option value=$r[col_id] selected>$r[col_name]</option>";

	}

	else

	{

		echo "<option value=$r[col_id]>$r[col_name]</option>";

	}

}

?>

</select></td></tr>



<tr><td>Select Department</td><td align="center"><select name="dept" onChange="RefreshMe(0)" style="width:200px">

<option value=0>Select</option>

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

</select></td></tr>

    <?php

if($dept!=0)

{

	?>

	<tr><td>Select Location</td><td align="center"><select name="location" onChange="RefreshMe(0)" style="width:200px">

	<option value=0>Select</option>

	<?php

	$sql1=execute("select * from location_master where dept_id=$dept");

	for($j=0;$j<rowcount($sql1);$j++)

	{

		$r1=fetcharray($sql1,$j);

		if($location==$r1[id])

		{

			echo "<option value=$r1[id] selected>$r1[location]</option>";

		}

		else

		{

			echo "<option value=$r1[id]>$r1[location]</option>";

		}

	}

	?>

	</select>

	</td></tr>

	<tr><td>Select Asset Group</td><td align="center"><select name="group" onChange="RefreshMe(0)" style="width:200px">

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

	</td></tr>

	<tr><td>Select Asset SubGroup</td><td align="center"><select name="subgroup" onChange="RefreshMe(0)" style="width:200px">

	<option value=0>Select</option>

	<?php

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

	</select>

	</td></tr>

	<tr><td>Select Asset Name</td><td align="center"><select name="agroup" onChange="RefreshMe(0)" style="width:200px">

	<option value=''>Select</option>

	<?php

	$sql=execute("select * from asset_master where asset_group_id='$subgroup'");



	for($k=0;$k<rowcount($sql);$k++)

	{

		$r2=fetcharray($sql,$k);

		if($r2[id]==$agroup)

		{



		echo "<option value=$r2[id] selected>$r2[asset_name]($r2[assetcode])</option>";

		}

		else

		{

		echo "<option value=$r2[id]>$r2[asset_name]($r2[assetcode])</option>";

		}

	}

	?>

	</select></td></tr>

	<tr><td>Bar Code Reqired/Not</td><td align="center"><select name="bropt" onChange="RefreshMe(0)" style="width:200px">

	<option value=''>Select</option>

	<?php

		$temppf="";

$temppf1="";

if($bropt=="YES")

{

	$temppf="selected";

	$temppf1="";

}

elseif($bropt=="NO")

{

	$temppf1="selected";

	$temppf="";

}

?>

<option value="YES" <?=$temppf?>>YES</option>

<option value="NO" <?=$temppf1?>>NO</option>

		

	</select></td></tr>

	</table><br>

	<?php

}	



if($dept!=0)

{

	?>

	

	<table class=forumline align=center width="80%">
    <br>

	<?php	

		

	  ?>

	<tr><td colspan=11 align=center Class="head" width="80%"><b>Enter Asset Details</b></td></tr>

	<tr ><!--<td class=rowpic>Asset Code</td>--><td class=rowpic align="center">Purchase Value</td><td class=rowpic align="center">Depreciated Value</td><td class=rowpic align="center">Bill No</td>

	<? if( $bropt == 'YES')

		  

	{

		

		  ?>

	<td class=rowpic nowrap align="center">Bar Code<br>Starting No</td>

	<?

	$wws='2';		

	}

	/*if( $bropt == 'YES')

	{

		$wws='3';

	}*/

		else

	{

			$wws='2';

	}

	

	?>

	<td class=rowpic nowrap value='<?=$wws?>'>Quantity</td><td class=rowpic nowrap>Purchase Date</td><td class=rowpic nowrap>Vendor</td><!--<td class=rowpic>Bar code <br>Starting No</td><td class=rowpic>Bar code <br>Ending No</td>--></tr>

	<?

	/*for($j=0;$j<=$qtyies;$j++)

	{*/

		  ?>

	<tr><!--<td><input type="text" name="asset_code" size="15" value='<?=$nrkj?>'></td>-->

	<td><input type="text" name="purchase_value" size="8"></td>

	<td><input type="text" name="depreciated_value" size="8"></td>

	<td><input type="text" name="billno" size="12"></td>

	<? if( $bropt == 'YES')

		  

	{

		//echo ("select max(item_description) from individual_asset_details where item_description!='NULL'");

		$zgtn=fetcharray(execute("select max(item_description) from individual_asset_details where item_description!='NULL'"));

	$bust=$zgtn[0]+1;

		  ?>

	<td><input type="text" name="descript" size="12" value="<?=$bust?>"></td>

	<?

	}

		  /*

		  else

	{

			*/  ?>

			<td><input type="text" name="quantity" size="12" value="<?=$quantity?>"></td>

			  <?
			?>

	<td align="center">&nbsp;&nbsp;<input type="text" name="adate" value="<?php if($adate==""){ $adate=date("d/m/Y"); } echo $adate?>" readonly>&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg"  align="absmiddle" ></a></td>

	

	

	<td colspan=9><select name="vendor">

	<?php

	$sql22=execute("select * from vendormaster_assets where status='1' order by name");



	for($j=0;$j<rowcount($sql22);$j++)

	{
		$r22=fetcharray($sql22,$j);
		
	  		if($vendor==$r22['name'])
	 		{
				echo "<option value='$r22[id]' selected>$r22[name]</option>";
			}
			else
			{
					echo "<option value='$r22[id]'>$r22[name]</option>";
			}
	}

	?>

	</select>

	</td></tr>

	<!--<tr><td colspan=10 align=center><input type="submit" name="AddDetails" value="Add Asset Details" class=bgbutton><onClick="SaveDetails()></td></tr>-->
   

	</table>

	

	<p>

	<div align="center">

	<input type="submit" name="AddDetails" value="SAVE" class=bgbutton>

	</div>
    

	
<?php
    //echo "SELECT a.id, a.dept_id, a.item_code, b.asset_name, a.unitprice, a.current_value, a.date_of_purchase, a.vendor,b.asset_group_id FROM individual_asset_details a INNER JOIN asset_master b ON a.id = b.id WHERE a.dept_id='$dept' AND b.asset_group_id='$agroup'";
	$sql = "SELECT a.id, a.dept_id, a.item_code, b.asset_name, a.unitprice, a.current_value, a.date_of_purchase, a.vendor,b.asset_group_id,b.assetcode FROM individual_asset_details a INNER JOIN asset_master b ON a.id = b.id WHERE a.dept_id='$dept' AND b.asset_group_id='$agroup'";
	$rs = execute($sql);
	$num = rowcount($rs);
	if($num)
	{
		?>
        <br>
		<table class=forumline align=center width="80%">
		<tr><td Class="head" colspan=9 align=center>Modify Vendor Details</td></tr>
		<tr height='20'><td class="rowpic" align=center>Select</td><td class="rowpic" align=center>Asset Code</td><td class="rowpic" align=center>Asset Name</td><td class="rowpic" align=center>Purchase Value</td><td class="rowpic" align=center>Depreciated Value</td><td class="rowpic" align=center>Purchase Date</td><td class="rowpic" align=center>Vendor</td></tr>

		<?php
		for($i=0;$i<$num;$i++)
		{
			$r = fetcharray($rs,$i);
			$x=stripslashes
			?>
			<tr><td align="center"><input type="checkbox" name="mid[]" Value="<?=$r["id"]?>"></td>
            <td><a Style='text-decoration: none; ' href='view.php?id=<?=$r[item_code]?>'><input type="text" size=20 name="vname<?=$r[id]?>" value="<?=stripslashes($r[item_code])?>" readonly></a></td>
            <td><input type="text" size=20 name="aname<?=$r[id]?>" value="<?=stripslashes($r[b.asset_name])?>" readonly></td>
			<td><input type="text" size=20 name="vname<?=$r[id]?>" value="<?=stripslashes($r[unitprice])?>"></td>
			<td><input type="text" size=20 name="vcontact_person<?=$r[id]?>" value="<?=stripslashes($r[current_value])?>"></td>
			
			<td><input type="text" size=20 name="vemail<?=$r[id]?>" value="<?=stripslashes($r[date_of_purchase])?>"></td>
            <?
           // $satisfied=fetcharray(execute("select name from vendormaster_assets where `id`='$r[vendor]'"));
			?>
           
			<td><select name="vendor">

	<?php

	$sql22=execute("select * from vendormaster_assets where status='1' order by name");



	for($j=0;$j<rowcount($sql22);$j++)

	{

		$r22=fetcharray($sql22,$j);

          echo $r22['name'];
		  echo $vendor;
		if($vendor==$r22['name'])
		echo "<option value=$r22[id] selected>$r22[name]</option>";
		else
		echo "<option value=$r22[id]>$r22[name]</option>";

	}

	?>


			<?php
		}
		?>
		</table>
        <br>
        <div align="center"><input Type="Button" class=bgbutton Value="MODIFY" onClick="moddata()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input Type="Button" class=bgbutton Value="DELETE" onClick="deldata()"></div>
		<?php
	}
	}
	

?>



</form>

</body>

</html>

