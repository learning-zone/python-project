<HTML>
<HEAD>
</HEAD>
<BODY>
<?php
require("../db.php");
$to_date=$t_date;
$from_date=$f_date;

require("../db.php");
$sql1= "select a.*,b.* from lib_membership_det a,lib_membership_m b WHERE a.m_id=b.id and b.m_no='$m_no'";
$rs = execute($sql1);
$row=rowcount($rs);
$r = fetcharray($rs);

$qry= "SELECT * FROM lib_circulation_m WHERE cno='$r[mbno]'";
$qry1= execute($qry);
$pq=rowcount($qry1);
$s=fetcharray($qry1);
if($row==0)
{
	die("Member details not found in library");
}

$type = $r["type"];
$issue=$r["issued_on"];
$valid=$r["valid_till"];
$sql55="select count(cno) as total from lib_circulation_m where cno='$r[mbno]'";
$rs55=execute($sql55);
$r55=fetcharray($rs55);
$rest = substr ($m_no, 0, 2);

If($type == 1)
{
	$xyz1 = "Student Id";
	$xyz2 = "Student Name";
	$xyz3 = "Branch";
	$xyz4 = "Semester";
	$xyz5 = "Permanent Address";
	$xyz6 = "Per State";
	$xyz7 = "Per Country";
	$xyz8 = "Per pincode";
	$xyz9 = "Phone No";
	$xyz10 = "E-Mail";
    
	$msg=execute("select a.first_name,a.last_name,a.per_address,a.per_state,a.per_country,a.per_pincode,a.per_phone,a.student_id,b.m_no,b.issued_on,b.valid_till,c.coursename,d.year_name from student_m a,lib_membership_m b,course_m c,course_year d where a.id=b.s_id and b.m_no='$m_no' and c.course_id=a.course_admitted and a.course_yearsem=d.year_id");
    $msg1=fetcharray($msg);

    $id = "$msg1[student_id]";
    $name = "$msg1[first_name]"."$msg1[last_name]";
    $course = "$msg1[coursename]";
    $sem = "$msg1[year_name]";
    $temp1 = str_replace(",","<br>",$msg1[per_address]);
    $temp2 = "$msg1[per_state]";
    $temp3 = "$msg1[per_country]";
    $temp4 = "$msg1[per_pincode]";
    $temp5 = "$msg1[per_phone]";
    $temp6 = "$msg1[per_email]";
}
ElseIf($type == 2)
{
	$xyz1 = "Staff ID";
	$xyz2 = "Staff Name";
	$xyz3 = "Department";
	$xyz4 = "Designation";
	$xyz5 = "Permanent Address";
	$xyz6 = "Per City";
	$xyz7 = "Per State";
	$xyz8 = "Per Pincode";
	$xyz9 = "Phone No";
	$xyz10 = "E-Mail";

	$sql=execute("select a.f_name,a.s_name,a.	slno,a.addr_perm,a.ct_perm,a.pin_perm,a.st_perm,a.ph_perm,a.email,b.m_no,b.issued_on,b.valid_till,c.Dept,d.d_name FROM staff_det a,lib_membership_m b,dept_no c,staff_des d WHERE a.type_id=d.d_id and a.id=b.s_id and b.m_no='$m_no' and a.subj=c.dpt_id");
	$stf=fetcharray($sql);

	$id = "$stf[slno]";
	$name = "$stf[f_name]"."$stf[s_name]";
	$course = "$stf[Dept]";
    $sem = "$stf[d_name]";
    $temp1 = str_replace(",","<br>",$stf[addr_perm]);
	$temp2 = "$stf[ct_perm]";
    $temp3 = "$stf[st_perm]";
	$temp4 = "$stf[pin_perm]";
    $temp5 = "$stf[ph_perm]";
    $temp6 = "$stf[email]";
}
Else
{
echo("There was an error in retrieving the member info.No such member exist.,12,1");
}
?>
<table width="90%" cellspacing="2" cellpadding="0" align="center" Class="forumline" colspan=2>
<tr>
  <td colspan=2 class=head align=center><font size='2'>View Member Information </font></td>
</tr>
<tr height='20'>
  <td class="rowpic" align=center colspan=2>General Membership Information</td>
</tr>
<tr>
  <td><font color='red'><?php echo $xyz1?></font></td>
  <td><?php echo $id?></td>
</tr>
<tr>
  <td><font color='red'><?php echo $xyz2?></font></td>
  <td><?php echo $name?></td>
</tr>
<tr>
  <td><font color='red'><?php echo $xyz3?></font></td>
  <td><?php echo $course?></td>
</tr>
<tr>
  <td><font color='red'><?php echo $xyz4?></font></td>
  <td><?php echo $sem?></td>
</tr>
<tr>
  <td><font color='red'><?php echo $xyz5?></font></td>
  <td><?php echo $temp1?></td>
</tr>
<tr>
  <td><font color='red'><?php echo $xyz6?></font></td>
  <td><?php echo $temp2?></td>
</tr>
<tr>
  <td><font color='red'><?php echo $xyz7?></font></td>
  <td><?php echo $temp3?></td>
</tr>
<tr>
  <td><font color='red'><?php echo $xyz8?></font></td>
  <td><?php echo $temp4?></td>
</tr>
<tr>
  <td><font color='red'><?php echo $xyz9?></font></td>
  <td><?php echo $temp5?></td>
</tr>
<tr>
  <td><font color='red'><?php echo $xyz10?></font></td>
  <td><?php echo $temp6?></td>
</tr>
</table>

<br>
 <table border="0" width="90%" class=forumline align=center colspan=6>
 <tr height='20'>
   <td colspan=6 class='head' align='center'><font size=2>Member Library Card Information:</font></td>
 <tr height='20'>
   <td class="rowpic" align=center>Card Number</td>
   <td class="rowpic" align=center>Member Id</td>
   <td class="rowpic" align=center>Member No</td>
   <td class="rowpic" align=center>Total Media Borrowed</td>
   <td class="rowpic" align=center>Card Issued On</td>
   <td class="rowpic" align=center>Card Valid Till</td>
 </tr>
 <tr>
  <td align=center><?php echo $r["mbno"] ?></td>
  <td align=center><?php echo $r["m_id"] ?></td>
  <td align=center><?php echo $r["m_no"] ?></td>
  <td align=center><?php echo $r55["total"] ?></td>
  <td align=center><?php echo $issue ?></td>
  <td align=center><?php echo $valid ?></td>
</tr>
</table>

<br>
<?php
$sql1 = "SELECT distinct(a.mbno),a.m_id,b.s_id,b.type FROM lib_membership_det a,lib_membership_m b,lib_circulation_m c";
$sql1 .=" where c.m_id=a.m_id and b.m_no='$m_no' and a.m_id=b.id";
$exsql1=execute($sql1);
$nn=fetcharray($exsql1);
$row3=rowcount($exsql1);
if($nn[type]==1)
$sdm11=execute("select first_name  from student_m where id=$nn[s_id] ");
if($nn[type]==2)
$sdm11=execute("select f_name  from staff_det where id=$nn[s_id] ");
$fmn11=fetcharray($sdm11);
?>
<table width="90%" cellspacing="1" cellspacing=2 class=forumline align=center colspan='7'>
<tr height='20'>
  <td align="center" colspan='7' class='head'><font size=2>Trnsaction Information :</font></td>
</tr>
<tr height='15'>
  <td class="rowpic" width='15%' align="center">Name </td>
  <td class="rowpic" align="center"> Accession No. </td>
  <td class="rowpic" align="center"> Title </td>
  <td class="rowpic" align="center"> Media Type</td>
  <td class="rowpic" align="center"> Issue Date </td>
  <td class="rowpic" align="center"> Due Date </td>
  <td class="rowpic" align="center"> Return Date </td>
</tr>
<?php
for($e=0;$e<$row3;$e++)
{
$var_03=execute("select a.issue_date,a.return_date,a.due_date,a.acc_id,d.name,c.title from lib_circulation_m a,lib_acc_details b,lib_book_details c,lib_mediatype d where d.id=b.media_type and a.acc_id=b.acc_no and b.master_id=c.id and a.cno='$nn[mbno]' and a.m_id='$nn[m_id]' and a.media_type=1 and a.issue_date between '$f_date' and '$t_date'");
for($a=0;$a<rowcount($var_03);$a++)
{
$exftch=fetcharray($var_03);
$clr1="black";
if($exftch[return_date]=="0000-00-00")
{
$pend="Pending";
$clr1="red";
}
else
$pend=$exftch[return_date];
?>
<tr>
 <td><?php echo $fmn11[0] ?></td>
 <td><?php echo $exftch[acc_id] ?></td>
 <td><?php echo $exftch[title] ?></td>
 <td><?php echo $exftch[name] ?></td>
 <td><?php echo $exftch[issue_date] ?></td>
 <td><?php echo $exftch[due_date] ?></td>
 <td><font color=<?php echo $clr1 ?>><?php echo $pend ?></font></td>
</tr>
<?php
}

$var_04=execute("select a.issue_date,a.return_date,a.due_date ,a.acc_id,d.name,c.title from lib_circulation_m a,lib_cd_acc_det b,lib_cd_det c,lib_mediatype d where d.id=b.media_type and a.acc_id=b.acc_no and b.master_id=c.id and a.cno='$nn[mbno]' and a.m_id='$nn[m_id]' and a.media_type in(2,4) and a.issue_date between '$f_date' and '$t_date'");
for($q1=0;$q1<rowcount($var_04);$q1++)
{
$exftch=fetcharray($var_04);
$clr1="black";
if($exftch[return_date]=="0000-00-00")
{
$pend="Pending";
$clr1="red";
}
else
$pend=$exftch[return_date];
?>
<tr>
 <td><?php echo $fmn11[0] ?></td>
 <td><?php echo $exftch[acc_id] ?></td>
 <td><?php echo $exftch[title] ?></td>
 <td><?php echo $exftch[name] ?></td>
 <td><?php echo $exftch[issue_date] ?></td>
 <td><?php echo $exftch[due_date] ?></td>
 <td><font color=<?php echo $clr1 ?>><?php echo $pend ?></font></td>
</tr>
<?php
}

$var_05=execute("select a.issue_date,a.return_date,a.due_date ,a.acc_id,d.name,c.title from lib_circulation_m a,lib_floppy_acc_det b,lib_floppy_det c,lib_mediatype d where d.id=b.media_type and a.acc_id=b.acc_no and b.master_id=c.id and a.cno='$nn[mbno]' and a.m_id='$nn[m_id]' and a.media_type=3 and a.issue_date between '$f_date' and '$t_date'");
for($q1=0;$q1<rowcount($var_05);$q1++)
{
$exftch=fetcharray($var_05);
$clr1="black";
if($exftch[return_date]=="0000-00-00")
{
$pend="Pending";
$clr1="red";
}
else
$pend=$exftch[return_date];
?>
<tr>
 <td><?php echo $fmn11[0] ?></td>
 <td><?php echo $exftch[acc_id] ?></td>
 <td><?php echo $exftch[title] ?></td>
 <td><?php echo $exftch[name] ?></td>
 <td><?php echo $exftch[issue_date] ?></td>
 <td><?php echo $exftch[due_date] ?></td>
 <td><font color=<?php echo $clr1 ?>><?php echo $pend ?></font></td>
</tr>
<?php
}

$var_06=execute("select a.issue_date,a.return_date,a.due_date ,a.acc_id,d.name,c.title from lib_circulation_m a, lib_proj_acc_det b,lib_project_report_det c,lib_mediatype d where d.id=b.media_type and a.acc_id=b.acc_no and b.master_id=c.id and a.cno='$nn[mbno]' and a.m_id='$nn[m_id]' and a.media_type=5 and a.issue_date between '$f_date' and '$t_date'");
for($q1=0;$q1<rowcount($var_06);$q1++)
{
$exftch=fetcharray($var_06);
$clr1="black";
if($exftch[return_date]=="0000-00-00")
{
$pend="Pending";
$clr1="red";
}
else
$pend=$exftch[return_date];
?>
<tr>
 <td><?php echo $fmn11[0] ?></td>
 <td><?php echo $exftch[acc_id] ?></td>
 <td><?php echo $exftch[title] ?></td>
 <td><?php echo $exftch[name] ?></td>
 <td><?php echo $exftch[issue_date] ?></td>
 <td><?php echo $exftch[due_date] ?></td>
 <td><font color=<?php echo $clr1 ?>><?php echo $pend ?></font></td>
</tr>
<?php
}

$var_07=execute("select a.issue_date,a.return_date,a.due_date,a.acc_id,c.title from lib_circulation_m a,lib_magazine b,lib_magazine_subscription c where a.acc_id=b.magazine_no and b.magazine_sub_no=c.id and a.cno='$nn[mbno]' and a.m_id='$nn[m_id]' and a.media_type=7 and a.issue_date between '$f_date' and '$t_date'");
for($q1=0;$q1<rowcount($var_07);$q1++)
{
$exftch=fetcharray($var_07);
$clr1="black";
if($exftch[return_date]=="0000-00-00")
{
$pend="Pending";
$clr1="red";
}
else
$pend=$exftch[return_date];
?>
<tr>
 <td><?php echo $fmn11[0] ?></td>
 <td><?php echo $exftch[acc_id] ?></td>
 <td><?php echo $exftch[title] ?></td>
 <td>Magazine/Journal</td>
 <td><?php echo $exftch[issue_date] ?></td>
 <td><?php echo $exftch[due_date] ?></td>
 <td><font color=<?php echo $clr1 ?>><?php echo $pend ?></font></td>
</tr>
<?php
}

$var_08=execute("select a.issue_date,a.return_date,a.due_date,a.acc_id,b.month,b.year,b.scheme,c.subject_code from lib_circulation_m a,lib_question_paper_det b,subject_m c where a.acc_id=b.id and b.subject=c.subject_id and a.cno='$nn[mbno]' and a.m_id='$nn[m_id]' and a.media_type=8 and a.issue_date between '$f_date' and '$t_date'");
for($q1=0;$q1<rowcount($var_08);$q1++)
{
$exftch=fetcharray($var_08);
$clr1="black";
if($exftch[return_date]=="0000-00-00")
{
$pend="Pending";
$clr1="red";
}
else
$pend=$exftch[return_date];
?>
<tr>
 <td><?php echo $fmn11[0] ?></td>
 <td><?php echo $exftch[acc_id] ?></td>
 <td><?php echo $exftch[subject_code].",".$exftch[month]."/".$exftch[year].",".$exftch[scheme]?>&nbsp;Scheme</td>
 <td>Question Paper</td>
 <td><?php echo $exftch[issue_date] ?></td>
 <td><?php echo $exftch[due_date] ?></td>
 <td><font color=<?php echo $clr1 ?>><?php echo $pend ?></font></td>
</tr>
<?php
}
}
?>
</table>
<br>
<?php
$sql1 = "SELECT distinct(a.mbno),a.m_id,b.s_id,b.type FROM lib_membership_det a,lib_membership_m b,lib_reference_media_trans c";
$sql1 .=" where c.m_id=a.m_id and b.m_no='$m_no' and a.m_id=b.id";
$exsql1=execute($sql1);
$nn=fetcharray($exsql1);
$row3=rowcount($exsql1);
if($nn[type]==1)
$sdm11=execute("select first_name  from student_m where id=$nn[s_id] ");
if($nn[type]==2)
$sdm11=execute("select f_name  from staff_det where id=$nn[s_id] ");
$fmn11=fetcharray($sdm11);
?>
<table width="90%" cellspacing="1" cellspacing=2 class=forumline align=center colspan='7'>
<tr height='20'>
  <td align="center" colspan='7' class='head'><font size=2>Reference Media Trnsaction Information :</font></td>
</tr>
<tr height='15'>
  <td class="rowpic" width='15%' align="center">Name </td>
  <td class="rowpic" align="center"> Accession No. </td>
  <td class="rowpic" align="center"> Title </td>
  <td class="rowpic" align="center"> Media Type</td>
  <td class="rowpic" align="center"> Issue Date </td>
  <td class="rowpic" align="center"> Due Date </td>
  <td class="rowpic" align="center"> Return Date </td>
</tr>
<?php
for($e=0;$e<$row3;$e++)
{
$var_03=execute("select a.issue_date,a.return_date,a.due_date,a.acc_id,d.name,c.title from lib_reference_media_trans a,lib_acc_details b,lib_book_details c,lib_mediatype d where d.id=b.media_type and a.acc_id=b.acc_no and b.master_id=c.id and a.cno='$nn[mbno]' and a.m_id='$nn[m_id]' and a.media_type=1 and a.issue_date between '$f_date' and '$t_date'");
for($a=0;$a<rowcount($var_03);$a++)
{
$exftch=fetcharray($var_03);
$clr1="black";
if($exftch[return_date]=="0000-00-00")
{
$pend="Pending";
$clr1="red";
}
else
$pend=$exftch[return_date];
?>
<tr>
 <td><?php echo $fmn11[0] ?></td>
 <td><?php echo $exftch[acc_id] ?></td>
 <td><?php echo $exftch[title] ?></td>
 <td><?php echo $exftch[name] ?></td>
 <td><?php echo $exftch[issue_date] ?></td>
 <td><?php echo $exftch[due_date] ?></td>
 <td><font color=<?php echo $clr1 ?>><?php echo $pend ?></font></td>
</tr>
<?php
}

$var_04=execute("select a.issue_date,a.return_date,a.due_date ,a.acc_id,d.name,c.title from lib_reference_media_trans a,lib_cd_acc_det b,lib_cd_det c,lib_mediatype d where d.id=b.media_type and a.acc_id=b.acc_no and b.master_id=c.id and a.cno='$nn[mbno]' and a.m_id='$nn[m_id]' and a.media_type in(2,4) and a.issue_date between '$f_date' and '$t_date'");
for($q1=0;$q1<rowcount($var_04);$q1++)
{
$exftch=fetcharray($var_04);
$clr1="black";
if($exftch[return_date]=="0000-00-00")
{
$pend="Pending";
$clr1="red";
}
else
$pend=$exftch[return_date];
?>
<tr>
 <td><?php echo $fmn11[0] ?></td>
 <td><?php echo $exftch[acc_id] ?></td>
 <td><?php echo $exftch[title] ?></td>
 <td><?php echo $exftch[name] ?></td>
 <td><?php echo $exftch[issue_date] ?></td>
 <td><?php echo $exftch[due_date] ?></td>
 <td><font color=<?php echo $clr1 ?>><?php echo $pend ?></font></td>
</tr>
<?php
}

$var_05=execute("select a.issue_date,a.return_date,a.due_date ,a.acc_id,d.name,c.title from lib_reference_media_trans a,lib_floppy_acc_det b,lib_floppy_det c,lib_mediatype d where d.id=b.media_type and a.acc_id=b.acc_no and b.master_id=c.id and a.cno='$nn[mbno]' and a.m_id='$nn[m_id]' and a.media_type=3 and a.issue_date between '$f_date' and '$t_date'");
for($q1=0;$q1<rowcount($var_05);$q1++)
{
$exftch=fetcharray($var_05);
$clr1="black";
if($exftch[return_date]=="0000-00-00")
{
$pend="Pending";
$clr1="red";
}
else
$pend=$exftch[return_date];
?>
<tr>
 <td><?php echo $fmn11[0] ?></td>
 <td><?php echo $exftch[acc_id] ?></td>
 <td><?php echo $exftch[title] ?></td>
 <td><?php echo $exftch[name] ?></td>
 <td><?php echo $exftch[issue_date] ?></td>
 <td><?php echo $exftch[due_date] ?></td>
 <td><font color=<?php echo $clr1 ?>><?php echo $pend ?></font></td>
</tr>
<?php
}

$var_06=execute("select a.issue_date,a.return_date,a.due_date ,a.acc_id,d.name,c.title from lib_reference_media_trans a, lib_proj_acc_det b,lib_project_report_det c,lib_mediatype d where d.id=b.media_type and a.acc_id=b.acc_no and b.master_id=c.id and a.cno='$nn[mbno]' and a.m_id='$nn[m_id]' and a.media_type=5 and a.issue_date between '$f_date' and '$t_date'");
for($q1=0;$q1<rowcount($var_06);$q1++)
{
$exftch=fetcharray($var_06);
$clr1="black";
if($exftch[return_date]=="0000-00-00")
{
$pend="Pending";
$clr1="red";
}
else
$pend=$exftch[return_date];
?>
<tr>
 <td><?php echo $fmn11[0] ?></td>
 <td><?php echo $exftch[acc_id] ?></td>
 <td><?php echo $exftch[title] ?></td>
 <td><?php echo $exftch[name] ?></td>
 <td><?php echo $exftch[issue_date] ?></td>
 <td><?php echo $exftch[due_date] ?></td>
 <td><font color=<?php echo $clr1 ?>><?php echo $pend ?></font></td>
</tr>
<?php
}
}
?>
</BODY>
</HTML>