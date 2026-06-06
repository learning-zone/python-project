<html>
<head>
<?php
session_start();
include("../db.php");
?>
<SCRIPT LANGUAGE ="JavaScript">
function EditClick()
{
document.form1.action="AlterAdmissionType.php?Types=Mod";
document.form1.submit();
 }
</script>
</head>
<body><font size='10' class='bodyline'>

<?php

 $query = "SELECT *  FROM admission";

 $rs = execute($query);

 $row=rowcount($rs);


 if($row){

?>
  <form method="post" id="form1" name="form1">
  <table class='forumline' align=center>
  <tr>
<td Class="head" colspan=3 align='center'>Manage Admission Type</td>

</tr>
  <tr><td class="rowpic">Select</td><td class="rowpic" align="center">Admission Type</td>
  <td class="rowpic" align="center">Short Name</td></tr>
  <?php
	for($i=0;$i<$row;$i++){
 		$r = fetchrow($rs);
  ?>
<tr><td class="CBody" align="center">
  <input type="checkbox" name="cid[]" Value="<?=$r[0]?>">

    </td>
    <td class="CBody">
    <input type="text" size=40 name="CName<?=$r[0]?>" value="<?=$r[1]?>">
    </td>
    <td class="CBody">
	    <input type="text" size=10 name="short_name<?=$r[0]?>" value="<?=$r[2]?>">
    </td>
    </tr>

   <?php
	}
   ?>
  </table>
  <div align=center>

  <input type="button" onClick="EditClick()" value="    Modify    " class='bgbutton'>
  </div>

  </form>
  <?php
	}else{
          echo "<p align=\"left\"><b>No Admission Types Present</b></p>";
	}

  ?>

<form Name="AddAdmissiontype" action="Add_AdmissionType.php" method="GET">
<table class='forumline' align=center>
<tr>
<td Class="head" colspan=3 align='center'>Add Admission Type</td>


</tr>
<tr>
<td class="row3" align="center">Admission Type</td>
<td class="row3" align="center">Short Name</td>
</tr>

<tr><td >
<input type="text" size="40" name="AdmissionType">
</td>
<td >
<input type="text" size="10" name="short_name">
</td>
</tr></table>
<div align=center><input type="Submit" value="    ADD    " class='bgbutton'></div>
</form>
</body>
</html>