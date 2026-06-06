<?php
session_start();
include("../db.php");
$academic_year=$_SESSION['AcademicYear'];

if(!$_POST and !$_GET)
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];

}
elseif(!$_POST and $_GET)
{
	$sem=$_REQUEST['sem'];
	$branch=$_REQUEST['branch'];
	$studfname=$_REQUEST['searchField'];
	$class_section_id=$_REQUEST['class_section_id'];
}
else
{

	$sem=$_POST['sem'];
	$branch=$_POST['branch'];
	$app_no=$_POST['app_no'];
	//$studfname=$_POST['studfname'];	
	$studfname=$_POST['searchField'];
	$class_section_id=$_POST['class_section_id'];
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="autocomplete.css" type="text/css" media="screen">
<script src="jquery.js" type="text/javascript"></script>
<script src="dimensions.js" type="text/javascript"></script>
<script src="autocomplete.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function(){
	    setAutoComplete("searchField", "results", "autocomplete.php?part=");
	});
</script>

<script>
function OpenWind2(URL, title,w,h)
{
 var left = (screen.width/2)-(w/2);
 var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=no, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>

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
<script type="text/javascript">
function ReloadMe()
{
    document.frm.action="rfid_view_stud.php";
	document.frm.submit();
}
</script>
<script LANGUAGE="JavaScript">
	function student(str)
	{
		alert(str);
		var url="student.php";
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
				document.getElementById("student").innerHTML=xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET",url,true);
		xmlhttp.send();
	}
</script>

<title>RFID</title>
</head>
<body>
<br>
<fieldset >
<legend>RFID
</legend>
    <input type="radio" name="typeval" onClick="student(1)"  value="1">Staff
    <input type="radio" name="typeval" onClick="student(2)" value="2">Student
    <input type="radio" name="typeval" onClick="student(3)" value="3">Father
    <input type="radio" name="typeval" onClick="student(4)" value="4">Mother
    <input type="radio" name="typeval" onClick="student(6)" value="5">Care Giver
    <input type="radio" name="typeval" onClick="student(7)" value="6">Vehicle
    <input type="radio" name="typeval" onClick="student(8)" value="7">Visitor
</fieldset>
	<form method='post' action="rfid_view_stud.php" name="frm" >

    <table class='forumline' align='center' width="90%" ><tr><td Class="Head" colspan='7' align='center'>Search Student Detials</td></tr>

    

	<tr height='30'>

		<td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>

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

	<td>&nbsp;&nbsp;&nbsp;&nbsp;Section</td><td><select name='class_section_id'>

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

		<td><input type="text"  name='app_no' value="" size="30" ></td></tr>

	<tr height='30'>

		

		<td>&nbsp;&nbsp;&nbsp;&nbsp;Student Name</td>
		<td colspan="3" id="auto">
        <input type="text" name="searchField" id="searchField" value="<?=$studfname?>"  onChange="get(this.value)" autocomplete="off" ></td></tr>
	</table><br>

	<div align=center>

	<input type="submit" class='bgbutton' value="Search" name="studdet">

	</div>

	</form>

<?php

if(!$_POST['studdet'] and ! $_REQUEST)

die();

	$sql="select id,student_id,usn,first_name,last_name,admission_id from student_m where id is not null and archive='N' and academic_year='$academic_year'";

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

	 	$sql.=" and first_name like '$studfname%'";

	}

 $sql.=" order by first_name";

		$rs=execute($sql) or die(mysql_error());



	if(rowcount($rs)==0)

	{

		echo "<font><b>No Records Found !!</b></font>";

		die();

	}



?>



<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='90%'>

<tr><td align='center' class='head' colspan='5'>Student Details</td>

</tr>

<tr height='25' >

<td Class="rowpic" align='center'>Sl No</td>

<td Class="rowpic" align='center'>Student ID</td>

<td Class="rowpic" align='center'>Admission No</td>

<td Class="rowpic" align='center'>Student Name</td></tr>

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
		<td align="center">&nbsp;&nbsp;
        <a href="javascript:void(0);" onClick ="OpenWind2('rfid_det.php?StudID=<?php echo $r[id]?>', 'OpenWind2',1000,600)"><?=$r[student_id]?></a></td>

        <TD align="center"><?=$r['admission_id']?></TD>

		<td>&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?=$r[last_name]?></td></tr>

		<?php

		$sno++;

		$rowclass = 1 - $rowclass;

	}

?>

</table>
</body>
</html>