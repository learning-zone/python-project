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
<br><br><?php
if($_POST['save'])
{
	$name=$_POST['name'];
	$g_from=$_POST['g_from'];
	$g_to=$_POST['g_to'];
	$remarks=$_POST['remarks'];
	if($name=='' and $g_from=='' and $g_to=='')
	echo "<script language='javascript'> alert ('*** Mandatory  to fill all the field ***'); </script>";
	else
	{
		$sql1=execute("select * from grade where name='$name'");
		if(rowcount($sql1)==0)
		{
		execute("insert into grade(name,g_from,g_to,remarks) value('$name','$g_from','$g_to','$remarks')");
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
		$name=$_POST['name'.$sel[$i]];
		$g_from=$_POST['g_from'.$sel[$i]];
		$g_to=$_POST['g_to'.$sel[$i]];
		$remarks=$_POST['remarks'.$sel[$i]];
		$sql3=execute("select * from grade where name='$name' and id!=$sel[$i]");
		if(rowcount($sql3)==0)
		{
			
		execute("update grade set name='$name' , g_from='$g_from' , g_to='$g_to' ,remarks='$remarks' where id=$sel[$i] ");
		echo "<script language='javascript'> alert ('Updated Successfully '); </script>";
		}
		else
		echo "<script language='javascript'> alert ('Duplicate entry not allowed '); </script>";
	}
}
?>
		<table align="center"  class='forumline' width="50%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" colspan="4" class="head">Declare Grading System </td>
    </tr>
  <tr>
    <td align="center"  class="rowpic">From</td>
    <td align="center"  class="rowpic">To</td>
    <td align="center"  class="rowpic">Grade</td>
    <td align="center"  class="rowpic">Remarks</td>
  </tr>
  <tr>

    <td align="center" ><input type="text" name="g_from" size="4" value=""></td>
    <td align="center" ><input type="text" name="g_to"  size="4"  value=""></td>
        <td align="center" ><input type="text" name="name" size="4"  value=""></td>
    <td align="center" ><textarea name="remarks" cols="30" rows="2"></textarea></td>
  </tr>
</table>
	<br>
    <div align="center"><input type="submit" name="save" value="SAVE"></div>
	<br>
    	<br>
        <?php
		$sql2=execute("select * from grade ");
		if(rowcount($sql2)==0)
		die();
		
		?>
        <table align="center"  class='forumline' width="50%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" colspan="5" class="head">Modify Grading System </td>
    </tr>
  <tr>
   <td align="center"  class="rowpic">Select</td>
    <td align="center"  class="rowpic">From</td>
    <td align="center"  class="rowpic">To</td>
    <td align="center"  class="rowpic">Grade</td>
    <td align="center"  class="rowpic">Remarks</td>
  </tr>
  <?php
  while($r1=fetcharray($sql2))
  {
  ?>
  <tr>
  <td align="center" ><input type="checkbox" name="sel[]" value="<?=$r1[0]?>"></td>
   
    <td align="center" ><input type="text" name="g_from<?=$r1[0]?>" size="4" value="<?=$r1[2]?>"></td>
    <td align="center" ><input type="text" name="g_to<?=$r1[0]?>"  size="4"  value="<?=$r1[3]?>"></td>
     <td align="center" ><input type="text" name="name<?=$r1[0]?>" size="4"  value="<?=$r1[1]?>"></td>
    <td align="center" ><textarea name="remarks<?=$r1[0]?>" cols="30" rows="1"><?=$r1[4]?></textarea></td>
  </tr>
   <?php
  }
  ?>
</table>	
	<br>
    <div align="center"><input type="submit" name="Update" value="Update"></div>	
</form>
</body>
</html>
