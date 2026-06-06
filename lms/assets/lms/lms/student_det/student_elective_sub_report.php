<?php
session_start();
include("../db.php");
$branch=$_POST['branch'];
$sem=$_POST['sem'];
$class_section_id=$_POST['class_section_id'];
$academic_year=$_SESSION['AcademicYear'];

?>
<HTML>
<HEAD>
	<script language="JavaScript">
		function prn()
		{
			pr1.style.display = "none";
			window.print();
		}
		function gen_excel()
		{
			document.frm1.action='student_elective_sub_report_exl.php';
			document.frm1.submit();
		}
	</script>
</HEAD>
<BODY>
<?php

$esub=execute("select * from subject_m where elective='Y' and course_id='$branch' and course_year_id='$sem'");
$ss=rowcount($esub);
if($ss > 0)
{
	
$rs = execute("SELECT * FROM student_m limit 1");
$num = rowcount($rs);
if($num > 0)
{
	?>
<form name="frm1" method="POST">
<INPUT TYPE="HIDDEN" NAME="branch" VALUE="<?php echo $branch ?>">
<INPUT TYPE="HIDDEN" NAME="sem" VALUE="<?php echo $sem ?>">
<INPUT TYPE="HIDDEN" NAME="class_section_id" VALUE="<?php echo $class_section_id ?>">

<table border='1' width="100%" cellspacing='0' cellpadding='0' align='center' class='forumline'>
<?php
		$dd=0;
		$subele=execute("select subject_name,subject_id from subject_m where elective='Y' and course_id='$branch' and course_year_id='$sem'");
		
		while($rr=fetcharray($subele))
		{
			
			
		 $dd++;
		}
		
		?>
		
    <tr height='30'>
		<td colspan='<?=$dd+3?>' align='center' class='head'>STUDENT ELECTIVE SUBJECTS DETAILS </td>
	</tr>
	<tr height='25'>
		<td colspan='<?=$dd+3?>' class="rowpic" align='left'>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?> : 
		<?php 
		if(branchname($branch))
		echo branchname($branch);
		else
		echo "All"; ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php echo $_SESSION['semname']; ?> : <?php 
		if(semname($sem))
		echo semname($sem);
		else
		echo "All"; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;Section :  <?php echo secname($class_section_id); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

		</td>
	</tr>
      <?php
		$cc=0;
		$subele=execute("select subject_name,subject_id from subject_m where elective='Y' and course_id='$branch' and course_year_id='$sem'");
		
		while($rr=fetcharray($subele))
		{
			
			
		 $cc++;
		}
		//echo $cc;
		?>
	
   
   
	<tr height='25'>
		<td align='center' rowspan="2" nowrap>Sl No</td>
		<td align='center' rowspan="2" nowrap>Student Id</td>
		<td align='center' rowspan="2" nowrap>Student Name</td>
        <td align='center' colspan="<?=$cc?>" nowrap>Elective subjects</td>
		
        </tr>
      <tr height='25'>
      
        <?php
		$cc=0;
		$subele=execute("select subject_name,subject_id from subject_m where elective='Y' and course_id='$branch' and course_year_id='$sem'");
		
		while($rr=fetcharray($subele))
		{
			
			   ?>
         <td align="center" nowrap ><?php echo $rr[subject_name] ?> </td>
         <?
		 $cc++;
		}
		//echo $cc;
		?>
        
      
      </tr>  
         
        
	
    
	<?php
	$sql=execute("select coursename from course_m where course_id='$branch'");
	$branchname=mysql_fetch_row($sql);
	$rs=execute("SELECT year_name FROM course_year year_id='$sem'");
	$classname=mysql_fetch_row($rs);
			
				//	$var = "select student_id,first_name,last_name,g_num,parent_name,m_name,f_email,m_email,g_mail,g_name,sms_mobile,mnum from student_m where course_admitted='$branch' and course_yearsem='$sem' and class_section_id=$class_section_id ";
			
			
			
	$sql="select * from student_m where id is not null and archive='N' and academic_year='$academic_year'";
	
	if($branch!=0)
	{
	$sql.=" and course_admitted=$branch";
	}
	if($sem!=0)
	{
	$sql.=" and course_yearsem=$sem";
	}
	if($class_section_id!='')
	{
	$sql.=" and class_section_id=$class_section_id  ";
	}
	
 $sql.=" order by course_admitted, course_yearsem, class_section_id, first_name";
	$var=$sql;
	$res  = mysql_query($var) or die(mysql_error());
	$tnum=1;
	
	while($r=mysql_fetch_array($res))
	{
			
			   ?>
              
        <tr>
        <td align='center' ><?php echo $tnum ?></td>
        <td nowrap align='center'><?php echo $r[student_id] ?></td>
        <td  nowrap><?php echo $r[first_name]?>&nbsp;<?php echo $r[last_name] ?></td>
        <?php
		
		$subele=execute("select subject_name,subject_id from subject_m where elective='Y' and course_id='$branch' and course_year_id='$sem'");
		while($rr=fetcharray($subele))
		{
			$rt=fetcharray(execute("select * from student_course where stu_id='$r[id]' and sub='$rr[subject_id]'"));
			if($rt[id])
			{
				$gg='&#10004;';
			}
			else
			{
				$gg='';
			}
		
		?>
        <td align="center"><?=$gg?></td>
        <?
		}
		?>
        </tr>
		<?php
			$tnum++;
	}
	
	
?>
</table>
<br>
<div id='pr1' align='center'>
	<INPUT TYPE="SUBMIT" class='bgbutton' NAME="print" VALUE="PRINT" onclick='prn()'>&nbsp;&nbsp;
	<INPUT TYPE="button" NAME="Excel" class='bgbutton' VALUE="EXCEL EXPORT" OnClick="gen_excel()">
</div>
</form>
<?php
}
else
{
	?>
	<td>No studentid Record</td>
	<?php
}
}
else
{
	?>
    <br><br><br>
	<div align="center"><b>No Elective Subjects<b></div>
    <?
}
?>
</body>
</html>