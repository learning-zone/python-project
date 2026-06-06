<?php
session_start();
include("../db.php");
$accyear=$_SESSION['AcademicYear'];

if($_POST)
{
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$student_id=$_POST['student_id'];
	$studfname=$_POST['studfname'];
	$a_year=$_POST['a_year'];
}
else
{
	$a_year=$_SESSION['AcademicYear'];
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
}
?>
<html>
<head>
<script LANGUAGE="JavaScript">
function send()
{
	if(document.frm.studfname.value=='' && document.frm.student_id.value=='' && document.frm.sem.value==0)
	{
		alert ("Enter Student ID or Name or Semester Details ... ");
		return false;
	}
	document.frm.action='fee_rec.php';
	document.frm.submit();
}
function frm_reload()
{
	document.frm.action='fee_rec.php';
	document.frm.submit();
} 
function OpenWind(k)
{
	var finalVar;
	finalVar=k;
	window.open(finalVar,'Stud','height=700,width=1000,status=no,toolbar=no,scrollbars=yes,menubar=no,location=no');
}

</script>
</head>
<body>
<form method='post' action="fee_rec.php" name="frm" >

<table class='forumline' align='center' width='90%'><tr><td Class="Head" colspan='5' align='center'> Collect Fees </td></tr>
<tr>
<td>&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>
	<td>
		<select name="branch" onchange='frm_reload()'>
		<option value="0">---- Select ----</option>
			<?php
				$sql="select course_id,coursename from course_m order by head_id,coursename";
				$rs=execute($sql);
				for($i=0;$i<rowcount($rs);$i++)
				{
				  $r=fetcharray($rs);

					if($branch==$r[course_id])
					{
						?>
						<option value="<?=$r[course_id]?>" selected><?php echo $r[coursename] ?></option>
						<?php
					}
					else
					{
						?>
						<option value="<?php echo $r[course_id] ?>"><?=$r[coursename]?></option>
						<?php
					}
				}
			?>
		</select>
	</td>
		<td>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>
	<td><select name="sem" onchange='frm_reload()'>
		<option value='0'>------ Select -----</option>
		<?php
			$rs1=execute("select * from course_m where course_id=$branch");
			$hdid=fetcharray($rs1);
			$hd_id=$hdid[head_id];
			$rs=execute("SELECT year_name,year_id FROM course_year where head_id='$hd_id'");
			while($r=fetcharray($rs))
			{
				if($sem==$r[year_id])
				{
					echo "<option value='$r[year_id]' selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $r[year_name]</option>";
				}
				else
				{
					echo "<option value='$r[year_id]'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $r[year_name]</option>";
				}
			}
		?>
		</select>
	</td></tr>
	<!--<tr>
	<td>&nbsp;&nbsp;Student ID</td>
	<td align=''><input type='text' name='student_id' value=""></td>
	<td>&nbsp;&nbsp;Student Name</td>
	<td align=''><input type='text' name='studfname' value=""></td></tr>
    <tr>-->
	<td>&nbsp;&nbsp;Academic Year   </td>
	<td align='' colspan="3">
    <select name="a_year" id="a_year" OnChange='frm_reload()'>
                <option value='0'>Select Year</option>
                <?php
				   $MyYear=date('Y')-10;
				   $CurrentYr=date("Y")+2;
				   for($i=$MyYear;$i<$CurrentYr;$i++)
					 {
						$Fyear=$i;
						$Tyear=$i+1;
						$Tyear=substr($Tyear,2);
						$sele="";
						if($a_year=='')
						{
							if($i==date('Y'))
							$sele="selected";
						}
						else
						{
							if($i==$a_year)
							$sele="selected";
						}

						?>
					<option value="<?=$i?>" <?=$sele?>><?=$Fyear?>- <?=$Tyear?></option>
						<?php
					 }
						   ?>
              </select>
	</tr>

</table><br>
<div align='center'>
<input type="submit" class='bgbutton' value="Submit" name="studdet" OnClick=" return send()">
    &nbsp;&nbsp;<a href= "javascript:OpenWind('feeSettings.php?addyear=<?=$a_year?>')"><input type="button" align="center" class="bgbutton" value="Add Fee Settings"></a> 		
</td>
</div></div><br>
<?php
if($sem)
{
	$sem1[]=$sem;
}
elseif($branch and !$sem)
{
	$sem2=execute("SELECT year_id
FROM `course_year` where status=1 and head_id='$branch' order by year_id");
	while($r1=fetcharray($sem2))
	{
		$sem1[]=$r1[0];
	}

}
else
{
	$sem2=execute("SELECT year_id
FROM `course_year` where status=1 order by head_id, year_id");
	while($r1=fetcharray($sem2))
	{
		$sem1[]=$r1[0];
	}
}
		$sno=1;

if($sem1)
{
	


	?>
	<table border=1 class=forumline align=center width='90%' cellspacing='0' cellpadding='1'>
	<tr><td align='center' class='head' colspan='5'>Student Details</td>
	</tr>
	<tr height='30'>
	<td Class="rowpic" align='center' nowrap>Sl No</td>
	<td Class="rowpic" align='center' nowrap>Admission ID</td>
    <td Class="rowpic" align='center' nowrap>Status</td>
	<td Class="rowpic" align='center' nowrap>Student Name</td>
	<td Class="rowpic" align='center' nowrap><?php echo $_SESSION['semname']; ?></td>
   	
</tr>
	<?php
	for($k=0;$k<sizeof($sem1);$k++)
	{
		$sem=$sem1[$k];
		$sql="select a.id,a.student_id,a.first_name,a.last_name,a.admission_type,a.course_admitted,a.course_yearsem,a.academic_year,a.class_section_id,a.adm_yr,a.admission_id from student_m a,fee_apply_fee_student b  where a.archive='N' and b.acc_year='$a_year' and a.id=b.student_id and b.status='1' and b.division='$sem' ";
		
		
		
		
		$sql.=" order by a.course_admitted, a.course_yearsem, a.class_section_id, a.first_name";
		
		
		
		$rs=execute($sql);
		$fg=0;
		for($i=0;$i<rowcount($rs);$i++)
		{
			$r=fetcharray($rs);
			$cyr=$r[academic_year];
			$admitedyear=$r[adm_yr];
			if($academic_year)
			
			$a_year;
							
			$slab_id=fetchrow(execute("select slab_id from fee_slab_student where status='1' and  student_id='$r[id]' and acc_year='$a_year'"));
			$chkstud=fetchrow(execute("select uid, currency from fee_m_descrption where status='1' and  adm_cat='$r[admission_type]'  and class='$sem' and accyear='$slab_id[0]'"));
			
			
	$fee12=execute("select uid,no_of_instal, currency from  fee_m_descrption where uid='$chkstud[0]'");
	while($r2=fetcharray($fee12))
	{
		$no_of_instal=$r2[1];
		$currency=$r2[2];
	}
	$installid=fetchrow(execute("select count(installmentId) from fee_m_collect  where studentId='$r[0]' and accYear=$a_year and status=1"));
	
		if($installid[0]==$no_of_instal)
		$displayval="<font color='#003300'>Paid</font>";// all the installment amount cleared
		else
		$displayval="<font color='#FF0000'>Due</font>";// all the installment amount cleared
		
			
			
			
			if($chkstud[0])
			{
				$fg=1;
				if($sno<10)
					$sno="0".$sno;
				echo "<tr height='23'><td align='center'>$sno</td>";
				if($installid[0]==$no_of_instal)
				echo "<td align='center'>$r[admission_id]</td>";
				else
				{
					?>
				<td align="center" >
				   <A HREF="javascript:OpenWind('fee_add.php?stud_id=<?php echo $r[id]?>&course=<?php echo $r[course_admitted] ?>&sem=<?=$sem?>&adm_id=<?php echo $r[admission_type] ?>&stud_yr=<?php echo $r[academic_year]?>&a_year=<?=$a_year?>&admited_yr=<?=$r['adm_yr']?>');"><?php echo $r[admission_id] ?></A>	
				  </td>
                <?php
				}
				?>  
                  <td align="center" >( <?=$displayval?> )</td>
				<td>&nbsp;&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?php echo $r[last_name]?></td>
				<?php
				$cname=fetcharray(execute("select year_name from course_year where year_id='$sem'"));
				
				echo "<td align='center'>$cname[0]</td>";

							
			
				//echo "<td align='right'>$amt</td>";
				
				echo '</tr>';
				$sno++;
			}
			
		}
	}

	
}
else
{
		echo "<b>No Student Records Found !!</b>";
		die();
}
?>
</table>

</form>
</body>
</html>