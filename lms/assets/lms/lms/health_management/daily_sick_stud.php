<html>
<head>
<?php
	session_start();
	include("../db.php");

	$academic_year=$_SESSION['AcademicYear'];
	
	if(!$_POST and !$_REQUEST)
	{
		$branch=$_SESSION['branch'];
		$sem=$_SESSION['sem'];
		
	}
	elseif(!$_POST and $_REQUEST)
	{
		$branch=$_REQUEST['branch'];
		$sem=$_REQUEST['sem'];
		$class_section_id=$_REQUEST['class_section_id'];
	}
	else
	{
		$branch=$_POST['branch'];
		$sem=$_POST['sem'];
		$class_section_id=$_POST['class_section_id'];
		$app_no=$_POST['app_no'];
		$studfname=$_POST['studfname'];	
	}
?>

<script language="javascript">
function cli()
{
	document.form1.action="daily_sick_stud.php";
	document.form1.submit();
}
function reload(str)
{
var url="../sessionbranchfile.php";
url=url+"?q="+str;
url=url+"&sid="+Math.random();

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint9").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}

</script>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="File-List" href="SICK%20REPORT_files/filelist.xml">
<title>New Page 1</title>
</head>
<body>
<p>&nbsp;</p>
<form name="form1" method="post" action="daily_edit_medical_rep.php">
  <table class='forumline' align='center' width="90%" >
<tr>
  <td align=center colspan=4  class=head>Student Medical Report</td></tr>
	<tr height='30'>
		<td><?php echo $_SESSION['branchname']; ?></td>
		<td><select name="branch" onChange="reload(this.value)" style="width:170px">
			<option value="0">---------------Select---------------</option>
				<?php
					$sql="select course_id,coursename from course_m";
					$rs=execute($sql) or die(error_description());
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
			<td> <?php echo $_SESSION['semname']; ?></td>
		<td><div id="txtHint9" class="inline">
        <select name="sem" style="width:170px">
			<option value='0'>----------Select---------</option>
			<?php
				$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");
				while($r=fetcharray($rs))
				{
					if($sem==$r[year_id])
					{
						echo "<option value='$r[year_id]' selected>$r[year_name]</option>";
					}
					else
					{
						echo "<option value='$r[year_id]'>$r[year_name]</option>";
					}
				}
			?>
			</select></div>

		</td>
	</tr>
	<tr>
	<td>Section</td><td><select name='class_section_id' style="width:100px">
<?
$rs_section=execute("select * from class_section");
echo "<option value=''>--Select--</option>";

for($i=0;$i<rowcount($rs_section);$i++)
{
	$r_section=fetcharray($rs_section,$i);
	if($class_section_id==$r_section[id])
	{
		echo "<option value='$r_section[id]' selected>$r_section[section_name]</option>";
	}
	else
	{
		echo "<option value='$r_section[id]'>$r_section[section_name]</option>";
		
	}
}
?>
</select>
</td>
	<td>Student Id</td>
		<td><input type='text' name='app_no' value="" style="width:100px"></td></tr>
	<tr height='30'>
		
		<td>Student Name</td>
		<td colspan="3" ><input type='text' name='studfname' value=""></td></tr>
</table><br>
<div align="center"><input type="button" name="Submit" value="Submit" class="bgbutton" onClick="cli()"  ></div> 
<br>
<?php
if(!$_POST['studdet'] and ! $_REQUEST)
die();
	$sql="select id, student_id,  usn, first_name, last_name, course_admitted, academic_year, course_yearsem,gender from student_m where id is not null and archive='N' and academic_year='$academic_year'";
	if($app_no!='')
	{
	 $sql.=" and student_id='$app_no'";
	}
	if($sem!=0)
	{
	$sql.=" and course_yearsem=$sem";
	}
	if($class_section_id!='')
	{
	$sql.=" and class_section_id=$class_section_id  ";
	}
	
	if($studfname!='')
	{
	 $sql.=" and (first_name like '$studfname%' or last_name like '$studfname%')";
	}
 	$sql.=" order by first_name";

	if(rowcount($rs)==0)
	{
		//echo "<font><b>No Records Found !!</b></font>";
		//die();
	}

?>

<input type=hidden name='grade' value='<?php echo $grade?>'>
<table  class='forumline' cellspacing=0 width="90%" align=center> 
		<tr><td colspan=6 align=center  class=head>Student Details</td></tr>
		<tr>
		        <td align=center>Student Name</td>
			<td align=center>Identification Number</td>
			<td align=left>Sex</td>
			<td align=center>Age(Yrs.)</td>
			<td align=center>Admission Type</td>
			<td align=center>Academic Year</td>
		</tr>
	<?php
    $df=execute($sql);
    while($ddf=fetcharray($df))
    {
		$fname=$ddf[first_name]." ".$ddf[last_name];
		$mm=$ddf[admission_type];
		$ecc=execute("select * from admission where id='$mm'");
		$ec=fetcharray($ecc);		 
		$cdat=date('Y-m-d');
		$ddat=$ddf[dob];
		$hai=$ddf[gender];
		
		if($ddat=='')
		$h='NULL';
		else
		$h=$cdat-$ddat;
		
		//$diff=date_diff($cdat,$ddat,$h);
		if($hai=='F')
		{
			$ss='Female';
		}
		if($hai=='M')
		{
			$ss='Male';
		}
		
		?>
		<tr>
		<td align="center">&nbsp;&nbsp;<?php echo $fname?></td>
		<td align=center><a href='daily_treatment_stud.php?id=<?=$ddf[id]?>&stud=<?php echo $ddf[student_id]?>&grade=<?php echo $ddf[course_admitted]?>&ad=<?php echo $ddf[academic_year]?>&ag=<?php echo $h?>&gen=<?php echo $ss?>&adm=<?php echo $ddf[admission_type]?>&branch=<?php echo $ddf[course_admitted]?>&class_section_id=<?php echo $class_section_id?>&sem=<?php echo $sem?>'>
		<?php echo $ddf[student_id]?></a></td>
		<td ><?php echo $ss?></td>
		<td >&nbsp;&nbsp;<?php echo $h?></td>
		<td ><?php echo $ec[name]?></td>
		<td align=center><?php echo $ddf[academic_year]?></td>
		</tr>
    <?php
    }
    ?>
    
	</table>

</form>
</body>
</html>
