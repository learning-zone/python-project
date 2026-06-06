<?php
session_start();
include("../db.php");
if($_POST)
{
	$subject=$_POST['subject'];
	$description=$_POST['description'];
	$notes=$_POST['notes'];
	$reported_by=$_POST['id'];
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

	$result=execute("SELECT * FROM `student_behaviour_type`  WHERE `student_id`='$StudID' ORDER BY id") or die(mysql_error());

if(rowcount($result)>0)
{
	
	 	 
     $stud_fname=fetcharray(execute("SELECT first_name FROM `student_m` WHERE `id`='$StudID' LIMIT 1"));
	 $stud_lname=fetcharray(execute("SELECT last_name FROM `student_m` WHERE `id`='$StudID' LIMIT 1"));
	 ?>
	 
	 <br>	
	 <html><body><table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='90%'>

	 <tr height="25">
		 <td  align="center" class='head' colspan='7'><?=$stud_fname[0]?>&nbsp;<?=$stud_lname[0]?></td>
	 </tr>
         <tr>
			   <td class='row3' align='center' width="5%">Sr No</td>
			   <td class='row3' align='center' width="10%">Date</td>
			   <td class='row3' align='center' width="40%">Behaviour</td>
			   <td class='row3' align='center' width="15%">Reported By</td>
			   <td class='row3' align='center' width="15%">Decription</td>
			   <td class='row3' align='center' width="15%">Notes</td>
			   			
		</tr>
   <?
     $i=0;
     $rowclass=1;
     $sno=1; 
     while($row=fetcharray($result))
     {
	 	
				
	   	$behaviour=fetcharray(execute("SELECT subject FROM  `student_behaviour_m`  WHERE `id` = '$row[behaviour]'"));
		$fac_fname=fetcharray(execute("SELECT f_name FROM  `staff_det`  WHERE `id` = '$row[reported_by]'"));
		$fac_lname=fetcharray(execute("SELECT s_name FROM  `staff_det`  WHERE `id` = '$row[reported_by]'"));
		
		###########  TO CHANGE DATE FORMAT (DD-MM-YYYY) #########
		
		 $newd1=$row[adate];
		 $dateArray=explode('-',$newd1);
		 $acq_yy=$dateArray[0];
		 $acq_mm=$dateArray[1];
		 $acq_dd=$dateArray[2];
		 $dd_mm_yy="$acq_dd-$acq_mm-$acq_yy";
	 	
		
		if($sno<10)
		{
			$sno="0".$sno;
		}
		if($i%2)
		echo   "<tr class='clsname'>";
		else
		echo   "<tr>";


		?>

			<td align='center' ><?=$sno?></td>
			<td align='center' ><?=$dd_mm_yy?></td>
			<td align='center' ><?=$behaviour[0]?></td>
			<td align='center' ><?=$fac_fname[0]?>&nbsp;<?=$fac_lname[0]?></td>
			<td align='center' ><?=$row[description]?></td>
			<td align='center' ><?=$row[notes]?></td>
			
		<?
		$i++;
		$sno++;
		$rowclass = 1 - $rowclass;
	}
	
}
?>
</table>
</body>
</html>

 