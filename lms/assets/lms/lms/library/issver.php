<?php
include_once("../db.php");
$accno=$_POST['accno'];
?>
<html>
<head>
<script language='javascript'>
function focus()
{
	document.frm.accno.focus();
}
function reload()
{
	document.frm.action='issver.php'
	document.frm.submit();
}
</script>
</head>
<body onload='focus()'>
<form name='frm' method='post'>
<table border='0' align='center' class='forumline' width='47%'>
<tr><td class='head' colspan='2' align='center'>Media Details</td></tr>
<tr><td align="right">Accession Number &nbsp;</td>
<td><input type="text" name="accno" value="<?php echo $accno; ?>" onChange="reload()"></td></tr>
<?php
if($accno!="")
{
	$rs=execute("select * from lib_acc_details where acc_no='$accno'");
	if(rowcount($rs)>0)
	{
		$r=fetcharray($rs);
		if($r[flag]==1)
		{
			$r1=fetcharray(execute("select * from lib_book_details where id='$r[master_id]'"));
			$r2=fetcharray(execute("select name from library_name where id='$r[library]'"));
			$r3=fetcharray(execute("select name from lib_mediatype where id='$r[media_type]'"));
			$r4=fetcharray(execute("select a.s_id,a.type,b.issue_date,b.due_date,b.cno from lib_membership_m a,lib_circulation_m b where b.acc_id='$accno' and b.status=0 and a.m_no=b.cno "));
			if($r4[type]==1)
			{
				$mname="Student";
				$r5=fetcharray(execute("select first_name,last_name,course_admitted,course_yearsem,class_section_id from student_m where id='$r4[s_id]'"));
				$r6=fetcharray(execute("select coursename from course_m where course_id='$r5[course_admitted]'"));
				$r7=fetcharray(execute("select year_name from course_year where year_id='$r5[course_yearsem]'"));
				if($r5[class_section_id]==0)
					$secname="No Section";
				else
				{
					$r8=fetcharray(execute("select section_name from class_section where id='$r5[class_section_id]'"));
					$secname=$r8[0]."Section";
				}
			}
			else
			{
				$mname="Staff";
				$r5=fetcharray(execute("select f_name,s_name,subj from staff_det where id='$r4[s_id]'"));
				$r6=fetcharray(execute("select Dept from dept_no where dpt_id='$r5[subj]'"));
			}
			echo "<tr><td>&nbsp;&nbsp;Title</td><td>&nbsp;&nbsp;$r1[title]</td></tr>";
			echo "<tr><td>&nbsp;&nbsp;Author</td><td>&nbsp;&nbsp;$r1[author]</td></tr>";
			echo "<tr><td>&nbsp;&nbsp;Publisher</td><td>&nbsp;&nbsp;$r1[publisher]</td></tr>";
			echo "<tr><td>&nbsp;&nbsp;Call No</td><td>&nbsp;&nbsp;$r[call_no]</td></tr>";
			echo "<tr><td>&nbsp;&nbsp;Libray</td><td>&nbsp;&nbsp;$r2[0]</td></tr>";
			echo "<tr><td>&nbsp;&nbsp;Media Type</td><td>&nbsp;&nbsp;$r3[0]</td></tr>";
			echo "<tr><td class='head' colspan='2' align='center'>Member Details</td></tr>";
			echo "<tr><td>&nbsp;&nbsp;Member No</td><td>&nbsp;&nbsp;$r4[cno]</td></tr>";
			echo "<tr><td>&nbsp;&nbsp;Member Name</td><td>&nbsp;&nbsp;$r5[0] $r5[1]</td></tr>";
			echo "<tr><td>&nbsp;&nbsp;Member Type</td><td>&nbsp;&nbsp;$mname</td></tr>";
			echo "<tr><td>&nbsp;&nbsp;Department/Course Details</td><td>&nbsp;&nbsp;";
			if($r4[type]==1)
				echo $r6[0]." - ".$r7[0]." - ".$secname;
			else
				echo $r6[0];
			echo "</td></tr>";
			$idt=explode("-",$r4[issue_date]);
			$ddt=explode("-",$r4[due_date]);
			echo "<tr><td>&nbsp;&nbsp;Issue Date</td><td>&nbsp;&nbsp;$idt[2]-$idt[1]-$idt[0]</td></tr>";
			echo "<tr><td>&nbsp;&nbsp;Due Date</td><td>&nbsp;&nbsp;$ddt[2]-$ddt[1]-$ddt[0]</td></tr>";
		}
		else
		{
			echo "<div>Media not issued to any member ..</div>";
		}
	}
	else
	{
		echo "<div>Entered accession number does not exits ..</div>";
	}
}
?>
</form>
</body>
</html>