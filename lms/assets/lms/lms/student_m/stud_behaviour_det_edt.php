<?php
session_start();
include("../db.php");
if($_POST)
{
	$subject=$_POST['subject'];
	$description=$_POST['description'];
	$notes=$_POST['notes'];
	$reported_by=$_POST['id'];
	$id=$_POST['id'];
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
}

if($_POST['adate'])
{
	$adate=$_POST['adate'];
}
else
{
	$adate=date("d/m/Y");
}

//print_r($_POST);
//echo "<br>";
//print_r($_REQUEST);
//echo "<br>";

//if($_POST['Submit'])
if(isset($_REQUEST['Submit']))
{
	
	  	$dateArray=explode('/',$adate);
	    $acq_yy=$dateArray[2];
	    $acq_mm=$dateArray[1];
	    $acq_dd=$dateArray[0];
	    $yy_mm_dd="$acq_yy-$acq_mm-$acq_dd";
		
		//echo "yy_mm_dd :".$yy_mm_dd;
	
      
      $sql="UPDATE `student_behaviour_type` SET student_id='$StudID', `reported_by`='$reported_by', adate='$yy_mm_dd', behaviour='$subject', description='$description', notes='$notes' WHERE student_id=$StudID";
	  //echo $sql;
	  execute($sql) or die(mysql_error());
	  if($sql)
	  {
	  		echo "Records Updated Successfully";
	  }
}
	 $stud_fname=fetcharray(execute("SELECT first_name FROM `student_m` WHERE `id`='$StudID' LIMIT 1"));
	 $stud_lname=fetcharray(execute("SELECT last_name FROM `student_m` WHERE `id`='$StudID' LIMIT 1"));
	 

	 $result=execute("SELECT * FROM student_behaviour_type WHERE student_id='$StudID'");
	  
	   if(rowcount($result)>0)
       {

           while($row=fetcharray($result))
           {
					 $student_id = $row['student_id '];
					 $id = $row['reported_by'];
					 $adate = $row['adate'];
					 $subject = $row['behaviour'];
					 $description = $row['description'];
					 $notes = $row['notes'];
					 
					    $dateArray=explode('-',$adate);
						$acq_yy=$dateArray[0];
						$acq_mm=$dateArray[1];
						$acq_dd=$dateArray[2];
						$adate="$acq_dd/$acq_mm/$acq_yy";

            }
	   }
 
	 
	 

?>
<html>
<head>
<script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
</head>
<body>
<form name="frm" method='POST' action="stud_behaviour_det_edt.php" >
<input type="hidden" name="StudID" value="<?=$StudID?>"/>
<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='60%'>
<tr height="25">
    <td align='center' class='head' colspan='4'>BEHAVIOUR FORM</td>
</tr>
<tr height="25">
    <td align='center' class='row3' colspan='4'><?=$stud_fname[0]?>&nbsp;<?=$stud_lname[0]?></td>
</tr>
<tr height="25">
	<td>&nbsp;&nbsp;&nbsp;Date</td>
    <td><input type="text" name="adate" value="<?php echo $adate ?>" readonly>&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" >
        </a>
	</td>
	<td>&nbsp;&nbsp;&nbsp;Reported By</td>
	<td><select name='id'>
	<option value="0">--- Select ---</option>
	<?php
	     $sql1=execute("SELECT id, f_name, s_name FROM `staff_det` ORDER BY id");
			while($r=fetcharray($sql1))
			{ 	
		
				if($id==$r[id])
				echo "<option value='$r[id]' selected>$r[f_name]&nbsp;&nbsp;$r[s_name]</option>";
				else
				echo "<option value='$r[id]' >$r[f_name]&nbsp;&nbsp;$r[s_name]</option>";
			}
			
		?>
	 </select>
	
	
	</td>
</tr>
<tr height="25">
	<td>&nbsp;&nbsp;&nbsp;Behaviour</td>
	<td colspan="3">
	<select name='subject'>
	<option value="0">--- Select ---</option>
		<?php
		$sql2=execute("SELECT * FROM `student_behaviour_m` where status=1 ORDER BY id");
			while($r=fetchrow($sql2))
			{
				if($subject==$r[0])
				echo "<option value='$r[0]' selected>$r[1]</option>";
				else
				echo "<option value='$r[0]' >$r[1]</option>";
			}
			
		?>
	 </select>
	</td>
</tr>
<tr height="25">
	<td>&nbsp;&nbsp;&nbsp;Desciption</td>
	<td colspan="3"><textarea name="description" cols="90" rows="8" tabindex="1" maxlength="255" ><?=$description?></textarea></td> 
</tr>
<tr height="25">
	<td>&nbsp;&nbsp;&nbsp;Notes</td>
	<td colspan="3"><textarea name="notes" cols="90" rows="8" tabindex="1" maxlength="255" ><?=$notes?></textarea></td> 
</tr>

</table>
<p align="center"><input name="Submit" type="submit" value=" Update "  class="bgbutton"/></p>
 