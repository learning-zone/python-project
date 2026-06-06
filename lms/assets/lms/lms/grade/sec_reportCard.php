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
	document.frm.action='sec_reportCard.php';
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
    <td colspan="2" align="center" class="head">SECONDARY REPORT CARD</td>
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

	$sql21=execute("SELECT d.year_id,d.year_name from all_teachers a,users b,class_section c,course_year d,subject_m e WHERE b.username='$user'  AND e.sub_type=2 AND c.id=a.section AND c.status=1 AND c.sub=e.subject_id AND d.year_id=a.class  AND b.srid IN ( sub_teac2, sub_teac, home_teac) AND d.year_id > 9 GROUP BY a.class ORDER BY a.class");
		while($r2=fetcharray($sql21))
		{
			
			if($sem==$r2[0])
				echo "<option value='$r2[0]' selected>$r2[1]</option>";
			else
				echo "<option value='$r2[0]'>$r2[1]</option>";
			
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
          <option value="">--- Select ---</option>
          
		<?php
		
			$sql21=execute("SELECT c.id,c.codename,c.section_name from all_teachers a,users b,class_section c,course_year d,subject_m e WHERE b.username='$user'  AND e.sub_type=2 AND c.id=a.section AND c.status=1 AND c.sub=e.subject_id AND d.year_id=a.class AND c.grade='$sem' AND b.srid IN ( sub_teac2, sub_teac, home_teac) GROUP BY c.id ORDER BY a.class, a.section");
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

	if($sts==1)
	{
		
	?>
      <td>&nbsp;
        <select name="class" onChange="reload()">
          <option value="">--- Select ---</option>
          
		<?php
			$sqlSub=execute("SELECT a.id,a.codename,a.section_name FROM class_section a,subject_m b WHERE  a.status=1 AND b.subject_id=a.sub AND b.status=1 AND b.sub_type=2 AND a.grade='$sem'  GROUP BY a.id  ORDER BY a.grade,a.codename,a.section_name");
		  
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
    
    <a href="javascript:void(0);" onClick ="OpenWind2('reportCard.php?student_id=<?=$r1['id']?>&branch=<?=$branch?>&sem=<?=$sem?>&term=<?=$term?>', 'OpenWind2',1000,1200)">VIEW</a>
    	
   </td></tr>
	
	<?php
      ++$i;  
   }
}
  ?>
</table>
<br>
<div align='center'> 
 <a href="javascript:void(0);" onClick ="OpenWind2('sendmailsSecondary.php?term=<?=$term?>', 'OpenWind2',1000,1200)">
 <input type="button"  value="Sendmail"  class="bgbutton"/></a>
</div>
</form>	
</body>
</html>
