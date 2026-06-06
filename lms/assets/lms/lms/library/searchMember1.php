<?PHP
session_start();
require_once("../db.php");


$B1 = $_POST['B1'];
$crs = $_POST['crs'];
$crsyr = $_POST['crsyr'];
$staff = $_POST['staff'];
$member = $_POST['member'];

$member = trim("$member");

?>
<HTML>
<HEAD>
<script language="javascript">
function frm_reload()
{
	document.frm.action="searchMember1.php";
	document.frm.submit();
}
function frmsubmit()
{
	document.frm.action="deleteMember.php";
	document.frm.submit();
}
function select_member()
{
	document.frm.m_no.value=(document.frm.s_id.options[document.frm.s_id.selectedIndex].text);
	document.frm.stud_name.selectedIndex=document.frm.s_id.selectedIndex;
}
function select_student()
{
	document.frm.s_id.selectedIndex=document.frm.stud_name.selectedIndex;
    document.frm.m_no.value=(document.frm.s_id.options[document.frm.s_id.selectedIndex].text);
}
</script>
<?php

	
	if ($member == 1)
		{
			$sql = "SELECT a.id,a.s_id,a.m_no,a.MemberName FROM lib_membership_m a,student_m b WHERE a.type=1 AND a.status=1 AND b.course_admitted=".$crs." AND b.course_yearsem=".$crsyr." AND b.archive='N' AND a.s_id=b.id order by b.first_name";
		}
	if($member == 2 )
		{
			$sql = "SELECT a.id,a.s_id,a.m_no,a.MemberName FROM lib_membership_m a,staff_det b WHERE a.type=2 AND a.status=1 AND b.subj='$staff' AND a.s_id=b.id order by b.f_name";
		}
	if($member == 3 )
	{
		$sql = "SELECT a.id,a.s_id,a.m_no,a.MemberName FROM lib_membership_m a,dept_no b WHERE a.type=3 AND a.status=1 AND a.s_id=b.dpt_id order by a.MemberName";
	}
	$rs = execute($sql);
	$row=rowcount($rs);
	?>
</HEAD>
<BODY>
<form method="POST" name="frm" >
<input type="hidden"  name="crs" value="<?=$crs?>">
<input type="hidden"  name="crsyr" value="<?=$crsyr?>">
<input type="hidden"  name="staff" value="<?=$staff?>">
<input type="hidden"  name="member" value="<?=$member?>">
<table align='center' class='forumline' width="47%">
	<tr>
	<?php 
		if ($member == 1)
		{
			?>
			<td class='head' align='center'>Student ID</td>
			<td class='head' align='center'>Student Name</td>
			<?php
		}
		if ($member == 2)
		{
			?>
			<td class='head' align='center'>Staff ID</td>
			<td class='head' align='center'>Staff Name</td>
			<?php
		}
		if ($member == 3)
		{
			?>
			<td class='head' align='center'>Dept ID</td>
			<td class='head' align='center'>Department Name</td>
			<?php
		}
		?>
		<td class='head' align='center'>Select</td>
	</tr>
	<?php
	for($i=1;$i<=$row;$i++)
	{
		$r = fetcharray($rs);
		$id = $r[id];
		$stud = $r[m_no];
		$name = $r[MemberName];
		?>
	<tr>
		<td align="center">&nbsp;&nbsp;<?php echo $stud ?></td>
		<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $name ?></td>
		<td align='center'><input type='checkbox' name='sel[]' value='<?php echo $id ?>'></td>
	</tr>
	<?php
	}
	?>
	<tr>
		 
	</tr>
</table>
<br>
<div align='center'><input type="button" value=" Cancel Member" name="B1" onClick="frmsubmit()" class='bgbutton' style="height:25px"></div>
<input type="hidden" name="mType" value="<?=$member?>">
</form>
</BODY>
</HTML>