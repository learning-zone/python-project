<?php
require_once("../db.php");
$member = $_POST['member'];
$B1 = $_POST['B1'];
$member = trim("$member");
$crsyr = $_POST['crsyr'];
$staff = $_POST['staff'];
$crs = $_POST['crs'];
$frm = $_POST['frm'];
$mType = $_POST['mType'];
	if ($member == 1)
		{
			$sql="SELECT student_id,id,usn,first_name,last_name FROM student_m where course_admitted=".$crs." AND course_yearsem=".$crsyr." and archive='N' and id not in(select s_id from lib_membership_m where status=1 and type=1) ORDER BY first_name";
			$msg = "<center>Membership already created for all Students ...</center>";
		}
	if($member == 2 )
		{
			$sql="select slno,f_name,s_name,id from staff_det where subj='$staff' and active='YES' and id not in(select s_id from lib_membership_m where status=1 and type=2) ORDER BY f_name";
			$msg = "<center>Membership already created for all Staff ...</center>";
		}
	if($member == 3 )
		{
			$sql="select Dept,dpt_id,dept_code from dept_no where status=1 and dpt_id not in (select s_id from lib_membership_m where status=1 and type=3) ORDER BY Dept ";
			$msg = "<center>Membership already created for all Departments ...</center>";
		}
	$rs = execute($sql);
	$row=rowcount($rs);
	if($row==0)
	{
		echo "$msg<br>";
		die();
	}
?>
<HTML>
<HEAD>
<script language="javascript">
function frm_reload()
{
	document.frm.action="searchMember.php";
	document.frm.submit();
}
function frmsubmit()
{
	document.frm.action="addMember.php";
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
function selectMe()
{
	var i = document.frm.length;
	for(j=0;j<i;j++)
	{
		if(document.frm[j].Sel != "CheckBox")
		{
			flag = document.frm[j].checked;
			document.frm[j].checked = !flag;
		}
	}
}
</script>

</HEAD>
<BODY>
<form method="POST" name="frm" >
<input type="hidden"  name="member" value="<?=$member?>">
<input type="hidden"  name="crs" value="<?=$crs?>">
<input type="hidden"  name="crsyr" value="<?=$crsyr?>">
<input type="hidden"  name="staff" value="<?=$staff?>">
<table align='center' class='forumline' width="47%">
	<tr height='20'>
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
			<td class='head' align='center' nowrap>Deparment Code</td>
			<td class='head' align='center' nowrap>Department Name</td>
			<?php
		}
		?>
		<td class='head' align='center'><div class="head" id="checkAll" 
	onClick="selectMe()" Title="Click to Select all Students">Select ALL<input type="checkbox"></div></td>
	</tr>
	<?php
	for($i=1;$i<=$row;$i++)
	{
		$r = fetcharray($rs);
		if ($member == 1)
			{
				$id = $r[id];	
				$stud = $r[student_id];
				$name = $r[first_name]."&nbsp;".$r[last_name];
			}
		if($member == 2)
			{
				$id = $r[id];
				$stud = $r[slno];
				$name = $r[f_name]."&nbsp;".$r[s_name];
			}
			if ($member == 3)
			{
				$id = $r[dpt_id];	
				$stud = $r[dept_code];
				$name = $r[Dept];
			}
		?>
	<tr>
		<td align="center"><?php echo $stud ?></td>
		<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php echo $name ?></td>
		<td align='center'><input type='checkbox' name='sel[]' value='<?php echo $id ?>'></td>
	</tr>
	<?php
	}
	?>
	<tr>
		
	</tr>
</table>
<br>
<div align='center'><input type="button" value=" Add Member" name="B1" onClick="frmsubmit()" class='bgbutton'></div>
<input type="hidden" name="mType" value="<?=$member?>">
</form>
</BODY>
</HTML>