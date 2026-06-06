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
	document.frm.action='addcmnt.php';
	document.frm.submit();
}

function refresh()
{
	document.frm.action='addcmnt.php';
	document.frm.submit();
}

</SCRIPT>
</HEAD>

<body>
<form name="frm" action="" method="post">
<?php
session_start();
require("../db.php");

$accyear=$_SESSION['AcademicYear'];
$class=$_POST['class'];



if(!$_POST)
{
	$course=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
}
else
{
	$subject=$_POST['subject'];
	$exam_id=$_POST['exam_id'];
	$course=$_POST['course'];
	$sem=$_POST['sem'];
	$class_section_id=$_POST['class_section_id'];
}
	$examname_m=$_POST['examname_m'];
	$masteexamn=$_POST['masteexamn'];
	
	
	
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
 


	

?>		<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head">Add Comment</td>
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
	$sql2 = "SELECT * FROM course_year where status=1  ";
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
	$sql21=execute("select d.year_id,d.year_name from all_teachers a,users b,class_section c,course_year d,subject_m e where b.username='$user'  and e.sub_type=2 and c.id=a.section and c.status=1 and c.sub=e.subject_id and d.year_id=a.class  and b.srid IN ( sub_teac2, sub_teac, home_teac) group by a.class order by a.class");
		while($r2=fetcharray($sql21))
		{
			
			if($sem==$r2[0])
				echo "<option value='$r2[0]' selected>$r2[1]</option>";
			else
				echo "<option value='$r2[0]'>$r2[1]</option>";
			
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
		
			$sql21=execute("select c.id,c.codename,c.section_name from all_teachers a,users b,class_section c,course_year d,subject_m e where b.username='$user'  and e.sub_type=2 and c.id=a.section and c.status=1 and c.sub=e.subject_id and d.year_id=a.class and c.grade='$sem' and b.srid IN ( sub_teac2, sub_teac, home_teac) order by a.class, a.section");
		while($r2=fetcharray($sql21))
		{
			
			if($class==$r2[0])
				echo "<option value='$r2[0]' selected>$r2[1]-$r2[2]</option>";
			else
				echo "<option value='$r2[0]'>$r2[1]-$r2[2]</option>";
			
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
			$sqlSub=execute("SELECT a.id,a.codename,a.section_name FROM class_section a,subject_m b WHERE  a.status=1 and b.subject_id=a.sub and b.status=1 and b.sub_type=2 and a.grade='$sem' order by a.grade,a.codename,a.section_name");
		  
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
	<option value="0">Select  </option>
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
	<option value="0">Select  </option>
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
</table>
<br>
<?php
$examname_m=$_POST['examname_m'];

	
if($examname_m=='0' ||  $examname_m=='' )
{
die();
}
?>
<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
    <tr>
    <td align='center' class='head' colspan="2">Exam Master</td></tr> 
    <?
    $rs=execute("select unit,id from msp_unit where status=1  and exam_id='$examname_m' order by posi");
    
    while($r=fetcharray($rs))
    {
    ?> 
    <tr>
    <td width="50%" align="left" class=''>&nbsp;&nbsp;<a href="javascript:OpenWind2('updatemarks.php?course=<?=$course?>&sem=<?=$sem?>&class=<?=$class?>&examid=<?=$examname_m?>&unit=<?=$r[1]?>')"><?=$r[0]?></a>
    </td>
    </tr>
    <?
    }
    ?>
    </table>
</form>	
</body>
</html>
