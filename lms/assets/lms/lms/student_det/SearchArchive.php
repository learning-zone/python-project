<?php
session_start();
include("../db.php");

$academic_year=$_SESSION['AcademicYear'];

if($_POST)
{
	$branch=$_POST['branch'];
	$class_section_id=$_POST['class_section_id'];
	$sem=$_POST['sem'];
	$studfname=$_POST['studfname'];
	$app_no=$_POST['app_no'];
	$a_sts=$_POST['a_sts'];
}
elseif($_GET['status']=='active')
{
	$branch=$_REQUEST['branch'];
	$class_section_id=$_REQUEST['class_section_id'];
	$sem=$_REQUEST['sem'];
	$a_sts=$_REQUEST['a_sts'];
	?>
    <script language="javascript">
		alert("Updated successfully ");
    </script>
    <?php
}
else
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
}

?>
<html>
<head>
<title>Student details Modify form</title>
</head>

<body>
<script LANGUAGE="JavaScript">

function reload()

{

	document.frm.action='SearchArchive.php';

	document.frm.submit();

	

}
function send()
{
	if(document.frm1.a_sts.value=='0')
	{
		alert("Plese select Archive Status..");
		return false;
	}
	else
	{
		document.frm1.action='SearchArchive.php';
		document.frm1.submit();
	}
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
<script LANGUAGE="JavaScript">
function reloadAjax(str)
{

var url="../sessionsectionfile.php";

url=url+"?r="+str;

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

    document.getElementById("txtHint10").innerHTML=xmlhttp.responseText;

    }

  }

xmlhttp.open("GET",url,true);

xmlhttp.send();

}

</script>

<?php
$rs = execute("SELECT id FROM student_m limit 5");
$num = rowcount($rs);
if($num > 0)
{
	?>
	<form method='post' name="frm1" >
	
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
			<td><?php echo $_SESSION['semname']; ?></td>
		<td><div id="txtHint9" class="inline"> 
        	 <select name="sem" onChange="reloadAjax(this.value)">
				<option value='0'>----------Select---------</option>
			<?php
				$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");
				while($r=fetcharray($rs))
				{
					if($sem==$r[year_id])
					{
						echo "<option value='$r[year_id]' selected> $r[year_name]</option>";
					}
					else
					{
						echo "<option value='$r[year_id]'>$r[year_name]</option>";
					}
				}
			?></select>
			</div>

		</td>
	</tr>
	<tr height='30'><td>&nbsp;&nbsp;Section</td><td>
	 <div id="txtHint10" class="inline">
	<select name='class_section_id'>
<?
$rs_section=execute("SELECT * FROM student_m a,class_section b WHERE a.archive='N' and a.class_section_id=b.id and course_yearsem='$sem' group by b.id");
echo "<option value=''>--Select--</option>";
for($i=0;$i<rowcount($rs_section);$i++)
{
	$r_section=fetcharray($rs_section,$i);
	if($class_section_id==$r_section['id'])
		echo "<option value='$r_section[id]' selected>$r_section[section_name]</option>";
	else
		echo "<option value='$r_section[id]'>$r_section[section_name]</option>";

}
?>
</select>
</div>
</td>
	
		<td>Student Name</td>
		<td><input type='text' name='studfname' value=""></td></tr>
		<tr height='30'>
		<td>&nbsp;&nbsp;Student Id </td>
		<td><input type='text' name='app_no' value=""></td><td>Archive Status&nbsp;&nbsp;</td>
		<td >
        <?php
        if($a_sts=='F')
		{
			$essel='selected';
			$essel1='';
		}
		if($a_sts=='Y')
		{
			$essel1='selected';
			$essel='';
		}
		?>
        <select name="a_sts" >
			<option value='0'> select Status</option>
			<option value='F' <?php echo $essel; ?>>&nbsp;&nbsp;&nbsp;Withdrawn&nbsp;&nbsp;&nbsp;</option>
			<option value='Y' <?php echo $essel1; ?>>&nbsp;&nbsp;&nbsp;Graduate  &nbsp;&nbsp;&nbsp;</option>
             </select></td>
			 
	</tr>

	</table><br>
	<div align=center>
	<input type="button" class='bgbutton' value="Submit" name="studdet" OnClick="send()">
	</div>
	</form>
	<?php
}
else
{
	?>
	<td>No studentid Record</td>
	<?php
}
if($a_sts)
{
if($a_sts=='F' )
	$tname="student_m";
else
	$tname="archive_student";

	$sql="select id,student_id,usn,first_name,last_name from $tname where id is not null and archive!='N' and academic_year='$academic_year' ";
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
//	echo $sql;
	$rs=execute($sql) or die(mysql_error());
	if(rowcount($rs)==0)
	{
		echo "No Records Found !!";
		die();
	}

?>
<form name="frm" method="post">
<table border=1 class=forumline align=center width='90%' cellspacing=0 cellpadding=0>
<tr>
  <td align='center' class='head' colspan='4'>STUDENT DETAILS TO MODIFY</td>
</tr>
<tr height='25'>
<td Class="rowpic">&nbsp;Application No</td>

<td Class="rowpic">Student Name</td>
<td Class="rowpic">Action</td></tr>
<?php
    $rowclass=1;
	for($i=0;$i<rowcount($rs);$i++)
	{
	 $r=fetcharray($rs);
		if($i%2)
		echo "	<tr class='clsname' height='25'> ";
		else
		echo "	<tr height='25'> ";

?>
		<td>&nbsp; <?=$r[student_id]?></td>
		<td><?=$r[first_name]?>&nbsp;<?=$r[last_name]?></td>

<td><?php echo "<a href='ViewArchiveReport1.php?StudID=$r[id]&a_sts=$a_sts&class_section_id=$class_section_id&sem=$sem&branch=$branch'>Activate</a>"; ?>
</tr>
<?php
	$rowclass = 1 - $rowclass;
	}
}
?>
</table>
</form>
</body>
</html>
