<html>
<script language="JavaScript">
function prn()
{
	pr1.style.display = "none";
	window.print();
}
function gen()
{
	document.frm.action='ex_viewreligion.php';
	document.frm.submit();
}
</script>
<body>
<?php
	session_start();
	include("../db.php");
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$religion=$_POST['religion'];
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
?>
<form name="frm" method="post">
<input type="hidden" name="branch" value="<?=$branch?>">
<input type="hidden" name="sem" value="<?=$sem?>">
<input type="hidden" name="temp_religion" value="<?=$temp_religion?>">
<input type="hidden" name="religion" value="<?=$religion?>">
<input type="hidden" name="temp_sem" value="<?=$temp_sem?>">
<table class='forumline' border='1' width='80%' cellspacing="0" cellpadding="0" align="center"  >
	<tr height='30'>
		<td align='center' colspan='4' class='head'><b>RELIGION WISE LIST(DETAIL)</b></td>
	</tr>
	
	<?php
		while($rs45=fetcharray($sql45))
			{
				$branch=$rs45[course_id];
	?>
	
	<?php
		if($branch!=0)
			{
				$sql46 = execute("SELECT year_id FROM course_year WHERE head_id='$branch'") or die("sdfds");
			}
		else
			{
				$sql46 = execute("SELECT year_id FROM course_year") or die("cvcvzx");
			}
		while($rs46=fetcharray($sql46))
			{
				$sem=$rs46[year_id];
	?>
	<tr height='25'>
		<td colspan='4' align='center' Class="row3"><font color='blue' size='2'> <?=GetCourseYear($rs46["year_id"])?></td>
	</tr>
	<tr height='30'>
		<td align='center'><font size='2.5'>Sl.No</font></td>
	  	<td align='center'><font size='2.5'>Registration No.</font></td>
	  	<td align='center'><font size='2.5'>Name</font></td>
	  	<td align='center'><font size='2.5'>Fee Category</font></td>
	</tr>
	<?php
		if($temp_religion!=0)
			{
				$sql477="SELECT distinct(religion) as d from student_m where religion='$temp_religion' and course_admitted='$branch' and course_yearsem=$sem";
			}
		else
			{
				$sql477="SELECT distinct(religion) as d from student_m where course_admitted='$branch' and course_yearsem='$sem'";
			}
			
		$sql47=execute($sql477) or die();
		$rowc=rowcount($sql47);
		while($rs47=fetcharray($sql47))
			{	
				$religion=$rs47[d];
				if($branch !=0 && $sem !=0 && $religion!="")
					{
						$sqlstr = "Select * " ;
						$sqlstr .= " from student_m where course_admitted=" . trim($branch) ;
						$sqlstr .= " and course_yearsem='$sem'"  ;
						$sqlstr .= " and archive='N' and religion='$religion' and gender='M'";

						$sqlstr1 = "Select * " ;
						$sqlstr1 .= " from student_m where course_admitted=" . trim($branch) ;
						$sqlstr1 .= " and course_yearsem='$sem'"  ;
						$sqlstr1 .= " and archive='N' and religion='$religion' and gender='F'" ;
					}
				elseif($branch ==0 && $sem !=0 && $religion!="")
					{
						$sqlstr = "Select * " ;
						$sqlstr .= " from student_m where " ;
						$sqlstr .= " course_yearsem='$sem' and gender='M'" ;
						$sqlstr .= " and archive='N' and religion='$religion'" ;

						$sqlstr1 = "Select * " ;
						$sqlstr1 .= " from student_m where " ;
						$sqlstr1 .= " course_yearsem='$sem'" ;
						$sqlstr1 .= " and archive='N' and religion='$religion' and gender='F'" ;
					}
				elseif($branch !=0 && $sem ==0 && $religion!="")
					{
						$sqlstr = "Select * " ;
						$sqlstr .= " from student_m where course_admitted=" . trim($branch) ;
						$sqlstr .= " and archive='N' and religion='$religion' and gender='M'";

						$sqlstr1 = "Select * " ;
						$sqlstr1 .= " from student_m where course_admitted=" . trim($branch) ;
						$sqlstr1 .= " and archive='N' and religion='$religion' and gender='F'";
					}
				elseif($branch ==0 && $sem ==0 && $religion=="")
					{
						$sqlstr = "Select * " ;
						$sqlstr .= " from student_m where  gender='M'";

						$sqlstr1 = "Select * " ;
						$sqlstr1 .= " from student_m where gender='F'";
					}
				elseif($branch !=0 && $sem !=0 && $religion=="")
					{
						$sqlstr = "Select * " ;
						$sqlstr .= " from student_m where course_admitted=" . trim($branch) ;
						$sqlstr .= " and course_yearsem='$sem'"  ;
						$sqlstr .= " and archive='N' and gender='M'";

						$sqlstr1 = "Select * " ;
						$sqlstr1 .= " from student_m where course_admitted=" . trim($branch) ;
						$sqlstr1 .= " and course_yearsem='$sem'"  ;
						$sqlstr1 .= " and archive='N' and gender='F'" ;
					}
				elseif($branch !=0 && $sem ==0 && $religion=="")
					{
						$sqlstr = "Select * " ;
						$sqlstr .= " from student_m where course_admitted=" . trim($branch) ;
						$sqlstr .= " and archive='N' and gender='M'";

						$sqlstr1 = "Select * " ;
						$sqlstr1 .= " from student_m where course_admitted=" . trim($branch) ;
						$sqlstr1 .= " and archive='N' and gender='F'";
					}
				elseif($branch ==0 && $sem !=0 && $religion=="")
					{
						$sqlstr = "Select * " ;
						$sqlstr .= " from student_m where" ;
						$sqlstr .= " course_yearsem='$sem'" ;
						$sqlstr .= " and archive='N' and gender='M'";

						$sqlstr1 = "Select * " ;
						$sqlstr1 .= " from student_m where";
						$sqlstr1 .= " course_yearsem='$sem'"  ;
						$sqlstr1 .= " and archive='N' and gender='F'" ;
					}
				elseif($branch ==0 && $sem ==0 && $religion!="")
					{
						$sqlstr = "Select * " ;
						$sqlstr .= " from student_m where ";
						$sqlstr .= " religion='$religion'"  ;
						$sqlstr .= " and archive='N' and gender='M'";

						$sqlstr1 = "Select * " ;
						$sqlstr1 .= " from student_m where";
						$sqlstr1 .= " religion='$religion'"  ;
						$sqlstr1 .= " and archive='N' and gender='F'" ;
					}
				
				if(strlen($sqlstr) < 10)
					{
						die("<B align='center'>Please select a proper search criteria</b><br><Hr>");
					}
				$rs = execute($sqlstr) 	or die(error_description());
				$num = rowcount($rs);			
				if($religion!="")
					{
						if(strlen($religion)>1) 
							{
								$religion=4;
							}
						$sql2=execute("select name from religion where id='$religion'");
						$row=fetcharray($sql2);
					}
			?>
			<tr height='20'>
				<td align='center'><font color='blue'><b><?php echo $row[name] ?></b></td>
				<td colspan='3'><font color='blue'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MALE</b></td>
			</tr>
			<?php
			for($i=0;$i<$num;$i++)
				{
					$r = fetcharray($rs,$i);
					?>
					<tr height='20'>
						<td>&nbsp;&nbsp;<?php echo $i+1 ?></td>
						<td>&nbsp;&nbsp;<?php echo $r["student_id"] ?></td>
						<td>&nbsp;&nbsp;<?php echo $r["first_name"] ." ".$r["last_name"] ?></td>
						<td>&nbsp;&nbsp;<?=GetSeatCategory($r[admission_type]);?></td>
					</tr>
					<?php
				}
			if(strlen($sqlstr1) < 10)
				{
					die("<B align='center'>Please select a proper search criteria</b><br><Hr>");
				}
			$rs1 = execute($sqlstr1) 	or die(error_description());
			$num1 = rowcount($rs1);
			if($religion!="")
			$rowclass = 1;
				{
					$sql2=execute("select name from religion where id='$religion'");
					$row=fetcharray($sql2);
				}
		    ?>
			<tr height='20'>
				<td align='center'><font color='blue'><b><?=$row["name"]?></b></td>
				<td colspan='3'><font color='blue'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FEMALE</b></td>
			</tr>
			<?php
			for($i=0;$i<$num1;$i++)
				{
					$r1 = fetcharray($rs1,$i);
					?>
					<tr height='20'>
						<td>&nbsp;&nbsp;<?php echo $i+1?></td>
						<td>&nbsp;&nbsp;<?php echo $r1["student_id"] ?></td>
						<td>&nbsp;&nbsp;<?php echo $r1["first_name"] ." ".$r["last_name"] ?></td>
						<td>&nbsp;&nbsp;<?=GetSeatCategory($r1[admission_type]);?></td>
					</tr>
					<?php
				}		
		}
	}
}
?>
</Table>
<div id='pr1' align='center'>
	<INPUT TYPE="SUBMIT" class='bgbutton' NAME="print" VALUE="PRINT " onclick='prn()'>&nbsp;&nbsp;
	<span class="spc"><INPUT TYPE="SUBMIT" class='bgbutton' NAME="print" VALUE="Export" onclick='gen()'></span>
	
</div>
</form>
</BODY>
<style>
.spc{
padding-left:50px;
}
</style>
</HTML>