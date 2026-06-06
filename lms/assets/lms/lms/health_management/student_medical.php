<html>
<?php
session_start();
require("../db.php");
$per00=$_SESSION['per00'];
if($per00==1)
{
	echo "<font color='red'>This link will work only for student's an parent's </font> ";
	die();
}

	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];	
	$grade=$sem;
	$user=$_SESSION['user'];
$sql=execute("select id ,student_id ,first_name ,last_name ,admission_id ,class_section_id from student_m where student_id='$user'");
while($r=fetcharray($sql))
{
	$class_section_id=$r['class_section_id'];
	$id=$r['id'];
	$student_name=$r['first_name']." ".$r['last_name'];
}

$ad =$_SESSION['AcademicYear'];

$st =$student_name;
$sid =$user;

?>

<head>
<script>
function printReport()
{
	prn.style.display='none';
	print(this.form);
	prn.style.display=='';
}
function ga()
{
  document.frmMedicaldetail.action='viewadd_main.php';
  document.frmMedicaldetail.submit();
}
</script>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Medical Details for</title>
</head>

<body>

        <form name="frmMedicaldetail" method="post">
		
<SCRIPT language=javascript>
		
		function trim(par)
{	
	
	y=par.length;
	ret='';
	for (i=0;i<y;i++)
	{
		if (par.charAt(i)!=' ')
		{
			ret=ret+par.charAt(i);
		}
	}
	
	return ret;
	
}


function frmMedicaldetail_submit1()
{
	frmMedicaldetail.txhControl.value = "Back";
	document.frmMedicaldetail.submit();
}	

		</SCRIPT>
<?php
	$query=execute("select * from stud_health where studid='$sid'");
if(rowcount($query)==0)
die("Records not found ");
?>
			<table class='forumline' cellspacing=0 width="60%"  align="center" border=1>
			<tr>
			<td vAlign="top" align="Center"  height="30" colspan=4 class=head>
			Medical Details of  
			<?php echo $st?> </td>
		</tr>
		<?
		$r=fetcharray($query);
		{
		?>
		
				
				<tr class="keyrow">
					<td  >
					<?php
					  $cr=execute("select * from course_year where year_id='$sem'");
				   $rtt=fetcharray($cr);
					?>
				  <?php echo $_SESSION['semname']; ?></td>
					
					<td  nowrap >&nbsp;&nbsp;<?php echo $rtt[year_name]?></td>
					<td  nowrap>
					Academic Year</td>
					<td  nowrap >&nbsp;<?php echo $ad?></td>
				</tr>
				<tr vAlign="top" align="left">
					<td class="keycell" nowrap >
					&nbsp;Height in cms </td>
					<td colSpan="3">
					&nbsp;
					<?php echo $r['height'] ?>
					</td>
				</tr>
				<tr vAlign="top" align="left">
					<td class="keycell" nowrap>
					&nbsp;Weight </td>
					<td colSpan="3">
                    &nbsp;
					<?php echo $r['weight'] ?>
					</td>
				</tr>
				<tr>
					<td class="keycell" nowrap >
					&nbsp;General Examination </td>
					<td colSpan="3">
                    &nbsp;
					<?php echo $r['general_exam'] ?></td>
				</tr>
				<tr>
					<td class="keycell" nowrap>
					&nbsp;Vision </td>
					<td colSpan="3">
                    &nbsp;
					<?php echo $r['vision'] ?></td>
				</tr>
				<tr>
					<td class="keycell" nowrap>&nbsp;Dental </td>
					<td colSpan="3">
                    &nbsp;
					<?php echo $r['dental'] ?>
				 </td>
				</tr>
				<tr>
					<td class="keycell" nowrap>
					&nbsp;Cardiovascular Examination </td>
					<td colSpan="3">   &nbsp;<?php echo $r['cardio_exam'] ?> </td>
				</tr>
				<tr>
					<td class="keycell" nowrap>
					&nbsp;Chest Exam </td>
					<td colSpan="3">
                    &nbsp;
					<?php echo $r['chest_exam']?>
					</td>
				</tr>
				<tr>
					<td class="keycell" nowrap>
					&nbsp;Urine Microscopic Examination </td>
                    
					<td colSpan="3">&nbsp;<?php echo $r['urine_exam'] ?>	</td>
				</tr>
				<tr>
					<td class="keycell" nowrap >&nbsp;Blood Examination </td>
                    
					<td colSpan="3">&nbsp;<?php echo $r['blood_exam']?>
					</td>
				</tr>
				<tr>
					<td class="keycell" nowrap>&nbsp;Remarks </td>
                    
					<td colSpan="3">&nbsp;<?php echo $r['remarks'] ?></td>
				</tr>

                                    <tr><td colspan="4">&nbsp;</td></tr>
		                    <tr><td colspan=4 align=left>Report Date : <?php echo date("d-m-Y",strtotime($r['rep_date']))?></td></tr>
				<?
		}

					?>
			
		
				<tr>
					<td class="keycell" nowrap colSpan="4">Abbreviations used</td>
				</tr>
				<tr>
					<td class="keycell" nowrap colSpan="4">WNL - Within Normal Limits</td>
				</tr>

				<tr>
					<td class="keycell" nowrap colSpan="4">NAD - Nothing Abnormal Detected</td>
				</tr>
					<tr>
					<td class="keycell" nowrap colSpan="4">
					For More details please contact infirmary at Campus </td>
				</tr>
				
				</tr>
				
</table><br>
<div align=center>
				
				
				<div id='prn' align=center colspan=5>
	                        <td><input type=button name='prn' value="Print" class='bgbutton' onclick='printReport()'>
			</td>
			<td>&nbsp;</td>
		</tr>
				</div>
	</form>
</table>
</body>
</html>
