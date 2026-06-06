<?php
session_start();
include("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

$period=1;
if($_GET)
{	
	$day=$_GET['day'];
	$msg=$_GET['msg'];
	$prm=$_GET['prm'];
	$semid=$_GET['semid'];
	$secid=$_GET['secid'];
}

if($_POST)
{
	$fac=$_POST['fac'];
	$sub=$_POST['sub'];
	$bid=$_POST['bid'];
	$prm=$_POST['prm'];
	$bid=$_POST['bid'];
	$prd=$_POST['prd'];
	$act=$_POST['act'];
	$rsid=$_POST['rsid'];
	$semid=$_POST['semid'];
	$secid=$_POST['secid'];
	$hallno=$_POST['hallno'];
	$subcode=$_POST['subcode'];
	$subname=$_POST['subname'];
	$head_id=$_POST['head_id'];

}

if($day==1){
	$displayDay='MONDAY';
}elseif($day==2){
	$displayDay='TUESDAY';
}elseif($day==3){
	$displayDay='WEDNESDAY';
}elseif($day==4){
	$displayDay='THURSDAY';
}elseif($day==5){
	$displayDay='FRIDAY';
}elseif($day==6){
	$displayDay='SATURDAY';
}elseif($day==7){
	$displayDay='SUNDAY';
}


	$cc=fetcharray(execute("SELECT `subject_name` FROM `subject_m` WHERE `subject_id`='$subcode'"));
	$subname=$cc[subject_name];
	
if($_POST['sub']!='' && $_POST['fac']!='' && $_POST['hallno']!='')
{
			
				
	if($sub!=0 && $fac!='-1')
	{
		$chk=rowcount(execute("SELECT id FROM timetable WHERE hallno='$hallno' AND pid='$prd' AND weekday='$weekday'"));
		if($chk<1)
		{
			$chk1=rowcount(execute("SELECT id FROM timetable WHERE staffid='$fac' AND pid='$prd' AND weekday='$weekday'"));
			if($chk1<1)
			{
				$cc=fetcharray(execute("SELECT sub_type FROM subject_m WHERE subject_id='$sub'"));
				
				if($cc[sub_type]==2)
					$chk2=rowcount(execute("SELECT id FROM timetable WHERE course_id='$prm' AND sem_id='$semid' AND sec_id='$secid' AND batchid='$bid' AND sub_id='$sub' AND pid='$prd' AND weekday='$weekday'"));

				else

					$chk2=rowcount(execute("SELECT id FROM timetable WHERE course_id='$prm' AND sem_id='$semid' AND sec_id='$secid' AND sub_id='$sub' AND pid='$prd' AND weekday='$weekday'"));

				if($chk2<1)
				{

					$sn=fetcharray(execute("SELECT f_name FROM staff_det a WHERE a.slno='$fac'"));
									
					//execute("INSERT INTO timetable (subjectcode,subname,hallno,staffid,staffname,course_id,sem_id,sec_id,batchid,pid,sub_id,weekday) values ('$subcode','$subname','$hallno','$fac','$sn[0]','$prm','$semid','$secid','$bid','$prd','$sub','$weekday')");

					echo "<p align='center'><blink>Records Added</b></font>";

				}
				else
					echo "<p align='center'><blink>Time Table already assigned for this selection ...!!!</b></font>";
			}
			else
				echo "<p align='center'><blink>Time Table already assigned to this day / Period / Faculty...!!!</b></font>";
		}

		else
			echo "<p align='center'><blink>Time Table already assigned to this day / Period / Hall..!!!</blink></p>";
	}

	else

		echo "<font color=''><b>Select Subject & Subject Teacher ..!!!</b></font>";

	$act=1;
}
$prm=$semid=$secid=1;
$i=$period=1;
$j=$day=1;
?>
<!DOCTYPE HTML>
<html>
<head>
<head>
<script language="JavaScript">
function reloadMe()
{
	//alert('hi');
	document.frm.action="timeTable_edt.php";
	document.frm.submit();
}
</script>
<title>MODIFY TIME TABLE</title>
</head>
<body>
<form name="frm" method="post">
<table align='center' border='1' class='forumline'  width="98%">
	<tr>
    	<td colspan="4" class='head' align='center'>MODIFY TIME TABLE</td>
	</tr>
	<tr>
    	<td colspan="4" class='row3' align='center'><?=$displayDay?></td>
	</tr>
    <tr>
    	<td class='rowpic' align='center'>Period <?=$period?></td>
        <td> <select name='sub' onChange="reloadMe()" style="width:250px;">
				<option value='0'>--- Subject ---</option>
                <?	
				
				 					
	$sqlS=execute("SELECT subject_id,subject_name,elective FROM subject_m WHERE course_id='$prm' AND course_year_id='$semid' AND status=1 ORDER BY subject_name");
				
				while($rs=fetcharray($sqlS))
				{
					if($rs[2]=='Y')
						$sname=$rs[1]." (Elective)";
					else
						$sname=$rs[1];
						
					if($sub==$rs[0])
						echo "<option value='$rs[0]' selected>$sname</option>";
					else
						echo "<option value='$rs[0]'>$sname</option>";
						
				}
				
			?></select><BR>
            <?
            $cc=fetcharray(execute("SELECT sub_type,subject_name,subject_code FROM subject_m WHERE subject_id='$sub'"));

				if($cc[sub_type]==2)
				{

					if($bid.$i.$j=='0')
						$s="selected";
					else
						$s="";
				?>
				  <select name="bid" onChange="reloadMe()" style="width:250px;">
					<option value='0' <?=$s?>>-- No Batch --</option>
				<?PHP
				 $sqlB=execute("select * FROM batch_master");

					while($rb=fetcharray($sqlB))
					{

						if($bid==$rb[0])
							echo "<option value=$rb[0] selected>$rb[1]</option>";
						else
							echo "<option value=$rb[0]>$rb[1]</option>";
					}
					?>
					</select>
				<?
				}
				
				if($cc[sub_type]==2)
					$qry="SELECT a.StaffID,b.f_name,b.s_name FROM staff_rights a,staff_det b WHERE a.course_id='$prm' AND a.subject_id='$sub' AND a.year_id='$semid'  AND a.class_section_id='$secid' AND  a.StaffID=b.slno AND a.batch_id='$bid' group by b.slno";
				else
					$qry="SELECT a.StaffID,b.f_name,b.s_name FROM staff_rights a,staff_det b WHERE a.course_id='$prm' AND a.subject_id='$sub' AND a.year_id='$semid' AND a.class_section_id='$secid'  AND a.StaffID=b.slno  group by b.slno";

			?>
				<select name='fac' onChange="reloadMe()" style="width:250px;">
				<option value=''>--- Faculty ---</option>
			<?
					$sqlF=execute($qry);
					
				while($rr=fetcharray($sqlF))
				{
					if($fac==$rr[0])
						echo "<option value='$rr[0]' selected>$rr[1]</option>";
					else
						echo "<option value='$rr[0]'>$rr[1]</option>";
				}
			?>
				</select>
			<BR>
              <select name='hallno' onChange="reloadMe()" style="width:250px;">
               <option value=''>--- Hall No ---</option>
             <?
				$sqlH=execute("SELECT * FROM hallno");	
				
				while($rh=fetcharray($sqlH))
				{
					if($hallno==$rh[0])
						echo "<option value='$rh[0]' selected>$rh[1]</option>";
					else
						echo "<option value='$rh[0]'>$rh[1]</option>";
				}
				?>
				</select></td>
	</tr>
</table>
</form>
</body>
</html>
 	




