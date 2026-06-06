<?php
	session_start();
	include("../db.php");
	$accyear=$_SESSION['AcademicYear'];

	$acc_fname=$_POST['acc_fname'];
	$acc_sname=$_POST['acc_sname'];
	
if($_POST['update'])
{

	$cid=$_POST['cid'];
	for($i=0;$i<sizeof($cid);$i++)
	{
		$acc_fname=$_POST['acc_fname'.$cid[$i]];
		$acc_sname=$_POST['acc_sname'.$cid[$i]];
		
			$staff_upadte=1;
			$viewstaff_acc=execute("select * from leave_acc_year where status=1 and acc_name='$acc_sname'");
			if(mysql_num_rows($viewstaff_acc)>1)
			{
				$staff_upadte=0;
				?>
				<Script language="JavaScript">
				alert("Please update correct academic year");		
				</Script>
				<?php
			}
			if($staff_upadte)
			{
        mysql_query("update leave_acc_year set acc_year='$acc_fname',acc_name='$acc_sname' where id='$cid[$i]'");
			}
	}
	if($staff_upadte)
	{
	?>
		<Script language="JavaScript">
        alert("Updated Successfully");
        </Script>
	<?php
	}
}
if($_POST['save'])
{
	$staff_upadte=1;
			$viewstaff_acc=execute("select * from leave_acc_year where status=1 and acc_name='$acc_sname'");
			if(mysql_num_rows($viewstaff_acc)>0)
			{
				$staff_upadte=0;
				?>
				<Script language="JavaScript">
				alert("Please add correct academic year");		
				</Script>
				<?php
			}
			if($staff_upadte)
			{
		
		$sql5="INSERT INTO `leave_acc_year` (`acc_year`,`status`,`acc_name`) VALUES ('$acc_fname','1','$acc_sname');";
		
		mysql_query($sql5);
		?>
		<Script language="JavaScript">
        alert("Inserted Successfully");		
        </Script>
		<?php
		}
		
}
?>

<html>
<head>
<style>

</style>
<title>Add Academic Year</title>
<Script language="JavaScript">
function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
	function RefreshMe(val)
	{
		document.MyFrm.action="add_section.php";
		document.MyFrm.submit();
	}

	
</script>
</head>
<body class='bodyline'>
<form method="post" name="MyFrm">
<input type="hidden" name="flag" value="<?=$flag?>">
<input type="hidden" name="userid" value="<?=$userid?>">
<table align='center' class='forumline' width='50%' border="1" >
    <tr>
        <td align='center' class='head' nowrap>Full Name</td>
        <td align='center' class='head' nowrap>Short Name</td>
    </tr>
    <tr>
        <td align='center' nowrap>
        <input size="20" type='text' name='acc_fname' value='' required>
        </td> 
         <td align='center' nowrap>
         <input size="20" type='text' name='acc_sname' value='' required>
        </td>
    </tr>
</table>
<br>
  <div align='center' >
  <input type="submit" name="save" value="SAVE"  class='bgbutton'>
  </div>
  <br>
  </form>
  <?php
$sql3=mysql_query("select id,acc_year,acc_name from leave_acc_year where status=1");
if(mysql_num_rows($sql3)>=1)
{	
	?>
<form method="post" name="MyFrm1">

<table align='center' class='forumline' width='50%' border="1" >
    <tr>
        <td align='center'  colspan="3" class='head' nowrap>Modify</td>
    </tr>
     <tr>
        <td align='center' class='rowpic' nowrap>Sel</td>
        <td align='center' class='rowpic' nowrap>Full Name</td>
        <td align='center' class='rowpic' nowrap>Short Name</td>
    </tr>
	<?php
	while($r6=mysql_fetch_array($sql3))
	{		
	echo "<tr><td align='center'  nowrap>";
			echo "<input type='checkbox' name='cid[]' value='$r6[0]' >";
		echo "</td>
		 <td align='center' nowrap>";
	
        echo "<input size='20' type='text' name='acc_fname$r6[0]' value='$r6[1]'>";
		echo "</td><td align='center' nowrap>";
		echo "<input size='20' type='text' name='acc_sname$r6[0]' value='$r6[2]' >";	
		
		echo "</td>";
		?>
		<?php
		
		echo "</tr>";
	}
	?>
	<?php
	?>
	</table>
    <br>
  <div align='center' >
  <input type="submit" name="update" value="UPDATE"  class='bgbutton'>
  </div>
	<?php
}
?>	
 
	</form></body></html>
