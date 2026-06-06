<html>
<head>
<?php
session_start();
include("../db.php");
$act=$_REQUEST['act'];
$msg=$_REQUEST['msg'];
?>
<script language="javascript">
function adddata()
{
	if(document.form1.bankname.value=="" || document.form1.bankstname.value=="")
	{
		alert("Please enter Bank Name & Short Name ..!!")
	}
	else
	{
		document.form1.action="alterbanktype.php?Types=Add";
		document.form1.submit();
	}
 }
function moddata()
{
	document.form1.action="alterbanktype.php?Types=Mod";
	document.form1.submit();
}
function deldata()
{
	document.form1.action="alterbanktype.php?Types=Del";
	document.form1.submit();
}
</script>
</head>
<body>
<form method="post" id="form1" name="form1">
<?php
if($msg!="")
	echo "<div><font size='3'>$msg</font></div><br>";


	?><br>
	<table class=forumline align=center width='90%'>
	<tr><td Class="head" colspan=5 align=center>Add New Bank Details</td></tr>
	<tr height='20'><td class="rowpic" align=center>Bank Name</td><td class="rowpic" align=center>Short Name</td><td class="rowpic" align=center>Bank Address</td><td class="rowpic" align=center>Tel No</td><td class="rowpic" align=center>Bank A/C No</td></tr>
	<td align=center><input type="text" size=25 name="bankname"></td>
	<td align=center><input type="text" size=10 name="bankstname"></td>
	<td align=center><textarea rows="3" cols="25" name="address"></textarea></td>
	<td align=center><input type="text" size=15 name="telno"></td>
	<td align=center><input type="text" size=20 name="accno"></td></tr>
	</table>
    <br>
    <div align='center'>
    <input class='bgbutton' type="button" value=" ADD" onClick="adddata()">
    </div>
    <br>
    
	<?php
	$sql = "SELECT * FROM bank_details where status=1 order by bank_name";
	$rs = execute($sql);
	$num = rowcount($rs);
	if($num)
	{
		?>
		<table class=forumline align=center width='90%'>
		<tr><td Class="head" colspan=6 align=center>Modify Bank Details</td></tr>
		<tr height='20'><td class="rowpic" align=center>Select</td><td class="rowpic" align=center>Bank Name</td><td class="rowpic" align=center>Short Name</td><td class="rowpic" align=center>Address</td><td class="rowpic" align=center>Telephone</td><td class="rowpic" align=center>ACC No</td></tr>

		<?php
		for($i=0;$i<$num;$i++)
		{
			$r = fetcharray($rs,$i);
			$x=stripslashes
			?>
			<tr><td align="center"><input type="checkbox" name="mid[]" Value="<?=$r["id"]?>"></td>
			<td><input type="text" size=20 name="bName<?=$r[id]?>" value="<?=stripslashes($r[bank_name])?>"></td>
			<td><input type="text" size=10 name="bstName<?=$r[id]?>" value="<?=stripslashes($r[bank_st_name])?>"></td>
			<td><textarea rows="3" cols="25" name="badd<?=$r[id]?>" ><?=stripslashes($r[bank_address])?></textarea></td>
			<td><input type="text" size=20 name="btel<?=$r[id]?>" value="<?=$r[telephone]?>"></td>
			<td class='cbody' nowrap><input type="text" size=20 name="accno<?=$r[id]?>" value="<?=$r[acc_no]?>"></tr>
			<?php
		}
		?>
		</table><br>
        <div align='center'><input Type="Button" class=bgbutton Value="Modify" onClick="moddata()">&nbsp;&nbsp;&nbsp;&nbsp;
        <input Type="Button" class=bgbutton Value="Delete" onClick="deldata()">	</div>
		<?php
	}

?>
</form>
</body>
</html>
