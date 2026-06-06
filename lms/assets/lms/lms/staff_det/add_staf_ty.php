<?php
	session_start();
	include("../db.php");
	$accyear=$_SESSION['AcademicYear'];

	$leave_name=$_POST['leave_name'];
	$adate=$_REQUEST['adate'];	

if($_POST['update'])
{

	$cid=$_POST['cid'];
	for($i=0;$i<sizeof($cid);$i++)
	{
		$leave_name=$_POST['leave_name'.$cid[$i]];
			
        mysql_query("update staff_group set name='$leave_name' where id='$cid[$i]'");	
	}
		?>
		<Script language="JavaScript">
        alert("Updated Successfully");
		/*window.opener.location.href='leavestaffsetup.php?tab=2&adate='+"<?=$adate?>";*/
		
        </Script>
		<?php		
}
if($_POST['save'])
{
		
		$sql5="INSERT INTO `staff_group` (`name`,`status`) VALUES ('$leave_name','1');";
		
		mysql_query($sql5);
		?>
		<Script language="JavaScript">
        alert("Inserted Successfully");
		/*window.opener.location.href='leavestaffsetup.php?tab=2&adate='+"<?=$adate?>";*/
		
        </Script>
		
<?php
		
}
?>

<html>
<head>
<title>Add Staff Type </title>
<Script language="JavaScript">
function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}

	
</script>
</head>
<body class='bodyline'>
<form method="post" name="MyFrm">
<input type="hidden" name="flag" value="<?=$flag?>">
<input type="hidden" name="userid" value="<?=$userid?>">
<input type='hidden' name='adate' value='<?php echo $adate?>'>

<table align='center' class='forumline' width='50%' border="1" >
    <tr>
         <td align='center' class='head' nowrap>Staff Type Name</td>
    </tr>
    <tr>
        <td align='center' nowrap>
        <input size="40" type='text' name='leave_name' value='' >
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
$sql3=mysql_query("select id,name from staff_group where status=1");
if(mysql_num_rows($sql3)>=1)
{	
	?>
<form method="post" name="MyFrm1">

<table align='center' class='forumline' width='50%' border="1" >
    <tr>
        <td align='center' class='head' nowrap>Sel</td>
        <td align='center' class='head' nowrap>Staff Type Name</td>
    </tr>
	<?php
	while($r6=mysql_fetch_array($sql3))
	{
	echo "<tr><td align='center'  nowrap><input type='checkbox' name='cid[]' value='$r6[0]'>
		</td>
		 <td align='center' title='$r6[1]' nowrap>
        <input size='40' type='text' name='leave_name$r6[0]' value='$r6[1]' title='$r6[1]'>
		</td>";
		?>
		
		<?php
		
		
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
