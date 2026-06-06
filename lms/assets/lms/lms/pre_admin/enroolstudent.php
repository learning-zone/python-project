<?php
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";

session_start();
require_once("../db.php");

$academic_year=$_SESSION['AcademicYear'];
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

$admissiondate = date("Y-m-d");

//$academic_year = 2012;

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

	$newst=$_POST['studentid'];

	?>

    	<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='90%'>

        <tr><td align='center' class='head' colspan='5'>Student Details</td>

        </tr>

        <tr height='25' >

        <td Class="rowpic" align='center'>Application Id</td>

        <td Class="rowpic" align='center'>Student Name</td>

        <td Class="rowpic" align='center'>Student Id</td>

        <td Class="rowpic" align='center'>Application Date</td>        

        </tr>

		<?

	for($i=0;$i<sizeof($newst);$i++)

	{

		

		//end generate		

		$sql1 = "update student_m_pre set archive = 'N' where id = '$newst[$i]'";

		execute($sql1);	

		

		$sqlpre = "select * from student_m_pre where id = '$newst[$i]'";

		$rs1=execute($sqlpre);

		//generate id, username,password,parent username, password

		while($r=fetcharray($rs1))

		{			

			$sem=$r['course_yearsem'];

			$new=substr($r[academic_year],-2);

			$siddet=fetchrow(execute("SELECT student_id FROM `course_year` where year_id='$sem'"));

			$da=$siddet[0];	

			$res = execute("SELECT max(RIGHT(`admission_id`,4)) FROM `student_m` ");

			$row = fetchrow($res);

			$varb = $da.$new.($row[0]+1);

			$app_num = $varb;

			

			$sql=execute("insert into student_m SELECT * FROM `student_m_pre` WHERE  id = '$newst[$i]'");

			

			$student_id=$app_num;

			$username=$app_num;

			$password=$app_num;

			$parent_username=$app_num.'P';

			$parent_password=$app_num.'P';

			$qq=execute("update student_m set admission_id='$app_num', student_id='$student_id', username='$username', password='$password', parent_username='$parent_username', parent_password='$parent_password'  where id='$newst[$i]' ");

		}		

		//ends here

		$sqlm = "select * from student_m where id = '$newst[$i]'";

		$rsm=execute($sqlm);		

		while($r=fetcharray($rsm))

		{

			//echo "inside while";

			?>

       <tr>
            <td  ALIGN="CENTER"><?php echo $r[admission_id]; ?></td>
            <td  ALIGN="CENTER"><?php echo $r[first_name]; ?></td>
            <td  ALIGN="CENTER"><?php echo $r[student_id]; ?></td>
            <td  ALIGN="CENTER"><?php echo $r[admission_date]; ?></td>
       </tr>
            <?php				
		}

		}		

?>

</table>

<br>

<br>

<?php

	}

// ends here

?>

<form method='post' action="enroolstudent.php" name="frm" >

<table class='forumline' align='center' width="90%" >
<tr>
	<td Class="Head" colspan='7' align='center'>ENROLLMENT</td>
</tr>
<tr height='30'>
<td>&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>
<td><select name="branch" onChange="reload(this.value)">
<option value="0">-------------  Select  --------------</option>

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

<option value='0'>----------  Select  ---------</option>

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

</select>

</div>

</td>

</tr></table><br>

<div align=center>

<input type="submit" class='bgbutton' value="Search" name="studdet">

</div>

<br>

<?php

if(!$_POST['studdet'])

die();

if($branch!=0)

{

	$countid = "select count(id) as count from interview where class = '$sem'";

	$res = execute($countid);

	$r=fetcharray($res);

	

	$count = $r[0];

}

	$sql="select id,first_name,admission_date from student_m_pre where id is not null and archive='Y' and academic_year = '$academic_year'";

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

	if($count)

	{

		$sql.=" and class_section_id='$count' ";

	}

 $sql.=" order by first_name";





//echo $sql; 

$rs=execute($sql);



if(rowcount($rs)==0)

{

	echo "<center>No Records Found !!!! </center>";

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

<td Class="rowpic" align='center'>Select</td>

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

    <td align="center"><? print( date("d-M-Y", strtotime($r['admission_date'])) ); ?></td>

    <td align="center"><input type="checkbox" name="studentid[]" value="<?=$r[id]?>"></td>

    </tr>

	<?php

	$sno++;

	$rowclass = 1 - $rowclass;

}

	

?>

</table>

<br>

<div align=center>

<input type="submit" class='bgbutton' value="Enroll Student" name="generate">

</div>

</form>

</body>

</html>