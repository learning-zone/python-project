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
	document.frm.action='rprtstes.php';
	document.frm.submit();
}

</SCRIPT>
</HEAD>

<body>
<form name="frm" action="" method="post">
<?php
session_start();
require("../db.php");
//print_r($_POST);
$accyear=$_SESSION['AcademicYear'];

if(!$_POST)
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
}
else
{
	$subject=$_POST['subject'];
	$exam_id=$_POST['exam_id'];
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$class_section_id=$_POST['class_section_id'];
	$examid=$_POST['examid'];
	$reports=$_POST['reports'];
	$examname_m=$_POST['examname_m'];
	$masteexamn=$_POST['masteexamn'];
	$unit=$_POST['unit'];
	$class=$_POST['class'];
}

	$usergroup=fetchrow(execute("SELECT groupname,srid FROM users WHERE username='$user'"));
if($usergroup[0]=='ADMIN' or $usergroup[0]=='adminm' or $usergroup[0]=='Admin' )
{
 	$sts=1;
}
else
{
	 $sts=2;
	// SUBJECT RIGHTS STARTS
	 $user=$_SESSION['user'];
 
// teacher rights
//class teacher code
$sql21=execute("SELECT  a.class, a.section FROM all_teachers a,users b WHERE b.username='$user' and a.home_teac=b.srid ORDER BY a.class");

// subject teacher code
$sql=execute("SELECT a.sub, a.class, a.sub_type, a.section FROM all_teachers a,users b WHERE b.username='$user' AND (a.sub_teac =b.srid or a.sub_teac2=b.srid) ORDER BY a.class, a.sub");
 if(rowcount($sql)==0 and rowcount($sql21)==0)
 {
  	echo die("You don't have rights"); 
 }
 //end
 
// class teacher
if(rowcount($sql21)!=0)
{
	 while($r12=fetcharray($sql21))
	 {
	
		  $yearname1[]=$r12[0];
		  $sm1=$r12[0];
		  $sql5=execute("SELECT subject_id FROM subject_m WHERE course_year_id='$sm1' AND status=1 ORDER BY sub_pre");
		  while($r=fetcharray($sql5))
		  {
		   		$subject_id[]=$r[0];
		  }
	 }
}
//end

//subject teacher
$sql=execute("SELECT a.sub, a.class, a.sub_type, a.section FROM all_teachers a,users b WHERE b.username='$user' AND (a.sub_teac =b.srid or a.sub_teac2=b.srid) ORDER BY a.class, a.sub");
if(rowcount($sql)!=0)
{
	 while($r12=fetcharray($sql))
	 {
		  $yearname1[]=$r12[1];
		  $subject_id[]=$r12[0];
	 }
}

$branch2=array_unique($branch1);
$yearname2=array_unique($yearname1);
asort($yearname2);
$subject_id2=array_unique($subject_id);
//end
//SUBJECT RIGHTS ENDS 
}


	
?>
<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head">Report Card</td>
    </tr>
<tr>

      <td>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>
      <td>&nbsp;&nbsp;<select name="sem" onChange="reload()">
<option value="">Select</option>
  <?
	if($sts==1)
	{
	?>
<?php
	$sql2 = "SELECT * FROM course_year where status=1 and year_id<10";
	$rs2 = execute($sql2);
	$num = rowcount($rs2);
	for($i=0;$i<$num;$i++)
	{
		$r2 = fetcharray($rs2,$i);
		if($sem==$r2[0])
		echo "<option value=\"$r2[0]\" selected>$r2[1]</option>";
		else
		echo "<option value=\"$r2[0]\">$r2[1]</option>";
	}
	?> 
    <?
	}
	?>
    <?
	if($sts==2)
	{
	?>
<?php
	/*$sql21=execute("select d.year_id,d.year_name from all_teachers a,users b,class_section c,course_year d,subject_m e where b.username='$user'  and e.sub_type=2 and c.id=a.section and c.status=1  and d.year_id<10  and c.sub=e.subject_id and d.year_id=a.class  and b.srid IN ( sub_teac2, sub_teac, home_teac) group by a.class order by a.class");
		while($r2=fetcharray($sql21))
		{
			
			if($sem==$r2[0])
				echo "<option value='$r2[0]' selected>$r2[1]</option>";
			else
				echo "<option value='$r2[0]'>$r2[1]</option>";
			
		}*/
		
		
		$sql21=execute("select d.year_id,d.year_name from all_teachers a,users b,class_section c,course_year d,subject_m e where b.username='$user'  and e.sub_type=2 and c.id=a.section and c.status=1  and d.year_id<10  and c.sub=e.subject_id and d.year_id=a.class  and b.srid IN ( sub_teac2, sub_teac, home_teac) group by a.class order by a.class");
		while($r23=fetcharray($sql21))
		{
			$tmorets3[]=$r23[0];
		}
		$sqnma=execute("select d.year_id,d.year_name from staff_class_group a,users b,class_section c,course_year d,subject_m e where b.username='$user'  and c.id=a.section and c.status=1  and a.grade='$sem' and e.sub_type=2  and c.sub=e.subject_id and d.year_id=a.grade and b.srid=a.staff_id  group by a.grade order by a.grade, a.section");
   	
    while($sqnma1=fetcharray($sqnma))
    {
        $tmorets3[]=$sqnma1[0];
    }
	$tmore=array_unique($tmorets3);
	
	while (list(, $value1) = each($tmore)) 
		{
		$jm=$value1;
			$sectne=fetchrow(execute("SELECT * FROM course_year where status=1 and year_id='$jm'"));

			if($sem==$j)
				echo "<option value='$jm' selected>$sectne[year_name]</option>";
			else
				echo "<option value='$jm'>$sectne[year_name]</option>";
			
		}
		
		
	?> 
    <?
	}
	?>
</select>
</td>
</tr>
<tr>
      <td>&nbsp;&nbsp;Class</td>
    <?
	if($sts==2)
	{
	?>
      <td>&nbsp;
        <select name="class" onChange="reload()">
          <option value=""> --Select-- </option>
          
		<?php
		
			/*$sql21=execute("select c.id,c.codename,c.section_name from all_teachers a,users b,class_section c,course_year d,subject_m e where b.username='$user'  and e.sub_type=2 and c.id=a.section and c.status=1 and c.sub=e.subject_id and d.year_id=a.class and c.grade='$sem' and b.srid IN ( sub_teac2, sub_teac, home_teac) group by c.id order by a.class, a.section");
		while($r2=fetcharray($sql21))
		{
			
			if($class==$r2[0])
				echo "<option value='$r2[0]' selected>$r2[1]-$r2[2]</option>";
			else
				echo "<option value='$r2[0]'>$r2[1]-$r2[2]</option>";
			
		}*/
		$sql1=execute("select c.id,c.codename,c.section_name from all_teachers a,users b,class_section c,course_year d,subject_m e where b.username='$user'  and e.sub_type=2 and c.id=a.section and c.status=1 and c.sub=e.subject_id and d.year_id=a.class and c.grade='$sem' and b.srid IN ( sub_teac2, sub_teac, home_teac) group by c.id order by a.class, a.section");
		while($r2=fetcharray($sql1))
		{
			$tmorets[]=$r2[2];
		}
		$sqnmars=execute("select c.id,c.codename,c.section_name from staff_class_group a,users b,class_section c,course_year d,subject_m e where b.username='$user'  and c.id=a.section and c.status=1  and a.grade='$sem' and e.sub_type=2  and c.sub=e.subject_id and d.year_id=a.grade and b.srid=a.staff_id order by a.grade, a.section");
   	
    while($sqnmars1=fetcharray($sqnmars))
    {
        $tmorets[]=$sqnmars1[0];
    }
	$tmorets1=array_unique($tmorets);
	
	while (list(, $value) = each($tmorets1)) 
		{
		$j=$value;
			$sectname=fetchrow(execute("SELECT codename,section_name FROM `class_section` WHERE id='$j'"));

			if($class==$j)
				echo "<option value='$j' selected>$sectname[0]-$sectname[1]</option>";
			else
				echo "<option value='$j'>$sectname[0]-$sectname[1]</option>";
			
		}
        ?>
        </select></td>
        <?
		}
		?>
    <?
	if($sts==1)
	{
	?>
      <td>&nbsp;
        <select name="class" onChange="reload()">
          <option value=""> --Select-- </option>
          
		<?php
			$sqlSub=execute("SELECT a.id,a.codename,a.section_name FROM class_section a,subject_m b WHERE  a.status=1 and b.subject_id=a.sub and b.status=1 and b.sub_type=2 and a.grade='$sem'  group by a.id  order by a.grade,a.codename,a.section_name");
		  
          while($r1=fetcharray($sqlSub))
          {
              if($class==$r1[0])
                  echo "<option value=$r1[0] selected>$r1[codename] - $r1[section_name]</option>";
              else
                  echo "<option value=$r1[0]>$r1[codename] - $r1[section_name]</option>";
          }
        ?>
        </select></td>
        <?
		}
		?>     



</tr>

<tr>
<td>&nbsp;&nbsp;Select Semester</td><td>&nbsp;&nbsp;<select name="masteexamn" onChange="reload()">
	<option value="0">---Select---</option>
<?php
	echo $sql3=execute("SELECT id,exam_name FROM `igc_exam_year_m` where `class`='$sem' and status=1 and acc_year='$accyear'");
	for($j=0;$j<rowcount($sql3);$j++)
	{
		$r3=fetcharray($sql3,$j);
		if($r3[0]==$masteexamn)
		{
			echo "<option value=$r3[0] selected>$r3[1]</option>";
		}
		else
		{
			echo "<option value=$r3[0]>$r3[1]</option>";
		}
	}
?>
</select>
</td>
</tr>
<tr>
<td>&nbsp;&nbsp;Select Exam</td><td>&nbsp;&nbsp;<select name="examname_m" onChange="reload()">
	<option value="0">---Select---</option>
<?php
	echo $sql3=execute("SELECT id,exam_name FROM `dp_exam_sub_m` where `class`='$sem' and status=1 and acc_year='$accyear' and exam_id='$masteexamn'");
	for($j=0;$j<rowcount($sql3);$j++)
	{
		$r3=fetcharray($sql3,$j);
		if($r3[0]==$examname_m)
		{
			echo "<option value=$r3[0] selected>$r3[1]</option>";
		}
		else
		{
			echo "<option value=$r3[0]>$r3[1]</option>";
		}
	}
?>
</select>
</td>
</tr>
<tr>
<td>&nbsp;&nbsp;Select Unit</td><td>&nbsp;&nbsp;<select name="unit" onChange="reload()">
	<option value="0">---Select---</option>
<?php
	echo $sql3=execute("select unit,id from msp_unit where status=1  and exam_id='$examname_m' order by posi");
	for($j=0;$j<rowcount($sql3);$j++)
	{
		$r3=fetcharray($sql3,$j);
		if($r3[1]==$unit)
		{
			echo "<option value=$r3[1] selected>$r3[0]</option>";
		}
		else
		{
			echo "<option value=$r3[1]>$r3[0]</option>";
		}
	}
?>
</select>
</td>
</tr>
</table>
<br>
  <?php
  $unit=$_POST['unit'];

	
if($unit=='0' ||  $unit=='' )
{
die();
}

 $sql123.="select c.id,c.student_id,c.first_name,c.last_name from class_section a,student_course b,student_m c where a.status=1 and a.id=b.sub_sec and b.acc_year='$accyear' and b.stu_id=c.id and c.archive='N' and a.id='$class'  and a.grade='$sem' group by a.id,b.stu_id order by c.first_name";
	
	
	$rs=execute($sql123) ;
  ?><br>  <table width="50%" border="1" cellspacing="0"  align="center" class="forumline"  cellpadding="0">
  <tr>
    <td width="10%" class="head" nowrap>Sl No.</td>
    <td width="40%" align="center" class="head" nowrap>Name</td>
    <td width="20%" align="center" class="head" nowrap>Student Id</td>
    <td width="23%" align="center" class="head" nowrap>Action</td>
   <!-- <td width="7%" align="center">Sel</td>-->
  </tr>
  <?php
  $i=1;
  while($r1=fetcharray($rs))
  { 
  echo "<tr>
    <td nowrap>&nbsp;$i</td>
    <td nowrap>&nbsp;$r1[first_name] $r1[last_name]</td>
    <td nowrap align='center'>&nbsp;$r1[student_id]</td>
    <td nowrap align='center'>&nbsp;";
    
	?>

    <a href="javascript:OpenWind2('reports1.php?student_id=<?=$r1['id']?>&course=<?=$branch?>&sem=<?=$sem?>&examid=<?=$examname_m?>&masteexamn=<?=$masteexamn?>&unit=<?=$unit?>')">
	VIEW
	</a> </td></tr><?php
$i++;  }
  ?>
  
</table>
<div align='center'>
<a href="javascript:OpenWind2('reports1.php?student_id=<?=$r1['id']?>&course=<?=$branch?>&sem=<?=$sem?>&examid=<?=$examname_m?>&masteexamn=<?=$masteexamn?>&unit=<?=$unit?>')">
	<input type="sendmailss" name="mailsss" value="Sendmail"  class='bgbutton'>
	</a> 
</div>

</form>	
</body>
</html>
