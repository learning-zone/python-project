<?php
	session_start();
	include("../db.php");
	$clid=$_REQUEST['clid'];
	$secid=$_REQUEST['secid'];	
		$a_year=$_SESSION['AcademicYear'];

?>
<html>
<head>
</head>
<script language="JavaScript">
function prn()
{
	pr1.style.display = "none";
	window.print();
}
</script>
<body>
<form name="frm" method="post">
<table border=1 class=forumline cellpadding="0" cellspacing="0" align=center width='90%' >
<tr><td align='center' class='head' colspan='4'>Student List</td>
<?php
if($clid !='a')

	$sql1=execute("select year_id,year_name from course_year where year_id='$clid'");

else

{

	if($secid !='a')

		$sql1=execute("select distinct(a.course_yearsem),b.year_name from student_m a,course_year b where a.course_yearsem=b.year_id and a.class_section_id='$secid' order by a.course_yearsem ");

	else

		$sql1=execute("select distinct(a.course_yearsem),b.year_name from student_m a,course_year b where a.course_yearsem=b.year_id order by a.course_yearsem ");

}



while($r1=fetcharray($sql1))

{

	if($secid !='a')

		$sql2=execute("select id,section_name from class_section where id='$secid'");

	else

		$sql2=execute("select distinct(a.class_section_id) , b.section_name from student_m a, class_section b where a.course_yearsem='$r1[0]' and a.class_section_id=b.id order by a.class_section_id");



	while($r2=fetcharray($sql2))

	{

		echo "<tr height='30'><td class='rowpic' colspan='4'>&nbsp;&nbsp;&nbsp;Class : $r1[1]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Section : $r2[1]</td></tr>";

		echo "<tr><td align='center' colspan='2'><b>Male</b></td><td align='center' colspan='2'><b>Female</b></td></tr></tr>";

		for($z=1;$z<3;$z++)
		{
			if($z==1)
			{
				$sql="select student_id,first_name,last_name,course_yearsem,class_section_id , id from student_m where id is not null and archive='N'";

				$sql.=" and course_yearsem='$r1[0]' and class_section_id='$r2[0]' and gender!='F'  and academic_year='$a_year' order by first_name";
			}
			else
			{	
				$sql="select student_id,first_name,last_name,course_yearsem,class_section_id , id from student_m where id is not null and archive='N'";

				$sql.=" and course_yearsem='$r1[0]' and class_section_id='$r2[0]' and gender='F'  and academic_year='$a_year' order by first_name";

			}
			
			$rs=execute($sql);

			?>

			<td valign='top' colspan='2'><table border=1 class=forumline cellpadding="0" cellspacing="0" align=center  width='100%'>

			<tr height='25'><td align="center" Class="rowpic">Sl.No</td><td align="center"  Class="rowpic">Student ID</td>

			<td align="center"  Class="rowpic">Student Name</td>

            <td align="center"  Class="rowpic">Status</td>

            

			<?php



			$hedid=fetcharray(execute("SELECT head_id FROM course_year where year_id='$r1[0]'"));

			$attandanceTablename="att_$r1[0]";

			$ststemdate=date("Y-m-d");
			//$ststemdate='2013-08-22';
			$rowclass=1;

			for($i=0;$i<rowcount($rs);$i++)

			{

				$morningp[0]='';

				$noonngp[0]='';

				$r=fetcharray($rs);



$morningp=fetcharray(execute("SELECT mor FROM $attandanceTablename where att_date='$ststemdate'  and sec='$r2[0]' and stu_id='$r[id]'"));

$noonngp=fetcharray(execute("SELECT after FROM $attandanceTablename where att_date='$ststemdate'  and sec='$r2[0]' and stu_id='$r[id]'"));

$attst=mysql_fetch_row(mysql_query("SELECT Short_name FROM `attendance_points` where order_id='$morningp[0]' "));

				?>

				<tr class='row<?php echo $rowclass ?>' height='25'>

				<td align="center" ><?=$i+1?></td>

				<td align="center" ><?=$r[student_id]?></td>

				<td nowrap>&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?=$r[last_name]?></td>

                <td align="center"  ><?=$attst[0]?></td>

            	</tr>

				<?php
				$attst[0]='--';
				$morningp[0]='';
				$rowclass = 1 - $rowclass;

			}

			echo "</table></td>";

		}

		echo "</tr><tr><td colspan='4'>&nbsp;</td></tr>";

	}

}

?>

</table><br>

<div id=pr1 align=center><INPUT TYPE="SUBMIT" class=bgbutton NAME="print" VALUE="PRINT " onclick='prn()'>

</div>

</form>

</body>

</html>

