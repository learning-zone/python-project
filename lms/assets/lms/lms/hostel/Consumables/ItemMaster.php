<html>
<?php
session_start();
include("../../db.php");
$item_name = $_GET['item_name'];
$quantity_type = $_GET['quantity_type'];
$stock = $_GET['stock'];
$click = $_GET['click'];


$id = $_POST['id'];
$itemname = $_POST['itemname'];
$quantity_type = $_POST['quantity_type'];
$stock = $_POST['stock'];
$Types = $_POST['Types'];
?>
<head>
<title>Consumables - Item Master</title>
<script language="JavaScript">
function EditClick()
{
	document.form1.action="AlterItemMaster.php?Types=Mod";
	document.form1.submit();
}
function DeleteClick()
{
	document.form1.action="AlterItemMaster.php?Types=Del";
	document.form1.submit();
}

</script></head>

<body background="../bg.gif">
<?
	$dse=execute("select *from h_item_master order by item_name");
	$rtk=rowcount($dse);
	if($rtk)
		{
	?>
<form method="post" id="form1" name="form1">
<?php
if($flag_modify==1)
  {
	echo "<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Details Have Been Modified Successfully.</b>";
  }
  ?>
<table width="90%" class="forumline" align='center'>
	<tr><td colspan='4' Class='head' align='center'>ITEM MASTER</td></tr>
<tr>
<td Class='head' align='center'>SELECT</td>
<td Class='head' align='center'>ITEM NAMES</td>
<td Class='head' align='center'>QUATITY TYPE</td>
<td Class='head' align='center'><b>UNITS</b></td>
	</tr>
	<?php
		for($t=0;$t<$rtk;$t++)
	{
	$ddp=fetcharray($dse);
	if($t%2)
               echo "        <tr class='clsname'> ";
               else
               echo "        <tr> ";
	?>
	
	<td align='center'><input type="checkbox" name="id[]" Value="<?php echo $ddp[0]?>"></td>
	<td align='center'><input type="text" size="25" name="itemname<?php echo $ddp[0]?>" value="<?php echo $ddp[1]?>"></td>
	<td align='center'><input type="text" size="25" name="quantity_type<?php echo $ddp[0]?>" value="<?php echo $ddp[2]?>"></td>
	<td align='center'><input type="text" size="25" readonly name="stock<?php echo $ddp[0]?>" value="<?php echo $ddp[3]?>"></td>
	
	<?
	
	/*if($ddp[group_id]!='' && $ddp[group_id]!='NULL')
	{
	$gro=execute("select *from consumables_group where id='$ddp[group_id]'");
	$gr=fetcharray($gro);
	echo "$gr[consumablesgroupname]";*/
	}
	
	echo "</tr>";
?>
</table>
<br>
<center>
		<INPUT type="button" onClick="EditClick()" VALUE="Modify" CLASS="bgbutton">
        &nbsp;
		<INPUT type="button" onClick="DeleteClick()" VALUE="Delete" CLASS="bgbutton">
</center>

</form>
<?php
		}
?>

<form Name="addasset" action="AddItemMaster.php" method="GET">
<table width="90%" class="forumline" align='center'>
	<tr><td colspan=3 Class=head align=center>ITEM MASTER</td></tr>
<tr>
<td Class="rowpic">Item Name</td>
<td Class="rowpic">Quantity Type</td>
<td Class="rowpic">Opening Stock(Units)</td>
</tr>
<tr>
<td Class="row2"><input type="text" size="25" name="item_name"></td>
<td Class="row2"><input type="text" size="25" name="quantity_type"></td>
<td Class="row2"><input type="text" size="25" name="stock" value='0'></td>
</tr>
</table>
<br>
<center><input type="Submit" name="click" class='bgbutton' value="ADD ITEM MASTER"></center>
</form>
</body></html>