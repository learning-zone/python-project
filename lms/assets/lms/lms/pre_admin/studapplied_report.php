<?php
session_start();
include("../db.php");
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

	$status = $_POST['status'];

	$app_no=$_POST['app_no'];

	$studfname=$_POST['studfname'];	

	$appl_no = $_POST['appl_no'];

	

}

else
{

	$sem=$_REQUEST['sem'];
	$branch=$_REQUEST['branch'];
	$class_section_id=$_REQUEST['class_section_id'];
}
?>
<html>
<head>
<title>WALK-IN ENQUIRY</title>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
<script LANGUAGE="JavaScript">
function reload1()
{
	document.frm.action = "studapplied_report.php";
	document.frm.submit();
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
<body>
<?php
$rs = execute("SELECT * FROM student_m_pre limit 1");
$num = rowcount($rs);
if($num > 0)
{
	?>
	<!-- <form method='post' action="onlineforms_report.php" name="frm" > -->    
	 <form method='post' action="studapplieddis.php" name="frm" > 
    <table class='forumline' align='center' width="90%" >
    <tr>
    	<td Class="Head" colspan='7' align='center'>WALK-IN ENQUIRY</td>
     </tr>
	<tr>

		<td nowrap>&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>

		<td><select name="branch" onChange="reload(this.value)">

			<option value="0">---------------  Select  ---------------</option>

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
	  <td nowrap> &nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>
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

			</select></div>

		</td>
        </tr>
      <tr>
		   <td nowrap>&nbsp; Status</td>
           <td> 
			<?php
				if($status == 1)
					$sel1 = "selected";
				if($status == 2)
					$sel2 = "selected";
            ?>
			<select name="status" onChange="reload1()" >
              <option value="0">---- select ----</option>                 
              <option value="1" <?php echo $sel1; ?>> Approved</option>
              <option value="2" <?php echo $sel2; ?>> Rejected</option>                  
            </select></td>              
           <td nowrap>&nbsp;&nbsp;Date</td>
            <td><input type="text" name="adate" value="<?=$fdate?>" readonly size="10">
                 <a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
                &nbsp;To&nbsp;<input type="text" name="bdate" value="<?=$fdate?>" readonly size="10">
                 <a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
                 
            </td>
        </tr>                
</table><br>

    <?php

		$sql="select count(id) from student_m_pre where id is not null and academic_year = '$academic_year'";

		if($status=='1')

		{

		$sql.= " and archive ='Y'";

		}

		if($status=='2')

		{

		 $sql.= " and archive = 'F'";

		}			

		if($branch!=0)

		{

		$sql.=" and course_admitted='$branch'";

		}

		if($sem!=0)

		{

		$sql.=" and course_yearsem='$sem'";

		}	

	 $sql.=" order by first_name";

	//echo $sql;

			$rs=fetchrow(execute($sql));
   }

?>

		<div align=center>
		<input type="submit" class='bgbutton' value="Search" name="studdet">
		</div>
    </form>
</body>
</html>

