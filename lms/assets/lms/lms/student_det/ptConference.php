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
	    setAutoComplete("searchField", "results", "autocompletes.php?part=");
	});
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
    document.frm.action="ptConference.php";
	document.frm.submit();
}
</script>
<script type="text/javascript">
function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=1200,height=800,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
</script>
<title>PARENT-TEACHER MEETING</title>
</head>
<body>
<?php

$rs = execute("SELECT * FROM student_m limit 1");

$num = rowcount($rs);

if($num > 0)
{
	?>
	<form method='post' action="ptConference.php" name="frm" >
 <table class='forumline' align='center' width="90%" >
   <tr>
   		<td Class="Head" colspan='7' align='center'>PARENT-TEACHER MEETING</td>
   </tr>
	<tr height='30'>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>
		<td><select name="branch" onChange="reload(this.value)">
			<option value="0">------ Select ------</option>
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
			<option value="0">------ Select ------</option>
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
		<!--<td>&nbsp;&nbsp;&nbsp;&nbsp;Section</td><td><select name='class_section_id'>
		<?
        $rs_section=execute("select * from class_section");
        echo "<option value=''>-- Select --</option>";
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
</td>-->
	<td>&nbsp;&nbsp;&nbsp;&nbsp;Student Id</td>
	
		<td  colspan=3><input type="text"  name='app_no' value="" size="30" ></td>
    </tr>
	<tr height='30'>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;Student Name</td>
		<td colspan="3" id="auto">
<input type="text" name="searchField" id="searchField" value="<?=$studfname?>"  onChange="get(this.value)" autocomplete="off" size="30"></td></tr>
	</table><br>
	<p align=center>
	<input type="submit" class='bgbutton' value="Search" name="studdet">
	</p>
	</form>
	<?php
}
else
{	
?>
<td>No studentid Record </td>
<?php
}
?>
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
		die("<center><blink>No Records Found !!!<blink></center>");
	}
?>
<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='90%'>
<tr><td align='center' class='head' colspan='5'>STUDENT DETAILS</td>
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
			echo "<tr class='clsname'> ";
		else
			echo "<tr>";
				
    $stDet=fetcharray(execute("SELECT admission_id,student_id,usn,first_name,last_name,course_yearsem,academic_year,class_section_id,course_admitted,id FROM `student_m` WHERE student_id='$r[student_id]' LIMIT 1"));

		?>
		<td   align='center' ><?=$sno?></td>
		        
       <td align="center">&nbsp;&nbsp;
       <a href="javascript:OpenWind2('conference_edt.php?StudID=<?=$stDet['id']?>&class_section_id=<?=$stDet['class_section_id']?>&branch=<?=$stDet['course_admitted']?>&sem=<?=$stDet['course_yearsem']?>&studfname=<?=$stDet['first_name']?>&studlname=<?=$stDet['last_name']?>&a_year=<?=$stDet['academic_year']?>')" ><?=$r['student_id']?></a></td>
         
        <TD align="center"><?=$r['admission_id']?></TD>
      
		<td>&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?=$r[last_name]?></td>
        
    </tr>
		<?php

		$sno++;

		$rowclass = 1 - $rowclass;

	}

?>

</table>
</body>
</html>