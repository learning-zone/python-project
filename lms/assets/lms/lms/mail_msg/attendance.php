<html>
<HEAD>
<SCRIPT LANGUAGE="JavaScript">
function reload()
{
	document.frm.action='attendance.php';
	document.frm.submit();
	
}

</SCRIPT>
</HEAD>
<body>
<?php 
session_start();
require("../db.php");
include("mail_class.php");
$academic_year=$_SESSION['AcademicYear'];
if(!$_REQUEST)
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
	
}
else
{
	$branch=$_REQUEST['branch'];
	$sem=$_REQUEST['sem'];
	$examname=$_REQUEST['examname'];
	$class_section_id=$_REQUEST['class_section_id'];
	$sess=$_REQUEST['sess'];
	$msgidnumaber=$_REQUEST['msgidnumaber'];
	$msgidname=$_REQUEST['msgidname'];
}
	$tablename="att_".$sem;
	
	$sysdate=date("Y-m-d");

if($_POST['open'])
{
	$sysdate1=date("d-m-Y");
	$check=$_POST['check'];
	$studentid=$_POST['studentid'];
	$msgidname=$_POST['msgidname'];
	$tt=0;
	$flag=1;
	for($i=0;$i<sizeof($studentid);$i++)
	{
		$sql5=execute(" select id from $tablename where att_date='$sysdate' and stu_id='$studentid[$i]' and mor='0' group by stu_id");
		if(rowcount($sql5)>0)
		{
				$mobilenumbers=$msgidnumaber[$i];
				$message="Dear Parent, your ward $msgidname[$i] is absent today $sysdate1";
				$studentid1=$studentid[$i];
				send_msg($mobilenumbers,$message,$studentid1,$sem);
				
				$flag=0;
				$tt++;
		}	
		
	}
	$sql6=execute("select count(mor) from $tablename where att_date='$sysdate' and sec='$class_section_id' ");
	if(rowcount($sql6)>0)
	{	
		$flag=0;
	}
	if($flag==1)
	{
		?>
		<SCRIPT LANGUAGE="JavaScript">
		alert("Attendance not taken");
		</SCRIPT>
		<?php
	}
	else
	{
		?>
		<SCRIPT LANGUAGE="JavaScript">
		alert("Attendance Msg Sent Succesfully");
		</SCRIPT>
		<?php
	}
	
}
	

?>		<form name="frm" action="" method="post" >
<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td  colspan="2" align="center" class="head" nowrap>SEND ATTENDANCE TO PARENTS</td>
    </tr>
     
  <tr>
    <td nowrap>&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>
		<td>&nbsp;<select name="branch" onChange="reload()">
			<option value="0">------Select-----</option>
				<?php
					$sql="select course_id,coursename from course_m";
					$rs=execute($sql) or die(error_description());
					for($i=0;$i<rowcount($rs);$i++)
					{
					  $r=fetcharray($rs);

						if($branch==$r[course_id])
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
			</select>
			</td>
		
  </tr>
  <tr>
   <td>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>
		<td>&nbsp;<select name="sem" onChange="reload()">
			<option value='0'>-----Select----</option>
			<?php
				$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");
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
  <td height="28">&nbsp;&nbsp;Section </td>
  <td>&nbsp;<select name='class_section_id'  onChange="reload()">
  		<option value=''>-----Select----</option>

<?
$rs_section=execute("select * from class_section");

for($i=0;$i<rowcount($rs_section);$i++)
{
	$r_section=fetcharray($rs_section,$i);
	if($class_section_id==$r_section[id])
	echo "<option value='$r_section[id]' selected>$r_section[section_name]</option>";
	else
	echo "<option value='$r_section[id]'>$r_section[section_name]</option>";

}
?>
</select>

</td>
  </tr>
 
</table>
<?php
 if($branch=='0')
	die();
	if($sem=='0')
	die();
	
   $sql123.="select id, first_name, msgphone,last_name from student_m where id is not null and archive='N' and academic_year='$academic_year' ";
	if($branch!=0)
	{
	$sql123.=" and course_admitted=$branch";
	}
	if($sem!=0)
	{
	$sql123.=" and course_yearsem=$sem";
	}
	if($class_section_id!='')
	{
	$sql123.=" and class_section_id=$class_section_id  ";
	}
	
	$sql123.=" order by first_name";

$sq1=execute($sql123);
if(rowcount($sq1)==0)
{
?>
		<SCRIPT LANGUAGE="JavaScript">
		alert("Student record not found ");
		</SCRIPT>
<?php
die();

}
	$flag==0;
	$sql6=execute("select count(mor) from $tablename where att_date='$sysdate' ");
	$stcount=fetchrow($sql6);
	if($stcount[0]>0)
	{	
		$flag=1;
	}
	if($flag==0)
	{
		?>
		<SCRIPT LANGUAGE="JavaScript">
		alert("attendance not taken");
		</SCRIPT>
		<?php
		die();
	}
$fl=0;
while($r5=fetcharray($sq1))
{

	echo "
	<input type='hidden' name='studentid[]' value='$r5[0]' >
	<input type='hidden' name='msgidname[]' value='$r5[1] $r5[3]' >
	<input type='hidden' name='msgidnumaber[]' value='$r5[2]'>";
	$sql5=execute(" select id from $tablename where att_date='$sysdate' and stu_id='$r5[0]' and mor='0'");
		if(rowcount($sql5)>0)
		{
			$fl=1;
		}
}	
if($fl==0)
{
	?>
	<SCRIPT LANGUAGE="JavaScript">
	alert("All the students present today");
	</SCRIPT>
	<?php
	die();
}	

?>
<br>
<div align="center"><input type="submit" class="bgbutton" name="open" value="SEND" ></div><br>
</form>	
</body>
</html>
