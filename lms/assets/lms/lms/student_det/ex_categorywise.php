<?php
$file_type = "vnd.ms-excel";
$file_name= "Admission_Details.xls";
header("Content-Type: application/$file_type");
header("Content-Disposition: attachment; filename=$file_name");
?>
<HTML>
 <HEAD>
 </head>
 <BODY>
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
		<td align='center' colspan='4' class='head'><b>CATEGORY WISE REPORT LIST(DETAIL)</b></td>
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
					 <?=GetCourseYear($rs46["year_id"])?></td>
					</tr>
					
					<?php
					if($temp_cat!=0)
						{
							$sql477="SELECT distinct(cetcategory) as d from student_m where cetcategory='$temp_cat' and course_admitted='$branch' and course_yearsem='$sem'";
						}
					else
						{
							$sql477="SELECT distinct(cetcategory) as d from student_m where course_admitted='$branch' and course_yearsem='$sem'";
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
</BODY>
</HTML>
