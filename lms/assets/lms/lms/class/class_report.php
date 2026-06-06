<html>
<head>
<script  LANGUAGE="JavaScript">
	function reloadme()
	{
		document.frm.action="class_report.php";
		document.frm.submit();
	}
		function prn()
		{
			pr1.style.display = "none";
			window.print();
		}
		
		function gen_excel()
		{
			document.frm.action='class_reports_ex.php';
			document.frm.submit();
		}
		function genert_excel()
		{
			document.frm.action='class_reports_one_ex.php';
			document.frm.submit();
		}

</script>

<Script language="JavaScript">	
	function OpenWind2(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left)
}
</script>
</head>
 <?php
	session_start();
	include("../db.php");
	//print_r($_POST);
	$academic_year=$_SESSION['AcademicYear'];
	$grdes=$_POST['grdes'];
	$test=$_POST['test'];
	$alls=$_POST['alls'];

	$staffrigtss=fetcharray(execute("SELECT groupname FROM `users` where username='$user'"));

	?>

<body>
<form Name="frm"  method="post">     
<input type="hidden" name="test" value="<?=$test?>"/>
<input type="hidden" name="grdes" value="<?=$grdes?>"/>
<table width="60%" border="1" cellspacing="0"  align="center" cellpadding="0">
<tr>
<td align="center" class="head" colspan="3">
Class Wise Report
</td>
</tr>
<tr>
<td align="center">
            <?			
				if($grdes=='2')
				{
					$second='checked';
				}
				if($grdes=='')
				{
					$second='checked';
				}
				if($grdes=='1')
				{
					$first='checked';
				}
				if($grdes=='3')
				{
					$alls3='checked';
				}
				
				
			?>
        	&nbsp;<input type="radio" name="grdes" value="1" required <?=$first?> onClick="reloadme()">&nbsp;Course Wise</td>
            <td>&nbsp;<input type="radio" name="grdes" value="2" required <?=$second?> onClick="reloadme()">&nbsp;Class wise
        </td>
         <td>&nbsp;<input type="radio" name="grdes" value="3" required <?=$alls3?> onClick="reloadme()">&nbsp;All
        </td>
        </tr>
        <tr>
        <?
		if($grdes=='2' || $grdes=='')
		{ 
		?>
<td align="center" colspan="3">
<select name="test" STYLE="width:150px;height:80px" multiple onClick="reloadme()">
   <?php
     if($staffrigtss[0]=='adminm' || $staffrigtss[0]=='admin' || $staffrigtss[0]=='ADMIN')
	{
    $rs=execute("select a.id,a.codename,a.section_name from class_section a,subject_m b where b.sub_type=2 and a.sub=b.subject_id and b.course_year_id=a.grade and a.status=1 group by a.id order by  b.course_year_id,a.section_name");
		while($r=fetcharray($rs))
		{
			if($test==$r[0])
			{
				echo "<option value='$r[0]' selected> $r[1] $r[2]</option>";
			}
				else
			{
				echo "<option value='$r[0]'> $r[1] $r[2]</option>";
			}
		}
	}
	else
   	{
   	$sqlname=execute("select c.id,c.codename,c.section_name from all_teachers a,users b,class_section c,course_year d,subject_m e where b.username='$user'  and e.sub_type=2 and c.id=a.section and c.status=1 and c.sub=e.subject_id and d.year_id=a.class and b.srid IN ( sub_teac2, sub_teac, home_teac) order by a.class, a.section");
   	
    while($sqlname1=fetcharray($sqlname))
    {
        $tmorets[]=$sqlname1[0];
    }
	
	$sqnmars=execute("select c.id,c.codename,c.section_name from staff_class_group a,users b,class_section c,course_year d,subject_m e where b.username='$user'  and e.sub_type=2 and c.id=a.section and c.status=1 and c.sub=e.subject_id and d.year_id=a.grade and b.srid=a.staff_id order by a.grade, a.section");
   	
    while($sqnmars1=fetcharray($sqnmars))
    {
        $tmorets[]=$sqnmars1[0];
    }
		$tmorets1=array_unique($tmorets);
		
		while (list(, $value) = each($tmorets1)) 
		{
		$j=$value;
			$sql1="select id,codename,section_name from class_section where id='".$j."' and status=1 order by grade";
			$sqlname=fetchrow(execute($sql1));
			if($j==$test)
			{
				echo "<option value='$j' selected>$sqlname[1]-$sqlname[2]</option>";
			}
		else
			{
				echo "<option value='$j'>$sqlname[1]-$sqlname[2]</option>";
			}
		}

}
    ?>
    </select>
</td>
<?
}
if($grdes=='1' )
	{ 
	?>
	<td align="center" colspan="3">
	<select name="test" STYLE="width:150px;height:80px" multiple onClick="reloadme()">
	<?php
	 if($staffrigtss[0]=='adminm' || $staffrigtss[0]=='admin' || $staffrigtss[0]=='ADMIN')
	{
	$rs=execute("select a.id,a.codename,a.section_name from class_section a,subject_m b where b.sub_type!=2 and a.sub=b.subject_id and b.course_year_id=a.grade and a.status=1 group by a.id order by b.course_year_id,a.section_name");
	while($r=fetcharray($rs))
    {
        if($test==$r[0])
        {
            echo "<option value='$r[0]' selected> $r[1] $r[2]</option>";
        }
            else
        {
            echo "<option value='$r[0]'> $r[1] $r[2]</option>";
        }
    }
	}
	else
   	{
   	$rs33=execute("select c.id,c.codename,c.section_name from all_teachers a,users b,class_section c,course_year d,subject_m e where b.username='$user'  and e.sub_type!=2 and c.id=a.section and c.status=1 and c.sub=e.subject_id and d.year_id=a.class and b.srid IN ( sub_teac2, sub_teac, home_teac) order by a.class, a.section");
	while($r3=fetcharray($rs33))
	{
		$testartyss[]=$r3[0];
	}
	$rs44=execute("select c.id,c.codename,c.section_name from staff_class_group a,users b,class_section c,course_year d,subject_m e where b.username='$user'  and e.sub_type!=2 and c.id=a.section and c.status=1 and c.sub=e.subject_id and d.year_id=a.grade and b.srid=a.staff_id order by a.grade, a.section");
	while($r2=fetcharray($rs44))
	{
		$testartyss[]=$r2[0];
	}
	
	 	$testnames=array_unique($testartyss);
		
		while (list(, $value) = each($testnames)) 
		{
		$j=$value;
			$sql1="select id,codename,section_name from class_section where id='".$j."' and status=1 order by grade";
			$sqlname=fetchrow(execute($sql1));
			if($j==$test)
			{
				echo "<option value='$j' selected>$sqlname[1]-$sqlname[2]</option>";
			}
		else
			{
				echo "<option value='$j'>$sqlname[1]-$sqlname[2]</option>";
			}
		}
	
}
	?>
	</select>
	</td>
	<?
	}
?>
</tr>
</table>
  <?php
   $sectvats = fetchrow(execute("select codename,section_name from class_section where id='$test'")); 
   	$sql123.="select a.id,a.student_id,a.first_name,a.last_name,a.admission_id,a.course_yearsem from student_m a,student_course b where b.stu_id=a.id and a.archive='N' and b.sub_sec='$test' and b.acc_year='$academic_year' ";
	
	 $sql123.=" group by b.stu_id order by a.first_name";
	
	$rs=execute($sql123) or die(mysql_error());
  ?>
  <br>
  <?php
  if($grdes!=3 &&( $grdes==2 || $grdes==1))
  {
  ?>
<table width="60%" border="1" cellspacing="0"  align="center" cellpadding="0">
<tr>
    <td class="head" align="center" colspan=5  nowrap>Class&nbsp;:&nbsp;<?=$sectvats[0]?>-<?=$sectvats[1]?></td>
    </tr>
<tr>
    <td width="3%"  class="head" align="center"   nowrap>Sl No.</td>
    <td width="10%" class="head"  align="center"  nowrap>Name</td>
    <td  width="10%" class="head"  align="center" nowrap>Student Id</td>
    <td  width="10%" class="head"  align="center" nowrap>Course</td>
     <td  width="10%" class="head"  align="center" nowrap>Faculty</td>   
    </tr>
  <?php
  $i=1;
  while($r1=fetcharray($rs))
  {  
  $coursssvat = fetchrow(execute("select year_name from course_year where year_id='$r1[course_yearsem]'")); 

  $classnames1q= fetchrow(execute("select sub_teac,sub_teac2 from all_teachers where section='$test' and ( sub_teac!=0 or sub_teac2!=0)"));
  if(!$classnames1q[0])
  $classnames1q[0]=$classnames1q[1];
  
   $allteac= fetchrow(execute("select f_name,s_name from staff_det where id='$classnames1q[0]'"));
   
  echo "<tr>
    <td align='center' nowrap>&nbsp;$i</td>
    <td nowrap>&nbsp;$r1[first_name] $r1[last_name]</td>
    <td nowrap align='center'>&nbsp;$r1[student_id]</td>
    <td nowrap align='center'>$coursssvat[0]</td>
<td nowrap >&nbsp;$allteac[0]&nbsp;$allteac[1]</td>
    ";
	?>
  </tr><?php
$i++;  }
  ?>
  </table>
  <?php
 }
  $allstrud = "select a.id,a.codename,a.section_name,a.sub,a.grade,b.stu_id from class_section a,student_course b,student_m c where a.status=1 and a.id=b.sub_sec and b.acc_year='$academic_year' and b.stu_id=c.id and c.archive='N' group by a.id,b.stu_id order by a.grade,a.codename,a.section_name ";
	 $rs22=execute($allstrud) ;
  ?>
  <br>
  <?php
  if($grdes==3)
  {
   $m=1;
  while($r3=fetcharray($rs22))
  { 
   $allteacds44= fetchrow(execute("select first_name,last_name,student_id from student_m where id='$r3[5]' and archive='N' and academic_year='$academic_year'"));
  
 
  $classnames1= fetchrow(execute("select sub_teac,sub_teac2 from all_teachers where section='$r3[0]' and ( sub_teac!=0 or sub_teac2!=0)"));
  if(!$classnames1[0])
  $classnames1[0]=$classnames1[1];
  
   $clasnm1= fetchrow(execute("select f_name,s_name from staff_det where id='$classnames1[0]'"));
    
   $classection= fetchrow(execute("select codename,section_name from class_section where id='$r3[0]'"));
  $tempnew=$classection[0].$classection[1];
	if($newstaff!=$tempnew)
	{
		?></table><br>
          <br style="page-break-before: always;" clear="all" />

   <table width="60%" border="1" cellspacing="0"  align="center" cellpadding="0">
  <tr>
      <td colspan="5" class="head" align="center"nowrap>Class&nbsp;:&nbsp;<?=$classection[0]?>-<?=$classection[1]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Faculty&nbsp;:&nbsp;<?=$clasnm1[0]?>&nbsp;<?=$clasnm1[1]?></td>
  </tr> 
<tr>
    <td width="3%"  class="head" align="center"   nowrap>Sl No.</td>
    <td width="10%" class="head"  align="center"  nowrap>Name</td>
    <td  width="10%" class="head"  align="center" nowrap>Student Id</td>
    <td  width="10%" class="head"  align="center" nowrap>Course</td>
     <td  width="10%" class="head"  align="center" nowrap>Faculty</td>   
    </tr>     
        <?php
		 $m=1;
	}
	
 
  echo "<tr>
    <td align='center' nowrap>&nbsp;$m</td>
    <td nowrap>&nbsp;$allteacds44[0] $allteacds44[1]</td>
    <td nowrap align='center'>&nbsp;$allteacds44[2]</td>
    <td nowrap align='center'>$classection[0]-$classection[1]</td>
<td nowrap >&nbsp;$clasnm1[0]&nbsp;$clasnm1[1]</td>
    ";
	?>
  </tr><?php
  
  $newstaff=$classection[0].$classection[1];
  
$m++;  }
  ?>
  </table>
  <?
  }
  ?>
  <br>
  <?
if($grdes==3)
  {
	  ?>
<div id=pr1 align=center><INPUT TYPE="button" class=bgbutton NAME="print" VALUE="PRINT " onclick='prn()'>
&nbsp;&nbsp;
<INPUT TYPE="button" NAME="Excel" class='bgbutton' VALUE="EXCEL EXPORT" OnClick="gen_excel()">
</div>
<?
}
if($grdes==2 || $grdes==1)
{
?>
  <div align="center">
<a href="javascript:void(0);" onClick ="OpenWind2('class_reports_print.php?section=<?=$test?>', 'OpenWind2',800,500)">
<INPUT TYPE="button" class="bgbutton"  VALUE="Print"></a>
&nbsp;&nbsp;
<INPUT TYPE="button" NAME="Excel" class='bgbutton' VALUE="EXCEL EXPORT" OnClick="genert_excel()">
<?
}
?>
</div>
</form>

</BODY>
</HTML>
