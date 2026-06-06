<html>
<HEAD>
<SCRIPT LANGUAGE="JavaScript">
function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
function reload()
{
	document.frm.action='ex_FetchsubjectDet1.php';
	document.frm.submit();
	
}

</SCRIPT>
</HEAD>

<body>
<?php 
session_start();
require("../db.php");
$a_year=$_SESSION['AcademicYear'];
$user=$_SESSION['user'];
$rightss=1;
?>
	<form name="frm" action="" method="post" >
<?
$cheknam=fetcharray(execute("select shortname from users where username='$user'"));

if($cheknam[0]=='admin')
{
$sql21=execute("select grade,id,sub from class_section where status=1 group by sub,id order by grade,codename");
	?>
	<table width="80%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
	  <tr height="25">
		<td colspan="4" align="center" class="head">DAILY ATTENDANCE</td>
	  </tr>
	<tr height="25">
		<td align="center" class="row3" nowrap>Sl.No</td>
		<td align="center" class="row3" nowrap><?php echo $_SESSION['semname']; ?></td>
		<td align="center" class="row3" nowrap>Section</td>
		<td align="center" class="row3" nowrap>Action</td>
	</tr>
	<?php
	$i=1;
	while($r12=fetcharray($sql21))
	{
		$rightss=0;
		//$branch1=$r12[0];
		$sql=execute("select course_id,coursename from course_m where course_id='$branch1'");
		$sem1=$r12[0];
		$yearname=fetchrow(execute("SELECT year_name FROM course_year where year_id='$sem1'"));
		
		$hedids=fetchrow(execute("SELECT head_id FROM course_year where year_id='$sem1'"));
		$branch1=$hedids[0];
		$class_section_id1=$r12[1];
		$rs_section=fetchrow(execute("select section_name,codename from class_section where id='$class_section_id1' and status=1"));
	
	?>
	<tr height="25">
		<td align="center" nowrap><?=$i?></td>
		<td align="center" nowrap><?=$yearname[0]?></td>
		<td align="center" nowrap><?=$rs_section[1]?>-<?=$rs_section[0]?></td>
		<td align="center" width="40%" nowrap>
        <?php
		$sql_id=fetchrow(execute("select type from attendance where `acc_year`='$a_year' and `class_id`='$sem1' and status=1"));
			//if($sql_id[0]==1)
			//{
		?>
        
        <a href="javascript:OpenWind2('addattendace.php?subname=DAILY&branch=<?=$branch1?>&sem=<?=$sem1?>&class_section_id=<?=$class_section_id1?>&subject=<?=$r12[2]?>&sess=s')"><input type="button" name="update" value="Modify Attendance"  class='bgbutton'></a>
        <?php
			//}
			if($sql_id[0]==2)
			{
		?>
              <a href="javascript:OpenWind2('addattendace.php?subname=MORNING&branch=<?=$branch1?>&sem=<?=$sem1?>&class_section_id=<?=$class_section_id1?>&subject=0&sess=m')"><input type="button" name="update" value="Mor Attendance"  class='bgbutton'></a>
       <a href="javascript:OpenWind2('addattendace.php?subname=NOON&branch=<?=$branch1?>&sem=<?=$sem1?>&class_section_id=<?=$class_section_id1?>&subject=0&sess=n')"><input type="button" name="update" value="Noon Attendance"  class='bgbutton'></a>
 
        <?php
			}
		?>
        </td>
	</tr>
	<?php
	$i++;
	}
	?>
	</table>
		<br>
	<?php
}
else
	{
?>
<table width="80%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
	  <tr height="25">
		<td colspan="4" align="center" class="head">DAILY ATTENDANCE</td>
	  </tr>
	<tr height="25">
		<td align="center" class="row3" nowrap>Sl.No</td>
		<td align="center" class="row3" nowrap><?php echo $_SESSION['semname']; ?></td>
		<td align="center" class="row3" nowrap>Section</td>
		<td align="center" class="row3" nowrap>Action</td>
	</tr>		    
<?
$m=1;
$sql1=execute("select a.class,a.section,a.sub,a.sub_type from all_teachers a,users b,class_section c where  b.username='$user'  and a.section=c.id and c.status=1 and b.srid IN ( sub_teac2, sub_teac, home_teac)  group by a.sub,a.section order by a.class,c.codename");
		while($r2=fetcharray($sql1))
		{
			$rightss=0;
			$tmorets[]=$r2[1];
		}
		$sqnmars=execute("select c.id,c.codename,c.section_name from staff_class_group a,users b,class_section c,course_year d,subject_m e where b.username='$user'  and c.id=a.section and c.status=1 and a.status=1 and e.status=1 and c.sub=e.subject_id  and b.srid=a.staff_id order by a.grade, a.section");
   	
    while($sqnmars1=fetcharray($sqnmars))
    {
		$rightss=0;
        $tmorets[]=$sqnmars1[0];
    }
	$tmorets1=array_unique($tmorets);
	
	while (list(, $value) = each($tmorets1)) 
		{
		$j=$value;
			$sectname=fetchrow(execute("SELECT codename,section_name,id,grade,sub FROM `class_section` WHERE id='$j'"));
			
			//echo "<br>$sectname[0]-$sectname[1]-$sectname[2]";
		$semid=$sectname[3];
		$class_section_ids=$sectname[2];
		$yearnamesdis=fetchrow(execute("SELECT year_name FROM course_year where year_id='$semid'"));
		$headids=fetchrow(execute("SELECT head_id FROM course_year where year_id='$semid'"));
		$branchid=$headids[0];
	?>
	<tr height="25">
		<td align="center" nowrap><?=$m?></td>
		<td align="center" nowrap><?=$yearnamesdis[0]?></td>
		<td align="center" nowrap><?=$sectname[0]?>-<?=$sectname[1]?></td>
		<td align="center" width="40%" nowrap>
        <?php
		$sql_id=fetchrow(execute("select type from attendance where `acc_year`='$a_year' and `class_id`='$semid' and status=1"));
			//if($sql_id[0]==1)
			//{
		?>
        
        <a href="javascript:OpenWind2('addattendace.php?subname=DAILY&branch=<?=$branchid?>&sem=<?=$semid?>&class_section_id=<?=$class_section_ids?>&subject=<?=$sectname[4]?>&sess=s')"><input type="button" name="update" value="Modify Attendance"  class='bgbutton'></a>
     </td>
     </tr>
        <?php	
		$m++;								
		}
	}
	if($rightss)
	{
		echo die("You don't  have attendance rights"); 
	}
	?>
    
 </table>   			
</form>	
</body>
</html>
