<?php
	session_start();
	include("../db.php");
	$accyear=$_SESSION['AcademicYear'];

	$leave_name=$_POST['leave_name'];
	$leavetype=$_POST['leavetype'];
	
if($_POST['update'])
{

	$cid=$_POST['cid'];
	for($i=0;$i<sizeof($cid);$i++)
	{
		$leave_name=$_POST['leave_name'.$cid[$i]];
		$leavetype=$_POST['leavetype'.$cid[$i]];
			
        mysql_query("update staff_leave_type set leave_name='$leave_name',special_type='$leavetype' where id='$cid[$i]'");	
	}
		?>
		<Script language="JavaScript">
        alert("Updated Successfully");
		window.opener.location.href='leavestaffsetup.php?tab=2';
		
        </Script>
		<?php		
}
if($_POST['save'])
{
	
		
		$sql5="INSERT INTO `staff_leave_type` (`leave_name`,`status`,`special_type`) VALUES ('$leave_name','1','$leavetype');";
		
		mysql_query($sql5);
		?>
		<Script language="JavaScript">
        alert("Inserted Successfully");
		window.opener.location.href='leavestaffsetup.php?tab=2';
		
        </Script>
		
		<?php
		
}
?>

<html>
<head>
<style>

</style>
<title>Add Leave Type</title>
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
         <td colspan="2" align='center' class='head' nowrap>Leave Type Name</td>
    </tr>
    <tr>
        <td align='center' nowrap>
        <input size="20" type='text' name='leave_name' value='' >
        </td> 
         <td align='center' nowrap>
        <select name="leavetype" >
        <option value='1'>Normal Leave</option>
        <option value='2'>Special  Leave</option>		
        </select>
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
$sql3=mysql_query("select id,leave_name,special_type from staff_leave_type where status=1");
if(mysql_num_rows($sql3)>=1)
{	
	?>
<form method="post" name="MyFrm1">

<table align='center' class='forumline' width='50%' border="1" >
    <tr>
        <td align='center' class='head' nowrap>Sel</td>
        <td align='center'  colspan="2" class='head' nowrap>Leave Type Name</td>
    </tr>
	<?php
	while($r6=mysql_fetch_array($sql3))
	{		
	echo "<tr><td align='center'  nowrap>";
	if($r6[0]==1 || $r6[0]==6 )
		{
	echo "<input type='checkbox' name='cid[]' value='$r6[0]'  title='disabled' disabled>";
		}
		else
		{
			echo "<input type='checkbox' name='cid[]' value='$r6[0]' >";
		}
		echo "</td>
		 <td align='center' nowrap title='$r6[1]'>";
		 if($r6[0]==1 || $r6[0]==6  )
		{
        echo "<input size='20' type='text' name='leave_name$r6[0]' value='$r6[1]' title='disabled' disabled>";
		}
		else
		{
		echo "<input size='20' type='text' name='leave_name$r6[0]' value='$r6[1]' title='$r6[1]'>";	
		}
		echo "</td>";
		$leavetype1='';
		$leavetype2='';
		if($r6[2]==1)
		{
		$leavetype1='selected';
		}
		if($r6[2]==2)
		{
		$leavetype2='selected';
		}
		?>
		 <td align='center' nowrap>
        <select name="leavetype<?=$r6[0]?>" >
        <option value='1' <?=$leavetype1?>>Normal Leave</option>
        <option value='2' <?=$leavetype2?>>Special  Leave</option>		
        </select>
        </td>
		<?php
		
		echo "</td></tr>";
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
