<html>
<head>
<?php
session_start();
include("../db.php");
?>

<script language="javascript">


</script>
</head>
<body>
<form method="POST" name="frm" action="">
<?php
if($_POST['save'])
{
	$unit_name=$_POST['unit_name'];
	$posi=$_POST['posi'];
	if($unit_name=='' and $posi=='')
	echo "<script language='javascript'> alert ('*** Mandatory  to fill all the field ***'); </script>";
	else
	{
		$sql1=execute("select * from lms_units where unit_name='$unit_name'");
		if(rowcount($sql1)==0)
		{
			
		execute("insert into lms_units(`unit_name`, `posi`, `status`) value('$unit_name', '$posi', '1')");
		echo "<script language='javascript'> alert ('Successfully  inserted '); </script>";
		}
		else
		echo "<script language='javascript'> alert ('Duplicate entry not allowed '); </script>";
	}
}

if($_POST['Update'])
{
	$sel=$_POST['sel'];
	for($i=0;$i<sizeof($sel);$i++)
	{
		$unit_name=$_POST['unit_name'.$sel[$i]];
		$posi=$_POST['posi'.$sel[$i]];
		$sql3=execute("select * from lms_units where unit_name='$unit_name' and id!=$sel[$i]");
		if(rowcount($sql3)==0)
		{
			
		execute("update lms_units set `unit_name`='$unit_name' , `posi`='$posi' where id=$sel[$i] ");
		echo "<script language='javascript'> alert ('Updated Successfully '); </script>";
		}
		else
		echo "<script language='javascript'> alert ('Duplicate entry not allowed '); </script>";
	}
}
?>
		<table align="center"  width="90%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" colspan="4" class="head">Manage Unit</td>
    </tr>
  <tr>
    <td align="center"  class="rowpic">Unit Name</td>
    <td align="center"  class="rowpic">Order</td>
  </tr>
  <tr>
		<td align="center" ><input type="text" name="unit_name" size="50"  value=""></td>
        <td align="center" ><input type="text" name="posi"  size="4"  value=""></td>
  </tr>
</table>
<br>
    <div align="center"><input type="submit" name="save" value="SAVE" class="bgbutton"></div>
        <?php
		$sql2=execute("select * from lms_units ");
		if(rowcount($sql2)==0)
		die();
		
		?>
        <br>
        <table align="center"  class='forumline' width="90%" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td align="center" colspan="5" class="head">Modify Unit Name</td>
    </tr>
  <tr>
   <td align="center"  class="rowpic">Select</td>
    <td align="center"  class="rowpic">Unit Name</td>
    <td align="center"  class="rowpic">Order</td>
  </tr>
  <?php
  while($r1=fetcharray($sql2))
  {
  ?>
  <tr>
  <td align="center" ><input type="checkbox" name="sel[]" value="<?=$r1[0]?>"></td>
    <td align="center" ><input type="text" name="unit_name<?=$r1[0]?>" size="50"  value="<?=$r1[1]?>"></td>
    <td align="center" ><input type="text" name="posi<?=$r1[0]?>"  size="4"  value="<?=$r1[2]?>"></td>
    
  </tr>
   <?php
  }
  ?>
</table>	
<br>
    <div align="center"><input type="submit" name="Update" value="Update" class="bgbutton"></div>	
</form>
</body>
</html>
