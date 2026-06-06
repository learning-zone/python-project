<?php
session_start();
require_once("../db.php");
/*
echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";
*/
$academic_year=$_SESSION['AcademicYear'];

if($_GET)
{
	$sem=$_REQUEST['sem'];
    $branch=$_REQUEST['branch'];
	$class_section_id=$_REQUEST['class_section_id'];
}
if($_POST)
{
	$sem  = $_POST['sem'];
	$m_id = $_POST['m_id'];
	$branch = $_POST['branch'];
	$studdet = $_POST['studdet'];
	$appl_no = $_POST['appl_no'];
	$studfname = $_POST['studfname'];	
	$student_id = $_POST['student_id'];
	$class_section_id = $_POST['class_section_id'];

}
?>
<html>
<head>
<title>MISCELLANEOUS FEE COLLECT</title>
<script language="javascript">
function OpenWind2(URL,title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank,titlebar=no,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>
<script type="text/javascript">
  function reloadMe()
  {
	  document.frm.action="miscfee_collect.php";
	  document.frm.submit();
  }
</script>
</head>
<body>
<form method='post' action="miscfee_collect.php" name="frm" >
 <table class='forumline' align='center' width="90%" >
   <tr>
    	<td Class="Head" colspan='7' align='center'>MISCELLANEOUS FEE COLLECT</td>
    </tr>
    <tr>
    	<td Class="row3" colspan='7' align='center'>Search Student Details</td>
    </tr>
	<tr height='30'>
        <td align='left'>&nbsp;&nbsp;Fee Title</td>
        <td >
        <select name='m_id' onChange="reloadMe()">
        <option value='0'>-----  Select  ------</option>
        <?php
          $sqlF=execute("SELECT  id, name FROM `fee_misc_m` WHERE `status` = 1 ORDER BY id");                    
				    while($row=fetcharray($sqlF))
                    {
                        if($m_id==$row['id'])
                            echo "<option value='$row[id]' selected>$row[name]</option>";
                        else
                            echo "<option value='$row[id]' >$row[name]</option>";
							
                    }
                ?>
            </select></td>
            
		<td> <?php echo $_SESSION['semname']; ?></td>
		<td><select name="sem" disabled>
			<option value='0'>---- Apply for all ----</option>
			<?php
		$class=fetcharray(execute("SELECT `class` FROM `fee_misc_m_desc` WHERE m_id ='$m_id' LIMIT 1"));
		        $sem=$class[0];

				$rs=execute("SELECT  year_name, year_id FROM course_year");

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
		</td>
	</tr>
	<tr height='30'>
		<td>&nbsp;&nbsp;Student Name</td>
		<td><input type='text' name='studfname' value=""></td>
        
        <td>Admission ID</td>

		<td colspan="3"><input type='text' name='student_id' value=""></td>
   </tr>
 </table>
	<p align=center><input type="submit" class='bgbutton' value="Search" name="studdet"></p>
</form>
<?

if($_POST['studdet']!='')
{
	
$sql="SELECT `id`, `student_id`, `first_name`, `course_yearsem`, `academic_year` FROM `student_m` WHERE `id` is not null AND archive='N' and academic_year = '$academic_year'";

	if($student_id!='')
	{
	 	$sql.=" and student_id='$student_id'";
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
		$sql.=" and class_section_id='$class_section_id'";
	}	
	if($studfname!='')
	{
		 $sql.=" and first_name like '$studfname%'";
	}

		 $sql.=" ORDER BY first_name";

       //echo "<br>".$sql;
		$result=execute($sql) or die(mysql_error());

}

if(rowcount($result)>0)
{
	
 ?>
<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='90%'>
<tr>
	<td align='center' class='head' colspan='6'>STUDENT DETAILS</td>
</tr>
<tr height='25' >
    <td Class="rowpic" align='center'>Sl No</td>
    <td Class="rowpic" align='center'>Admission ID</td>
    <td Class="rowpic" align='center'>Student Name</td>
    <td Class="rowpic" align='center'>Grade</td>
</tr>

<?php

  $rowclass=1;

  $sno=1;

	for($i=0;$i<rowcount($result);$i++)
	{
		$r=fetcharray($result);
		if($sno<10)
			$sno="0".$sno;
			
		if($i%2)
			echo "<tr class='clsname' > ";
		else
			echo "<tr>";
			
		?>
		<td align='center'><?=$sno?></td> 
        
        <td align='center' title="Click to generate receipt" >
 <a href="javascript:void(0);" onClick ="OpenWind2('miscfee_receipt.php?student_mID=<?=$r[id]?>&academic_year=<?=$r[academic_year]?>&m_id=<?=$m_id?>', 'OpenWind2',1000,800)"><?=$r[id]?></a>
        </td>

		<td>&nbsp;&nbsp;<?=$r[first_name]?></td>
        
        <td align="center">&nbsp;&nbsp;<?php

		$course_yearsem=fetchrow(execute("select year_name from course_year where year_id='$r[course_yearsem]'"));

		echo $course_yearsem[0]; ?></td>

    </tr>

		<?php

		$sno++;

		$rowclass = 1 - $rowclass;

	}

?>
</table>
<?
}
?>
</body>
</html>