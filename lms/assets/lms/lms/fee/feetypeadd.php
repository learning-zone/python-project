<html>
<head>
<?php
session_start();
include("../db.php");
$act=$_REQUEST['act'];
$msg=$_REQUEST['msg'];
?>
<script language="javascript">
function activate()
{
	document.form1.action="alterfeetype.php?Types=Act";
	document.form1.submit();
}
function EditClick()
{
	document.form1.action="alterfeetype.php?Types=Mod";
	document.form1.submit();
}
function DeleteClick()
{
	document.form1.action="alterfeetype.php?Types=Del";
	document.form1.submit();
}
function adddata()
{
	if(document.form1.feename.value=='')
	{
		alert("Please Enter Fee Name");
		return false;
	}
	if(document.form1.ftype.value=='')
	{
		alert("Please Select Fee Typ ");
		return false;
	}
	if(document.form1.refund.value=='')
	{
		alert("Please Select Is refundable ?");
		return false;
	}
	else
	{
		document.form1.action="alterfeetype.php?Types=Add";
		document.form1.submit();
	}
}
</script>
<title></title>
</head>
<body>
<form method="post" name="form1">
<?php
if($msg!="")
{
?><script language="javascript">
alert("<?php echo $msg; ?>");
</script>
<?php
}
?><br>
	<table class=forumline align=center width='90%'>
	<tr><td Class="head" align=center colspan=4>Add New Fee Details</td></tr>
	<tr height='20'><td class="rowpic" align=center>Fee Name</td>
	<td class="rowpic" align=center>Fee Type</td>
	<td class="rowpic" align=center>Is Refundable ?</td></tr>
	<tr><td valign="top" align=center><input type="text" size="25" name="feename"></td>
	<td align="center" class="cbody"><select name="ftype">
	<option value=''>- Select -</option>
	<option value=1>One Time Fee</option>
	<option value=2>Recurring Fee</option>
	</select></td>
	<td align="center" class="cbody"><select name="refund">
	<option value=''>- Select -</option>
	<option value=0>NO</option>
	<option value=1>YES</option></select></td></tr>
	</table><br>
    <div align="center">
    <input type="button" value="Add" class=bgbutton onClick = "adddata()">
	</div>
    <br>

	<?php
	$sql = "SELECT fee_id,fee_name,refund,catid,ftype FROM fee_type WHERE status=1 ORDER BY fee_id";
	$rs = execute($sql);
	$rc = rowcount($rs);
	if($rc)
	{
		?>
		<table class=forumline align=center width='90%'>
		<tr><td Class="head" align=center colspan=5>Modify Fee Details</td></tr>
		<tr height='20'><td class="rowpic" align=center>Select</td>
		<td class="rowpic" align=center>Fee Name</td>
		<td class="rowpic" align=center>Fee Type</td>
		<td class="rowpic" align=center nowrap>Is Refundable ?</td></tr>
		<?php
		while($r = fetcharray($rs))
		{
			$sel1="";
			$sel2="";
			if($r[refund]==0)
				$sel1="selected";
			if($r[refund]==1)
				$sel2="selected";
			$sel4="";
			$sel5="";
			$sel3="";
			if($r[ftype]==1)
				$sel4="selected";
			if($r[ftype]==2)
				$sel5="selected";
			if($r[ftype]==3)
				$sel3="selected";
			?>
			<tr><td align="center" class="cbody" ><input type="checkbox" name="fid[]" value="<?=$r["fee_id"]?>"></td>
			<td class="cbody" align=center><input type="text" size="20" name="fName<?=$r["fee_id"]?>" value="<?=$r["fee_name"]?>"></td>
			<td align="center" class="cbody"><select name="ftype<?=$r["fee_id"]?>">
			<option value=1 <?=$sel4?>>One Time Fee</option>
			<option value=2 <?=$sel5?>>Recurring Fee</option>
			</select></td>
			<td align="center" class="cbody"><select name="refund<?=$r["fee_id"]?>">
			<option value=0 <?=$sel1?>>NO</option>
			<option value=1 <?=$sel2?>>YES</option></select></td></tr>
			<?php
		}
		?>
        </table><br>
		<div align="center"><input class='bgbutton' Type="Button" Value="Modify" onClick="EditClick()" >
        </div><br>
		<?php
	}

?>
</form>
</body>
</html>