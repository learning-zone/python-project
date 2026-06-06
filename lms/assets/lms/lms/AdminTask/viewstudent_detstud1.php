<?php
session_start();
include("../db.php");
$branch = $_POST['branch'];
$sem = $_POST['sem'];
$section = $_POST['section'];
?>
<HTML>
<HEAD>
<script language="Javascript">
function prn()
{
	pr1.style.display="none";	
	print(this.form);
}
</script>
</HEAD>
<BODY>
<form name="frm1" method="POST">
<?php
//--------------------------------------------------------------------------
function GetCourseName($id){
//Retrieves the name of the course associated with the integer.
	$sql = "SELECT coursename FROM course_m where course_id=$id";
	//echo $sql;
	$rs = execute($sql);
	$num = rowcount($rs);
	if($num){
		$ar = fetcharray($rs,0);
		return($ar[0]);
	}else{
		return("Unknown Course $id");
	}
}
function GetCourseYear($id){
//Retrieves the name of the year associated with the id.
	$sql = "SELECT year_name FROM course_year WHERE year_id=$id";
	//echo $sql;
	$rs = execute($sql);
	$num = rowcount($rs);
	if($num){
		$ar = fetcharray($rs,0);
		return($ar[0]);
	}else{
		return("Unknown Year $id");
	}
}
function GetCourseSec($id){
//Retrieves the name of the year associated with the id.
	$sql = "SELECT section_name FROM class_section WHERE id=$id order by section_name";
	//echo $sql;
	$rs = execute($sql);
	$num = rowcount($rs);
	if($num){
		$ar = fetcharray($rs,0);
		return($ar[0]);
	}else{
		return("Unknown Sec $id");
	}
}
//--------------------------------------------------------------------------
$temp_sem=$sem;
$temp_sec=$section;
$j=1;
if($branch==0)
{
	$sql45 = execute("SELECT * FROM course_m");
}
else
{
$sql45 = execute("SELECT * FROM course_m where course_id=$branch");//; and head_id='$cname'");
}
$rs45=fetcharray($sql45);
$branch=$rs45[course_id];
if($temp_sem!=0)
{
	$sql46 = execute("SELECT year_id FROM course_year WHERE head_id=$rs45[head_id]  and year_id=$temp_sem");
}
else
{
	$sql46 = execute("SELECT year_id FROM course_year where head_id=$rs45[head_id] ");
}
$rs46=fetcharray($sql46);
?>
<FORM NAME="frm" METHOD="POST">
<INPUT TYPE="HIDDEN" NAME="filename" VALUE="<?=$filename;?>">
<INPUT TYPE="HIDDEN" NAME="branch" VALUE="<?=$branch;?>">
<INPUT TYPE="HIDDEN" NAME="temp_sem" VALUE="<?=$temp_sem;?>">
<table class='forumline' ALIGN='center' valign='top' width="90%">
<tr><td colspan=6 align='center' class='head'>Student Details Report As on :<?=date("d-m-Y g:i a")?> </td></tr>
<tr><td colspan=6 align='center' class='row3'>
<table cellspacing='0' cellpadding='0' width='100%' border="1">
<tr><td Class="rowpic" align='center'><b>Sl. No.</b></td>
<td Class="rowpic" align='center'><b>Registration No.</b></td>
<td Class="rowpic" align='center'><b>Name</b></td>
<td Class="rowpic" align='center'><b>Academic Year</b></td>
<td Class="rowpic" align='center'><b>User Name</b></td>
<td Class="rowpic" align='center'><b>Password</b></td>
</tr>
<?
//Modification Done by Shri On date : 25/03/04
//Codes for student details
			$sem=$rs46[year_id];
			if($temp_sec!=-1)
			{
				//echo $temp_sec;
				if ($temp_sec < 0)
				{
				$sql47=execute("select distinct(id),section_name from class_section");
				
				//echo "1111";
				}
				else
				{
				$sql47=execute("select distinct(id),section_name from class_section where id=$temp_sec");
				}
				//echo ("select distinct(id),section_name from class_section");
				while($rs47=fetcharray($sql47))
				{
					$section=$rs47[id];
					//$section=$temp_sec;
					//echo $branch;
					if($branch !=0 && $sem !=0 && $section!=0)
					{
						$sqlstr = "Select admission_id,first_name," ;
						$sqlstr .= "last_name,course_admitted,academic_year,course_yearsem,student_id,username,password" ;
						$sqlstr .= " from student_m where course_admitted=" . trim($branch) ;
						$sqlstr .= " and course_yearsem='$sem' and class_section_id=$section  " ;
						$sqlstr .= " and archive='N' ORDER BY " ;
						$sqlstr .= "student_id, first_name ASC" ;
						//echo $sqlstr;
					}
					elseif($branch !=0 && $sem!=0 && $section==0)
					{
					$sqlstr = "Select admission_id,first_name," ;
					$sqlstr .= "last_name,course_admitted,academic_year,course_yearsem,student_id,username,password" ;
					$sqlstr .= " from student_m where course_admitted=".trim($branch);
					$sqlstr .= " and course_yearsem='$sem' " ;
					$sqlstr .= " and archive='N' and class_section_id=$section ORDER BY " ;
					$sqlstr .= "class_section_id, first_name ASC" ;
					}
					elseif($branch ==0 && $sem !=0 && $section!=0)
					{
						$sqlstr = "Select admission_id,first_name," ;
						$sqlstr .= "last_name,course_admitted,academic_year,course_yearsem,student_id,username,password" ;
						$sqlstr .= " from student_m where " ;
						$sqlstr .= " course_yearsem='$sem' and class_section_id=$section " ;
						$sqlstr .= " and archive='N' ORDER BY " ;
						$sqlstr .= "student_id, first_name ASC" ;
					}
					elseif($branch !=0 && $sem ==0 && $section!=0)
					{
						$sqlstr = "Select admission_id,first_name," ;
						$sqlstr .= "last_name,course_admitted,academic_year,course_yearsem,student_id,username,password" ;
						$sqlstr .= " from student_m where course_admitted=".trim($branch);
						$sqlstr .= " and class_section_id=$section and archive='N' ORDER BY " ;
						$sqlstr .= "student_id, first_name ASC" ;
					}
					elseif($branch ==0 && $sem !=0 && $section==0)
					{
						$sqlstr = "Select admission_id,first_name," ;
						$sqlstr .= "last_name,course_admitted,academic_year,course_yearsem,student_id,username,password" ;
						$sqlstr .= " from student_m where ";
						$sqlstr .= " course_yearsem='$sem' and archive='N' and class_section_id=$section ORDER BY " ;
						$sqlstr .= "student_id,first_name ASC" ;
					}
					elseif($branch ==0 && $sem ==0 && $section==0)
					{
						$sqlstr= "Select admission_id,first_name," ;
						$sqlstr.= "last_name,course_admitted,academic_year,course_yearsem,student_id,username,password" ;
						$sqlstr.= " from student_m where ";
						$sqlstr .= " archive='N' and class_section_id=$section ORDER BY " ;
						$sqlstr .= "student_id,first_name ASC" ;
					}
					if(strlen($sqlstr) < 10)
					{
					die("<B align='center'>Please select a proper search criteria</b><br><Hr>");
					}
					//echo $sqlstr."<br><br>";		
					$rs = execute($sqlstr) 	or die("shashi");
					$num = rowcount($rs);
					if($num == 0)
					{
						//die("<b>Match Not Found<b><br><hr>");
					}
					else
					{
						/*if($branch==-1)
						{
				?>			<tr><TD Class="row3" colspan=5><b><??></b></td>
							<TD Class="row3"><b><?=GetCourseYear($rs46["course_year_id"])." Section : ".GetCourseSec($rs47["id"])?></b></TD>
							</tr>
				<?		}
						else
						{*/
						?>
						<tr><TD Class="row3" colspan=3><?=	GetCourseName($rs45["course_id"]);?></td>
						<TD Class="row3" colspan='3'><?=GetCourseYear($rs46["year_id"])." &nbsp;&nbsp;&nbsp;Section : ".GetCourseSec($rs47["id"])?></TD>
						</tr>
			<?			//}
						$rs = execute($sqlstr) 	or die(error_description());
						for($i=0;$i<$num;$i++)
						{
							$r = fetcharray($rs,$i);
							if($i%2)
							echo "<tr> ";
							else
							echo "<tr class='clsname'> ";
				?>			<td align="center"><?=$i+1?></td>
							<TD>&nbsp;&nbsp;&nbsp;<?=$r["student_id"]."<br>"?></TD>
							<TD>&nbsp;&nbsp;&nbsp;<?=$r["first_name"] ." ".$r["last_name"]. "<br>" ?></TD>
							<?$ayearnext=$r["academic_year"]+1;?>
							<TD>&nbsp;&nbsp;&nbsp;<?=$r["academic_year"] ." - "."  ".$ayearnext ."<br>" ?></td>
							<TD>&nbsp;&nbsp;&nbsp;<?=$r["username"]."<br>"?></TD>
							<TD>&nbsp;&nbsp;&nbsp;<?=$r["password"]."<br>"?></TD>
							</TR>
							<?php	
						}
					}
				}
			}	
			elseif($temp_sec==-1)
			{
				if($branch !=0 && $sem !=0 )
				{
					$sqlstr = "Select admission_id,first_name," ;
					$sqlstr .= "last_name,course_admitted,academic_year,course_yearsem,student_id,username,password" ;
					$sqlstr .= " from student_m";
					$sqlstr .= " and course_yearsem='$sem' and class_section_id=0 " ;
					$sqlstr .= " where  archive='N' and head_id='$cname' ORDER BY " ;
					$sqlstr .= "student_id, first_name ASC" ;
				}
				elseif($branch ==0 && $sem !=0 )
				{
					$sqlstr = "Select admission_id,first_name," ;
					$sqlstr .= "last_name,course_admitted,academic_year,course_yearsem,student_id,username,password" ;
					$sqlstr .= " from student_m where " ;
					$sqlstr .= " course_yearsem='$sem' and class_section_id=0 " ;
					$sqlstr .= " and archive='N' and head_id='$cname' ORDER BY " ;
					$sqlstr .= "student_id, first_name ASC" ;
				}
				elseif($branch !=0 && $sem ==0 )
				{
					$sqlstr = "Select admission_id,first_name," ;
					$sqlstr .= "last_name,course_admitted,academic_year,course_yearsem,student_id,username,password" ;
					$sqlstr .= " from student_m where course_admitted=".trim($branch);
					$sqlstr .= " and class_section_id=0 and archive='N'and head_id='$cname'  ORDER BY " ;
					$sqlstr .= "student_id, first_name ASC" ;
				}
				//echo $sqlstr;
				if(strlen($sqlstr) < 10)
				{
					die("<B align='center'>Please select a proper search criteria</b><br><Hr>");
				}
				$rs = execute($sqlstr) 	or die(error_description());
				$num = rowcount($rs);
				if($num == 0)
				{
					//die("<b>Match Not Found<b><br><hr>");
				}
				else
				{
					/*if($branch==-1)
					{
						?><tr><TD Class="row3" colspan=3><b>
						<??></b></td><TD Class="row3"><b>
						<?=GetCourseYear($rs46["course_year_id"])." --> : No Section "?></b></TD>
						</tr>
						<?
					}
					else
					{*/
						?>
						<tr><TD Class="row3" colspan=3><b>
						<?=GetCourseName($rs45["course_id"]);?></b></td>
						<TD Class="row3"><b>
						<?=GetCourseYear($rs46["year_id"])." --> : No Section"?></b></TD>
						</tr>
						<?
					//}
					$rs = execute($sqlstr) 	or die(error_description());
					for($i=0;$i<$num;$i++)
					{
						$r = fetcharray($rs,$i);
						?>
						<TR height='20'><td align="center"><?=$i+1?></td>
						<TD> &nbsp;&nbsp;&nbsp;<?=$r["student_id"]."<br>"?></TD>
						<TD>&nbsp;&nbsp;&nbsp;<?=$r["first_name"] ." ".$r["last_name"]. "<br>" ?></TD>
						<?	$ayearnext=$r["academic_year"]+1; ?>
						<TD>&nbsp;&nbsp;&nbsp;<?=$r["academic_year"] ." - "."  ".$ayearnext ."<br>" ?></td>
						<TD>&nbsp;&nbsp;&nbsp;<?=$r["username"]."<br>"?></TD>
							<TD>&nbsp;&nbsp;&nbsp;<?=$r["password"]."<br>"?></TD>
						</TR>
						<?php

					}
				}
}
?>

</Table>
</td>
</tr>
</table>
<br>
<div align='center'><INPUT TYPE="button" NAME="print" class='bgbutton' VALUE="PRINT" OnClick="prn()"></div>
</form>
</BODY>
</HTML>
