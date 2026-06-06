<html>
<head><title>Add Rights to Staff</title>
<Script language="JavaScript">

	function SaveDetails()
	{
		document.MyFrm.action="InsAddUserRights.php";
		document.MyFrm.submit();
	}
	function RefreshMe(val)
	{
		document.MyFrm.flag.value=val;
		document.MyFrm.action="AddRightsToStaff.php";
		document.MyFrm.submit();
	}

	function win_open()
	{
		var a = document.MyFrm.username.value;
		var len = a.length;
		if (a == "")
		{
			alert("Enter the Username atleast 3 characters !!");
			document.MyFrm.username.focus();
			return false;
		}
		else if (len < 3)
		{
			alert("Enter the First 3 characters of Username !!");
			document.MyFrm.username.focus();
			return false;
		}
		var x = window.open("usersearch2.php?username="+a,"user1","width=500,height=500,status=no,toolbar=no,scrollbar=no,menubar=no,sizeable=0");
	}

</script>
<?php
session_start();
include("../db.php");
$user=$_SESSION['user'];
if($_POST['del'])
{
	$chks=$_POST['chks'];
	for($i=0;$i<sizeof($chks);$i++)
	{
		$stid=$chks[$i];
		execute("DELETE FROM `staff_rights` WHERE `id`=$stid");
	}
	?>
	<SCRIPT LANGUAGE="JavaScript">
	alert("Deleted Successfully");
	</script>
	<?php

}

if(!$_POST and !$_REQUEST)
{
	$course=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
	
}
elseif($_REQUEST['course'])
{
	$flag=$_REQUEST['flag'];
	$id=$_REQUEST['id'];
	$userid=$_REQUEST['userid'];
	$course=$_REQUEST['course'];
	$subject_type=$_REQUEST['subject_type'];
	$section=$_REQUEST['section'];
	$batch_type=$_REQUEST['batch_type'];
	$sem=$_REQUEST['sem'];
	$StaffName=$_REQUEST['StaffName'];
	$check_id=$_REQUEST['check_id'];
	$username=$_REQUEST['username'];
}
else
{
	$course=$_POST['course'];
	$sem=$_POST['sem'];
	$username=$_POST['username'];
	$flag=$_POST['flag'];
	$id=$_POST['id'];
	$userid=$_POST['userid'];
	$subject_type=$_POST['subject_type'];
	$section=$_POST['section'];
	$batch_type=$_POST['batch_type'];
}
	if($flag=='')
	{
		$flag=1;
	}
	if($_POST['addsubjects'])
	{
		$flag=0;
		while( list(,$Value) = each($id) )
		{

			$ID=explode("-",$Value);
			$CourseId=$ID[0];
			$SubjectId=$ID[1];
			$YearId=$ID[2];
			$SubjectType=$ID[3];
			$StaffId=$userid;
			$class_section=$ID[4];
					
			
				$sql="insert into temp_staff_rights(staff_id,subject_id,course_id,year_id,subject_type,class_section_id,batch_id) ";
				$sql.=" values($StaffId,$SubjectId,$CourseId,$YearId,$SubjectType,$class_section,$batch_type)";
				execute($sql) or die(mysql_error()."error1");
			
		}
		?>
	<SCRIPT LANGUAGE="JavaScript">
	alert("Updated successfully");
	</script>
	<?php
	
	}

?>
</head>
<body class='bodyline'>
<form method="post" name="MyFrm">
<input type="hidden" name="flag" value="<?=$flag?>">
<input type="hidden" name="userid" value="<?=$userid?>">
<table align='center' class='forumline' border="1" width="70%" >
<tr>
  <td colspan=2 align='center' class='head'>Add Subject Rights </td></tr>
<tr><td>&nbsp;&nbsp;User</td><td>
    <select name="username" onChange="RefreshMe(0)">
      <option value=''>-- Select --</option>
      <?php

	$sql="SELECT a.username, b.f_name, b.s_name FROM users a, staff_det b WHERE a.Activated='On' and a.username!='administrator' and b.slno=a.S_ID order by a.username";
	$rs=execute($sql) or die(error_description());
	for($i=0;$i<rowcount($rs);$i++)
	{
		$r=fetcharray($rs);
		if($username==$r[username])
		{
			?>
      <option value="<?=$r['username']?>" selected><?php echo $r['f_name']." ".$r['s_name']; ?></option>
      <?php
		}
		else
		{
			?>
      <option value="<?php echo $r[username] ?>">
        <?php echo $r['f_name']." ".$r['s_name']; ?>
        </option>
      <?php
		}
	}

?>
    </select></td>
</tr>

<?php
$query = "SELECT a.id,b.id as stfid FROM users a,staff_det b WHERE a.Activated='On' AND a.Person<>'Student' AND a.username LIKE '$username' and a.S_ID=b.slno ";
$query1=execute($query);
$muzzu=fetcharray($query1);
$fid=$muzzu[stfid];
?>
<tr><td nowrap>&nbsp;&nbsp;<? echo $_SESSION['branchname']; ?>
</td><td><select name="course" onChange="RefreshMe(0)">
<option value='-1'>-- Select --</option>
<?php

	$sql="select course_id,coursename from course_m";
	$rs=execute($sql) or die(error_description());
	for($i=0;$i<rowcount($rs);$i++)
	{
		$r=fetcharray($rs);
		if($course==$r[course_id])
		{
			?>
				<option value="<?=$r[course_id]?>" selected><?php echo $r[coursename] ?></option>
			<?php
		}
		else
		{
			?>
				<option value="<?php echo $r[course_id] ?>"><?=$r[coursename]?></option>
			<?php
		}
	}

?>
</select></td></tr>
<tr>
      <td nowrap>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?>
      </td>
      <td><select name="sem" onChange="RefreshMe(0)">
<option value="">----- Select -----</option>
<?php
				$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$course'");
				while($r=fetcharray($rs))
				{
					if($sem==$r[year_id])
					{
						echo "<option value='$r[year_id]' selected> $r[year_name]</option>";
					}
					else
					{
						echo "<option value='$r[year_id]'> $r[year_name]</option>";
					}
				}
			?>
</select>
</td>
</tr>

<tr>
	<td>&nbsp;&nbsp;Section</td><td><select name="section" onChange="RefreshMe(0)">
<?
$rs_section=execute("select * from class_section");
echo "<option value=''>--Select--</option>";

for($i=0;$i<rowcount($rs_section);$i++)
{
	$r_section=fetcharray($rs_section,$i);
	if($section==$r_section[id])
	echo "<option value='$r_section[id]' selected>$r_section[section_name]</option>";
	else
	echo "<option value='$r_section[id]'>$r_section[section_name]</option>";

}
?>
</select>
</td>
</tr>
<tr>
	<td>&nbsp;&nbsp;Subject Type</td><td nowrap><select name="subject_type" onChange="RefreshMe(0)">
	<option value="0">----- Select ------</option>
<?php
	$sql1=execute("select * from subjecttype") or die(mysql_error());
	for($j=0;$j<rowcount($sql1);$j++)
	{
		$r1=fetcharray($sql1,$j);
		if($r1[subtype_id]==$subject_type)
		{
			echo "<option value=$r1[subtype_id] selected>$r1[subtype_name]</option>";
		}
		else
		{
			echo "<option value=$r1[subtype_id]>$r1[subtype_name]</option>";
		}
	}
?>
</select>
<?php
if($userid=='')
{
	$userid=$muzzu[id];
	echo "<input type=hidden name=userid value=$userid>";
}

	echo "<input type='hidden' name='batch_type' value='0'>";
?>
</td>
</tr>
</table>
<br>
<?php
if(!$username)
die();
if($subject_type !=0)
{
?>
<table class='forumline' align='center'  width="70%">
<tr><td class='head' align='center'>Select</td><td class='head' align='center'>Subject</td><td class='head' align='center'>Subject Code</td></tr>
<?php
		$sql2="select * from subject_m  where course_year_id='$sem' and course_id='$course' and sub_type='$subject_type' and status=1";
	$rs2=execute($sql2) or die(mysql_error()."error3");	
	for($k=0;$k<rowcount($rs2);$k++)
	{
		$r2=fetcharray($rs2);

		if($r2[elective]=='Y')
		{
			$ele_remarsk="[Elective]";
		}
		else
		{
			$ele_remarsk="";
		}

		if($sem==1 || $sem==2)
		{
			$sql4="select * from staff_rights where staff_id='$userid'";
			$sql4.=" and subject_id='$r2[subject_id]' and year_id='$sem' and subject_type='$r2[sub_type]' and class_section_id='$section' and batch_id='$batch_type' ";
		}
		else
		{
			
				$query  = "SELECT S_ID FROM users WHERE username='$username' AND id='$userid'";
	$rs = execute($query) or die("QUERY $query " . error_description());
	$row = fetcharray($rs);
	$staff_id1 = $row["S_ID"];

			
			$sql4="select * from staff_rights where course_id='$course' and StaffID='$staff_id1'";
			 $sql4.=" and subject_id='$r2[subject_id]' and year_id='$sem' and subject_type='$r2[sub_type]' and class_section_id='$section' and batch_id='$batch_type'";
		}
		
		$rs4=execute($sql4) or die(mysql_error());
		if((rowcount($rs4)!=0))
			$checksel="checked";
		else
			$checksel="";
			
			$sqln="select * from subjecttype where subtype_id='$r2[sub_type]'";
			$rsn=execute($sqln);
			$rown=fetcharray($rsn);
			$subtype=$rown[1];

			$sqln="select * from course_year where year_id='$r2[course_year_id]'";
			$rsn=execute($sqln);
			$rown=fetcharray($rsn);
			$yearname=$rown[1];
			if($k%2)
				echo "<tr> ";
				else
				echo "<tr class='clsname'> ";
				
			if($sem==1 || $sem==2)
			{				
				echo "<td align='center'><input type=checkbox name=check_id[] value='$cid-$r2[subject_id]-$r2[course_year_id]-$r2[sub_type]-$section-$batch_type-$r2[cycle]' $checksel></td>";
				echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;$r2[subject_name]$ele_remarsk</td>";
				echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;$r2[subject_code]</td>";
			}
			else
			{				
				echo "<td align='center'><input type=checkbox name=check_id[] value='$r2[course_id]-$r2[subject_id]-$r2[course_year_id]-$r2[sub_type]-$section-$batch_type' $checksel></td>";
				echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;$r2[subject_name]$ele_remarsk</td>";
				echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;$r2[subject_code]</td>";
			 }
	}
	/*$sql2="select * from major m where m.course_year_id='$sem' and sub_type='$subject_type' and m.status=1";
	$rs2=execute($sql2) or die(mysql_error()."$sql2");

	for($k=0;$k<rowcount($rs2);$k++)
	{
		$r2=fetcharray($rs2,$k);
		if($r2[elective]=='Y')
		{
			$ele_remarsk="[Elective]";
		}
		else
		{
			$ele_remarsk="";
		}
		$sql3="select * from temp_staff_rights where staff_id='$userid' ";
		$sql3.=" and subject_id='$r2[id]' and year_id='$sem' and subject_type='$r2[sub_type]' and class_section_id='$section'";
		$rs3=execute($sql3) or die(mysql_error()."error4");
		$sql4="select * from staff_rights where staff_id='$userid' ";
		$sql4.=" and subject_id='$r2[id]' and year_id='$sem' and subject_type='$r2[sub_type]' and class_section_id='$section' and batch_id='$batch_type' and maj_id='$r2[major_id]'";
		$rs4=execute($sql4) or die(mysql_error()."error4");
		if((rowcount($rs4)!=0))
			$checksel="checked";
		else
			$checksel="";
			$sqln="select * from subjecttype where subtype_id='$r2[sub_type]'";
			$rsn=execute($sqln);
			$rown=fetcharray($rsn);
			$subtype=$rown[1];
			echo "<tr><td><input type=checkbox name=check_id[] value='$course-$r2[id]-$r2[course_year_id]-$r2[sub_type]-$section-$batch_type-$r2[major_id]' $checksel></td>";
			echo "<td>$r2[subject_name]$ele_remarsk</td><td>$r2[subject_code]</td>";
}*/
?>
</table>
<br>

	<div align='center' >
	<input type="button" name="save" value="Save Rights" onClick="SaveDetails()" class='bgbutton'>
	<input type="hidden" name="StaffName" value="<?=$username?>">
	</div>
    <br>
  
<?php
}
?>  
    <table class='forumline' align='center' width="70%" border="1">
<tr>
  <td colspan=5 class='head' align='center'>Subject Rights</td></tr>
<tr>
<td align="center" class="row2">Check</td>
<td align="center" class="row2"><? echo $_SESSION['branchname']; ?></td>
<td align="center" class="row2"><? echo $_SESSION['semname']; ?></td>
<td align="center" class="row2">Section</td>
<td align="center" class="row2">Subject</td></tr>
<?php 
$usernameiddet=fetchrow(execute("select S_ID from users where username='$username'"));
$ds=execute("select * from staff_rights where StaffID='$usernameiddet[0]' order by year_id");
$dscnt=rowcount($ds);
for($t=1;$t<=$dscnt;$t++)
{
	if($t%2)
	echo "<tr class='clsname'> ";
	else
	echo "<tr> ";
	$dss=fetcharray($ds);
	?>
	<td align="center"><input type='checkbox' name='chks[]' value='<?php echo $dss[id]?>'></td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;<?php
	$ss1=execute("select coursename from course_m where course_id='$dss[course_id]'");
	$ss1ft=fetcharray($ss1);
	echo $ss1ft[coursename];?></td>
	<td align="center">&nbsp;&nbsp;<?php 
	$ss2=execute("select year_name from course_year where year_id='$dss[year_id]'");
	$ss2ft=fetcharray($ss2);	
	echo $ss2ft[year_name]?></td>
	<td align="center">&nbsp;&nbsp;<?php 
	$ss2=execute("select section_name from class_section where id='$dss[class_section_id]'");
	$ss2ft=fetcharray($ss2);	
	echo $ss2ft[section_name]?></td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;<?php 
	$ss2=execute("select subject_name from subject_m where subject_id='$dss[subject_id]'");
	$ss2ft=fetcharray($ss2);	
	echo $ss2ft[subject_name];?></td></tr>
	<?php 
}
?></table>
<br><div align='center'><input type='submit' name='del' value='&nbsp;&nbsp;Delete&nbsp;&nbsp;' class='bgbutton'></div>

    
    </form></body></html>
