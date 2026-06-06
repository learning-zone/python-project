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
	document.frm.action='addattendace.php';
	document.frm.submit();
	
}

		function prn()

		{

			pr1.style.display = "none";

			window.print();

		}
function selectMe()
{
	var i = document.frm.length;
	for(j=0;j<i;j++)
	{
		if(document.frm[j].Sel != "CheckBox")
		{
			flag = document.frm[j].checked;
			document.frm[j].checked = !flag;
		}
	}
}	
</SCRIPT>
</HEAD>

<body>
<?php 
session_start();
require("../db1.php");
	$a_year=$_SESSION['AcademicYear'];

	$user=$_SESSION['user'];

	$branch=$_REQUEST['branch'];
	$sem=$_REQUEST['sem'];
	$class_section_id=$_REQUEST['class_section_id'];
	if($_REQUEST['subject'])
	$subject=$_REQUEST['subject'];
	else
	$subject=0;
	$subject_type=$_REQUEST['subject_type'];
	$subname=$_REQUEST['subname'];
	$sess=$_REQUEST['sess'];
$user=$_SESSION['user'];
$tablename="att_".$sem;
$sysdate=date("Y-m-d");
if(!$_POST)
{
	execute("CREATE TABLE IF NOT EXISTS `$tablename` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `subject_id` int(2) NOT NULL,
  `username` varchar(100) NOT NULL,
  `att_date` date NOT NULL,
  `stu_id` bigint(20) NOT NULL,
  `sec` int(1) NOT NULL,
  `mor` int(1) NOT NULL,
  `after` int(1) NOT NULL,
  `att_desc` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");
}
$sql21=execute("select a.curri_type, a.grade,a.sect from class_teacher a,users b where b.username='$user' and a.teacher=b.srid");
while($r12=fetcharray($sql21))
{
	$branch1=$r12[0];
	$sem1=$r12[1];
	$class_section_id1=$r12[2];
}

if($_POST['open'])
{
	$check=$_POST['check'];
	$studentid=$_POST['studentid'];
	for($i=0;$i<sizeof($studentid);$i++)
	{
		$temp1=$studentid[$i];
		$tt=$_POST['rid'.$temp1];
		$desc=$_POST['desc'.$temp1];
			
		$sql5=execute(" select id from $tablename where att_date='$sysdate' and stu_id='$studentid[$i]' and sec='$class_section_id' and subject_id='$subject'");
		if(rowcount($sql5)>0)
		{
			if($sess=='m')
			{
				$sql1="update $tablename set mor='$tt', att_desc='$desc' ,username='$user' where att_date='$sysdate' and stu_id='$studentid[$i]' and sec='$class_section_id' and subject_id='$subject'";
			}
			elseif($sess=='n')
			{
				$sql1="update $tablename set after='$tt', att_desc='$desc' ,username='$user' where att_date='$sysdate' and stu_id='$studentid[$i]' and sec='$class_section_id' and subject_id='$subject'";
			}	
			else
			{
				$sql1="update $tablename set mor='$tt', after='$tt', att_desc='$desc' ,username='$user' where att_date='$sysdate' and stu_id='$studentid[$i]' and sec='$class_section_id' and subject_id='$subject' ";
			}			
		}
		else
		{
			if($sess=='m')
			{
				$sql1="insert into $tablename(att_date, stu_id, sec, mor, att_desc, username, subject_id) values('$sysdate', '$studentid[$i]', '$class_section_id', '$tt', '$desc', '$user', '$subject')";
			}
			elseif($sess=='n')
			{
				$sql1="insert into $tablename(att_date, stu_id, sec, after, att_desc, username, subject_id) values('$sysdate', '$studentid[$i]', '$class_section_id', '$tt', '$desc', '$user', '$subject')";
			}	
			else
			{
				$sql1="insert into $tablename(att_date, stu_id, sec, mor, after, att_desc, username, subject_id) values('$sysdate', '$studentid[$i]', '$class_section_id', '$tt', '$tt', '$desc', '$user', '$subject')";
			}
		}		
	execute($sql1);	
	}
	?>
	<SCRIPT LANGUAGE="JavaScript">
	alert("Attendance Updated Successfully");
	</SCRIPT>
	<?php
}
 ?>		<form name="frm" action="" method="post" >
<input type="hidden" name="subname" value="<?=$subname?>">
<input type="hidden" name="branch" value="<?=$branch?>">
<input type="hidden" name="sem" value="<?=$sem?>">
<input type="hidden" name="class_section_id" value="<?=$class_section_id?>">
<input type="hidden" name="subject" value="<?=$subject?>">
<input type="hidden" name="sess" value="<?=$sess?>">
<br>
  <?php
  if($branch=='0')
	die();
	if($sem=='0')
	die();
	if($class_section_id=='')
	die();
   $sql123.="select id,student_id,first_name,last_name,admission_id from student_m where id is not null and archive='N'  and academic_year='$a_year' ";
	if($branch!=0)
	{
	$sql123.=" and course_admitted=$branch";
	}
	if($sem!=0)
	{
	$sql123.=" and course_yearsem=$sem";
	}
	if($class_section_id!='-1')
	{
	$sql123.=" and class_section_id=$class_section_id  ";
	}
	
	$sql123.=" order by first_name";
	
	$rs=execute($sql123) or die(mysql_error());
  ?><br>  <table border="1" cellspacing="0"  align="center" class="forumline"  cellpadding="0" width="70%">
    <tr height="25">
    <td colspan="8" align="center" class="head"><?=$subname?> Special Instructions </td>
  </tr>
  <tr>
    <td  class="head" nowrap>Sl No.</td>
    <td  align="center" class="head" nowrap>Name</td>
    <td  align="center" class="head" nowrap>Student Id</td>
    <td  align="center" class="head" nowrap>Special Instructions</td>
  
  </tr>
  <?php
  $i=1;
  while($r1=fetcharray($rs))
  { 
  $flag1=1;
  if($sess=='s')
  {
	  $elective=fetchrow(execute("select elective from subject_m where subject_id='$subject'"));
	  if($elective[0]=='Y')
	  {
		$studentstatus=fetchrow(execute("select id from student_course where stu_id='$r1[id]' and acc_year='$a_year' and sub_sec='$class_section_id'"));
		if(!$studentstatus)
		$flag1=0;	
	  }
  }
  if($flag1==1)
  {
		if($sess=='n')
		$rownameid='after';
		else
		$rownameid='mor';
		$sql5=execute("select $rownameid from $tablename where att_date='$sysdate' and stu_id='$r1[id]' and sec='$class_section_id'  and subject_id='$subject'");
		$checkiddet=fetchrow($sql5);
		if($checkiddet[0]==1)
		$statuschek='checked';
		else
		$statuschek='';
		echo "<tr>
		<td nowrap>&nbsp;$i</td>
		<td nowrap>&nbsp;$r1[first_name] $r1[last_name]</td>
		<td nowrap align='center'>&nbsp;$r1[student_id]</td>";
		
		
		
		$special_inst=execute("select student_id,additional_info5 from doc_student where student_id='$r1[id]'");
		while($row=fetcharray($special_inst))
		{
			echo"<td nowrap align='center'>&nbsp;$row[1]</td>";
			
		
       
		}
		?>
		
		<td nowrap>
		<input type="hidden" name="studentid[]" value="<?php echo $r1[id]; ?>" >
		
		<?php
		/*$flag=1;
		$attst=execute("SELECT order_id, Short_name FROM `attendance_points` order by id ");
		while($nr=fetcharray($attst))
		{      
		if(rowcount($sql5))        
		{
		if($checkiddet[0]==$nr[0])
		{
		$statuschek='checked';
		$naval=$nr[1];
		}
		else
		$statuschek='';
		}
		else
		{
		if($flag==1)
		{
		$flag=0;
		$statuschek='checked';
		}
		else
		$statuschek='';
		
		}
		echo "&nbsp;$nr[1]&nbsp;<input type='radio' value='$nr[0]' name='rid".$r1['id']."' id='rid".$r1['id']."' $statuschek>&nbsp;&nbsp;&nbsp;";
		}*/
		?>
		</td>
		<!--<td align="center" class="row3">
		<div id="dis<?=$r1[id]?>" >
		<b><?=$naval?></b>
		</div>
		</td>-->
		<td align="center" nowrap>
		<?php
		$sql8=execute("select att_desc  from $tablename where att_date='$sysdate' and stu_id='$r1[id]' and sec='$class_section_id' and subject_id='$subject' ");
		$att_desc=fetchrow($sql8);
		
		?>	<!--<input type="text" size="50" name="desc<?=$r1[id]?>" value="<?=$att_desc[0]?>" >-->
		</td>
        
       
        </td>
		</tr><?php
	$i++;
	$naval='';
	
  }
}
  ?>
</table>
<br>
<div id=pr1 align=center><INPUT TYPE="SUBMIT" class=bgbutton NAME="print" VALUE="PRINT " onclick='prn()'>

</div>				
<div align="center">
<?php
 		//echo '<input type="submit" name="open" value="Update Attendance" class="bgbutton" >';
	
?>

</div><br>
</form>	
</body>
</html>
