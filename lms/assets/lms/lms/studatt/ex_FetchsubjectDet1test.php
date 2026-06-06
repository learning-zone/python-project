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

//day wise attendance
$daywise=fetcharray(execute("select shortname from users where username='$user'"));

if($daywise[0]=='admin')
{
$dayattnce=execute("select a.class,a.section,a.sub,a.sub_type from all_teachers a,class_section b where a.sub_type=2 and a.section=b.id and b.status=1 group by a.sub,a.section order by a.class");
}
else
{
$dayattnce=execute("select a.class,a.section,a.sub,a.sub_type from all_teachers a,users b,class_section c where  b.username='$user' and b.srid=a.home_teac and a.section=c.id and c.status=1  group by a.sub,a.section order by a.class");
}



//peroid wise attandance
$cheknam=fetcharray(execute("select shortname from users where username='$user'"));

if($cheknam[0]=='admin')
{
$sql21=execute("select grade,id,sub from class_section where status=1 group by sub,id order by grade,codename");
}
else
{
$sql21=execute("select a.class,a.section,a.sub,a.sub_type from all_teachers a,users b,class_section c where  b.username='$user'  and a.section=c.id and c.status=1 and b.srid IN ( sub_teac2, sub_teac, home_teac)  group by a.sub,a.section order by a.class,c.codename");
}
	if(rowcount($sql21)==0 && rowcount($dayattnce)==0)
	{
		echo die("You don't  have attendance rights"); 
	}

	?>
	<form name="frm" action="" method="post" >
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
	
	//day wise
	if(rowcount($dayattnce)!=0)
{
	$m=1;
	while($r45=fetcharray($dayattnce))
	{
		$sem1=$r45[0];
		
		$sql_idee=fetchrow(execute("select type from attendance where `acc_year`='$a_year' and `class_id`='$sem1' and status=1"));
			if($sql_idee[0]==1)
			{

		$sql_id=fetchrow(execute("select type from attendance where `acc_year`='$a_year' and `class_id`='$sem1' and status=1"));
			
		$sql=execute("select course_id,coursename from course_m where course_id='$branch1'");
		
		$yearname=fetchrow(execute("SELECT year_name FROM course_year where year_id='$sem1'"));
		
		$hedids=fetchrow(execute("SELECT head_id FROM course_year where year_id='$sem1'"));
		$branch1=$hedids[0];
		$class_section_id1=$r45[1];
		$rs_section=fetchrow(execute("select section_name,codename from class_section where id='$class_section_id1' and status=1"));
	
	?>
	<tr height="25">
		<td align="center" nowrap><?=$m?></td>
		<td align="center" nowrap><?=$yearname[0]?></td>
		<td align="center" nowrap><?=$rs_section[1]?>-<?=$rs_section[0]?></td>
		<td align="center" width="40%" nowrap>
        
        <a href="javascript:OpenWind2('addattendace.php?subname=DAILY&branch=<?=$branch1?>&sem=<?=$sem1?>&class_section_id=<?=$class_section_id1?>&subject=<?=$r45[2]?>&sess=s')"><input type="button" name="update" value="Modify Attendance"  class='bgbutton'></a>
        <?php
			}
			
		?>
        </td>
	</tr>
	<?php
	$m++;
	}
}
//end
	?>
    
    
    
	<?php
	//peroid
if(rowcount($sql21)!=0)
{

	$tt=1;
	while($r12=fetcharray($sql21))
	{
		$sem1=$r12[0];
		$sql_id=fetchrow(execute("select type from attendance where `acc_year`='$a_year' and `class_id`='$sem1' and status=1"));
			if($sql_id[0]==3)
			{
				
		$sql=execute("select course_id,coursename from course_m where course_id='$branch1'");
		
		$yearname=fetchrow(execute("SELECT year_name FROM course_year where year_id='$sem1'"));
		
		$hedids=fetchrow(execute("SELECT head_id FROM course_year where year_id='$sem1'"));
		$branch1=$hedids[0];
		$class_section_id1=$r12[1];
		$rs_section=fetchrow(execute("select section_name,codename from class_section where id='$class_section_id1' and status=1"));
	
	?>
	<tr height="25">
		<td align="center" nowrap><?=$tt?></td>
		<td align="center" nowrap><?=$yearname[0]?></td>
		<td align="center" nowrap><?=$rs_section[1]?>-<?=$rs_section[0]?></td>
		<td align="center" width="40%" nowrap>
        
        <a href="javascript:OpenWind2('addattendace.php?subname=DAILY&branch=<?=$branch1?>&sem=<?=$sem1?>&class_section_id=<?=$class_section_id1?>&subject=<?=$r12[2]?>&sess=s')"><input type="button" name="update" value="Modify Attendance"  class='bgbutton'></a>
        <?php
			}
			
		?>
        </td>
	</tr>
	<?php
	$tt++;
	}
}
//end
	?>
	</table>
</form>	
</body>
</html>
