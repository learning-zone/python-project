<?php
session_start();
require("../db.php");
?>
<HTML>
<HEAD>
<script language="JavaScript">
function SendMe(val){
	document.frm.action = "addyear.php?Types=" + val;
	document.frm.submit();
}
</script>
<body class='bodyline'>

<form name="frm" method="POST" action="addyear.php">
<?php

$sql = "SELECT * FROM course_year where status=1 ORDER BY head_id,year_id";

//echo($sql);

$rs = execute($sql)
	 or die(mysql_error());

$num = rowcount($rs);

//echo($num);

if($num > 0 ){
?>
<table width="50%" border="0" class='forumline' align=center>
<tr>
<td Class="head" colspan=4 align='center' nowrap>Modify Class Details</td></tr>
 <TR>
  <TD Class="rowpic" width="50" align="center">Select</TD>
  <TD Class="rowpic" width="150" align="center">Class Name</TD>
<td align=center class="rowpic">Short Name</td>

  <TD Class="rowpic" width="250" align="center" nowrap>School Division Type</TD></TR>

<?php
	for($i=0;$i<$num;$i++){
		$r = fetchrow($rs);

$exe=execute("select * from course_year where year_id='$r[0]'");
$exe1=fetcharray($exe);

		$dis=execute("select cname from coursehead where id='$exe1[4]'");
		$dis1=fetcharray($dis);
if($i%2)
		echo "	<tr class='clsname' > ";
		else
		echo "	<tr > ";
?>

  <TD Class="CBody" width="50" align="center">
	<input type="checkbox" name="Sel[]" Value="<?=$r[0]?>">
  </TD>
  <TD Class="CBody" width="150" align="center">
	<input type="text" name="yr<?=$r[0]?>"
                    value="<?=$r[1]?>">
  </TD>
 <td  align="center">
  <input type="text" name="short_name<?=$r[0]?>" value="<?=$r[2]?>" width="7" maxlength="5">
 </td>

<TD Class="CBody" width="150" align="center">
	<input type="text" name="Ctype<?=$r[0]?>"
                    value="<?=$dis1[0]?>" readonly=true>
		    <!--<?=$dis1[0]?>-->
  </TD></TR>
<?php
	}
?></table>
 <br>
  <div align="center">
  <input type="button" value="Modify" align='center' onClick="JavaScript:SendMe('Mod')" class='bgbutton'></div>
<!--
	 <TD ><input type="button" value="Delete" onClick="JavaScript:SendMe('Del')" class='bgbutton'></TD>-->
	 </td></TR>
<?php
}
?>
<br>
<table width="50%" class='forumline' align=center>
<tr><td Class="head" colspan=3 align='center' nowrap>Add Class Details</td></tr>


<tr><td align=center class="rowpic">Class Name</td>
<td align=center class="rowpic">Short Name</td>
<td class="rowpic" nowrap>School Division Type</td>
<tr>
 <td width="50%" align="center">
  <input type="text" name="newYear">
 </td>
 <td width="50%" align="center">
  <input type="text" name="short_name" width="7" maxlength="5">
 </td>
<td width="50%" align="center">	
<input type="hidden" size="5" name="CourseInta">
<?
$q=execute("select * from coursehead");
echo"<select name=type>";
while($q1=fetcharray($q))
{
echo"<option value=$q1[0]>$q1[1]</option>";
}
echo"</select></td>";
?>
</tr></table>
<br>
<div  align="center">
  <input type="button" value="Add New" onClick="JavaScript:SendMe('Add')" class='bgbutton'>
 </div></form>
</body></html>
