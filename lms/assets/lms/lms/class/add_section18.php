<?php
	session_start();
	include("../db.php");
	$accyear=$_SESSION['AcademicYear'];

	//print_r($_POST);
if($_POST)
{
	$course=$_POST['course'];
	$sem=$_POST['sem'];
}
else
{
	$course=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
}
	$section=$_POST['section'];
	$sem=$_REQUEST['sem'];
	$subj=$_REQUEST['subj'];
	$class_section=$_REQUEST['class_section'];
	
	if($sem=='')
	{
$mgl21=fetcharray(execute("select course_year_id from subject_m  where subject_id='$subj'"));
	$sem=$mgl21[0];
	}

$subnames23=fetcharray(execute("select subject_code from subject_m where subject_id='$subj'"));
	
if($_POST['update'])
{

	$cid=$_POST['cid'];
	for($i=0;$i<sizeof($cid);$i++)
	{
		$section=$_POST['section'.$cid[$i]];
		
        execute("update class_section set section_name='$section',codename='$subnames23[0]' where id='$cid[$i]'");	
	}
		?>
		<Script language="JavaScript">
        alert("Updated Sucessfully!");
		window.opener.location.href='class_create.php?id=1&sem='+"<?=$sem?>"+'&subject='+"<?=$subj?>"+'&section='+"<?=$class_section?>";
		window.close();
        </Script>
		<?php		
}
if($_POST['save'])
{
	
	if($section!='')
{
	$sql2=execute("select * from class_section where grade='$sem' and sub='$subj' and section_name='$section'");
	if(rowcount($sql2)>=1)
	{
		?>
		<Script language="JavaScript">
		alert("Duplicate entry not allowed");
		</Script>
		<?php
	}
	else
	{
		
		$sql5="INSERT INTO `class_section` (`section_name`, `sub`, `grade`,`codename`,`status`) VALUES ('{$section}', '$subj', '$sem','$subnames23[0]', '1');";
		
		execute($sql5);
		?>
		<Script language="JavaScript">
        alert("Updated Sucessfully!");
		window.opener.location.href='class_create.php?id=1&sem='+"<?=$sem?>"+'&subject='+"<?=$subj?>"+'&section='+"<?=$class_section?>";
		window.close();
        </Script>
		
		<?php
		}
		}
		else
		{
		?>
		
		<SCRIPT LANGUAGE="JavaScript">
	alert("Enter Section");
	</script>
	
		<?php
			
	}
}
?>
<html>
<?php
$subnames22=fetcharray(execute("select subject_name,subject_code from subject_m where subject_id='$subj'"));
?>
<title>
Section For <?=$subnames22[0]?>
</title>
<head>
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
<input type="hidden" name="subj" value="<?=$subj?>">
<input type="hidden" name="section" value="<?=$section?>">
<input type="hidden" name="sem" value="<?=$sem?>">
<input type="hidden" name="class_section" value="<?=$class_section?>">
<?php
$subnames2=fetcharray(execute("select subject_name,subject_code from subject_m where subject_id='$subj'"));

?>
<table align='center' class='forumline' width='50%' border="1" >
	<tr>
		<td align='center' class='head' nowrap>Section Name</td>
	</tr>
	<tr>
	
      <td align='center' nowrap><?=$subnames2[1]?> - 
        <input size="15" type='text' name='section' value='' required>
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
  
  
$sql3=execute("select id,section_name,sub,codename from class_section where sub='$subj' and status=1");
if(rowcount($sql3)>=1)
{	
$subnames=fetcharray(execute("select subject_name from subject_m where subject_id='$subj'"));
	?>
<br>
<form method="post" name="MyFrm1">

<table align='center' class='forumline' width='50%' border="1" >
    <tr>
        <td align='center' class='head' nowrap>Sel</td>
        <td align='center' class='head' nowrap>Section Name</td>
    </tr>
	<?php
	while($r6=fetcharray($sql3))
	{
	echo "<tr><td align='center'  nowrap><input type='checkbox' name='cid[]' value='$r6[0]'>
		</td>
		 <td align='center' nowrap>$r6[3] - 
        <input size='15' type='text' name='section$r6[0]' value='$r6[1]'>
		</td>
		";
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
