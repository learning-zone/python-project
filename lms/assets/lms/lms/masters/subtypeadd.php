<HTML>
<HEAD>
<?php
session_start();
require("../db.php");


?>
<script language="JavaScript">
function SendMe(val){
	document.frm.action = "addsubtype.php?Type=" + val;
	document.frm.submit();
}
</script>
<body >
<form name="frm" method="POST" action="addsubtype.php">
<br>
<?php

$sql = "SELECT * FROM subjecttype ORDER BY subtype_id";

//echo($sql);

$rs = execute($sql)
	 or die(mysql_error());

$num = rowcount($rs);

//echo($num);

if($num > 0 ){
?>
<table width="200" border="0" class='forumline' align=center>
<tr><td Class="head" colspan="2" align='center'>Modify Subject Type </td></tr>

 <TR>
  <TD Class="rowpic" width="50" align="center">Select</TD>
  <TD Class="rowpic" width="150" align="center">Subject Type Name</TD>
 </TR>

<?php
	for($i=0;$i<$num;$i++){
		$r = fetchrow($rs);

?>
 <TR>
  <TD Class="CBody" width="50" align="center">
	<input type="checkbox" name="Sel[]" Value="<?=$r[0]?>">
  </TD>
  <TD Class="CBody" width="150" align="center">
	<input type="text" name="subtype<?=$r[0]?>"
                    value="<?=$r[1]?>">
  </TD>
 </TR>

<?php
	}
?>
  </table><br>
 	 <div align=center><input type="button" value="Modify" onClick="JavaScript:SendMe('Mod')" class="bgbutton">
  </div>


<?php
}
?>
<br>
<table width="200" class='forumline' align=center>
<tr><td align='center' Class="head">Manage Subject Type</td></tr>
<tr>
 <td  align="center">
  <input type="text" name="newsubtype">
 </td></tr></table>
<br>
 <div align="center">
  <input type="button" value="ADD" onClick="JavaScript:SendMe('Add')" class="bgbutton">
 </div>

</form>
</body>
</html>


