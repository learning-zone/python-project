<?php
session_start();
include("../db.php");
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
<script language="javascript">
 function adddata()
{

	if(document.form1.vendorname.value=="" || document.form1.contactperson.value=="")
	{
		alert("Please enter Names ..!!")
	}
	else
	{
		document.form1.action="AlterVendor.php?Types=Add";
		document.form1.submit();
	}
 }
 function moddata()
{
	document.form1.action="AlterVendor.php?Types=Mod";
	document.form1.submit();
}
function deldata()
{
	document.form1.action="AlterVendor.php?Types=Del";
	document.form1.submit();
}
</script>
	</head>
<body>
<form method="post" id="form1" name="form1">

	<table class="forumline"  align=center width='85%'><br>
	<tr><td Class="head" colspan=7 align=center>Vendor Details</td></tr>
	<tr height='20'><td class="rowpic" align=center>Vendor Name</td><td class="rowpic" align=center>Vendor Address</td><td class="rowpic" align=center>Contact Person</td><td class="rowpic" align=center>Tel No</td><td class="rowpic" align=center>Fax</td><td class="rowpic" align=center>Email</td><td class="rowpic" align=center>Suppliers For</td></tr>
	<td align=center><input type="text" size=25 name="vendorname"></td>
	
	<td align=center><textarea rows="3" cols="25" name="address"></textarea></td>
	<td align=center><input type="text" size=25 name="contactperson"></td>
	<td align=center><input type="text" size=20 name="phone"></td>
	<td align=center><input type="text" size=20 name="fax"></td>
	<td align=center><input type="text" size=20 name="email"></td>
	<td align=center><input type="text" size=20 name="suppliersfor"></td>
	</tr>
	</table><br>
    <div align="center"><input class='bgbutton' type="button" value=" ADD" onClick="adddata()"></div><br>
	
		<?php

	$sql = "SELECT * FROM vendormaster_assets where status=1";
	$rs = execute($sql);
	$num = rowcount($rs);
	if($num)
	{
		?>
		<table class="forumline" align=center width='85%'>
		<tr><td Class="head" colspan=8 align="center">Modify Vendor Details</td></tr>
		<tr height='20'><td class="rowpic" align="center">Select</td><td class="rowpic" align=center>Vendor_Name</td><td class="rowpic" align="center">Address</td><td class="rowpic" align=center>ContactPerson</td><td class="rowpic" align=center>Telephone</td><td class="rowpic" align=center>Fax</td><td class="rowpic" align=center>E-Mail</td><td class="rowpic" align=center>SuppliersFor</td></tr>

		<?php
		for($i=0;$i<$num;$i++)
		{
			$r = fetcharray($rs,$i);
			$x=stripslashes
			?>
			<tr><td align="center"><input type="checkbox" name="mid[]" Value="<?=$r["id"]?>"></td>
			<td><input type="text" size=20 name="vname<?=$r[id]?>" value="<?=stripslashes($r[name])?>"></td>
			<td><textarea rows="3" cols="25" name="vcontact_person<?=$r[id]?>"> <?=stripslashes($r[contact_person])?></textarea></td>
			<td><input type="text" size="25" name="vphone<?=$r[id]?>" value="<?=stripslashes($r[phone])?>"></td>
			<td><input type="text" size=20 name="vfax<?=$r[id]?>" value="<?=$r[fax]?>"></td>
			<td class='cbody' nowrap><input type="text" size=20 name="vaddress<?=$r[id]?>" value="<?=$r[address]?>">
			<td><input type="text" size=20 name="vemail<?=$r[id]?>" value="<?=stripslashes($r[email])?>"></td>
			<td><input type="text" size=20 name="vsuppliers_for<?=$r[id]?>" value="<?=stripslashes($r[suppliers_for])?>"></td></tr>
			<?php
		}
		?>
		</table>
        <br>
        <div align="center"><input Type="Button" class=bgbutton Value="MODIFY" onClick="moddata()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input Type="Button" class=bgbutton Value="DELETE" onClick="deldata()"></div>
		<?php
	}
	

?>
</form>
</body>
</html>
