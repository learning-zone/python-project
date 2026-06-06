<html>
<script language="JavaScript">
function prn()
{
	pr1.style.display = "none";
	window.print();
}
</script>
<body>
<?php
	session_start();
	include("../db.php");
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$religion=$_POST['religion'];
	function GetReligion($id)
		{	
			if($id)
				{
					$sql = "SELECT name FROM religion where id='$id'";
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
							return("Unknown Religion name $id");
						}
				}
		}
	function GetSeatCategory($id)
		{
			if($id)
				{
					$sql = "SELECT name FROM admission where id='$id'";
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
			$sql = "SELECT year_name FROM course_year WHERE year_id='$id' ";
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
	$temp_religion=$religion;
	if($branch!=0 and $sem!='0')
		{	
			$sql45 = execute("SELECT * FROM course_m a,student_m b where a.course_id='$branch' and b.course_admitted='$sem' group by course_id");
		}
		elseif($branch!=0 and $sem=='0')
		{	
			$sql45 = execute("SELECT * FROM course_m a,student_m b where a.course_id='$branch' group by course_id");
		}
		else
		{
			$sql45 = execute("SELECT * FROM course_m a,student_m b where b.course_admitted=a.course_id group by course_id");
		}

if(mysql_num_rows($sql45)==0)
die('NO RECORDS FOUND');
?>
<table class='forumline' border='1' width='75%' cellspacing="0" cellpadding="0" align="center"  >
	<tr height='30'>
		<td align='center' colspan='4' class='head'><b>RELIGION WISE LIST</b></td>
	</tr>
	<tr height='30'>
		<td colspan='4' align='center' class='head'>AS ON :<?=date("d-m-Y g:i a")?> </td>
	</tr>
	<?php
		while($rs45=fetcharray($sql45))
			{
				$branch=$rs45[course_id];
	?>
	<tr>
		
    <td colspan='4' align='center' Class="row3"><font color='blue' size='2'>School Division
      <?=GetCourseName($rs45["course_id"]); ?>
    </td>
	</tr>
	<?php
		if($branch!=0)
			{
				$sql46 = execute("SELECT year_id FROM course_year WHERE head_id='$branch'") or die("sdfds");
			}
		else
			{
				$sql46 = execute("SELECT year_id FROM course_year" ) or die("cvcvzx");
			}
		while($rs46=fetcharray($sql46))
			{
				$sem=$rs46[year_id];
	?>
	<tr>
		
    <td colspan='4' align='center' Class="row3"> 
      <?=GetCourseYear($rs46["year_id"])?>
    </td>
	</tr>
	<tr height='20'>
		<td align='center' class='row3'><font size='2' color='blue'>Religion</font></td>
	  	<td align='center' class='row3'><font size='2' color='blue'>Male</font></td>
	  	<td align='center' class='row3'><font size='2' color='blue'>Female</font></td>
	  	<td align='center' class='row3'><font size='2' color='blue'>Total</font></td>
	</tr>
	<?php
		if($temp_religion!=0)
			{
				$sql47=execute("select distinct(religion) as id from student_m where religion=$temp_religion and course_admitted=$branch and course_yearsem='$sem'");
			}
		else
			{
				$sql47=execute("select distinct(religion) as id from student_m where course_admitted=$branch and course_yearsem='$sem'");
			}
		while($rs47=fetcharray($sql47))
			{
				$religion=$rs47[id];
				if($branch !=0 && $sem !=0 && $religion!=0)
				{
					$sqlstr = "select count(*) as male from $_DATABASE_.student_m where course_admitted=" . trim($branch) ;
					$sqlstr .= " and course_yearsem='$sem'" ;
					$sqlstr .= " and archive='N' and religion=$religion and gender='M'" ;

					$sqlstr1 = "select count(*) as male from $_DATABASE_.student_m where course_admitted=" . trim($branch) ;
					$sqlstr1 .= " and course_yearsem='$sem'" ;
					$sqlstr1 .= " and archive='N' and religion=$religion and gender='F'" ;
				}
				elseif($branch ==0 && $sem !=0 && $religion!=0)
					{
						$sqlstr = "select count(*) as male" ;
						$sqlstr .= " from $_DATABASE_.student_m where " ;
						$sqlstr .= " course_yearsem='$sem'" ;
						$sqlstr .= " and archive='N' and religion=$religion and gender='M'" ;

						$sqlstr1 = "select count(*) as male" ;
						$sqlstr1 .= " from $_DATABASE_.student_m where " ;
						$sqlstr1 .= " course_yearsem='$sem'" ;
						$sqlstr1 .= " and archive='N' and religion=$religion and gender='F'" ;
					}
				elseif($branch !=0 && $sem ==0 && $religion!=0)
					{
						$sqlstr = "select count(*) as male" ;
						$sqlstr .= " from $_DATABASE_.student_m where course_admitted=" . trim($branch) ;
						$sqlstr .= " and archive='N' and religion=$religion and gender='M'" ;

						$sqlstr1 = "select count(*) as male" ;
						$sqlstr1 .= " from $_DATABASE_.student_m where course_admitted=" . trim($branch) ;
						$sqlstr1 .= " and archive='N' and religion=$religion and gender='F'" ;
					}
				elseif($branch ==0 && $sem ==0 && $religion!=0)
					{
						$sqlstr = "Select count(*) as male";
						$sqlstr .= " from $_DATABASE_.student_m religion=$religion and gender='M'" ;

						$sqlstr1 = "Select count(*) as male";
						$sqlstr1 .= " from $_DATABASE_.student_m religion=$religion and gender='F'" ;
					}
				elseif($branch !=0 && $sem ==0 && $religion==0)
					{
						$sqlstr = "select count(*) as male" ;
						$sqlstr .= " from $_DATABASE_.student_m where course_admitted=" . trim($branch) ;
						$sqlstr .= " and archive='N' and gender='M'" ;

						$sqlstr1 = "select count(*) as male" ;
						$sqlstr1 .= " from $_DATABASE_.student_m where course_admitted=" . trim($branch) ;
						$sqlstr1 .= " and archive='N' and gender='F'" ;
					}
				elseif($branch !=0 && $sem !=0 && $religion==0)
					{
						$sqlstr = "select count(*) as male" ;
						$sqlstr .= " from $_DATABASE_.student_m where course_admitted=" . trim($branch) ;
						$sqlstr .= " and course_yearsem=$sem and archive='N' and gender='M'" ;

						$sqlstr1 = "select count(*) as male" ;
						$sqlstr1 .= " from $_DATABASE_.student_m where course_admitted=" . trim($branch) ;
						$sqlstr1 .= " and course_yearsem=$sem and archive='N' and gender='F'" ;
					}
				elseif($branch ==0 && $sem !=0 && $religion==0)
					{
						$sqlstr = "select count(*) as male" ;
						$sqlstr .= " from $_DATABASE_.student_m where" ;
						$sqlstr .= "  course_yearsem=$sem and archive='N' and gender='M'" ;

						$sqlstr1 = "select count(*) as male" ;
						$sqlstr1 .= " from $_DATABASE_.student_m where";
						$sqlstr1 .= "  course_yearsem=$sem and archive='N' and gender='F'" ;
					}
				elseif($branch ==0 && $sem ==0 && $religion==0)
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
				$r = fetcharray($rs,0);
				$r1 = fetcharray($rs1,0);
				if($religion!="")
					{
						$csql="select * from religion where id=$religion";
						$crs=execute($csql);
						$crow=fetcharray($crs);
						$religionname=$crow[1];
					}
		?>
			<tr height='20'>
			<td align='center'><?php echo $religionname ?></td>
			<td align='center'><?php echo $r[male] ?></td>
			<td align='center'><?php echo $r1[male] ?></td>
			<td align='center'><?php echo ($r1[male]+$r[male]) ?></td>
			<?php	
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
?>
		<tr height='25'>
			<td align='center'><font color='red' size='2'>Total</font></td>
			<td align='center'><font color='red' size='2'><?php echo $mtotal ?></font></td>
			<td align='center'><font color='red' size='2'><?php echo $ftotal ?></font></td>
			<td align='center'><font color='red' size='2'><?php echo $ntotal ?></font></td>
		</tr>
</Table>
<br>
<div id='pr1' align='center'>
<INPUT TYPE="SUBMIT" class='bgbutton' NAME="print" VALUE="PRINT" onclick='prn()'>
</div>
</form>
</BODY>
</HTML>