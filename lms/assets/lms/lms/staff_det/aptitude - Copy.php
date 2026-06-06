<html>
<HEAD>
<SCRIPT LANGUAGE="JavaScript">
function OpenWind2(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left)
}
function OpenWind5(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left)
}
function reload()
{
	document.frm.action='aptitude.php';
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
	//echo "select a.course_id, a.subject_id, a.year_id, a.subject_type, a.class_section_id from staff_rights a,users b where b.username='$user' and a.StaffID =b.S_ID";
	$sql=mysql_query("select a.course_id, a.subject_id, a.year_id, a.subject_type, a.class_section_id from staff_rights a,users b where b.username='$user' and a.StaffID =b.S_ID");
if(mysql_num_rows($sql)!=0)
{	
	?>
    <br>    
        <table align='center' cellpadding="5" class='forumline' width='90%' border="1" >
    <tr height="10"><td colspan='8' align='center' class='head'>Grade  </td></tr>
    <tr >
        <td align="center" class="row3" width="5%" nowrap>Sl No.</td>
        <td align="center" class="row3" nowrap>Subject</td>
        <td align="center" class="row3" nowrap>Subject type</td>
        <td align="center" class="row3" nowrap><?php echo $_SESSION['semname']; ?></td>
        <td align="center" class="row3" nowrap>Section</td>
        <td align="center" class="row3" width="10%"  nowrap>Term</td>
        <td align="center" class="row3" width="10%"  nowrap>Action</td>
        <td align="center" class="row3"  width="10%"  nowrap>View</td>
    </tr>
	<?php
    $k=1;
    while($r=mysql_fetch_array($sql))
    {
		$branch=$r['course_id'];
		$sem=$r['year_id'];
		$accyear=$_SESSION['AcademicYear'];
		//echo "select id, descr, sub_id  from exam_m where accyear='$accyear' and curriculam='$branch' and class>=13";
		$rs_ec=mysql_query("select id, descr, sub_id  from exam_m where accyear='$accyear' and curriculam='$branch' and class>13  and type=1  and sts=1");
		while($m=mysql_fetch_array($rs_ec))
		{
			$class_section=$r['class_section_id'];
			$subject=$r['subject_id'];
			$subid=explode(',', $m['sub_id']);
			for($i=0;$i<sizeof($subid);$i++)
			{
				if($subid[$i]==$subject)
				{
				
					$class_section=$r['class_section_id'];
					$subject=$r['subject_id'];
					$subject_type=$r['subject_type'];
					$subject_id_dis=mysql_fetch_row(mysql_query("select subject_name,subject_id from subject_m where subject_id='$subject'"));
					$subject_type_dis=mysql_fetch_row(mysql_query("select subtype_name from subjecttype where subtype_id='$subject_type'"));
					$section_name=mysql_fetch_row(mysql_query("select section_name from class_section where id='$class_section'"));
					$course_year=mysql_fetch_row(mysql_query("select year_name,year_id from course_year where year_id='$sem'"));
					?>	
					<tr >
					<td align="center" nowrap><?=$k?></td>
					<td nowrap><?=$subject_id_dis[0]?></td>
					<td nowrap><?=$subject_type_dis[0]?></td>
					<td align="center" nowrap><?=$course_year[0]?></td>
					<td align="center" nowrap><?=$section_name[0]?></td>
					<td align="center" nowrap><?=$m[1]?></td>
					<?
					if($subject_id_dis[1]==58 || $subject_id_dis[1]==93 )
					{
						?>
						<td align="center" width="30" nowrap><a href="javascript:void(0);" onClick ="OpenWind2('add_grade.php?subname=<?=$subject_id_dis[0]?>&credit=<?=$subject_id_dis[1]?>&branch=<?=$branch?>&sem=<?=$sem?>&class_section_id=<?=$class_section?>&examid=<?=$m[0]?>&subject=<?=$subject?>&sess=s', 'OpenWind2',1000,500)"><input type="button" name="update" value="Add Grade"  class='bgbutton'></a></td>
						
						<?
					}
					elseif($subject_id_dis[1]==355 or $subject_id_dis[1]==356 or $subject_id_dis[1]==357 or $subject_id_dis[1]==358 or $subject_id_dis[1]==359  or $subject_id_dis[1]==360)
					{
						?>
						<td align="center" width="30" nowrap><a href="javascript:void(0);" onClick ="OpenWind2('add_grade3.php?subname=<?=$subject_id_dis[0]?>&credit=<?=$subject_id_dis[1]?>&branch=<?=$branch?>&sem=<?=$sem?>&class_section_id=<?=$class_section?>&examid=<?=$m[0]?>&subject=<?=$subject?>&sess=s', 'OpenWind2',1000,500)"><input type="button" name="update" value="Add Grade"  class='bgbutton'></a></td>
						
						<?
					}
					else
					{
						?>
						<td align="center" width="30" nowrap><a href="javascript:void(0);" onClick ="OpenWind2('add_grade1.php?subname=<?=$subject_id_dis[0]?>&credit=<?=$subject_id_dis[1]?>&branch=<?=$branch?>&sem=<?=$sem?>&class_section_id=<?=$class_section?>&examid=<?=$m[0]?>&subject=<?=$subject?>&sess=s', 'OpenWind2',1000,500)"><input type="button" name="update" value="Add Grade"  class='bgbutton'></a></td>
						
						<?php
					}
					?>
                    <td align="center" width="30" nowrap><a href="fac_vw.php?sem=<?=$sem?>&examid=<?=$m[0]?>&subject=<?=$subject?>"><input type="button" name="rprts" value="Report"  class='bgbutton'></a></td></tr>
                    <?
					$k++;
				}
			}
		}	
    }
    ?>
    </table>
    <br>
    <?php
}
	$staffrigtss=fetcharray(execute("SELECT groupname FROM `users` where username='$user'"));
	
$dpcorights=execute("select a.dp_co,a.dp_hm,a.dp_hostel,a.sem from dpsem_right a,users b where a.status=1 and b.username='$user' and a.sem>13 and b.srid=a.dp_co");

$dphosrights=execute("select a.dp_co,a.dp_hm,a.dp_hostel,a.sem from dpsem_right a,users b where a.status=1 and b.username='$user' and a.sem>13 and b.srid=a.dp_hostel");

$dphmrights=execute("select a.teacher,a.sect  from  class_teacher a,users b where a.grade>13  and b.username='$user' and b.srid=a.teacher");

if($staffrigtss[0]=='adminm' || $staffrigtss[0]=='admin' || mysql_num_rows($dpcorights)>0 || mysql_num_rows($dphmrights)>0 || mysql_num_rows($dphosrights)>0)
		{
			
if(!$_POST and !$_REQUEST)

{

	$branch=$_SESSION['branch'];

	$sem=$_SESSION['sem'];	

}

else

{

	$branch=$_POST['branch'];

	$sem=$_POST['sem'];

}

$examname=$_POST['examname'];

$sectionrgts=$_POST['sectionrgts'];
echo '<form name="frm" action="" method="post" >';
if($staffrigtss[0]=='adminm' || $staffrigtss[0]=='admin')
		{	
    ?>
   
     <div align="left">&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="javascript:void(0);" onClick ="OpenWind5('app_teac.php', 'OpenWind5',900,500)"><input type="button" name="appfacn" value="Dp Setup"  class='bgbutton'></a>
    </div>
    <br>
    <?
		}
	?>
    
    <table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">

  <tr>

    <td colspan="2" align="center" class="head">Semester Report</td>

    </tr>

     

  <tr>

    <td>&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>

		<td>&nbsp;<select name="branch" onChange="reload()">

			<option value="0">------Select-----</option>

				<?php

					$sql="select course_id,coursename from course_m where course_id=4";

					$rs=execute($sql) or die(error_description());

					for($i=0;$i<rowcount($rs);$i++)

					{

					  $r=mysql_fetch_array($rs);



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
$dphmrightssem=fetcharray(execute("select a.grade  from  class_teacher a,users b where a.grade>13  and b.username='$user' and b.srid=a.teacher"));

if(mysql_num_rows($dphmrights)>0)
{
	$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch' and a.year_id='$dphmrightssem[0]'");
}
else
{
				$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");

}
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

    <td>&nbsp;&nbsp;Select Term</td>

  <?php

$accyear=$_SESSION['AcademicYear'];

$rs_ec=execute("select id, descr  from exam_m where accyear='$accyear' and curriculam='$branch' and class='$sem' and type=1  and sts=1");

?>

    <td>&nbsp;<select name='examname' onChange="reload()">

<?

echo "<option value=''>--Select--</option>";

for($i=0;$i<rowcount($rs_ec);$i++)

{

	$r_sec=fetcharray($rs_ec,$i);

	if($r_sec['id']==$examname)

	echo "<option value='$r_sec[id]' selected>$r_sec[descr]</option>";

	else

	echo "<option value='$r_sec[id]'>$r_sec[descr]</option>";



}

?>

</select></td>

  </tr>

  <tr>

  <td height="28">&nbsp;&nbsp;Section</td><td>&nbsp;<select name='sectionrgts'  onChange="reload()">

<?
$dphmrightssec=fetcharray(execute("select a.teacher,a.sect  from  class_teacher a,users b where a.grade>13  and b.username='$user' and b.srid=a.teacher"));

if(mysql_num_rows($dphmrights)>0)
{
$rs_section=execute("SELECT * FROM student_m a,class_section b WHERE a.archive='N' and a.class_section_id=b.id and a.course_yearsem='$sem' and b.id='$dphmrightssec[1]' group by b.id");
}
elseif($staffrigtss[0]=='adminm' || $staffrigtss[0]=='admin' || mysql_num_rows($dpcorights)>0 || mysql_num_rows($dphosrights)>0)
{
$rs_section=execute("SELECT * FROM class_section  WHERE id=0");
}

echo "<option value=''>--Select--</option>";

for($i=0;$i<rowcount($rs_section);$i++)

{

	$r_section=fetcharray($rs_section,$i);

	if($sectionrgts==$r_section[id])

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
if($sectionrgts!='' )
{	

?>
<br>
 <table align="center" width="50%" style="background:none">
  <tr>
    <?
  if(mysql_num_rows($dpcorights)>0 || $staffrigtss[0]=='admin')
		{
  ?>
  <td  align="center" nowrap style="background:none">
  <div align="center">
    <a href="javascript:void(0);" onClick ="OpenWind2('add_co_commn.php?credit=<?=$credit?>&branch=<?=$branch?>&sem=<?=$sem?>&class_section_id=<?=$class_section?>&subname=<?=$subname?>&examid=<?=$examname?>&sess=s', 'OpenWind2',1000,500)"><input type="button" name="appfacn2" value="DP Coordinator Comments"  class='bgbutton'></a>
    </div>
    </td>
    <?
		}
		?>
        <td align="center" nowrap style="background:none">
        <div align="center">
    <a href="fac_vwall.php?credit=<?=$credit?>&branch=<?=$branch?>&sem=<?=$sem?>&class_section_id=<?=$class_section?>&subname=<?=$subname?>&examid=<?=$examname?>&subject=<?=$subject?>&sess=s"><input type="button" name="appfacn22" value="View/Edit All"  class='bgbutton'></a>
    </div>
    </td>
        <?
		 if(mysql_num_rows($dphmrights)>0  || $staffrigtss[0]=='admin')
		{
	?>
    <td  align="center" nowrap style="background:none">
    <div align="center">
    <a href="javascript:void(0);" onClick ="OpenWind2('add_hm_commn.php?credit=<?=$credit?>&branch=<?=$branch?>&sem=<?=$sem?>&class_section_id=<?=$sectionrgts?>&subname=<?=$subname?>&examid=<?=$examname?>&sess=s', 'OpenWind2',1000,500)"><input type="button" name="appfacn" value="DP Homeroom Comments"  class='bgbutton'></a>
    </div>
    </td>
    <?
		}
	?>

    </tr>
     <tr>
    <?
  if(mysql_num_rows($dphosrights)>0 || $staffrigtss[0]=='admin')
		{
  ?>
  <td  align="center" nowrap style="background:none" colspan="3"><br>
  <div align="center">
    <a href="javascript:void(0);" onClick ="OpenWind2('add_hostel_com.php?credit=<?=$credit?>&branch=<?=$branch?>&sem=<?=$sem?>&class_section_id=<?=$class_section?>&subname=<?=$subname?>&examid=<?=$examname?>&sess=s', 'OpenWind2',1000,500)"><input type="button" name="appfacn28" value="DP Hostel Parent"  class='bgbutton'></a>
    </div>
    </td>
    <?
     
		}
		?>
    </tr>
    </table>
    <br> 
<? 
}   	$user=$_SESSION['user'];
	$sql=mysql_query("select course_id,subject_id,course_year_id,sub_type from subject_m  where course_year_id='$sem' and status =1");
if($sectionrgts!='' )
{	
	?>
    <br>    
        <table align='center' cellpadding="5" class='forumline' width='80%' border="1" >
    <tr height="10"><td colspan='8' align='center' class='head'>Grade  </td></tr>
    <tr >
        <td align="center" class="row3" width="5%" nowrap>Sl No.</td>
        <td align="center" class="row3" nowrap>Subject</td>
        <td align="center" class="row3" nowrap>Subject type</td>
        <td align="center" class="row3" nowrap><?php echo $_SESSION['semname']; ?></td>
        <td align="center" class="row3" nowrap>Section</td>
        <td align="center" class="row3" nowrap>Term</td>
        <td align="center" class="row3" nowrap>Action</td>
         <td align="center" class="row3" nowrap>View</td>
    </tr>
	<?php
    $k=1;
    while($r=mysql_fetch_array($sql))
    {
		$branch=$r['course_id'];
		$sem=$r['course_year_id'];
		$accyear=$_SESSION['AcademicYear'];
		
		$rs_ec=mysql_query("select id, descr, sub_id  from exam_m where accyear='$accyear' and curriculam='$branch' and id='$examname'  and type=1 and class=$sem  and sts=1");
		
		while($m=mysql_fetch_array($rs_ec))
		{
			
			$subject=$r['subject_id'];
			$subid=explode(',', $m['sub_id']);
			for($i=0;$i<sizeof($subid);$i++)
			{
				if($subid[$i]==$subject)
				{
				
					
					if($r['sub_type'])
					{
					$subject_type=$r['sub_type'];
					}
					else
					{
					$subject_type=1	;
					}
					$subject_id_dis=mysql_fetch_row(mysql_query("select subject_name,subject_id from subject_m where subject_id='$subject'"));
					$subject_type_dis=mysql_fetch_row(mysql_query("select subtype_name from subjecttype where subtype_id='$subject_type'"));
					$section_name=mysql_fetch_row(mysql_query("select section_name from class_section where id='$class_section'"));
					$course_year=mysql_fetch_row(mysql_query("select year_name,year_id from course_year where year_id='$sem'"));
					?>	
					<tr >
					<td align="center" nowrap><?=$k?></td>
					<td nowrap><?=$subject_id_dis[0]?></td>
					<td nowrap><?=$subject_type_dis[0]?></td>
					<td align="center" nowrap><?=$course_year[0]?></td>
					<td align="center" nowrap><?=$section_name[0]?></td>
					<td align="center" nowrap><?=$m[1]?></td>
					<?
					if($branch==3)
					{
						?>
                        <td align="center" width="30" nowrap><a href="javascript:void(0);" onClick ="OpenWind2('add_grademsp.php?subname=<?=$subject_id_dis[0]?>&credit=<?=$subject_id_dis[1]?>&branch=<?=$branch?>&sem=<?=$sem?>&class_section_id=<?=$class_section?>&examid=<?=$m[0]?>&subject=<?=$subject?>&sess=s', 'OpenWind2',1000,500)"><input type="button" name="update" value="Add Comment"  class='bgbutton'></a></td>
                        <?
					}
					else
					{
					if($subject_id_dis[1]==58 || $subject_id_dis[1]==93 )
					{
						?>
						<td align="center" width="30" nowrap><a href="javascript:void(0);" onClick ="OpenWind2('add_grade.php?subname=<?=$subject_id_dis[0]?>&credit=<?=$subject_id_dis[1]?>&branch=<?=$branch?>&sem=<?=$sem?>&class_section_id=<?=$class_section?>&examid=<?=$m[0]?>&subject=<?=$subject?>&sess=s', 'OpenWind2',1000,500)"><input type="button" name="update" value="Add Grade"  class='bgbutton'></a></td>
						
						<?
					}
					elseif($subject_id_dis[1]==355 or $subject_id_dis[1]==356 or $subject_id_dis[1]==357 or $subject_id_dis[1]==358 or $subject_id_dis[1]==359  or $subject_id_dis[1]==360)
					{
						?>
						<td align="center" width="30" nowrap><a href="javascript:void(0);" onClick ="OpenWind2('add_grade3.php?subname=<?=$subject_id_dis[0]?>&credit=<?=$subject_id_dis[1]?>&branch=<?=$branch?>&sem=<?=$sem?>&class_section_id=<?=$class_section?>&examid=<?=$m[0]?>&subject=<?=$subject?>&sess=s', 'OpenWind2',1000,500)"><input type="button" name="update" value="Add Grade"  class='bgbutton'></a></td>
						
						<?
					}
					else
					{
						?>
						<td align="center" width="30" nowrap><a href="javascript:void(0);" onClick ="OpenWind2('add_grade1.php?subname=<?=$subject_id_dis[0]?>&credit=<?=$subject_id_dis[1]?>&branch=<?=$branch?>&sem=<?=$sem?>&class_section_id=<?=$class_section?>&examid=<?=$m[0]?>&subject=<?=$subject?>&sess=s', 'OpenWind2',1000,500)"><input type="button" name="update" value="Add Grade"  class='bgbutton'></a></td>
						
						<?php
					}
					}
					?>
                    <td align="center" width="30" nowrap><a href="fac_vw.php?sem=<?=$sem?>&branch=<?=$branch?>&examid=<?=$m[0]?>&subject=<?=$subject?>"><input type="button" name="rprts" value="Report"  class='bgbutton'></a></td></tr>
                    <?
					$k++;
				}
			}
		}	
    }
    ?>
    </table>
    <?php
}
		}
?>
    			
</form>	
</body>
</html>
   
    
    			
</form>	
</body>
</html>
