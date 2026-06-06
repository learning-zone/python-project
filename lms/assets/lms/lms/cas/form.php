<HTML>
<head>
  <script language="javascript" src="cal2.js"></script>
  <script language="javascript" src="cal_conf2.js"></script>
</HEAD>
<script>
	function reload()
	{
		document.frm.action="form.php";
		document.frm.submit();
	}

</script>

<?php
session_start();
include("../db.php");
//print_r($_POST);
$name=$_POST['name'];
$year=$_POST['year'];
$description=$_POST['description'];
$cas=$_POST['cas'];
$organisation_name=$_POST['organisation_name'];
$mobile=$_POST['mobile'];
$email=$_POST['email'];
$adate=$_POST['adate'];
$bdate=$_POST['bdate'];
$cdate=$_POST['cdate'];
$examname_m=$_POST['examname_m'];
$comments=$_POST['comments'];

$user=$_SESSION['user'];
$sem=$_SESSION['sem'];

	if($_POST['save'])
	{
		$tfdate=explode('/',$adate);
		$fdate=$tfdate[2]."-".$tfdate[1]."-".$tfdate[0];
		$ttdate=explode('/',$bdate);
		$tdate=$ttdate[2]."-".$ttdate[1]."-".$ttdate[0];

		$namestaff=execute("select id from `dp_student` where `class`='$sem' and username='$user' and examid='$examname_m'");
		if(mysql_num_rows($namestaff)>0)
		{
				
				$nameupt="update dp_student set `name`='$name',`cas`='$cas', description='$description',`year`='$year',`organisation_name`='$organisation_name',`mobile`='$mobile',`email`='$email',`adate`='$adate', `bdate`='$bdate', `comments`='".addslashes($comments)."' where `class`='$sem' and username='$user' and examid=`$examname_m`";
			
		}
		else
		{
		
		$tfdate=explode('/',$adate);
		$fdate=$tfdate[2]."-".$tfdate[1]."-".$tfdate[0];
		$ttdate=explode('/',$bdate);
		$tdate=$ttdate[2]."-".$ttdate[1]."-".$ttdate[0];

			$nameupt="INSERT INTO `dp_student` (`name`,`year`,`description`, `cas`, `organisation_name`,`mobile`, `email`, `adate`, `bdate`, `comments`,`status`,`username`,`class`,`examid`) VALUES ('$name', '$year','$description', '$cas', '$organisation_name','$mobile', '$email', '$fdate', '$tdate', '".addslashes($comments)."',1,'$user','$sem','$examname_m')";
		}
	execute($nameupt);	

	?>
		<SCRIPT LANGUAGE="JavaScript">
        alert("Grade Updated Successfully");
        </SCRIPT>
<?
	}
?>

<form  name="frm"  action="form.php" method="post">
<table cellpadding="5" cellspacing="0" border="0" width="100%" align="center">
  <tr>
    <td class="head" width="20%" nowrap>&nbsp;&nbsp;Exam &nbsp;&nbsp;<select name="examname_m" onChange="reload()">
	<option value="0">Select  </option>
<?php
	echo $sql3=execute("SELECT id, descr FROM `exam_m` where `class`='$sem' and sts=1 ");
	for($j=0;$j<rowcount($sql3);$j++)
	{
		$r3=fetcharray($sql3,$j);
		if($r3[0]==$examname_m)
		{
			echo "<option value=$r3[0] selected>$r3[1]</option>";
		}
		else
		{
			echo "<option value=$r3[0]>$r3[1]</option>";
		}
	}
?>
</select>
</td>
<td align="center" class="head" width="60%" nowrap><u>ACTIVITY PROPOSAL FORM FOR CAS</u></td><td class="head"><a href="reflection.php"><input type="button" name="link" value="Next"  class="bgbutton"></a></td></tr>
    <tr><td align="center" colspan="3"><i>One from must be filled out for <u>each</u> activity you want to undertake for CAS.</i></td></tr>
    </table>
<table cellpadding="5" cellspacing="0" border="0" width="100%" align="center">
  <tr>
    <td align="left"> &nbsp;&nbsp;You must seek your CAS Advisor's (or CAS Coordinator's) Singned approval <u>before</u> you start any CAS-related activity.</td>
  </tr>
</table>
<?
$fulldet=execute("SELECT * FROM `dp_student` WHERE username='$user' and class='$sem' and examid='$examname_m'");
		while($fd=fetcharray($fulldet))
		{
			$name=$fd['name'];
			$year=$fd['year'];
			$description=$fd['description'];
			$cas=$fd['cas'];
			$organisation_name=$fd['organisation_name'];
			$mobile=$fd['mobile'];
			$email=$fd['email'];
			$adate=$fd['adate'];
			$bdate=$fd['bdate'];
			$comments=$fd['comments'];
		}
						
?>
<table cellpadding="5" cellspacing="0" border="0" width="100%" align="center">
  <tr>
    <td align="left" width="10%" nowrap>&nbsp;&nbsp;Name of Student :</td>
    <td align="left">&nbsp;&nbsp;<input name="name" type="text" size="50%"  value="<?=$name?>"></td>
    <td align="right" width="20%" nowrap>&nbsp;&nbsp;Year :</td>
    <td align="left">&nbsp;&nbsp;<input name="year" type="text" size="6%" maxlength="4"  value="<?=$year?>">&nbsp;&nbsp;</td>

  </tr>
  <tr>
    <td align="left" width="10%" nowrap>&nbsp;&nbsp;Description of Activity :</td>
    <td align="left">&nbsp;&nbsp;<input name="description" type="text" size="50%"  value="<?=$description?>"></td>
    <td align="right" width="20%" nowrap colspan="2">&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align="left" width="10%" nowrap>&nbsp;&nbsp;Customer C/A/S :</td>
    <td align="left">&nbsp;&nbsp;<input name="cas" type="text" size="50%"  value="<?=$cas?>"></td>
     <td align="right" width="20%" nowrap colspan="2">&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align="left" width="10%" nowrap>&nbsp;&nbsp;Name of organisation or place :</td>
    <td align="left">&nbsp;&nbsp;<input name="organisation_name" type="text" size="50%"  value="<?=$organisation_name?>"></td>
     <td align="right" width="20%" nowrap colspan="2">&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align="left" width="10%" nowrap>&nbsp;&nbsp;Mobile number of Supervisor :</td>
    <td align="left">&nbsp;&nbsp;<input name="mobile" type="text" size="50%"  value="<?=$mobile?>"></td>
     <td align="right" width="20%" nowrap colspan="2">&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align="left" width="10%" nowrap>&nbsp;&nbsp;Email address of Supervisor :</td>
    <td align="left">&nbsp;&nbsp;<input name="email" type="text" size="50%" value="<?=$email?>"></td>
     <td align="right" width="20%" nowrap colspan="2">&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td> &nbsp;&nbsp;Date of commencement :</td>
    <td align="left">
    <input type="text" name="adate" size="10%" value="">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>
     <td align="right"> &nbsp;&nbsp;Expected End Date :</td>
    <td align="left">&nbsp;&nbsp;<input type="text"  size="10%" name="bdate" value="">&nbsp;&nbsp;<a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
</td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;&nbsp;Signature of the Supervisor :&nbsp;&nbsp;&nbsp;&nbsp;___________________________________________________________________________</td></tr><tr><td></td><td><i>NOTE: The adult supervisor must <b> NOT </b> be a relative</i></td>
      <td align="right" width="20%" nowrap colspan="4">&nbsp;&nbsp;</td>
  </tr>
  </table>
  <table cellpadding="5" cellspacing="0" border="0" width="100%" align="center">
  <tr>
    <td align="left" width="12%" nowrap>&nbsp;&nbsp;Responsibilities of a CAS student :</td>
     <td align="right" width="20%" nowrap colspan="4">&nbsp;&nbsp;</td>
    
    <tr>
    <td align="left" width="14%"nowrap>&nbsp;&nbsp;
    <img src="arrow_bullet.gif"> To be on time,each time when expected</td>
    <td align="right" width="20%" nowrap colspan="4">&nbsp;&nbsp;</td>
    </tr>
    <tr>
    <td align="left" width="14%"nowrap>&nbsp;&nbsp;
    <img src="arrow_bullet.gif"> To do the best at all times.</td>
    <td align="right" width="20%" nowrap colspan="4">&nbsp;&nbsp;</td>
    </tr>
    <tr>
    <td align="left" width="14%"nowrap>&nbsp;&nbsp;
    <img src="arrow_bullet.gif"> To use initiative and go beyond the expectations.</td>
    <td align="right" width="20%" nowrap colspan="4">&nbsp;&nbsp;</td>
    </tr>
    <tr>
    <td align="left" width="14%"nowrap>&nbsp;&nbsp;
    <img src="arrow_bullet.gif"> To notify the supervisor well in advance if unable to attend.</td>
    <td align="right" width="20%" nowrap colspan="4">&nbsp;&nbsp;</td>
    </tr>
    <tr>
    <td align="left" width="14%"nowrap>&nbsp;&nbsp;
    <img src="arrow_bullet.gif"> To present the completed 'Supervisor Evaluation Form',within two weeks of the completion of the activity.</td>
    <td align="right" width="20%" nowrap colspan="4">&nbsp;&nbsp;</td>
    </tr>
    </tr>
    </table>
    <table cellpadding="5" cellspacing="0" border="0" width="100%" align="center">
  <tr>
    <td align="left" width="12%" nowrap>&nbsp;&nbsp;Responsibilities of the Supervisor:</td>
     <td align="right" width="20%" nowrap colspan="4">&nbsp;&nbsp;</td>
    
    <tr>
    <td align="left" width="14%"nowrap>&nbsp;&nbsp;
    <img src="arrow_bullet.gif"> Encourage and support the student</td>
    <td align="right" width="20%" nowrap colspan="4">&nbsp;&nbsp;</td>
    </tr>
    <tr>
    <td align="left" width="14%"nowrap>&nbsp;&nbsp;
    <img src="arrow_bullet.gif"> Complete the supervisor's portion of the'Supervisor Evaluation Form',which the student will provide you at the completion of the activity.</td>
    <td align="right" width="20%" nowrap colspan="4">&nbsp;&nbsp;</td>
    </tr>
    </table>
   
    <table cellpadding="6" cellspacing="0" border="0" width="100%" align="center">
     
  <tr>
    <td align="left" width="12%" nowrap>&nbsp;&nbsp;Approved(CAS Advisor/CAS Coordinator to sign):&nbsp;&nbsp;____________________________________________________</td>
    <td colspan="4"></td>
    </tr>
    <tr>
    <td align="left" width="12%" nowrap>&nbsp;&nbsp;Date:&nbsp;&nbsp;_________________________________________</td>
    <td colspan="4"></td>
    </tr>
    <tr>
    <td align="left" width="12%" nowrap>&nbsp;&nbsp;Additional Comments:<br>&nbsp;&nbsp;<textarea rows="3" cols="70" name="comments" ><?=$comments?></textarea>	</td>
    <td colspan="4"></td>
    </tr>
    </table>
    <br>
 <div align="center">
<input type="submit" name="save" value="Update" class="bgbutton"></div></form>
</html>