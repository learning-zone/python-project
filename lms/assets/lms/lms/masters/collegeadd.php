<html>
<head>
<?php
session_start();
require("../db.php");
?>
<SCRIPT LANGUAGE ="JavaScript">
function EditClick()
{
	document.form1.action="AlterCollege.php?Types=Mod";
	document.form1.submit();
}
 function DeleteClick()
 {
	document.form1.action="AlterCollege.php?Types=Del";
	 document.form1.submit();
 }
</script>
</head>
<body  class='bodyline'>
<?php
 $query = "SELECT * FROM college";
 $rs = execute($query);
 $r = fetchrow($rs);
 $row=rowcount($rs);
 $query1 = "SELECT * FROM company";
 $rs1 = execute($query1);
 $row1=rowcount($rs1);
 $que_1=fetcharray($rs1,0);
 if($row)
 {
	?>
  <form method="post" id="form1" name="form1" >
  <?php
  $flag_modify=$_REQUEST['flag_modify'];
  if($flag_modify==1)
  {
	  	?>
      	<script language="javascript">
		alert("Updated Successfully.");
		</script>
  		<?php
  }
  ?><br>
  <table class='forumline' align='center' width='90%'>
  <tr><td Class="head" colspan='2' align='center'>Manage School Details</td></tr>
  <tr><td     nowrap>&nbsp;&nbsp;School Name</td><td class="CBody">&nbsp;&nbsp;
	<input type="text" size=50 name="cname" value="<?=$r[1]?>" >
	</td></tr>
  <tr><td      nowrap>&nbsp;&nbsp;School Code</td><td class="CBody">&nbsp;&nbsp;
	<input type="text" size=10 name="ccode" value="<?=$r[2]?>">
	</td></tr>
<tr><td      nowrap>&nbsp;&nbsp;Address</td>	<td class="CBody">&nbsp;&nbsp;
	<textarea name="caddr" rows="5" cols="49"><?=$r[3]?></textarea>
	</td></tr>
	<tr><td      nowrap>&nbsp;&nbsp;City</td><td class="CBody">&nbsp;&nbsp;
	<input type="text" size=50 name="ccity" value="<?=$r[9]?>">
	</td></tr>
	<tr><td      nowrap>&nbsp;&nbsp;State</td><td class="CBody">&nbsp;&nbsp;
	<input type="text" size=50 name="cstate" value="<?=$r[10]?>">
	</td></tr>
	<tr><td     nowrap>&nbsp;&nbsp;Pin Code</td><td class="CBody">&nbsp;&nbsp;
	<input type="text" size=50 name="pincode" value="<?=$r[4]?>">
	</td></tr>
	<tr><td     nowrap>&nbsp;&nbsp;Phone</td><td class="CBody">&nbsp;&nbsp;
	<input type="text" size=50 name="cphone" value="<?=$r[5]?>">
	</td></tr>
	<tr><td     nowrap>&nbsp;&nbsp;Fax</td><td class="CBody">&nbsp;&nbsp;
	<input type="text" size=50 name="cfax" value="<?=$r[6]?>">
	</td></tr>
	<tr><td      nowrap>&nbsp;&nbsp;E-mail</td><td class="CBody">&nbsp;&nbsp;
	<input type="text" size=50 name="cemail" value="<?=$r[7]?>">
	</td></tr>
	<tr><td      nowrap>&nbsp;&nbsp;TIN No</td><td class="CBody">&nbsp;&nbsp;
	<input type="text" size=50 name="cpanno" value="<?=$r[11]?>">
	</td></tr>

  </table>
  <br>
  <div align='center'>
<input type="button" onClick="EditClick()" value="Modify" class='bgbutton'>
</div>
  </form>
  <?php
}	
else
{
     echo "No School details ..";
}

if(rowcount($rs)==0)
{
 ?>

	<form Name="Addcollege" action="addcollege.php" method="POST">
	<table class='forumline' align='center'>
	<tr><td Class="head" colspan=11 align='center'>Add School Details</td></tr>
	<tr><td    >School Name</td><td    >School Code</td><td    >Address</td><td    >City</td><td    >State</td><td    >Phone</td><td    >Email</td><td    >Pan No</td>
	</tr>
	<tr><td class="CBody">&nbsp;&nbsp;
	<input type="text" size="20" name="colname">
	</td><td class="CBody">&nbsp;&nbsp;
	<input type="text" size="10" name="colcode">
	</td>
	<td class="CBody">
	<textarea name="coladdr" rows="3" cols="20"></textarea>
	</td>
	<td class="CBody">
	<input type="text" size="10" name="city">
	</td>
	<td class="CBody">
	<input type="text" size="10" name="state">
	</td>
	<td class="CBody">
	<input type="text" size="10" name="colphone">
	</td>
	<td class="CBody">
	<input type="text" size="10" name="colemail">
	</td>
	<td class="CBody">
	<input type="text" size="10" name="pan_no">
	</td>
	<td class=CBody><input type=text name="area"></td>
	<td class=row2><input type=text name="area1"></td></tr>
	</tr>
	<tr><td colspan=11 align='center'><input type="Submit" value="ADD" class='bgbutton'></td></tr>
	</table>
	<br>

	</form>
	<?
}
?>
</body>
</html>
