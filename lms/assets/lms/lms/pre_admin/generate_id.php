<?php
session_start();
include("../db.php");
//print_r($_SESSION);
if(!$_POST)
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
}
elseif($_POST)
{
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$class_section_id=$_POST['class_section_id'];
	$app_no=$_POST['app_no'];
	$studfname=$_POST['studfname'];	
	$generate = $_POST['generate'];
	
}
else
{
	$branch=$_REQUEST['branch'];
	$sem=$_REQUEST['sem'];
	$class_section_id=$_REQUEST['class_section_id'];

}

?>

<html>
<head>
<title>Student ID</title>
</head>

<body>
<script LANGUAGE="JavaScript">
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


<?php
//starts here
if(isset($generate))	
{
	$cmaxid = "select max(id) from student_m";
	$cr = execute($cmaxid);
	$cr1 =fetcharray($cr);
	//echo $cr1[0];
	//echo "<br>";
	$sql="select id,first_name,admission_date from student_m where id is not null and archive='N' ";
	//echo $sql;
	if($app_no!='')
	{
	 $sql.=" and id='$app_no'";
	}
	if($branch!=0)
	{
	$sql.=" and course_admitted='$branch'";
	}
	if($sem!=0)
	{
	$sql.=" and course_yearsem='$sem'";
	}
	if($class_section_id!='')
	{
	$sql.=" and class_section_id='$class_section_id'  ";
	}
	
	if($studfname!='')
	{
	 $sql.=" and first_name like '$studfname%'";
	}
 $sql.=" and (student_id='' or student_id='NULL' or student_id='null' )  order by first_name";
 $rs=execute($sql);
 if(rowcount($rs)!=0)
 {
 ?>
 <table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='90%'>
<tr><td align='center' class='head' colspan='5'>Student Details</td>
</tr>
<tr height='25' >
<td Class="rowpic" align='center'>Sl No</td>
<td Class="rowpic" align='center'>Application Id</td>
<td Class="rowpic" align='center'>Student Name</td>
<td Class="rowpic" align='center'>Student ID</td>
</tr>
<?php
 }
 //$rows = rowcount($rs);
 for($i=0;$i<rowcount($rs);$i++)
 {
	 $new = $cr1[0] + $i + 1;
	 $newid = $_SESSION['SchoolCode'].'12'.$new;
	 $r=fetcharray($rs);
	 //echo "<br>NEW ID :".$newid."<br>";
	 $nsql = "update student_m set student_id = '$newid' where id = '$r[id]'";	
	 //echo $nsql."<br>";
	 execute($nsql) or die(mysql_error());
	 
	 $newsql = "select id, first_name,student_id from student_m where id = '$r[id]'";
	 $newrs=execute($newsql);
	 $newr=fetcharray($newrs);
	 //echo $newrs[first_name];
	 //echo $newrs[student_id];
	?>
        <td   align='center' ><?=$i + 1?></td>
		<td align="center">&nbsp;&nbsp;<?=$newr[id]?></td>
		<td>&nbsp;&nbsp;<?=$newr[first_name]?></td>
        <td>&nbsp;&nbsp;<?=$newr[student_id]?></td>        
        </tr>
    <?php
 }
 ?>
 <script language="javascript">
 alert("ID Generated Successfully");
 </script>

 <?php
 die();
}
// ends here
$rs = execute("SELECT * FROM student_m limit 1");
$num = rowcount($rs);
if($num > 0)
{
	?>
	<form method='post' action="generate_id.php" name="frm" >
	
    <table class='forumline' align='center' width="90%" ><tr><td Class="Head" colspan='7' align='center'>Search Student Detials</td></tr>
    
	<tr height='30'>
		<td>&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>
		<td><select name="branch" onChange="reload(this.value)">
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
        <select name="sem">
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
<?php
/*
	<tr>

	<td>Section</td><td><select name='class_section_id'>
<?
$rs_section=execute("select * from class_section");
echo "<option value=''>--Select--</option>";

for($i=0;$i<rowcount($rs_section);$i++)
{
	$r_section=fetcharray($rs_section,$i);
	echo "<option value='$r_section[id]'>$r_section[section_name]</option>";

}
?>
</select>
</td>
	
        */
?>	
<!--
	<tr height='30'>
	<td>&nbsp;&nbsp;Application No</td>
		<td><input type='text' name='app_no' value=""></td>
		<td>Student Name</td>
		<td colspan="3" ><input type='text' name='studfname' value=""></td></tr> 
        -->
	</table><br>
	<div align=center>
	<input type="submit" class='bgbutton' value="Search" name="studdet">
	</div>
	<br>
	<?php
}
else
{
	?>
	<td>No student Record</td>
	<?php
}
?>
<?php
if(!$_POST['studdet'])
die();
	//echo $sql;
	$sql="select id,first_name,admission_date from student_m where id is not null and archive='N' ";
	//echo $sql;
	if($app_no!='')
	{
	 $sql.=" and id='$app_no'";
	}
	if($branch!=0)
	{
	$sql.=" and course_admitted='$branch'";
	}
	if($sem!=0)
	{
	$sql.=" and course_yearsem='$sem'";
	}
	if($class_section_id!='')
	{
	$sql.=" and class_section_id='$class_section_id'  ";
	}
	
	if($studfname!='')
	{
	 $sql.=" and first_name like '$studfname%'";
	}
 $sql.=" and (student_id='' or student_id='NULL' or student_id='null' )  order by first_name";
// echo $sql; 
		$rs=execute($sql) or die(mysql_error());

	if(rowcount($rs)==0)
	{
		echo "<center>No Records Found !! </center>";
		die();
	}

?>

<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='90%'>
<tr><td align='center' class='head' colspan='5'>Student Details</td>
</tr>
<tr height='25' >
<td Class="rowpic" align='center'>Sl No</td>
<td Class="rowpic" align='center'>Application Id</td>
<td Class="rowpic" align='center'>Student Name</td>
<td Class="rowpic" align='center'>Application Date</td>
</tr>
<?php
  $rowclass=1;
  $sno=1;
	for($i=0;$i<rowcount($rs);$i++)
	{
		$r=fetcharray($rs);
		if($sno<10)
			$sno="0".$sno;
		if($i%2)
		echo "	<tr class='clsname' > ";
		else
		echo "	<tr > ";
		?>
	
		<td   align='center' ><?=$sno?></td>
		<td align="center">&nbsp;&nbsp;<?=$r[id]?></td>
		<td>&nbsp;&nbsp;<?=$r[first_name]?></td>
        <td>&nbsp;&nbsp;<?=$r[admission_date]?></td>        
        </tr>
		<?php
		$sno++;
		$rowclass = 1 - $rowclass;
	}
	
?>
</table>
<br>
<div align=center>
<input type="submit" class='bgbutton' value="Generate ID" name="generate">
</div>


</form>
</body>
</html>