<script src="../SpryAssets/SpryAccordion.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
       <table width="100%"  align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
         
         
  <?php
session_start();
include("../db.php");
$user=$_SESSION['user'];
$tablename="att_".$_SESSION['sem'];
$datedet=date("Y-m-d");
				$fieldname='username';
				$rdate=$datedet;
				$sql1=execute("select course_admitted, course_yearsem, class_section_id from student_m where $fieldname='$user' and archive='N'");
				while($r1=fetcharray($sql1))
				{	
					$branch=$r1[0];
					$sem=$r1[1];
					$class_section_id=$r1[2];
				}
?>         <table height="300" align="center" width="100%" cellpadding="5" cellspacing="0" border="1">
<tr height="24">
             <td align="center" class="head">Missed class </td>
           </tr>
           
           
        <?php
		$sysdate=date("Y-m-d");
  $i=1;
   $rs=execute("select id,student_id,first_name,last_name,admission_id from student_m where $fieldname='$user' and archive='N'");
	
  while($r1=fetcharray($rs))
  { 
		$rownameid='mor';
		$sql5=execute("select $rownameid, att_date from $tablename where att_date and stu_id='$r1[id]' and sec='$class_section_id' order by att_date desc");
		if(rowcount($sql5)==0)
		{
		echo '<tr >
             <td  valign="top">Student present for all the class </td>
           </tr>';	
		}
		while($checkiddet=fetchrow($sql5))
		{
			if($checkiddet[0]==1)
			$statuschek='present';
			else
			$statuschek='absent';
			
			$ndate=explode('-',$checkiddet[1]);
			
			echo "<tr><td valign='top' >Date : $ndate[2]-$ndate[1]-$ndate[0]<br>";
					$sql3=execute("select subject_id, subject_name from subject_m where   course_year_id='$sem' and status='1' order by sub_pre");
					if(rowcount($sql3)==0)
					{
					//echo 'Subject Details available<br>';	
					}
					while($r3=fetcharray($sql3))
					{		
						$sql24=execute("select topic , description 	 from teacher_lesson_plan where subj='$r3[0]' and  r_date='$checkiddet[1]' and sec='$class_section_id'");
						if(rowcount($sql24)==0)
						{
						//echo 'Lesson plan not available<br>';	
						}
						while($r4=fetcharray($sql24))
						{
							echo "
									Subject : $r3[1]<br>
									Description : $r4[1]";
									$reso=fetchrow(execute("select reso from master_lesson_plan where id='$r4[0]'"));

									if($reso[0]!='')
									{
										echo "<a href='$reso[0]'>
									Download</a>";
									}
									echo "<br>";
						}	
							
					}
		$i++;
		echo "</td></tr>";
			
		}
}
?>
  
</table>