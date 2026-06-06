<?php
session_start();
require("../db.php");
//header("Refresh: 5");

?>
<HTML>
<HEAD>
<TITLE>Student List</TITLE>
<script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
  <script language="javascript" src="cal2.js"></script>
  <script language="javascript" src="cal_conf2.js"></script>
<script type="text/JavaScript">
function OpenWind2(k)
{
	var finalVar;
	finalVar=k;
	window.open(finalVar,'Stud','height=700,width=1000,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
function printReport()
{
	prn.style.display="none";
	window.print();
}
</script>
</HEAD>
<BODY >
<form method="POST" name="frm">
<?php

if($_POST['adate']=='')
{
	$adate=date("d/m/Y");
	$bdate=date("d/m/Y");
?>
<table width="80%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head"> Day wise Attendance Report</td>
  </tr>
   <tr>
		<td nowrap>&nbsp;&nbsp;From &nbsp;<input type="text" readonly name="adate" value="<?php echo $adate?>" >&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
        </td>
		<td nowrap>
        &nbsp;&nbsp;To &nbsp;<input type="text" readonly name="bdate" value="<?php echo $bdate?>" >&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
        </td>
		</tr>  
</table> 

<br>
<div align="center"><input class="bgbutton" type="submit" name="open" value="View" ></div><br>       
<?php
}
else
{
	$adate=$_POST['adate'];
	$bdate=$_POST['bdate'];
	$user=$_SESSION['user'];
	$a_year=$_SESSION['AcademicYear'];

$sql21=execute("select a.class,a.section,a.sub,a.sub_type from all_teachers a,class_section b where a.sub_type=2 and a.section=b.id and b.status=1 group by a.sub,a.section order by a.class");
	if(rowcount($sql21)==0)
	{
		echo die("You don't  have rights"); 
	}

if(rowcount($sql21)!=0)
{
	?>
	<form name="frm" action="" method="post" >

  
    
	<table width="80%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
	  <tr height="25">
		<td colspan="4" align="center" class="head"> Day wise Attendance Report For <?=$adate." - ".$bdate?> </td>
	  </tr>
<?php
$sql6=execute("select course_id,coursename from course_m ");    
while($r=fetcharray($sql6))
{   
	?>
    	<tr height="25">
		<td align="center" colspan="2" class="row3" nowrap><?=$r[1]?></td>
		<td align="center" colspan="2" class="row3" nowrap><a href="javascript:OpenWind2('addattendaceReportallgrade.php?branch=<?=$r[0]?>&adate=<?=$adate?>&bdate=<?=$bdate?>')"><input type="button" name="update" value="All Report"  class='bgbutton'></a>&nbsp;&nbsp;
        <a href="javascript:OpenWind2('addattendaceReportallgradeexl.php?branch=<?=$r[0]?>&adate=<?=$adate?>&bdate=<?=$bdate?>')"><input type="button" name="update" value="All Excel"  class='bgbutton'></a>&nbsp;&nbsp;
        <a href="javascript:OpenWind2('addattendaceReportallgradea.php?branch=<?=$r[0]?>&adate=<?=$adate?>&bdate=<?=$bdate?>')"><input type="button" name="update" value="Absent Report"  class='bgbutton'></a>&nbsp;&nbsp;
        
        <a href="javascript:OpenWind2('addattendaceReportallgradeaexl.php?branch=<?=$r[0]?>&adate=<?=$adate?>&bdate=<?=$bdate?>')"><input type="button" name="update" value="Absent Excel"  class='bgbutton'></a>&nbsp;&nbsp;
        <a href="javascript:OpenWind2('addattendaceReportallgradep.php?branch=<?=$r[0]?>&adate=<?=$adate?>&bdate=<?=$bdate?>')"><input type="button" name="update" value="Present Report"  class='bgbutton'></a>&nbsp;&nbsp;
        
        <a href="javascript:OpenWind2('addattendaceReportallgradepexl.php?branch=<?=$r[0]?>&adate=<?=$adate?>&bdate=<?=$bdate?>')"><input type="button" name="update" value="Present Excel"  class='bgbutton'></a>&nbsp;&nbsp;
		</td>
	</tr>
 
	
	<?php
}

?>


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
		//$branch1=$r12[0];
		$sql=execute("select course_id,coursename from course_m where course_id='$branch1'");
		$sem1=$r12[0];
		$subject=$r12[2];
		$yearname=fetchrow(execute("SELECT year_name FROM course_year where year_id='$sem1'"));
		$class_section_id1=$r12[1];
		$rs_section=fetchrow(execute("select codename,section_name from class_section where id='$class_section_id1' and status=1"));
	if($rs_section[0]!='' && $rs_section[1]!='')
	{
	?>
	<tr height="25">
		<td align="center" nowrap><?=$i?></td>
		<td align="center" nowrap><?=$yearname[0]?></td>
		
		<td align="center" nowrap><?=$rs_section[0]?>-<?=$rs_section[1]?></td>
		
		<td align="center" width="40%" nowrap>
        <?php
		$sql_id=fetchrow(execute("select type from attendance where `acc_year`='$a_year' and `class_id`='$sem1' and status=1"));
			if($sql_id[0]==1 || $sql_id[0]==3)
			{
		?>
        
        <a href="javascript:OpenWind2('addattendaceReport.php?subname=Day&branch=<?=$branch1?>&sem=<?=$sem1?>&class_section_id=<?=$class_section_id1?>&subject=<?=$subject?>&sess=b&adate=<?=$adate?>&bdate=<?=$bdate?>')"><input type="button" name="update" value="View Report"  class='bgbutton'></a>
&nbsp;&nbsp;&nbsp;
        <a href="addattendaceReportexl.php?subname=Day&branch=<?=$branch1?>&sem=<?=$sem1?>&class_section_id=<?=$class_section_id1?>&subject=<?=$subject?>&sess=b&adate=<?=$adate?>&bdate=<?=$bdate?>"><input type="button" name="update" value="Export To Excel"  class='bgbutton'></a>
        <?php
			}
			if($sql_id[0]==2)
			{
		?>
              <a href="javascript:OpenWind2('addattendaceReport.php?subname=MORNING&branch=<?=$branch1?>&sem=<?=$sem1?>&class_section_id=<?=$class_section_id1?>&subject=0&sess=m&adate=<?=$adate?>&bdate=<?=$bdate?>')"><input type="button" name="update" value="View Morning Report"  class='bgbutton'></a>
       <a href="javascript:OpenWind2('addattendaceReport.php?subname=NOON&branch=<?=$branch1?>&sem=<?=$sem1?>&class_section_id=<?=$class_section_id1?>&subject=0&sess=n&adate=<?=$adate?>&bdate=<?=$bdate?>')"><input type="button" name="update" value="View Noon Report"  class='bgbutton'></a>
 
        <?php
			}
		?>
        </td>
	</tr>
	<?php
	$i++;
	}
		
	}	
	
	
	?>
	</table>
		<br>
	<?php
}

}
?>
</form>
</body>
</html>