<?php
session_start();
include("../db.php");
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";

$academic_year=$_SESSION['AcademicYear'];
if($_SESSION)
{
	$sem=$_SESSION['sem'];
	$branch=$_SESSION['branch'];
}
if($_POST)
{
	$sem=$_POST['sem'];
	$app_no=$_POST['app_no'];
	$branch=$_POST['branch'];
	$studfname=$_POST['studfname'];
	$class_section_id=$_POST['class_section_id'];	
	
}
if($_GET)
{
	$sem=$_REQUEST['sem'];
	$branch=$_REQUEST['branch'];
}
?>
<html>
<head>
<title>SELECT STUDENT</title>
<script LANGUAGE="JavaScript">
function reload()
{
	document.frm.action='search_student_det.php'
	document.frm.submit();
}
</script>
<script type="text/javascript">
function reloadMe(token)
{ 
	 window.opener.location.href="lib.php?tmid="+token+"&medtyp=1&type=1";
	 window.close();
}
</script>
</head>
<body>
<?php

$rs = execute("SELECT * FROM student_m limit 1");
$num = rowcount($rs);
if($num > 0)
{
	?>
	<form method='post' action="search_student_det.php" name="frm" >
	
 <table class='forumline' align='center' width="90%" >
  <tr>
    <td Class="Head" colspan='7' align='center'>SELECT STUDENT ID</td>
  </tr>   
  <tr height='30'>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>
		<td><select name="branch" onChange="reload()">
			<option value="0">-----------  Select  ------------</option>
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
        <select name="sem" onChange="reload()">
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
	<td>&nbsp;&nbsp;&nbsp;&nbsp;Section</td>
    <td><select name='class_section_id'>
	<?PHP
    
      $sql=execute("SELECT * FROM class_section WHERE class_id='$sem'");
      echo "<option value=''>--- Select ---</option>";
          while($r=fetcharray($sql))
          {
              if($class_section_id==$r['id'])
                echo "<option value='$r[id]' selected>$r[section_name]</option>";
              else
                echo "<option value='$r[id]' >$r[section_name]</option>";
          }
    ?>
    </select>
</td>
	<td>Student Id</td>
		<td><input type='text' name='app_no' value=""></td></tr>
	<tr height='30'>
		
		<td>&nbsp;&nbsp;&nbsp;&nbsp;Student Name</td>
		<td colspan="3" ><input type='text' name='studfname' value=""></td></tr>
	</table><br>
	<div align=center>
	<input type="submit" class='bgbutton' value="Search" name="studdet">
	</div>
	
	<?php
}
else
{
	?>
	<td>No studentid Record</td>
	<?php
}
?>
<?php
if(!$_POST['studdet'])
die();
	$sql="select id,student_id,usn,first_name,last_name from student_m where id is not null and archive='N' and academic_year='$academic_year' ";
	if($app_no!='')
	{
	 $sql.=" and student_id='$app_no'";
	}
	if($branch!=0)
	{
	$sql.=" and course_admitted=$branch";
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
 
 	//echo "<br>".$sql;

		$rs=execute($sql) or die(mysql_error());

	if(rowcount($rs)==0)
	{
		echo "<font ><b>No Records Found !!</b></font>";
		die();
	}

?>
<BR>
<table border="1" class="forumline" align="center" cellspacing="0" cellpadding="0" width='70%'>
<tr height='25' >
    <td Class="rowpic" align='center'>Sl No</td>
    <td Class="rowpic" align='center'>Student ID</td>
    <td Class="rowpic" align='center'>Student Name</td>
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
			echo "<tr class='clsname'>";
		else
			echo "<tr >";
		?>
	
		<td align='center' ><?=$sno?></td>
		
       <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
               
 <td align='center'><font color="#0033FF"><u><a LANGUAGE="JavaScript" onClick="reloadMe('<?=$r[student_id]?>')"><?=$r[student_id]?></a></font></u></td>
      
         
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?=$r[last_name]?></td></tr>
		<?php
		$sno++;
		$rowclass = 1 - $rowclass;
	}
?>
</table>
<!--<input type="hidden" name="tmid" value="<?=$tmid?>">-->
</form>
</body>
</html>