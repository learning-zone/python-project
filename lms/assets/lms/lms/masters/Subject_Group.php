<HTML>
<HEAD>
<?php
session_start();
require("../db.php");
$group_name=$_POST['group_name'];
$order_id=$_POST['order_id'];
if($group_name)
{
execute("INSERT INTO `subject_group` (`group_name`, `status`, `order_id`) VALUES ('$group_name', 1, '$order_id')");
}
?>
<script language="JavaScript">
function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
function add()
{
	var group_name=document.getElementById("group_name").value;
	if(group_name=='')
	alert("Enter subject group name");
	else
	document.frm.submit();
}
</script>
<body >
<form name="frm" method="POST" action="">
<br>
<table width="60%" border="1" class='forumline' align=center>
<tr>
  <td colspan="4" align='center' Class="head">Subject  Group</td></tr>
<tr>
 <td align="center" class="row3">Name</td>
 <td  align="">&nbsp;&nbsp;
  <input type="text" name="group_name"  id="group_name"></td>
 <td align="center" class="row3">Order</td>
  <td  align="">&nbsp;&nbsp;
  <input type="text" name="order_id"  id="order_id" width="2" size="2" maxlength="2">
 </td>
 </tr></table>
<br>
 <div align="center">
  <input type="button" value="Save" onClick="add()" class="bgbutton">
 </div>
<br>
<?php

$sql = "SELECT * FROM subject_group ORDER BY order_id";

//echo($sql);

$rs = execute($sql)
	 or die(mysql_error());

$num = rowcount($rs);

//echo($num);

if($num > 0 ){
?>
<table width="60%" border="0" class='forumline' align=center>
<tr>
  <td Class="head" colspan="4" align='center'>Modify Subject Group</td></tr>

 <TR>
  <TD Class="rowpic" width="50" align="center">Sl.No</TD>
  <TD Class="rowpic" width="150" align="center">Name</TD>
  <TD Class="rowpic" width="50" align="center">Order</TD>
  <TD Class="rowpic" width="150" align="center">Action</TD>
 </TR>

<?php
	while($r=fetcharray($rs))
	{
		
?>
 <TR>
  <TD Class="CBody" width="50" align="center">
	<input type="checkbox" name="Sel[]" Value="<?=$r[0]?>">
  </TD>
  <TD Class="CBody" width="150" align="center">
	<input type="text" name="group_name<?=$r[0]?>" value="<?=$r[1]?>">
  </TD>
  <TD Class="CBody" width="150" align="center">
	<input type="text" name="order_id<?=$r[0]?>" value="<?=$r['order_id']?>"  width="2" size="2"  maxlength="2">
  </TD>
  <TD Class="CBody" width="150" align="center" nowrap>
      <input type="button" value="Add Subject" onClick="JavaScript:OpenWind2('subject_group_sub.php?id=<?=$r[0]?>')" class="bgbutton">																		&nbsp;&nbsp;&nbsp;&nbsp;
      <!--<input type="button" value="Delete" onClick="JavaScript:SendMe('Mod')" class="bgbutton">-->
  </TD>
 </TR>
<?php
	}
?>
  </table><br>
 	<!-- <div align=center><input type="button" value="Modify" onClick="JavaScript:SendMe('Mod')" class="bgbutton">-->
  </div>


<?php
}
?>

</form>
</body>
</html>


