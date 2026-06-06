<?php
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";
require_once("../db.php");
$Cno=$_GET['Cno'];
$sql1= "SELECT * FROM `lib_membership_m` WHERE m_no='$Cno'";
$rs = execute($sql1);
$row=rowcount($rs);
$qry= "SELECT * FROM lib_circulation_m WHERE cno='$Cno'";
$qry1= execute($qry);
$pq=rowcount($qry1);
$s=fetcharray($qry1);
if($row==0)
{
	die("Member details not found in library");
}
$r = fetcharray($rs);
$type = $r["type"];
$issue=$r["issued_on"];
$valid=$r["valid_till"];
$sql55="select count(cno) as total from lib_circulation_m where cno='$Cno'";
$rs55=execute($sql55);
$r55=fetcharray($rs55);
$rest = substr ($m_no, 0, 2);
?>
<HTML>
<HEAD>
<script language="JavaScript">
function printReport()
{
	prn.style.display = "none";
	window.print();
	prn.style.display = " ";
}
</script>
</HEAD>
<BODY>
<?php
if($type == 1)
{
	$xyz1 = "University No";
	$xyz2 = "Student Name";
	$xyz3 = "Branch";
	$xyz4 = "Sem";
	$xyz5 = "Correspondence Address";
	$xyz6 = "Correspondence State";
	$xyz7 = "Permanent Address";
	$xyz8 = "Permanent State";
	$xyz9 = "Local Address";
	$xyz10 = "Local State";

    $msg=execute("select a.*,b.coursename,c.year_name from student_m a,course_m b, course_year c where a.course_admitted=b.course_id and a.course_yearsem=c.year_id and a.id='$r[s_id]'");
    $msg1=fetcharray($msg);

    $id = "$msg1[student_id]";
	$name = "$msg1[first_name]&nbsp;"."&nbsp;$msg1[last_name]";
    $course = "$msg1[coursename]";
    $sem = "$msg1[year_name]";
    $temp1 = str_replace(",","<br>",$msg1[cor_address]);
	$temp2 = "$msg1[cor_state]<br>"."$msg1[cor_pincode]<br>"."$msg1[cor_phone]<br>"."$msg1[cor_email]";
	$temp3 = str_replace(",","<br>",$msg1[per_address]);
	$temp4 = "$msg1[per_state]<br>"."$msg1[per_pincode]<br>"."$msg1[per_phone]<br>"."$msg1[per_email]";
    $temp5 = str_replace(",","<br>",$msg1[loc_address]);
    $temp6 = "$msg1[loc_state]<br>"."$msg1[loc_pincode]<br>"."$msg1[loc_phone]<br>"."$msg1[loc_email]";
}
if($type == 2)
{
	$xyz1 = "Staff ID";
	$xyz2 = "Staff Name";
	$xyz3 = "Department";
	$xyz4 = "Designation";
	$xyz5 = "Correspondence Address";
	$xyz6 = "Correspondence State";
	$xyz7 = "Permanent Address";
	$xyz8 = "Permanent State";
	$xyz9 = "E-Mail";
	$xyz10 = "";

	$sql=execute("select a.*,b.Dept,c.d_name from staff_det a,dept_no b,staff_des c where a.id='$r[s_id]' and a.subj=b.dpt_id and a.type_id=c.d_id");
	$stf=fetcharray($sql);
	
	$id = "$stf[slno]";
	$name = "$stf[f_name]&nbsp;"."&nbsp;$stf[s_name]";
	$course = "$stf[Dept]";
    $sem = "$stf[d_name]";
    $temp1 = str_replace(",","<br>",$stf[addr_perm]);
	$temp2 = "$stf[ct_perm]<br>"."$stf[st_perm]<br>"."$stf[pin_perm]<br>"."$stf[ph_perm]";
    $temp3 = str_replace(",","<br>",$stf[addr_pres]);
	$temp4 = "$stf[ct_pres]<br>"."$stf[st_pres]<br>"."$stf[pin_pres]<br>"."$stf[ph_pres]";
    $temp5 = str_replace(",","<br>",$stf[email]);
    $adrs6 = "";
}
?>
<table width="80%" align="center" class="forumline" colspan='4'>
<tr>
  <td align="center" Class="head" colspan='4'>View MemberInfo </td>
</tr>
<tr height='25'>
  <td colspan="4" align="left" class="row3">General Membership Information :</td>
</tr>
<tr height='25'>
  <td><?php echo $xyz1?></td>
  <td><?php echo $id?></td>
  <td><?php echo $xyz2?></td>
  <td><?php echo $name?></td>
</tr>
<tr>
  <td><?php echo $xyz3?></td>
  <td><?php echo $course?></td>
  <td><?php echo $xyz4?></td>
  <td><?php echo $sem?></td>
</tr>
<tr>
  <td><?php echo $xyz5?></td>
  <td><?php echo $temp1?></td>
  <td><?php echo $xyz6?></td>
  <td><?php echo $temp2?></td>
</tr>
<tr>
  <td><?php echo $xyz7?></td>
  <td><?php echo $temp3?></td>
  <td><?php echo $xyz8?></td>
  <td><?php echo $temp4?></td>
</tr>

<tr>
  <td><?php echo $xyz9?></td>
  <td><?php echo $temp5?></td>
  <td><?php echo $xyz10?></td>
  <td><?php echo $temp6?></td>
</tr>
<tr>
</tr>
<tr>
  <td colspan="4"><table width='100%' class='forumline' align="center" colspan='4'>
<tr height='25'>
  <td colspan="4" align="left" class="row3">Member Library Card Information:</td>
</tr>
<tr>
  <td>Card Number</td>
  <td><?=$s["cno"]?></td>
  <td>Member Id</td>
  <td><?=$s["m_id"]?></td>
</tr>
<tr>
  <td>Member No</td>
  <td><?=$r["m_no"]?></td>
  <td>Total Media Borrowed</td>
  <td><?=$r55["total"]?></td>
</tr>
<tr>
  <td>Card Issued On</td>
  <td><?=$issue?></td>
  <td>Card Valid Till</td>
  <?
  		if($valid=="0000-00-00")
		{
			$validF='NULL';	
		}
		else
		{
			$validF=date("d-m-Y", strtotime($inserted_date));
		}
  ?>
  <td><?=$validF?></td>
</tr>
</table>
</td>
</tr>
</table>
<br>
<div id='prn' align='center'>
<INPUT TYPE="button" id="prn" NAME="print" VALUE="<<  Print  >>" class='bgbutton' onClick="printReport()"></div>
</BODY>
</HTML>