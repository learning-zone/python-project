<?php
	session_start();
	include("../db.php");

	$StudID=$_REQUEST['StudID'];
	$mod="select first_name, last_name, nationality, dob, academic_year, course_yearsem from student_m where id='$StudID'";
	$mod1=execute($mod);
	$r=fetchrow($mod1);
	$check=fetchrow(execute("select * from student_LeavingCertificate where student_id='$StudID' "));
	$bdate=date("d/m/Y");

	if($check[0])
	{
		$r[5]=$check[2];
		$r[4]=$check[3];
		$t=explode("-",$check[4]);
		if($t[2]!=0000)
		{
			$adate="$t[2]/$t[1]/$t[0]";
		}
		$t=explode("-",$check[5]);
		if($t[2]!=0000)
		{
			$bdate="$t[2]/$t[1]/$t[0]";
		}
		else
			$bdate=date("d/m/Y");
		
		$r[4]=$check[6];
		$comments=$check[7];	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Leaving  Certificate</title>
</head>
<script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>

<body>
<form name="frm" action="LeavingCertificate3.php" method="post">
<input type="hidden" name="StudID" id="StudID" value="<?=$StudID?>" />
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center"><strong><u>Leaving  Certificate</u></strong></p>
<p>&nbsp;</p>
<p>Name of student: <strong><u><?=$r[0].' '.$r[1]?></u></strong></p>
<p>Nationality: 
	<?php
	    $nation=fetchrow(execute("select nation from  nationality where id='$r[2]'"));
    ?>
               <strong><u><?=$nation[0]?></u></strong></p>
<p>Date of Birth  (dd/mm/yy): <strong><u>
<?php
$dob=explode('-',$r[3]);
echo "$dob[2]/$dob[1]/$dob[0]";
?>
</u></strong></p>
<p>Class to which  he/she was admitted: <?=$_SESSION['semname']?><strong><u>
<?php

	$div=fetchrow(execute("select acc_year, division from  `fee_apply_fee_student` where student_id='$StudID' and status=1 order by division, id"));
	$divname=fetchrow(execute("select year_name from  `course_year` where year_id='$div[1]' and status=1 "));

echo $divname[0]."   $div[0]-".++$div[0];
?>
</u></strong></p>
<p>The grade  completed: <strong><?=$_SESSION['semname']?> *
        <select name="sem">
			<option value='0'>------Select------</option>
			<?php
			
				$rs=execute("SELECT year_name, year_id FROM course_year ");
				while($r1=fetcharray($rs))
				{
					if($r[5]==$r1[year_id])
					{
						echo "<option value='$r1[year_id]' selected>$r1[year_name]</option>";
					}
					else
					{
						echo "<option value='$r1[year_id]'>$r1[year_name]</option>";
					}
				}
			?>
			</select>&nbsp;&nbsp;&nbsp;  
            <select name="a_year">
            <?php
				$MyYear=date('Y')-12;
				$CurrentYr=date("Y")+2;
				for($i=$MyYear;$i<$CurrentYr;$i++)
				{
				$Fyear=$i;
				$Tyear=$i+1;
				if($r[4]==$i)
				echo "<option value='$i' selected>$Fyear - $Tyear</option>";
				else
				echo "<option value='$i'>$Fyear - $Tyear</option>";
            }
            ?>
            </select>
</strong></p>
<p>Last date of  attendance in school: <strong><input type="text" name="adate" size="10" width="10" value="<?php echo $adate ?>" readonly>&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" >
        </a></strong></p>
<p>Result at the end  of the academic year:              <select name="a_year1">
            <?php
				$MyYear=date('Y')-12;
				$CurrentYr=date("Y")+2;
				for($i=$MyYear;$i<$CurrentYr;$i++)
				{
				$Fyear=$i;
				$Tyear=$i+1;
				if($r[4]==$i)
				echo "<option value='$i' selected>$Fyear - $Tyear</option>";
				else
				echo "<option value='$i'>$Fyear - $Tyear</option>";
            }
            ?>
            </select>
<br />
<strong><textarea name="comments" cols="40"><?=$comments?></textarea></strong></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<p>Finbarr O&rsquo;Regan             
<br />
<strong><em>Principal</em></strong></p>
<p align="center">School Stamp</p>
<p>                                    <br />
  Date: <input type="text" name="bdate" size="10" width="10" value="<?php echo $bdate ?>" readonly>&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" >
        </a></p>
<p align="center"><input type="submit" name="Print" value="Print" class="bgbutton" /></p>
<p>&nbsp;</p>
</form></body>
</html>