<?php
session_start();
include('../db.php');
$subj = $_POST['subj'];
$stype = $_POST['stype'];
$stfname = $_POST['stfname'];
$sid = $_POST['sid'];
$B1 = $_POST['B1'];

$id = $_POST['id'];

$act=$_POST['act'];
$subn=$_POST['subn'];
?>
<html>
<head>

<script language='javascript'>
function perform()
{
	document.frm.action="act_staff.php";
	document.frm.submit();
}
function OpenWind(k)
{
	var finalVar;
	finalVar=k;
	window.open(finalVar,'Stud','height=800,width=800,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
</script>
<?php 
 
if(isset($subn))
{
  while( list(,$Value) = each($act) )
  {
	 $upd=execute("update staff_det set active='YES' where slno='$Value'"); 
  }
}
?>
</head>
<body class='bodyline'>
<form name='frm' method='post' action='act_staff.php'>
<table class="forumline" align='center' cellspacing='1' cellpadding="1" width='65%'>
<tr><td class='head' align='center'colspan='8'>Staff Details<br>
<tr><td width="218" style="font-size:13px;">Depatment&nbsp;&nbsp;</td>
<td><select name="subj" size="1">
<option value='0'>--select--</option>
<?php
$SQL = "SELECT * FROM dept_no";
$rs = execute($SQL);
$num = rowcount($rs);
for($i=0;$i<$num;$i++)
	{
	$r = fetcharray($rs);
	if($subj==$r[dpt_id])	{
		echo "<option value='$r[dpt_id]' selected>$r[Dept]</option>";
	}
	else	{
		echo "<option value='$r[dpt_id]'>$r[Dept]</option>";
	}
}
?> 
</select> </font></td>
<td width="218" align='center' >(OR)</td><td>Designation</td>
<td colspan='2'><select name="stype" size="1">
<option value='0'>--Select Designation--</option>
<?php
$SQL = "SELECT * FROM staff_des";
$rs = execute($SQL);
$num = rowcount($rs);

for($i=0;$i<$num;$i++)
	{
	$r = fetcharray($rs);
	if($stype==$r[d_id])
	{
?>
		<option value="<?=$r["d_id"]?>" selected><?=$r["d_name"]?></option>
<?php
	}
	else
	{?>
		<option value="<?=$r["d_id"]?>"><?=$r["d_name"]?></option>
	<?php
	}
}
?>
</select> </font></td>
</tr>
<tr>
	<TD colspan="8" align="center">(OR)</TD>
</TR>
<tr>
	<TD>Staff Name</TD>
	<TD><input type="text" name="stfname"></TD>
	<TD align='center'>(OR)</td><td>Staff ID</TD><td colspan='3'>
	<input type="text" name="sid"></TD>
</TR>
</table><br>
<div align="center">
<input type="submit" value="Submit" name="B1" onClick="perform()" class="bgbutton"></td></tr>
</div>
<br>
<?php

if(isset($B1))
{ 
		 if($sid!="")
		  {
			$sqq="select * from staff_det where slno='$sid' and active='NO'";
			
		  }
		  if($stfname!="")
		  {
			$sqq="select * from staff_det where f_name like '$stfname%' and active='NO'";
			//echo $sqq;
		  }
		  if($stype!="0")
		  {
			$sqq="select * from staff_det where type_id='$stype' and active='NO'";
		  }
		  if($subj!="0")
		  {
			$sqq="select * from staff_det where subj='$subj' and active='NO'";
			
		  }
		  if($stype!="0" and $subj!="0")
		  {
			$sqq="select * from staff_det where type_id='$stype' and subj='$subj' and active='NO'";  
		  }
    $sq=execute($sqq);
	if(rowcount($sq)>0)
	{
?>
		<table class='forumline' align='center'  width='85%' border="1">
		<tr><td class='head' align='center'colspan=5>LIST OF DEACTIVATED STAFFS
		</td></tr>
		<tr><td class='rowpic'>Check</td><td class='rowpic'>Staff ID.</td><td class='rowpic'>Staff Name</td><td class='rowpic'>Department</td>
		<td class='rowpic'>Designation</td>
		
        </tr>
		<?php
     for($ee=0;$ee<rowcount($sq);$ee++)
		{
			
			if($ee%2)
               echo "        <tr> ";
               else
               echo "        <tr class='clsname'> ";
			$ded=fetcharray($sq);     
 ?>

		
		<td class='StudBody' align="center"> <input type='checkbox' name='act[]' value='<?php echo $ded[slno]?>'></td>
		<td class='StudBody'> &nbsp;<?php echo $ded[slno]?></td>
		<td class='StudBody'>&nbsp;
		<a href="javascript:OpenWind('view_sta.php?id=<?php echo $ded[slno]?>')" ><?php echo $ded[f_name] ?></a></td>
        <?php 
		$dd="select * from dept_no where dpt_id='$ded[subj]'";
		$dde=mysql_query($dd);
		$ddes=mysql_fetch_array($dde);
		?>
		<td class='StudBody' align="center"> <?php echo $ddes[Dept]?></td>
		<?php 
		$dd1="select * from staff_des where d_id='$ded[type_id]'";
		$dde1=mysql_query($dd1);
		$ddes1=mysql_fetch_array($dde1);
		?>
		<td class='StudBody'> &nbsp;<?php echo $ddes1[d_name]?></td>
		</tr>
        
       
<?
       }?>

		
		</table>
         <br>
        <div align="center">
<input type='submit' name='subn' value='Activate' class='bgbutton'></div>
        <?php  }
		else
			{
			 //die("<font color='red'><b>Your Search Did Not Fetch Any Record!!!</b></font>");
			 ?>
        <SCRIPT LANGUAGE ="JavaScript">
            alert("No Records Found");
        </script>
        <?php
			}
}

?>

</form>
</body>
</html>