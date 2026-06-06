<?php
$branch=$_POST['branch'];
$category=$_POST['category'];
$sem=$_POST['sem'];
$current_date = date("d-m-Y", strtotime($_STARTOFDAY_));		
$getyearn=$getyear+1;
$serial = 1;
$total = 0;
$j = 0;
?>
<html><head>
<script language="JavaScript">
function prn()
{
	pr1.style.display = "none";
	window.print();
}
</script>
</head>
<body>
<?php
session_start();
include("../db.php");

function GetSeatCategory($id)
	{
		if($id)
			{
				$sql = "SELECT name FROM admission where id='$id' ";	
				$rs = execute($sql);
				$ar = fetcharray($rs,0);
				return($ar[0]);
				$num = rowcount($rs);
				if($num)
					{
						$ar = fetcharray($rs,0);
						return($ar[0]);
					}
				else
					{
						return("Unknown Seat Category $id");
					}
			}
	}
function GetCourseName($id)
	{
		$sql = "SELECT coursename FROM course_m where course_id='$id'";		
		$rs = execute($sql);
		$num = rowcount($rs);
		if($num)
			{
				$ar = fetcharray($rs,0);
				return($ar[0]);
			}
		else
			{
				return("Unknown Course $id");
			}
	}

function GetCourseYear($id)
	{
		$sql = "SELECT year_name FROM course_year WHERE year_id='$id'";
		$rs = execute($sql);
		$num = rowcount($rs);
		if($num)
			{
				$ar = fetcharray($rs,0);
				return($ar[0]);
			}
		else
			{
				return("Unknown Year $id");
			}
	}
$temp_sem=$sem;
$temp_cat=$category;
if($branch!=0)
	{
		$sql45 = execute("SELECT * FROM course_m,student_m where course_id=$branch and course_admitted=$course_id group by course_id");
	}
else
	{
		$sql45 = execute("SELECT * FROM course_m,student_m where course_admitted=course_id group by course_id");
	}
?>
<FORM NAME="frm" METHOD="POST">
<table class='forumline' width="80%" align='center' cellspacing="0" cellpadding="0"  border="1" >
	<tr height='30'>
		<td Class="head" align='center' colspan='4'><b>CASTE WISE STUDENT REPORT</b></td>
	</tr>
	<tr height='30'>
	   <td colspan='4' align='center' class='head'>AS ON :<?=date("d-m-Y g:i a")?> </td>
	</tr>
	<?php
	$rowclass = 1;
	$rowcount=rowcount($sql45);
	while($rs45=fetcharray($sql45))
		{
			$branch=$rs45[course_id];
			?>
			<tr height='20'>
				<td colspan='4' align='left' Class="row3"><font color='blue' size='2'>Course: <?=GetCourseName($rs45["course_id"]);?>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php
				if($temp_sem!=0)
					{
						$sql46 = execute("SELECT year_id FROM course_year WHERE year_id='$temp_sem'") or die("sdfds");
					}
				else
					{
						$sql46 = execute("SELECT year_id FROM course_year") or die("cvcvzx");
					}
				while($rs46=fetcharray($sql46))
					{
						$sem=$rs46[year_id];
				?>
				Semester: <?=GetCourseYear($rs46["year_id"]);?></td>
			</tr>
			<tr height='20'>
				<td align='center' class='row3'><font size='2' color='blue'>Caste</font></td>
				<td align='center' class='row3'><font size='2' color='blue'>Male</font></td>
				<td align='center' class='row3'><font size='2' color='blue'>Female</font></td>
				<td align='center' class='row3'><font size='2' color='blue'>Total</font></td>
			</tr>
			<?php
		if($temp_cat!=0)
			{
				$sql47=execute("select distinct(cetcategory) as id from student_m where cetcategory='$temp_cat' and course_admitted='$branch' and course_yearsem='$sem'");
			}
		else
			{
				$sql47=execute("select distinct(cetcategory) as id from student_m where course_admitted='$branch' and course_yearsem='$sem'");
			}
		while($rs47=fetcharray($sql47))
			{
				$castid=$rs47[id];
				if($branch !=0 && $sem !=0 && $castid!=0)
					{
						$sqlstr = "select count(*) as male from $_DATABASE_.student_m where course_admitted=" . trim($branch) ;
						$sqlstr .= " and course_yearsem='$sem'" ;
						$sqlstr .= " and archive='N' and cetcategory='$castid' and gender='M'" ;

						$sqlstr1 = "select count(*) as male from $_DATABASE_.student_m where course_admitted=" . trim($branch) ;
						$sqlstr1 .= " and course_yearsem='$sem'" ;
						$sqlstr1 .= " and archive='N' and cetcategory='$castid' and gender='F'" ;
					}
				elseif($branch ==0 && $sem !=0 && $castid!=0)
					{
						$sqlstr = "select count(*) as male" ;
						$sqlstr .= " from $_DATABASE_.student_m where " ;
						$sqlstr .= " course_yearsem='$sem'" ;
						$sqlstr .= " and archive='N' and cetcategory='$castid' and gender='M'" ;

						$sqlstr1 = "select count(*) as male" ;
						$sqlstr1 .= " from $_DATABASE_.student_m where " ;
						$sqlstr1 .= " course_yearsem='$sem'" ;
						$sqlstr1 .= " and archive='N' and cetcategory='$castid' and gender='F'" ;
					}
				elseif($branch !=0 && $sem ==0 && $castid!=0)
					{
						$sqlstr = "select count(*) as male" ;
						$sqlstr .= " from $_DATABASE_.student_m where course_admitted=" . trim($branch) ;
						$sqlstr .= " and archive='N' and cetcategory='$castid' and gender='M'" ;

						$sqlstr1 = "select count(*) as male" ;
						$sqlstr1 .= " from $_DATABASE_.student_m where course_admitted=" . trim($branch) ;
						$sqlstr1 .= " and archive='N' and cetcategory='$castid' and gender='F'" ;
					}
				elseif($branch ==0 && $sem ==0 && $castid!=0)
					{
						$sqlstr = "Select count(*) as male";
						$sqlstr .= " from $_DATABASE_.student_m cetcategory='$castid' and gender='M'" ;

						$sqlstr1 = "Select count(*) as male";
						$sqlstr1 .= " from $_DATABASE_.student_m cetcategory='$castid' and gender='F'" ;
					}
				elseif($branch !=0 && $sem ==0 && $castid==0)
					{
						$sqlstr = "select count(*) as male" ;
						$sqlstr .= " from $_DATABASE_.student_m where course_admitted=" . trim($branch) ;
						$sqlstr .= " and archive='N' and gender='M'" ;

						$sqlstr1 = "select count(*) as male" ;
						$sqlstr1 .= " from $_DATABASE_.student_m where course_admitted=" . trim($branch) ;
						$sqlstr1 .= " and archive='N' and gender='F'" ;
					}
				elseif($branch !=0 && $sem !=0 && $castid==0)
					{
						$sqlstr = "select count(*) as male" ;
						$sqlstr .= " from $_DATABASE_.student_m where course_admitted=" . trim($branch) ;
						$sqlstr .= " and course_yearsem='$sem' and archive='N' and gender='M'" ;

						$sqlstr1 = "select count(*) as male" ;
						$sqlstr1 .= " from $_DATABASE_.student_m where course_admitted=" . trim($branch) ;
						$sqlstr1 .= " and course_yearsem='$sem' and archive='N' and gender='F'" ;
					}
				elseif($branch ==0 && $sem !=0 && $castid==0)
					{
						$sqlstr = "select count(*) as male" ;
						$sqlstr .= " from $_DATABASE_.student_m where" ;
						$sqlstr .= "  course_yearsem='$sem' and archive='N' and gender='M'" ;

						$sqlstr1 = "select count(*) as male" ;
						$sqlstr1 .= " from $_DATABASE_.student_m where";
						$sqlstr1 .= "  course_yearsem='$sem' and archive='N' and gender='F'" ;
					}
				elseif($branch ==0 && $sem ==0 && $castid==0)
					{
						$sqlstr = "select count(*) as male" ;
						$sqlstr .= " from $_DATABASE_.student_m where ";
						$sqlstr .= " archive='N' and gender='M'" ;

						$sqlstr1 = "select count(*) as male" ;
						$sqlstr1 .= " from $_DATABASE_.student_m where";
						$sqlstr1 .= " archive='N' and gender='F'" ;
					}
				if(strlen($sqlstr) < 10)
					{
						die("<B align='center'>Please select a proper search criteria</b><br><Hr>");
					}
				$rs = execute($sqlstr) 	or die(error_description());
				$rs1 = execute($sqlstr1) 	or die(error_description());
				$num = rowcount($rs);		
				if($num != 0)
					{
						$r = fetcharray($rs,0);
						$r1 = fetcharray($rs1,0);
						if($castid!="")
							{
								$csql="select * from category where id='$castid'";
								$crs=execute($csql);
								$crow=fetcharray($crs);
								$castname=$crow[1];
							}
			?>
			<tr height='20'>
				<td align='center'><?php echo $castname ?></td>
				<td align='center'><?php echo $r[male] ?></td>
				<td align='center'><?php echo $r1[male] ?></td>
				<td align='center'><?php echo ($r1[male]+$r[male]) ?></td>
				<?php
				$rowclass = 1 - $rowclass;	
				$mtotal=($mtotal+$r[male]);
				$ftotal=($ftotal+$r1[male]);
				$ttotal=($r1[male]+$r[male]);
				$ntotal=($ntotal+$ttotal);
				?>
			</tr>
			<?php
            $tot=$r1[male]+$r[male];
			}
		}
	}
}
?>
		<tr height=20>
			<td align='center'><font color='red'>Total</font></td>
			<td align='center'><font color='red'><?php echo $mtotal ?></font></td>
			<td align='center'><font color='red'><?php echo $ftotal ?></font></td>
			<td align='center'><font color='red'><?php echo $ntotal ?></font></td>
		</tr>
		<?php
		$rowclass = 1 - $rowclass;	
		?> 		
</Table>
<br>
<div id='pr1' align='center'>
<INPUT TYPE="SUBMIT" class='bgbutton' NAME="print" VALUE="PRINT THE REPORT" onclick='prn()'>
</div>
</form>
</BODY>
</HTML>