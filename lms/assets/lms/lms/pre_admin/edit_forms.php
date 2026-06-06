<?php
session_start();
require_once("../db.php");


/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

$academic_year=$_SESSION['AcademicYear'];

if(!$_POST)
{

	$sem=$_SESSION['sem'];
	$branch=$_SESSION['branch'];	
}
elseif($_POST)
{
	$sem=$_POST['sem'];
	$branch=$_POST['branch'];
	$app_no=$_POST['app_no'];
	$studdet=$_POST['studdet'];
	$studfname=$_POST['studfname'];	
	$appl_no = $_POST['appl_no'];
	$class_section_id=$_POST['class_section_id'];

}
else
{
	
	$branch=$_REQUEST['branch'];
	$sem=$_REQUEST['sem'];
	$class_section_id=$_REQUEST['class_section_id'];

}
//echo "Branch :".$branch;

//echo "Sem :".$sem;

?>
<html>
<head>
<title>Student Application form</title>
<script language="javascript">
function OpenWind2(URL,title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank,titlebar=no,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
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
</head>
<body>
<?php
$rs = execute("SELECT * FROM student_m_pre limit 1");
$num = rowcount($rs);
if($num > 0)
{
	?>
	<form method='post' action="edit_forms.php" name="frm" >
    <table class='forumline' align='center' width="90%" >
    <tr>
    	<td Class="Head" colspan='7' align='center'>MODIFY STUDENT DETAILS</td>
    </tr>
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
	<tr height='30'>

	<td>&nbsp;&nbsp;Application No</td>

		<td><input type='text' name='app_no' value=""></td>

		<td>Student Name</td>

		<td colspan="3" ><input type='text' name='studfname' value=""></td></tr>

	</table><br>

	<div align=center>

	<input type="submit" class='bgbutton' value="Search" name="studdet">

	</div>

	</form>

	<?php

}

else
{

	?>

	<td><?=die("<p align=center>No Student Record</p>")?></td>

	<?php

}



	
$sql="SELECT `id`, `first_name`, `admission_date`, `course_yearsem` FROM `student_m_pre` WHERE `id` is not null AND archive='Y' and academic_year = '$academic_year'";

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

 $sql.=" order by first_name";


 //echo $sql;

		$rs=execute($sql) or die(mysql_error());



if(rowcount($rs)>0)
{
	
 ?>
<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='90%'>
<tr>
	<td align='center' class='head' colspan='6'>STUDENT DETAILS</td>
</tr>
<tr height='25' >
    <td Class="rowpic" align='center'>Sl No</td>
    <td Class="rowpic" align='center'>Application Id</td>
    <td Class="rowpic" align='center'>Student Name</td>
    <td Class="rowpic" align='center'>Grade</td>
    <td Class="rowpic" align='center'>Application Date</td>
    <td Class="rowpic" align='center'>Action</td>
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
			echo "<tr class='clsname' > ";
		else
			echo "<tr >";

		?>

		<td   align='center' ><?=$sno?></td>

		<td align="center">&nbsp;&nbsp;<?=$r[id]?></td>

		<td>&nbsp;&nbsp;<?=$r[first_name]?></td>
        
        <td align="center">&nbsp;&nbsp;<?php

		$course_yearsem=fetchrow(execute("select year_name from course_year where year_id='$r[course_yearsem]'"));

		echo $course_yearsem[0];

		?></td>

        <td align="center"><? print( date("d-M-Y", strtotime($r['admission_date'])) ); ?></td>

        <td align='center' title="Click here to View Details" >
        <a href="javascript:void(0);" onClick ="OpenWind2('edit.php?appl_no=<?php echo $r[id]?>', 'OpenWind2',1000,800)">Edit</a></td>

        </td>

    </tr>

		<?php

		$sno++;

		$rowclass = 1 - $rowclass;

	}

?>
</table>
<?
}else{
		die("<p align=center><font color=#FF0000>No Record Found !</font></p>");
}
?>
</body>
</html>