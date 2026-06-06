<?php

	session_start();
	$user=$_SESSION['user'];
	$accyear=$_SESSION['AcademicYear'];
	$course=$_REQUEST['course'];
	$sem=$_REQUEST['sem'];
	$examid=$_REQUEST['examid'];
	$class=$_REQUEST['class'];
	$subject=$_REQUEST['subject'];
	$masteexamn=$_REQUEST['masteexamn'];
	$unit=$_REQUEST['unit'];
	
	include("../db.php");
	$date=date("Y-m-d");
	$time=date("H:i:s");
	
	$linknameval=$_POST['linknameval'];
	$studentidinfo=$_POST['studentidinfo'];
	$branchnmaes=$_POST['branchnmaes'];
	
	$quer=execute("select * from `mail_settings` where `user_id`='$user' and status='1'");
	while($r1=fetcharray($quer))
	{
		$notify_fromname=$r1['From_name'];
		$notify_fromaddress=$r1['From_address'];
		$Domain_name=$r1['Domain_name'];
		$mail_smtpserver=$r1['SMTP'];
		$mail_smtpport=$r1['SMTP_Port'];
		$mail_smtpuser=$r1['Username'];
		$mail_smtppass=$r1['Password'];
		$Signatore=$r1['Signatore'];
	}


	
?>
<SCRIPT LANGUAGE="JavaScript">
function reload()
{
	document.frm.action='sendmails.php';
	document.frm.submit();
}

</SCRIPT>

<br>
<form method="post" id="frm" name="frm">
<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head">Report Card</td>
    </tr>
     
  <tr>
    <td>&nbsp;School Division</td>
		<td>&nbsp;<select name="branchnmaes" onChange="reload()">
			<option value="0">------Select-----</option>
				<?php
					$sql="select course_id,coursename from course_m where course_id<3";
					$rs=execute($sql) ;
					for($i=0;$i<rowcount($rs);$i++)
					{
					  $r=fetcharray($rs);

						if($branchnmaes==$r[course_id])
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
		
  </tr>
  </table>
  <?php
  $sql123="select id,student_id,first_name,last_name,admission_id from student_m where id is not null and archive='N' and academic_year='$accyear'";
	
	$sql123.=" and course_admitted=$branchnmaes";
	
	
	$sql123.=" order by first_name";
	
	$rs=execute($sql123);

  ?>
 <html>
<head>
<script language="javascript">
</script>
</head>
<body>
<form method="post" id="form1" name="form1">
    <input type="hidden" name="course" value="<?=$course?>" />
    <input type="hidden" name="sem" value="<?=$sem?>" />
    <input type="hidden" name="examid" value="<?=$examid?>" />
    <input type="hidden" name="class_section_id" value="<?=$class_section_id?>" />
    <input type="hidden" name="subject" value="<?=$subject?>" />
    <input type="hidden" name="masteexamn" value="<?=$masteexamn?>" />
    <input type="hidden" name="mainid" value="<?=$mainid?>" />
    <input type="hidden" name="unit" value="<?=$unit?>" />
    
  <?php
$unitnames=fetcharray(execute("select unit,id from msp_unit where status=1  and id='$unit' order by posi"));
  $examnsme=fetcharray(execute("select * from dp_exam_sub_m where id='$examid'"));
    $staff_names=fetcharray(execute("select email from users a,staff_det b where a.username='$user' and a.srid=b.id"));
    if(!$staff_names[0])
    {
$staff_names=fetcharray(execute("select From_address from  mail_settings where user_id='$user'"));
}
  ?>
  <br>
  <table width="90%" align="center" border=1>
  <tr><td colspan="4" class="head" align="center"><?=$unitnames[0]?></td></tr>
 <!--  <tr><td colspan="2"  align="center">CC to <textarea name="ccmail" cols="50"></textarea></td></tr>
  <tr><td width="70%" valign="top"> <table width="100%" border="1" cellspacing="0"  align="center" class="forumline"  cellpadding="0">
  <tr>-->
    <td width="10%" class="head" nowrap>Sl No.</td>
    <td width="40%" align="center" class="head" nowrap>Name</td>
    <td width="20%" align="center" class="head" nowrap>Student Id</td>
    <td width="23%" align="center" class="head" nowrap>check</td>
   <!-- <td width="7%" align="center">Sel</td>-->
  </tr>
  <?php
  $i=1;
  
  while($r1=fetcharray($rs))
  { 
 
	$linknameval[$i]="<a href='http://www.oberoi.myschoolone.com/renew/grade/reports1.php?student_id=$r1[id]&course=$course&sem=$sem&examid=$examid&masteexamn=$masteexamn&unit=$unit'>Click</a>";
  	
 	$studentidinfo[$i]=$r1[id];
	$studentname[$i]="$r1[first_name] $r1[last_name]";
 
  echo "<tr>
    <td nowrap>&nbsp;$i</td>
    <td nowrap>&nbsp;$r1[first_name] $r1[last_name]</td>
    <td nowrap align='center'>&nbsp;$r1[student_id]</td>
    <td nowrap align='center'>&nbsp;";
	?>
<input type="checkbox" name="stid[]" value="<?=$i?>" checked="checked" />
    
</td>
</tr><?php
$i++;  }
  ?>
</table>
</td><td valign="top" style="background:none"><font color="#FFFFFF">
<?php
if($_POST['sendmail1'])
{
	$stid=$_POST['stid'];
	
	for($k=0;$k<sizeof($stid);$k++)
	{
		$m=$stid[$k];
		
		$r=fetchrow(execute("select first_name ,last_name , course_yearsem, class_section_id, parent_username,f_email,m_email from student_m where id='$studentidinfo[$m]' "));
		
		//echo "$r[0] $r[1] $r[2] $r[3] $r[4] $r[5] <br>";	
			$from = $staff_names['0'];
			$parent_mailid=$r[5].",".$r[6];
			$mailbody='';

			$studentname[]="$r[0] $r[1]";
			$mailbody.="Dear Parent,<br>
						 
			Please find the $examnsme[exam_name] of $r[0] $r[1].<br>
			
			".$linknameval[$m]." to view report ";
			
		
			$mail_boday=$mailbody;
			$subject="Confidential: $examnsme[exam_name] ($r[0] $r[1])";
			

			$parent_mailid1=explode(',',$parent_mailid);
			for($i=0;$i<sizeof($parent_mailid1);$i++)
			{
				$message = urlencode($mail_boday);
				$to=$parent_mailid1[$i];
				
				$responce="Cound not send the message to";
				//echo "INSERT INTO `mail_logs_system` (`mail_sent_id`,`mail_det`, `response`, `status`, `mail_date`, `mail_time`, `user`, `from_mail`, `to_mail`, `subject`,`stud`) VALUES ('','{$message}', '{$responce}', '1', '{$date}', '{$time}', '{$user}', '{$from}', '{$to}', '{$subject}','$studentidinfo[$m]')";
				$sqlnames="INSERT INTO `mail_logs_system` (`mail_sent_id`,`mail_det`, `response`, `status`, `mail_date`, `mail_time`, `user`, `from_mail`, `to_mail`, `subject`,`stud`) VALUES ('','{$message}', '{$responce}', '1', '{$date}', '{$time}', '{$user}', '{$from}', '{$to}', '{$subject}','$studentidinfo[$m]')";
				$bdyname=execute($sqlnames);
				
			}				
		
			$message='';
			$subject='';
			$mailbody='';	
		}
	
}
?>
</font>

</td></tr>
</table>

<br>  <div align="center">
  <input type="submit" name="sendmail1" class="bgbutton" value="Send Mail" />
  </div>
</form>	
</body>
</html>




