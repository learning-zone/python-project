<?php
$current_date = date("d-m-Y", strtotime($_STARTOFDAY_));
$getyearn=$getyear+1;
$serial = 1;
$total = 0;
$j = 0;
$branch=$_POST['branch'];
$category=$_POST['category'];
$sem=$_POST['sem'];
?>
<html>
<script language="JavaScript">
		function prn()
		{
			pr1.style.display = "none";
			window.print();

		}
		function gen()
		{
		document.frm.action='ex_categorywise.php';
		document.frm.submit();
		}
</script>
<body>
<form name='frm' method='post'>
<input type="hidden" name="branch" value="<?=$branch?>">
<input type="hidden" name="sem" value="<?=$sem?>">
<input type="hidden" name="temp_religion" value="<?=$temp_religion?>">
<input type="hidden" name="religion" value="<?=$religion?>">
<input type="hidden" name="temp_sem" value="<?=$temp_sem?>">
<?php
session_start();
include("../db.php");
$sql2 = "select col_name from college ";
$rs2 = execute($sql2);
$row2 = rowcount($rs2);
$r2 = fetcharray($rs2,0);
$colname = $r2["col_name"];

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
		$sql = "SELECT coursename FROM course_m where course_id='$id' ";
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
				//return($ar[0]);
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
		$sql45 = execute("SELECT * FROM course_m,student_m where course_id='$branch' and course_admitted=course_id group by course_id");
	}
else
	{
		$sql45 = execute("SELECT * FROM course_m,student_m where course_admitted=course_id group by course_id");
	}
	
?>
<table class='forumline' width="90%" align='center' cellspacing="0" cellpadding="0"  border="1">
	<tr height='30'>
		<td align='center' class='head' colspan='4'><b>CATEGORY WISE REPORT LIST(DETAIL)</b></td>
	</tr>
	<tr height='30'>
		<td colspan='4' align='center' class='head'>AS ON :<?=date("d-m-Y g:i a")?> </td>
	</tr>
	<?php
	while($rs45=fetcharray($sql45))
	{
			$branch=$rs45[course_id];
			?>
			<tr height='20'>
			<td colspan='4' class='row3'>&nbsp;&nbsp;<font color='blue' size='2'><?=GetCourseName($rs45["course_id"]);?>
			&nbsp;&nbsp;&nbsp;
			
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
					 <?=GetCourseYear($rs46["year_id"])?></td>
					</tr>
					
					<?php
					if($temp_cat!=0)
						{
							$sql477="SELECT caste_id as d from student_m where caste_id='$temp_cat' and course_admitted='$branch' and course_yearsem='$sem'";
						}
					else
						{
							$sql477="SELECT distinct(caste_id) as d from student_m where course_admitted='$branch' and course_yearsem='$sem'";
						}
						
			$sql47=execute($sql477);		
			while($rs47=fetcharray($sql47))
				{				
					$casteid=$rs47[d];
					if($branch !=0 && $sem !=0 && $casteid!=0)
						{
							$sqlstr = "Select * " ;
							$sqlstr .= " from student_m where course_admitted=" . trim($branch) ;
							$sqlstr .= " and course_yearsem='$sem'"  ;
							$sqlstr .= " and archive='N' and cetcategory='$casteid' and gender='M'";

							$sqlstr1 = "Select * " ;
							$sqlstr1 .= " from student_m where course_admitted=" . trim($branch) ;
							$sqlstr1 .= " and course_yearsem='$sem'"  ;
							$sqlstr1 .= " and archive='N' and cetcategory='$casteid' and gender='F'" ;
						}
					elseif($branch ==0 && $sem !=0 && $casteid!=0)
						{
							$sqlstr = "Select * " ;
							$sqlstr .= " from student_m where " ;
							$sqlstr .= " course_yearsem='$sem' and gender='M'" ;
							$sqlstr .= " and archive='N' and cetcategory='$casteid'" ;

							$sqlstr1 = "Select * " ;
							$sqlstr1 .= " from student_m where " ;
							$sqlstr1 .= " course_yearsem='$sem'" ;
							$sqlstr1 .= " and archive='N' and cetcategory='$casteid' and gender='F'" ;
						}
					elseif($branch !=0 && $sem ==0 && $casteid!=0)
						{
							$sqlstr = "Select * " ;
							$sqlstr .= " from student_m where course_admitted=" . trim($branch) ;
							$sqlstr .= " and archive='N' and cetcategory='$casteid' and gender='M'";

							$sqlstr1 = "Select * " ;
							$sqlstr1 .= " from student_m where course_admitted=" . trim($branch) ;
							$sqlstr1 .= " and archive='N' and cetcategory='$casteid' and gender='F'";
						}
					elseif($branch ==0 && $sem ==0 && $casteid==0)
						{
							$sqlstr = "Select * " ;
							$sqlstr .= " from student_m where  gender='M'";

							$sqlstr1 = "Select * " ;
							$sqlstr1 .= " from student_m where gender='F'";
						}
					elseif($branch !=0 && $sem !=0 && $casteid==0)
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

					elseif($branch !=0 && $sem ==0 && $casteid==0)
						{
							$sqlstr = "Select * " ;
							$sqlstr .= " from student_m where course_admitted=" . trim($branch) ;
							$sqlstr .= " and archive='N' and gender='M'";

							$sqlstr1 = "Select * " ;
							$sqlstr1 .= " from student_m where course_admitted=" . trim($branch) ;
							$sqlstr1 .= " and archive='N' and gender='F'";

						}
					elseif($branch ==0 && $sem !=0 && $casteid==0)
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
					elseif($branch ==0 && $sem ==0 && $casteid!=0)
						{
							$sqlstr = "Select * " ;
							$sqlstr .= " from student_m where ";
							$sqlstr .= " cetcategory='$casteid'"  ;
							$sqlstr .= " and archive='N' and gender='M'";

							$sqlstr1 = "Select * " ;
							$sqlstr1 .= " from student_m where";
							$sqlstr1 .= " cetcategory='$casteid'"  ;
							$sqlstr1 .= " and archive='N' and gender='F'" ;
						}
	
					if(strlen($sqlstr) < 10)
					{
						die("<B align='center'>Please select a proper search criteria</b><br><Hr>");
					}
					
					$rs = execute($sqlstr) 	or die(error_description());
					$num = rowcount($rs);
					if($casteid!="")
						{
							$sql2=execute("select name from category where id='$casteid'");   
							$row=fetcharray($sql2);
							$rowclass = 1;
						}
					?>	
					<tr height='15'>
						<td colspan='4'>&nbsp;&nbsp;<font color='blue'><?php echo $row[name] ?>
						<font color='blue'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>MALE</b></td>
					</tr>
					
					<tr height='20'>
						<td align='center' class='row3'><b>Sl.No</b></td>
						<td align='center' class='row3'><b>Registration No.</b></td>
						<td align='center' class='row3'><b>Name</b></td>
						<td align='center' class='row3'><b>Seat Category</b></td>
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
								<td>&nbsp;&nbsp;<?=GetSeatCategory($r["admission_type"]);?></td>
							</tr>
							<?php
						}
					if(strlen($sqlstr1) < 10)
						{
							die("<B align='center'>Please select a proper search criteria</b><br><Hr>");
						}
					$rs1 = execute($sqlstr1) 	or die(error_description());
					$num1 = rowcount($rs1);
					if($casteid!="")
						{
							$sql2=execute("select name from category where id='$casteid'");
							$row=fetcharray($sql2);
							$rowclass = 1;
						}
				?>
				<tr>
					<td colspan='4'>&nbsp;&nbsp;<font color='blue'><?php echo $row["name"]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>FEMALE</b></td>
				</tr>
				<?php
				for($i=0;$i<$num1;$i++)
					{
						$r1 = fetcharray($rs1,$i);
						?>
						<tr height='20'>
							<td>&nbsp;&nbsp;<?php echo $i+1 ?></td>
							<td>&nbsp;&nbsp;<?php echo $r1["student_id"] ?></td>
							<td>&nbsp;&nbsp;<?php echo $r1["first_name"] ." ".$r1["last_name"] ?></td>
							<td>&nbsp;&nbsp;<?=GetSeatCategory($r1["admission_type"]);?></td>
						</tr>
						<?php
							 $name=$r1["first_name"] ." ".$r1["last_name"];				
					}
			}
		}
	}
?>
</Table>
<br>
<div id='pr1' align='center'>
<INPUT TYPE="SUBMIT" class='bgbutton' NAME="print" VALUE="PRINT" onclick='prn()'>
<span class='spc'><INPUT TYPE="SUBMIT" class='bgbutton' NAME="excel" VALUE="EXPORT" onclick='gen()'></span>

</div>
</form>
</BODY>
<style>
.spc{
padding-left:50px;
}
</style>
</HTML>