<?php
session_start();
include("../db.php");
$academic_year=$_SESSION['AcademicYear'];
if($_POST)
{
	$subject=$_POST['subject'];
	$description=$_POST['description'];
	$notes=$_POST['notes'];
	$reported_by=$_POST['reported_by'];
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$class_section_id=$_POST['class_section_id'];
	$app_no=$_POST['app_no'];
	$studfname=$_POST['studfname'];	
}
if($_REQUEST)
{
	$StudID=$_REQUEST['StudID'];
	$app_num=$_REQUEST['app_num'];
	$class_section_id=$_REQUEST['class_section_id'];
	$branch=$_REQUEST['branch'];
	$sem=$_REQUEST['sem'];
	$studfname=$_REQUEST['studfname'];
	$a_year=$_REQUEST['a_year'];
	$un=$_REQUEST['un'];
	$Submit=$_REQUEST['Submit'];	
	
}

if($_POST['adate'])
{
	$adate=$_POST['adate'];
}
else
{
	$adate=date("d/m/Y");
}
if($_POST['bdate'])
{
	$bdate=$_POST['bdate'];
}
else
{
	$bdate=date("d/m/Y");
}

if($_GET['action']=='delete')
{
		$BID=$_GET['BID'];
		$StudID=$_GET['StudID'];
		
		$sql="UPDATE `student_behaviour_type` SET status=0 WHERE `id`= '$BID' AND `student_id`= '$StudID'";
	  //echo $sql;
	  execute($sql) or die(mysql_error());
     ?>
      <script language="javascript">
        alert("Deleted  Successfully ");
		</script>
     <?php
}

if($_GET['action']=='activate')
{
		$BID=$_GET['BID'];
		$StudID=$_GET['StudID'];
		
		$sql="UPDATE `student_behaviour_type` SET status=1 WHERE `id`= '$BID' AND `student_id`= '$StudID'";
	  //echo $sql;
	  execute($sql) or die(mysql_error());
     ?>
      <script language="javascript">
        alert("Activated  Successfully ");
		</script>
     <?php
}
	 

//print_r($_POST);
//echo "<br>";
//print_r($_REQUEST);
//echo "<br>";
//print_r($_GET);
//echo "<br>";
?>
<html>
<head>
<script LANGUAGE="JavaScript">
function det(BID,StudID)
{		
		document.frm.action="stud_behaviour_edt.php?BID="+BID+"&StudID="+StudID+"&action=delete";
		document.frm.submit();
}
</script>
<script LANGUAGE="JavaScript">
function act(BID,StudID)
{		
		document.frm.action="stud_behaviour_edt.php?BID="+BID+"&StudID="+StudID+"&action=activate";
		document.frm.submit();
}
</script>
<script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
<script language="javascript">
function OpenWind2(k2)
{
 var finalVar ;
 finalVar=k2 ;
 window.open(finalVar,'Detailed_report','__blank,align=center,width=800,height=600,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
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
<?php

$rs = execute("SELECT * FROM student_m limit 1");
$num = rowcount($rs);
if($num > 0)
{
	?>
	<form method='post' action="stud_behaviour_edt.php" name="frm" >

    <table class='forumline' align='center' width="90%" ><tr>
	    <td Class="Head" colspan='7' align='center'>Search Student Detials</td></tr>
    
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
	<td>&nbsp;&nbsp;Section</td><td><select name='class_section_id'>
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
	<td><input type='text' name='app_no' value=""></td>
</tr>
 <tr height='30'>
    <td>&nbsp;&nbsp;From Date &nbsp;</td>
    <td><input type="text" name="adate" value="<?php echo $adate ?>" readonly>&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" >
        </a>
	</td>
   	    <td>Student Name</td>
		<td colspan="3" ><input type='text' name='studfname' value=""></td>
 </tr>
   <tr height='30'>
	<td>&nbsp;&nbsp;To Date &nbsp;</td>
    <td colspan="3"><input type="text" name="bdate" value="<?php echo $bdate ?>" readonly>&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" >
        </a>
	</td>
 </tr>
</table>
    <br>
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
if(!$_POST['studdet'] and ! $_REQUEST)
die();
            $newd1=$_POST['adate'];
		   	$dateArray1=explode('/',$newd1);
			$acq_yy1=$dateArray1[2];
			$acq_mm1=$dateArray1[1];
			$acq_dd1=$dateArray1[0];
			$FromDate="$acq_yy1-$acq_mm1-$acq_dd1";
			
			$newd2=$_POST['bdate'];
		   	$dateArray2=explode('/',$newd2);
			$acq_yy2=$dateArray2[2];
			$acq_mm2=$dateArray2[1];
			$acq_dd2=$dateArray2[0];
			$ToDate="$acq_yy2-$acq_mm2-$acq_dd2";		
     

		  
    $sql="select a.id, a.student_id, a.usn, a.first_name, a.last_name, a.admission_id, b.* from student_m a, student_behaviour_type b where a.id is not null and a.archive='N' AND a.academic_year = '$academic_year' AND a.id = b.student_id AND b.adate >= '$FromDate' AND b.adate <= '$ToDate' AND status=1";
	if($app_no!='')
	{
		 $sql.=" and a.student_id='$app_no'";
	}
	if($sem!=0)
	{
		$sql.=" and a.course_yearsem=$sem";
	}
	if($class_section_id!='')
	{
		$sql.=" and a.class_section_id=$class_section_id  ";
	}
	if($studfname!='')
	{
		 $sql.=" and a.first_name like '$studfname%'";
	}

        $sql.=" ORDER BY b.student_id ";
		$rs=execute($sql) or die(mysql_error());

	if(rowcount($rs))
	{
		
		
	

?>

</head>
<body>
<br/>  
	<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='98%'>
		<tr height='25'>
		    <td align='center' class='head' colspan='8'><b>EDIT BEHAVIOUR</b></td>
		</tr>
		<tr height='25' >
			<td Class="rowpic" align='center'>Sl No</td>
			<td Class="rowpic" align='center'>Date</td>
			<td Class="rowpic" align='center'>Student ID</td>
			<td Class="rowpic" align='center'>Student Name</td>
			<td Class="rowpic" align='center'>Reported By</td>
			<td Class="rowpic" align='center'>Behaviour</td>
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
		echo "	<tr class='clsname' > ";
		else
		echo "	<tr > ";
		?>
				
	
      <td align='center' ><?=$sno?></td>
		<?PHP
		      // echo "Data :".$r[7];
			        $newd1=$r['adate'];
					$dateArray=explode('-',$newd1);
					$acq_yy=$dateArray[0];
					$acq_mm=$dateArray[1];
					$acq_dd=$dateArray[2];
					$adate="$acq_dd-$acq_mm-$acq_yy";
					
			    $student_id=fetcharray(execute("SELECT admission_id FROM `student_m` WHERE `id`='$r[0]'"));
				$fac_fname=fetcharray(execute("SELECT f_name FROM `staff_det` WHERE `id`='$r[8]'"));
				$fac_lname=fetcharray(execute("SELECT s_name FROM `staff_det` WHERE `id`='$r[8]'"));
				$behaviour=fetcharray(execute("SELECT subject FROM `student_behaviour_m` WHERE `id`='$r[10]'"));
		?>
		
		<td align="center"><?=$adate?></td>
		<td align="center"><?=$student_id[0]?></td>
		<td>&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?=$r[last_name]?></td>
        <td align='center' ><?=$fac_fname[0]?>&nbsp;<?=$fac_lname[0]?></td>
		<td align="center"><?=$behaviour[0]?></td>
		
	  <td align='center' >
	  
	   <input type="button"  value="Edit" onclick ="javascript:OpenWind2('stud_behaviour_det_update.php?BID=<?=$r[6]?>&StudID=<?=$r[7]?>')" class="bgbutton"/>
	   
	   <input type="button"  value="Delete" onclick ="det(<?=$r[6]?>,<?=$r[7]?>)" class="bgbutton"/> 
	  </td>
	
		<?php
		$sno++;
		$rowclass = 1 - $rowclass;
	}
	
 ?>
 </table>
 <?
 }
?>
 <?php
 
		  
    $sql2="SELECT a.id, a.student_id, a.usn, a.first_name, a.last_name, a.admission_id, b.* from student_m a, student_behaviour_type b where a.id is not null and a.archive='N' AND a.academic_year = '$academic_year' AND a.id = b.student_id  AND status=0";

      
		$rs2=execute($sql2) or die(mysql_error());
		
    if(rowcount($rs2))
	{
		
 
?>

</head>
<body>
<br/>  
	<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='98%'>
		<tr height='25'>
		    <td align='center' class='head' colspan='8'><b>ACTIVATE BEHAVIOUR</b></td>
		</tr>
		<tr height='25' >
			<td Class="rowpic" align='center'>Sl No</td>
			<td Class="rowpic" align='center'>Date</td>
			<td Class="rowpic" align='center'>Student ID</td>
			<td Class="rowpic" align='center'>Student Name</td>
			<td Class="rowpic" align='center'>Reported By</td>
			<td Class="rowpic" align='center'>Behaviour</td>
			<td Class="rowpic" align='center'>Action</td>			
	   </tr>
<?php
  $rowclass=1;
  $sno=1;
	for($i=0;$i<rowcount($rs2);$i++)
	{
		$r2=fetcharray($rs2);
		if($sno<10)
			$sno="0".$sno;
		if($i%2)
		echo "	<tr class='clsname' > ";
		else
		echo "	<tr > ";
		?>
				
	
      <td align='center' ><?=$sno?></td>
		<?PHP
		      // echo "Data :".$r[7];
			        $newd1=$r2['adate'];
					$dateArray=explode('-',$newd1);
					$acq_yy=$dateArray[0];
					$acq_mm=$dateArray[1];
					$acq_dd=$dateArray[2];
					$adate="$acq_dd-$acq_mm-$acq_yy";
					
			    $student_id=fetcharray(execute("SELECT admission_id FROM `student_m` WHERE `id`='$r[0]'"));
				$fac_fname=fetcharray(execute("SELECT f_name FROM `staff_det` WHERE `id`='$r[8]'"));
				$fac_lname=fetcharray(execute("SELECT s_name FROM `staff_det` WHERE `id`='$r[8]'"));
				$behaviour=fetcharray(execute("SELECT subject FROM `student_behaviour_m` WHERE `id`='$r[10]'"));
		?>
		
		<td align="center"><?=$adate?></td>
		<td align="center"><?=$student_id[0]?></td>
		<td>&nbsp;&nbsp;<?=$r2[first_name]?>&nbsp;<?=$r2[last_name]?></td>
        <td align='center' ><?=$fac_fname[0]?>&nbsp;<?=$fac_lname[0]?></td>
		<td align="center"><?=$behaviour[0]?></td>
		
	  <td align='center' >
	  	   
	   <input type="button"  value="Activate" onclick ="act(<?=$r2[6]?>,<?=$r2[7]?>)" class="bgbutton"/> 
	  </td>
	
		<?php
		$sno++;
		$rowclass = 1 - $rowclass;
	}
	
 ?>
 </table>
 <?
 }
 ?>
</form>
 </body>
 </html>
 