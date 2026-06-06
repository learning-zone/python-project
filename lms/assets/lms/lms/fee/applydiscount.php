<?php
session_start();
include("../db.php");
//print_r($_SESSION);
$academic_year=$_SESSION['AcademicYear'];
if($_GET['std'])
{
	$tablename='student_m';
	$archive="archive='N'";
}
else
{
	$tablename='student_m_pre';
	$archive="archive='Y'";
}
if(!$_POST)
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
	$a_year=$academic_year;
}
elseif($_POST)
{
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$class_section_id=$_POST['class_section_id'];
	$app_no=$_POST['app_no'];
	$studfname=$_POST['studfname'];	
	$generate = $_POST['generate'];
	$a_year=$_POST['a_year'];
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
if($generate)	
{
	$newst=$_POST['studentid'];
	
	for($i=0;$i<sizeof($newst);$i++)
	{
		
		$id=$newst[$i];
		
		$dis_type=$_POST['dis_type'.$id];
		
		
		$fee1=execute("select discount_id from  fee_discount_student where student_id='$id' and acc_year='$a_year' and status='1' ");
		if(rowcount($fee1)>0)
		{
			$sql1="update `fee_discount_student` set `discount_id`='$dis_type' where student_id='$id'  and acc_year='$a_year' and status='1' ";
		}
		else
		{
			if($dis_type)
			{
				$sql1="INSERT INTO `fee_discount_student` (`student_id`, `discount_id`, `acc_year`, `status`) VALUES ('$id','$dis_type', '$a_year', '1')";
			}
			else
			$sql1='';
		}			
		execute($sql1);		
		
		
	}//ends here


	?>
    <script language="javascript">
	alert("Updated successfully ");
    </script>
    <?php	

}
// ends here
?>
<form method='post' action="" name="frm" >
<table class='forumline' align='center' width="90%" ><tr><td Class="Head" colspan='7' align='center'>Search Student Detials</td></tr>
<tr height='30'>
<td>&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>
<td><select name="branch" onChange="reload(this.value)">
<option value="0">---------------Select---------------</option>
<?php
$sql="select course_id,coursename from course_m";
$rs=execute($sql);
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
</select>
</div>
</td>
</tr>
    <tr>
	<td>&nbsp;&nbsp;Academic Year   </td>
	<td align='' colspan="3">
    <select name="a_year" id="a_year" OnChange='frm_reload()'>
                <option value='0'>Select Year</option>
                <?php
				   $MyYear=date('Y')-10;
				   $CurrentYr=date("Y")+2;
				   for($i=$MyYear;$i<$CurrentYr;$i++)
					 {
						$Fyear=$i;
						$Tyear=$i+1;
						$Tyear=substr($Tyear,2);
						$sele="";
						if($a_year=='')
						{
							if($i==date('Y'))
							$sele="selected";
						}
						else
						{
							if($i==$a_year)
							$sele="selected";
						}

						?>
					<option value="<?=$i?>" <?=$sele?>><?=$Fyear?>- <?=$Tyear?></option>
						<?php
					 }
						   ?>
              </select>
	</tr>
</table><br>
<div align=center>
<input type="submit" class='bgbutton' value="Search" name="studdet">
</div>
<br>
<?php

if($branch!=0)
{
	$countid = "select count(id) as count from interview where class = '$sem'";
	$res = execute($countid);
	$r=fetcharray($res);
	
	$count = $r[0];
}
	$sql="select id, first_name, admission_date, last_name, admission_type from $tablename where id is not null and $archive and academic_year = '$academic_year'";
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
	?><input type="hidden" name="studentid[]" value="<?=$r[id]?>">
    <td   align='center' ><?=$sno?></td>
    <td align="center">&nbsp;&nbsp;<?=$r[id]?></td>
    <td>&nbsp;&nbsp;<?=$r[first_name].' '.$r[3]?></td>
    <td>&nbsp;&nbsp;<?=$r[admission_date]?></td>
    <td align="center">
    <select name="dis_type<?=$r[id]?>" OnChange=go()>
    <option value="0" >Select</option>
		<?php
		$fee1=fetchrow(execute("select discount_id from  fee_discount_student where student_id='$r[id]' and acc_year='$a_year' and status='1' "));
        $qq="select disscountType from  fee_discount_det where admissionType='$r[4]' and status=1 group by disscountType";
        $qqq=execute($qq);
        for($k=0;$k<rowcount($qqq);$k++)
        {
			$disname=fetchrow(execute("select name from fee_discount_head where id='$myq[0]'"));
			
			$myq=fetcharray($qqq);
			if($fee1[0]==$myq[0])
			{
				?>
				<option value="<?=$myq[0]?>" selected><?=$disname[0]?></option>
				<?php
			}
			else
			{
				?>
				<option value="<?=$myq[0]?>"> 
				<?=$disname[0]?>
				</option>
				<?php
			}
        }
        ?>
    </select>
    </td>
    </tr>
	<?php
	$sno++;
	$rowclass = 1 - $rowclass;
}
	
?>
</table>
<br>
<div align=center>
<input type="submit" class='bgbutton' value="Update" name="generate">
</div>
</form>
</body>
</html>