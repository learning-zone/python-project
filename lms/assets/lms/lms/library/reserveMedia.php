<?php
require_once("../db.php");
$member=$_REQUEST['member'];
$id=$_REQUEST['id'];
$library=$_REQUEST['library'];
$media=$_REQUEST['media'];
?>
<?php
if($user=='administrator')
{
	die("<div>Administrator not allowed to reserve the media...</div>");
}
else
{
	$Tdate=date("Y-m-d");
	$p=execute("select id from lib_reservation_m where accno='$id' and end_date>='$Tdate' and l_id='$library' and media_type='$media'");	
	if(rowcount($p)>0)
	{
		die("<div>This media has been reseved by another member ...</div>");
	}
	$abc=rowcount(execute("select id from lib_circulation_m where acc_id='$id' and library='$library' and status=0 and media_type='$media'"));	
	if($abc>0)
	{
		die("<div>This media has been issued to another member ...</div>");
	}
	$q=fetcharray(execute("select s_id,type from lib_membership_m where m_no='$member'"));
	$m_id=$q[type];
	if($q[type]==1)
	{
		$q1=fetcharray(execute("select course_admitted from student_m where id='$q[s_id]'"));
		$q2=execute("select issues from cir_parameter where member='$q[type]' and course='$q1[0]' and media='$media'");
		if(rowcount($q2)==0)
			$q2=execute("select issues from cir_parameter where member='$q[type]' and course='0' and media='$media'");
		$q3=fetcharray($q2);
		$miss=$q3[0];
	}
	else
	{
		$q1=fetcharray(execute("select subj from staff_det where id='$q[s_id]'"));
		$q2=execute("select issues from cir_parameter where member='$q[type]' and department='$q1[0]' and media='$media'");
		if(rowcount($q2)==0)
			$q2=execute("select issues from cir_parameter where member='$q[type]' and department='0' and media='$media'");
		$q3=fetcharray($q2);
		$miss=$q3[0];
	}
	$q4=fetcharray(execute("select count(id) from lib_circulation_m where cno='$member' and media_type='$media' and status='0'"));
	$q44=fetcharray(execute("select count(id) from lib_reservation_m where m_id = '$member' and end_date>='$Tdate' and media_type='$media'"));
	$tcnt=$q4[0]+$q44[0];
	if($tcnt<=$miss)
	{
		$today = getdate();
		$month = $today['mon'];
		$day = $today['mday'];
		$year = $today['year'];
		$ndate= date("Y-m-d",mktime(0,0,0,$month,$day+1,$year));
		$ndate1= date("d-m-Y",mktime(0,0,0,$month,$day+1,$year));
		$sql="insert into lib_reservation_temp (l_id,resdate,m_id,accno,end_date,media_type) values ('$library','$Tdate','$member','$id','$ndate','$media')";
		
		//echo $sql;
		execute($sql) or die("Failed to reserve the media");
		if($media==2 || $media==4)
			$atbl="lib_cd_acc_det";
		elseif($media==1)
			$atbl="lib_acc_details";
		else
			$atbl="lib_proj_acc_det";
		$sql="update $atbl set flag=2 where acc_no='$id'";
		execute($sql) or die("Failed to reserve the media");
	}
	else
	{
		die("<div>Your quota is exceeded ...</div>");
	}
}
?>
<p>This media has been reserved on your account.</p><br><br>Please collect the media on or before <?=$ndate1?>.
<HTML>
<HEAD>
<script language="JavaScript">
	self.opener.location.reload();
</script>
</HEAD>
</BODY>
</HTML>