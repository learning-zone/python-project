<?php
session_start();
require("../db.php");

//print_r($_POST);


  $sem=$_SESSION['sem'];
  $branch=$_SESSION['branch'];
  $a_year=$_SESSION['AcademicYear'];
	
if($_POST)
{
	$sem=$_POST['sem'];
	$unit=$_POST['unit'];
	$term = $_POST['term'];
	$class=$_POST['class'];
	$branch=$_POST['branch'];
	$examid=$_POST['examid'];
	$subject=$_POST['subject'];
	$exam_id=$_POST['exam_id'];
	$reports=$_POST['reports'];
	$examname_m=$_POST['examname_m'];
	$term=$_POST['term'];
	$class_section_id=$_POST['class_section_id'];
}

	$usergroup=fetchrow(execute("SELECT groupname,srid FROM users WHERE username='$user'"));
if($usergroup[0]=='ADMIN' or $usergroup[0]=='adminm' or $usergroup[0]=='Admin'  or $usergroup[0]=='FACULTY'  or $usergroup[0]=='SCHOOL ADMIN' or $usergroup[0]=='SLT' )
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
$sql21=execute("SELECT  a.class, a.section FROM all_teachers a,users b WHERE b.username='$user' AND a.home_teac=b.srid ORDER BY a.class");

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
<html>
<HEAD>
<SCRIPT LANGUAGE="JavaScript">
function reload()
{
	document.frm.action='teacherComments.php';
	document.frm.submit();
}

</SCRIPT>
<script language="javascript">
function OpenWind2(URL,title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, 'toolbar=no,location=no,directories=no,status=no,menubar=no, scrollbars=yes,resizable=no,copyhistory=no,width='+w+',height='+h+',top='+top+',left='+left);
}
</script>
</HEAD>

<body>
<form name="frm" action="" method="post">
<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head">STUDENT REPORT </td>
    </tr>
<tr>

      <td style="border-right:none;">&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>
      <td >&nbsp;&nbsp;<select name="sem" onChange="reload()">
        <option value="">--- Select ---</option>
       <?
         if($sts==1)
         {
  
            $sql2 = "SELECT * FROM course_year WHERE status=1 AND `year_id` > 9";
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
           		
		}
	
	if($sts==2)
	{

	$sql21=execute("select d.year_id,d.year_name from all_teachers a,users b,class_section c,course_year d,subject_m e where b.username='$user'  and e.sub_type=2 and c.id=a.section and c.status=1  and d.year_id>9  and c.sub=e.subject_id and d.year_id=a.class  and b.srid IN ( sub_teac2, sub_teac, home_teac) group by a.class order by a.class");
		while($r23=fetcharray($sql21))
		{
			$tmorets3[]=$r23[0];
		}
		$sqnma=execute("select d.year_id,d.year_name from staff_class_group a,users b,class_section c,course_year d,subject_m e where b.username='$user'  and c.id=a.section and c.status=1 and d.year_id>9 and e.sub_type=2  and c.sub=e.subject_id and d.year_id=a.grade and b.srid=a.staff_id  group by a.grade order by a.grade, a.section");
   	
    while($sqnma1=fetcharray($sqnma))
    {
        $tmorets3[]=$sqnma1[0];
		$sqnma1[0];
    }
	$tmore=array_unique($tmorets3);
	
	while (list(, $value1) = each($tmore)) 
		{
		$jm=$value1;
			$sectne=fetcharray(execute("SELECT * FROM course_year where status=1 and year_id='$jm'"));
			if($sem==$jm)
				echo "<option value='$jm' selected>$sectne[year_name]</option>";
			else
				echo "<option value='$jm'>$sectne[year_name]</option>";
			
		}
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
		
			$sql1=execute("select c.id,c.codename,c.section_name from all_teachers a,users b,class_section c,course_year d,subject_m e where b.username='$user'  and e.sub_type=2 and c.id=a.section and c.status=1 and c.sub=e.subject_id and d.year_id=a.class and c.grade='$sem' and b.srid IN ( sub_teac2, sub_teac, home_teac) group by c.id order by a.class, a.section");
		while($r2=fetcharray($sql1))
		{
			$tmorets[]=$r2[0];
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
	<td>&nbsp;&nbsp;Semester</td>
    <?
	if($_POST['sem'] and $_POST['class'])
	{
				$CURDATE=date('Y-m-d');
		
			$termDate=fetcharray(execute("SELECT id FROM academic_term
		WHERE CURDATE() between start_date AND end_date AND `a_year`='$a_year' AND `status`=1"));
		
				if($_POST['term']!=''){
					$term=$_POST['term'];
				}
				else{
					$term=$termDate[0];
				}
	}
		?>
      <td>&nbsp;&nbsp;<select name="term" onChange="RefreshMe()">
          <option value="">--- Select ---</option>
          <?php
          $sql=execute("SELECT `id`, `term` FROM `academic_term` WHERE `a_year`='$a_year' AND `status`=1  ORDER BY `id`");
		          //$term=$rermDate[0];
          while($r2=fetcharray($sql))
          {
              if($term==$r2[id])
                  echo "<option value=$r2[id] selected>$r2[term]</option>";
              else
                  echo "<option value=$r2[id]>$r2[term]</option>";
          }
      ?>
        </select></td>
	</tr>
</table>
<br>
  <?php

 $sql123.="select c.id,c.student_id,c.first_name,c.last_name from class_section a,student_course b,student_m c WHERE a.status=1 AND a.id=b.sub_sec AND b.acc_year='$a_year' AND b.stu_id=c.id AND c.archive='N' AND a.id='$class'  AND a.grade='$sem' GROUP BY a.id,b.stu_id ORDER BY c.first_name";
	
	
	$rs=execute($sql123) ;
if($sem and $class and $term)
{
  ?><br>  
 <table width="50%" border="1" cellspacing="0"  align="center" class="forumline"  cellpadding="0">
  <tr>
    <td width="10%" class="head" nowrap align="center">Sl No.</td>
    <td width="40%" align="center" class="head" nowrap>Name</td>
    <td width="20%" align="center" class="head" nowrap>Student Id</td>
    <td width="23%" align="center" class="head" nowrap>Action</td>
   <!-- <td width="7%" align="center">Sel</td>-->
  </tr>
  <?php
  $i=1;
  while($r1=fetcharray($rs))
  { 
  ?>
  <tr>
    <td align="center">&nbsp;<?=$i?></td>
    <td nowrap>&nbsp;<?=$r1[first_name]?> <?=$r1[last_name]?></td>
    <td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;<?=$r1[student_id]?></td>
    <td nowrap align='center'>&nbsp;
    
    <a href="javascript:void(0);" onClick ="OpenWind2('viewTeacherComments.php?Key1=<?=base64_encode($r1['id'])?>&Key2=<?=base64_encode($term)?>', 'OpenWind2',1100,1200)">EDIT</a>
    	
   </td></tr>
	
	<?php
      ++$i;  
   }

  ?>
</table>
<?
}
?>
</form>	
</body>
</html>
