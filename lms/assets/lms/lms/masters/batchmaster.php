<?php
session_start();
include("../db.php");
?>
<HTML>
<HEAD>
<script language="JavaScript">
function check(objectvalue)
{

	if(objectvalue.value =="")
	{
		alert("Empty Batch name not allowed..!!")
		objectvalue.focus()
	}
}
function SendMe(val)
{
	document.frm.action = "addbatch.php?Type=" + val;
	document.frm.submit();
}
</script>
<body>

<form name="frm" method="POST">
<table width="200" class='forumline' align='center'>
<?php
$sql = "SELECT * FROM batch_master ORDER BY id";
$rs = execute($sql) or die(mysql_error());
$num = rowcount($rs);
if($num > 0 )
{
	?>
	<tr>
		<td Class="head" colspan=2 align='center'>Modify Batch </td>
	</tr>
	<TR>
		<TD Class="rowpic" width="50" align="center">Select</TD>
		<TD Class="rowpic" width="150" align="center">Batch Name</TD>
	</TR>
	<?php
	for($i=0;$i<$num;$i++)
	{
		$r = fetchrow($rs);
		?>
 		<TR>
 		<TD  width="50" align="center">
		<input type="checkbox" name="Sel[]" Value="<?=$r[0]?>">
 		</TD>
 		<TD  width="150" align="center">
		<input type="text" name="yr<?=$r[0]?>" value="<?=$r[1]?>" onBlur='check(this.form.yr<?=$r[0]?>)'>
		</TD>
		</TR>
		<?php
	}
	?>
	<TR height='40'>
		<td colspan="2" align='center'>
		<input type="button" value="Modify" onClick="JavaScript:SendMe('Mod')" class='bgbutton'>
		</td>
  	</tr>
</table>
	<?php
}
?>
<tr>
<td colspan=2 align='center'>
	<table width="200" class='forumline' align='center'>
	<tr><td colspan=2 align='center' class='head'>Manage Batch</td></tr>
	<tr>
       <td class="CBody" align="left">

	  <input type="text" size="40" name="newYear">
	 </td></tr>
       <tr height='40'>
 	<td colspan="2" align='center'>
	  <input type="button" value="ADD" class='bgbutton' onClick="JavaScript:SendMe('Add')">
	 </td></tr>	
	</table>
</td></tr>
</table>
</form>
</body>
</html>

