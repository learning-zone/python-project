<html>
<head><title>Add Rights to Staff</title>
<Script language="JavaScript">
	function SaveDetails()
	{
		document.MyFrm.action="DeleteRightsofStaff.php";
		document.MyFrm.submit();
	}

	function RefreshMe(val)
	{
		document.MyFrm.flag.value=val;
		document.MyFrm.action="DeleteRightsofStaff.php";
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
		var x = window.open("usersearch3.php?username="+a,"user1","width=500,height=500,status=no,toolbar=no,scrollbar=no,menubar=no,sizeable=0");
	}
</script>

<?php
	session_start();
	include("../db.php");
if(!$_POST and !$_REQUEST)
{
	$course=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
	
}
else
{	
	$course = $_POST['course'];
	$sem = $_POST['sem'];
	$username = $_POST['username'];
	$section = $_POST['section'];
	$subject_type = $_POST['subject_type'];
	$batch_type = $_POST['batch_type'];
	$check_id = $_POST['check_id'];
	$deleterights = $_POST['deleterights'];
}
//$batch_type='0';
	if(isset($deleterights))
	{

	$flag=0;
	if($check_id)
	{
		while( list(,$Value) = each($check_id) )
		{
		$MyID=$Value;

		execute("delete from staff_rights where id=$MyID") or die(error_description()."error1");
		//echo "delete from staff_rights where id=$MyID";
		}
		}
		else
		{
			echo "Please select all the details properly or there are no rights to delete";
			die();
		}
	}

?>
</head>
<body class='bodyline'>
<form method="post" name="MyFrm">
<input type="hidden" name="flag" value="<?=$flag?>">
<input type="HIDDEN" name="userid" value="<?=$userid;?>">
<table align='center' class='forumline' width="50%" >

<!--Modified by Muzammil Ahmed A on 21-June-2005
    The heading spelling was incorrect it has been rectified--> 

<tr><td colspan=2 align='center' class='head'>Delete Rights to Marks/Attendance</td></tr>
<tr><td width="50%">&nbsp;&nbsp;User</td>
<!-- <td><INPUT TYPE="TEXT" NAME="username" value="<? //=$username;?>" SIZE="15">&nbsp;&nbsp;
<INPUT TYPE="BUTTON" NAME="search" VALUE="SEARCH" CLASS="bgbutton" onClick="return win_open()"></td>
!-->
<TD WIDTH=45% ALIGN=LEFT>
<?php
//echo "<td align='left' >User Name</td>";


		$query = "SELECT username FROM users WHERE Activated='On'  ORDER BY username";
$rs = execute($query) or die("QUERY $query " . error_description());
       echo " <select name='username' onChange='RefreshMe(0)'>";
	   echo "<OPTION VALUE='0'>------------ Select ------------</OPTION>";
	   while($trow=fetcharray($rs))
	   {
		 //echo "<option value='$trow[0]'>$trow[0]</option>";
		 if($username==$trow[username])
		 {
			 echo "<option value='$trow[username]' selected>$trow[username]</option>";
		 }
		 else
		 {
			 echo "<option value='$trow[username]'>$trow[username]</option>";
			 }
		}
		
	echo "</select></TD>";
	?>

</tr>

<?php
//$query = "SELECT a.id,b.id as stfid FROM users a,staff_det b WHERE a.Activated='On' AND a.Person<>'Student' AND a.username LIKE '$user' and a.S_ID=b.slno ";
$query = "SELECT a.id,b.id as stfid FROM users a,staff_det b WHERE a.Activated='On' AND a.Person<>'Student' AND a.username LIKE '$username' and a.S_ID=b.slno ";
//echo $query;
$query1=execute($query);
$muzzu=fetcharray($query1);
$fid=$muzzu[stfid];
?>
<tr>
      <td>&nbsp;&nbsp;<?php
      echo $_SESSION['branchname'];
	  ?>
      </td>
	  
      <td><select name="course" onChange="RefreshMe(0)">
<option value='-1'>------------ Select ------------</option>
<?php
//if($user!='administrator')
if($username!='administrator')
{
	$chhod=execute("select courseid from app_hod where fid='$fid' order by courseid");
	for($j=0;$j<rowcount($chhod);$j++)
	{
		$r1=fetcharray($chhod);
		if($r1[courseid]=='0')
			echo "<option value='0' $s>-- First Year --</option>";
		else
		{
			$sch=fetcharray(execute("select coursename from course_m where course_id='$r1[courseid]' "));
			if($r1[courseid]==$course)
			{
				echo "<option value=$r1[courseid] selected>$sch[0]</option>";
			}
			else
			{
				echo "<option value=$r1[courseid]>$sch[0]</option>";
			}
		}
	}
}
else
{
	$sql1=execute("select * from course_m ") or die(mysql_error());
	for($j=0;$j<rowcount($sql1);$j++)
	{
		$r1=fetcharray($sql1,$j);

		if($r1[course_id]==$course)
		{
			echo "<option value=$r1[course_id] selected>$r1[coursename]</option>";
		}
		else
		{
			echo "<option value=$r1[course_id]>$r1[coursename]</option>";
		}
	}
}
?>
</select></td></tr>
<tr>
      <td>&nbsp;&nbsp;<?php
	  echo $_SESSION['semname'];
	  ?>
      </td>
      <td><select name="sem" onChange="RefreshMe(0)">
<option value="">------------ Select ------------</option>
<?php
	
	/*if($course!='-1' && $course!='')
	{		
		if($course=='0')
		{
			$sql11=execute("select * from course_year where year_id <3 ") or die(mysql_error());
		}
		else
		{
			$sql11=execute("select * from course_year  where year_id>2  ") or die(mysql_error());
		}
	}*/
	
	$sql11=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$course'");

	//for($j=0;$j<rowcount($sql11);$j++)
	while($r1=fetcharray($sql11))
	{
		//$r1=fetcharray($sql11,$j);

		if($r1[year_id]==$sem)
		{
			echo "<option value='$r1[year_id]' selected>$r1[year_name]</option>";
		}
		else
		{
			echo "<option value='$r1[year_id]'>$r1[year_name]</option>";
		}
	}
?>
</select>
</td>
</tr>
<tr><td>&nbsp;&nbsp;Section</td><td><select name="section" onChange="RefreshMe(0)">
<option value="99">------------ Select ------------</option>
<?php
	$sql1=execute("SELECT * FROM student_m a,class_section b WHERE a.archive='N' and a.class_section_id=b.id and course_yearsem='$sem' group by b.id") or die(error_description());

	for($j=0;$j<rowcount($sql1);$j++)
	{
		$r1=fetcharray($sql1,$j);

		if($r1[id]==$section)
		{
			echo "<option value=$r1[id] selected>$r1[section_name]</option>";
		}
		else
		{
			echo "<option value=$r1[id]>$r1[section_name]</option>";
		}
	}
?>
</select></td></tr>

<tr><td>&nbsp;&nbsp;Subject Type</td><td><select name="subject_type" onChange="RefreshMe(0)">
<option value="0">------------ Select ------------</option>

<?php



	$sql1=execute("select * from subjecttype") or die(error_description());

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
<?
if($userid=='')
{
	$userid=$muzzu[id];
}

if($subject_type ==2)
{
		if($sem==1 || $sem==2)
			{
				$sql1="select distinct(a.id) as batch_id,batch_name from batch_master a,staff_rights b where b.course_id=0";
				$sql1.=" and b.year_id='$sem' and b.staff_id='$userid' and b.class_section_id='$section' and b.batch_id=a.id and b.subject_type='$subject_type'";
			}
		else
			{
				$sql1="select distinct(a.id) as batch_id,batch_name from batch_master a,staff_rights b where b.course_id='$course'";
				$sql1.="and b.year_id='$sem' and b.staff_id='$userid' and b.class_section_id='$section' and b.batch_id=a.id and b.subject_type='$subject_type'";
			}
			//echo $sql1;
	$rs1=execute($sql1) or die(mysql_error());
	echo "<select name='batch_type'  onChange='RefreshMe(0)'>";
	echo "<option value='0'>Select Batch</option>";
	for($j=0;$j<rowcount($rs1);$j++)
	{
		$r1=fetcharray($rs1,$j);
		if($r1[batch_id]==$batch_type)
		{
			echo "<option value=$r1[batch_id] selected>$r1[batch_name]</option>";
		}
		else
		{
			echo "<option value=$r1[batch_id]>$r1[batch_name]</option>";
		}
	}
	?>
	</select>
<?
}
else
{
	
	echo "<input type='hidden' name='batch_type' value='0'>";
	 $batch_type=0;
	 
}
?>

</td></tr></table>
<br>
<?php
if($subject_type !=0)
{

if($sem==1 || $sem==2)
{
$sql2="select * from staff_rights where course_id=0 and year_id='$sem' and staff_id='$userid' and class_section_id='$section' and batch_id='$batch_type' and subject_type='$subject_type' and maj_id=0";
}
else
{
$sql2="select * from staff_rights where course_id='$course' and year_id='$sem' and staff_id='$userid' and class_section_id='$section' and batch_id='$batch_type' and subject_type='$subject_type'";
}
$rs2=execute($sql2) or die(error_description()."error3");
	?>
    <table class=forumline align=center width="50%">
	<tr>
    <td align="center" class="head">Select</td>
    <td align="center" class="head">Subject</td>
    <td align="center" class="head">Subject Code</td>
    </tr>
	<?php
	for($k=0;$k<rowcount($rs2);$k++)
	{
		if($k%2)
		echo "<tr> ";
		else
		echo "<tr  class='clsname'> ";
		$r2=fetcharray($rs2,$k);
		$autoid=$r2[0];
		$yid=$r2[year_id];
				$sid=$r2[subject_id];
				if($sem==1 || $sem==2)
					$sql4="select * from common_m m where m.course_year_id='$r2[year_id]' and subject_id='$r2[subject_id]'";
				else
					$sql4="select * from subject_m m where m.course_year_id='$r2[year_id]' and m.course_id='$r2[course_id]' and subject_id='$r2[subject_id]'";
				$rs4=execute($sql4) or die($sql4."error33");
				$r4=fetcharray($rs4);
				if($r4[elective]=='Y')
				{
					$ele_remarsk="[Elective]";
				}
				else
				{
					$ele_remarsk="";
				}


			$sqln="select * from subjecttype where subtype_id='$r2[subject_type]'";
			$rsn=execute($sqln);
			$rown=fetcharray($rsn);
			$subtype=$rown[1];

			echo "<td align='center'><input type=checkbox name=check_id[] value='$autoid'></td>";
			echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;$r4[subject_name]$ele_remarsk</td>";
			echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;$r4[subject_code]</td>";

	}

}
//majors
if($subject_type !=0)
{
	if($sem==1 || $sem==2)
	{
		$sql2="select * from staff_rights where course_id=0 and year_id='$sem' and staff_id='$userid' and class_section_id=$section and batch_id=$batch_type and subject_type='$subject_type' and maj_id!= 0";
		$rs2=execute($sql2) or die(error_description()."error3");

	for($k=0;$k<rowcount($rs2);$k++)
	{
		$r2=fetcharray($rs2,$k);
		$autoid=$r2[0];
		if($sem==1 || $sem==2)
			$sql4="select * from subject_m where course_year_id='$r2[year_id]' and subject_id='$r2[subject_id]'";
			//echo $sql4;
				$rs4=execute($sql4) or die($sql4."error33");
				$r4=fetcharray($rs4);
				if($r4[elective]=='Y')
				{
					$ele_remarsk="[Elective]";
				}
				else
				{
					$ele_remarsk="";
				}
			echo "<tr><td align='center'><input type=checkbox name=check_id[] value='$autoid'></td>";
			echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;$r4[subject_name]$ele_remarsk</td>";
			echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;$r4[subject_code]</td>";
	}
}
echo "</table><br>";
echo "<div align='center'><input type='submit' name='deleterights' value='Delete Rights' class='bgbutton' onclick='validate()'></div>";

}
?>
</form>
</body>
</html>