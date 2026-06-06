<?php
session_start();
include("../db.php");

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
<title>Student details Modify form</title>
</head>

<body>
<script LANGUAGE="JavaScript">
function formSubmit()

{

	if(document.frm.branch.selectedIndex != 0 && document.frm.sem.selectedIndex != 0)

		document.frm.submit();

	else

		alert("Please select School Division and Grade !!");
	
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
function reload11(str)

{

var url="../sessionsecitonfile.php";

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

    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;

    }

  }

xmlhttp.open("GET",url,true);

xmlhttp.send();

}
</script>

<?php
$esub=execute("select * from subject_m where elective='Y' and course_id='$branch' and course_year_id='$sem'");
$ss=rowcount($esub);
if($ss > 0)
{
	$bb="$esub";
}
$rs = execute("SELECT * FROM student_m limit 1");
$num = rowcount($rs);
if($num > 0)
{
	?>
<form method="POST" action="student_elective_sub_report.php"  name="frm">


	
    <table class='forumline' align='center' width="90%" ><tr><td Class="Head" colspan='7' align='center'>Search Student Detials</td></tr>
    
	<tr height='30'>
		<td><?php echo $_SESSION['branchname']; ?></td>
		<td><select name="branch" onChange="reload(this.value)">
			<option value="0">--------Select---------</option>
				<?php
					$sql="select course_id,coursename from course_m";
					$rs=execute($sql) or die(error_description());
					for($i=0;$i<rowcount($rs);$i++)
					{
					  $r=mysql_fetch_array($rs);

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
	<td></td>
		<td></td></tr>
	
	</table><br>
	<div align=center>
    <input type="button" value="View Report" onClick="formSubmit()" class='bgbutton'>
	
	</div>
	</form>
	<?php
}
else
{
	?>
	<td>No Studentid Record</td>
    
	<?php
}
?>

    
	

</body>
</html>