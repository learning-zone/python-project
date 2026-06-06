<html>
<head>
<title>:: LIBRARY ::</title>
<?php
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";
session_start();
include("../db.php");

if($_GET)
{	
	$rtp=$_GET['rtp'];
	$media=$_GET['media'];
	$to_date=$_GET['to_date'];
	$library=$_GET['library'];
	$from_date=$_GET['from_date'];
	$issue_date=$_GET['issue_date'];
}
?>
<script language="javascript">
function prnfee()
{
	prn.style.display = "none";
	window.print(this.form);
	prn.style.display = "";
}
</script>
</head>
<body>
<?php
$rs_sqll=execute("select name from library_name where id='$library'");
$rr=fetcharray($rs_sqll);
if($ndate=="")
{
	$adate=$from_date;
	$adate1=date('d-m-Y',strtotime($from_date));
	$bdate=$to_date;
	$bdate1=date('d-m-Y',strtotime($to_date));
}
else
{
	$adate=$from_date;
	$adate1=date('d-m-Y',strtotime($from_date));
	$bdate=$to_date;
	$bdate1=date('d-m-Y',strtotime($to_date));
}
if($rtp==1)
{
	/*************************************   NUMBER OF ISSUE  *************************************/
	if($media==0)
	{
		$sql="select cno,acc_id,due_date,media_type from lib_circulation_m where issue_date between '$adate' and '$bdate' and library='$library' order by issue_date";
		$sql1="select cno,acc_id,due_date,media_type from lib_circulation_r where issue_date between '$adate' and '$bdate' and library='$library' order by issue_date";
	}
	else
	{
		$sql="select cno,acc_id,due_date,media_type from lib_circulation_m where issue_date between '$adate' and '$bdate' and library='$library' and media_type='$media' order by issue_date";
		$sql1="select cno,acc_id,due_date,media_type from lib_circulation_r where issue_date between '$adate' and '$bdate' and library='$library' and media_type='$media' order by issue_date";
	}
	?>
	<table class='forumline' align='center' cellpadding='0' cellspacing='0' border='1' width='100%'>
	<tr><td align='center' class='rowpic'>Issued Media Report From &nbsp;<? print( date("d-M-Y", strtotime($from_date)) ); ?> &nbsp; &nbsp;    To &nbsp; &nbsp;<? print( date("d-M-Y", strtotime($to_date)) );?></td></tr>
	<tr><td><table class='forumline' width='100%' align='center' cellpadding='0' cellspacing='0' border='1'>
	<tr><td align='center' class='head' colspan='11'><?=$rr[name]?></td></tr>
	<tr><td align='center' rowspan='2' class='rowpic' nowrap>Sl No.</td><td align='center' colspan='4' class='rowpic' nowrap>Member Details</td>
	<td align='center' colspan='5' class='rowpic' nowrap>Media Details</td><td align='center' rowspan='2' class='rowpic' nowrap>Due Date</td></tr>
	<tr><td align='center' class='rowpic' nowrap>Card No.</td><td align='center' class='rowpic' nowrap>Name</td><td align='center' class='rowpic' nowrap>Details</td>
	<td align='center' class='rowpic' nowrap>Type</td><td align='center' class='rowpic' nowrap>Media</td><td align='center' class='rowpic' nowrap>Acc No.</td><td align='center' class='rowpic' nowrap>Title</td>	<td align='center' class='rowpic' nowrap>Author</td><td align='center' class='rowpic' nowrap>Publisher</td></tr>
	<?php
	$rs=execute($sql);
	$sno=1;
	while($r=fetcharray($rs))
	{
		if($sno<10)
			$sno="0".$sno;
		echo "<tr><td align='center'>$sno</td>";
		echo "<td nowrap>&nbsp;&nbsp;$r[cno]</td>";
		$memname="";
		$memdet="";
		$mtyp="";
		$rr1=fetcharray(execute("select s_id,type from lib_membership_m where m_no='$r[cno]'"));
		if($rr1[1]==1)
		{
			$rr2=fetcharray(execute("select first_name,last_name,course_admitted,course_yearsem from student_m where id='$rr1[s_id]'"));
			$rr3=fetcharray(execute("select course_abbr from course_m where course_id='$rr2[course_admitted]'"));
			$rr4=fetcharray(execute("select year_name from course_year where year_id='$rr2[course_yearsem]'"));
			$memname=$rr2[first_name]." ".$rr2[last_name];
			$memdet=$rr3[0].",".$rr4[0];
			$mtyp="Student";
		}
		elseif($rr1[1]==2)
		{
			$rr2=fetcharray(execute("select f_name,s_name,subj from staff_det where id='$rr1[s_id]'"));
			$rr3=fetcharray(execute("select dept_code from dept_no where dpt_id='$rr2[subj]'"));
			$memname=$rr2[f_name]." ".$rr2[s_name];
			$memdet=$rr3[0];
			$mtyp="Staff";
		}
		else
		{
			$rr3=fetcharray(execute("select Dept,dept_code from dept_no where dpt_id='$rr1[s_id]'"));
			$memname=$rr3[Dept];
			$memdet=$rr3[dept_code];
			$mtyp="Dept";
		}
		echo "<td>&nbsp;&nbsp;$memname</td>";
		echo "<td nowrap>&nbsp;&nbsp;$memdet</td>";
		echo "<td nowrap>&nbsp;&nbsp;$mtyp</td>";
		if($r[media_type]==2 || $r[media_type]==4)
		{
			$acctbl="lib_cd_acc_det a";
			$bktbl="lib_cd_det b";
			$d="b.rack";
			$mname="CD/DVD";
		}
		elseif($r[media_type]==1)
		{
			$acctbl="lib_acc_details a";
			$bktbl="lib_book_details b";
			$d="b.publisher";
			$mname="Book";
		}
		elseif($r[media_type]==5)
		{
			$acctbl="lib_proj_acc_det a";
			$bktbl="lib_project_report_det b";
			$d="b.guide_name";
			$mname="Proj";
		}
		$rr1=fetcharray(execute("select a.acc_no,b.title,b.author,$d from $acctbl,$bktbl where a.acc_no='$r[acc_id]' and a.master_id=b.id "));
		echo "<td align='center'>$mname</td>";
		echo "<td nowrap>&nbsp;&nbsp;$rr1[0]</td>";
		echo "<td>&nbsp;&nbsp;$rr1[1]</td>";
		echo "<td>&nbsp;&nbsp;$rr1[2]</td>";
		echo "<td>&nbsp;&nbsp;$rr1[3]</td>";
		echo "<td nowrap>&nbsp;&nbsp;".date('d-m-Y',strtotime($r[due_date]))."</td></tr>";
		$sno++;
	}
	$rs=execute($sql1);
	while($r=fetcharray($rs))
	{
		if($sno<10)
			$sno="0".$sno;
		echo "<tr><td align='center'>$sno</td>";
		echo "<td nowrap>&nbsp;&nbsp;$r[cno]</td>";
		$memname="";
		$memdet="";
		$mtyp="";
		$rr1=fetcharray(execute("select s_id,type from lib_membership_m where m_no='$r[cno]'"));
		if($rr1[1]==1)
		{
			$rr2=fetcharray(execute("select first_name,last_name,course_admitted,course_yearsem from student_m where id='$rr1[s_id]'"));
			$rr3=fetcharray(execute("select course_abbr from course_m where course_id='$rr2[course_admitted]'"));
			$rr4=fetcharray(execute("select year_name from course_year where year_id='$rr2[course_yearsem]'"));
			$memname=$rr2[first_name]." ".$rr2[last_name];
			$memdet=$rr3[0].",".$rr4[0];
			$mtyp="Student";
		}
		elseif($rr1[1]==2)
		{
			$rr2=fetcharray(execute("select f_name,s_name,subj from staff_det where id='$rr1[s_id]'"));
			$rr3=fetcharray(execute("select dept_code from dept_no where dpt_id='$rr2[subj]'"));
			$memname=$rr2[f_name]." ".$rr2[s_name];
			$memdet=$rr3[0];
			$mtyp="Staff";
		}
		else
		{
			$rr3=fetcharray(execute("select Dept,dept_code from dept_no where dpt_id='$rr1[s_id]'"));
			$memname=$rr3[Dept];
			$memdet=$rr3[dept_code];
			$mtyp="Dept";
		}
		echo "<td>&nbsp;&nbsp;$memname</td>";
		echo "<td nowrap>&nbsp;&nbsp;$memdet</td>";
		echo "<td nowrap>&nbsp;&nbsp;$mtyp</td>";
		if($r[media_type]==2 || $r[media_type]==4)
		{
			$acctbl="lib_cd_acc_det a";
			$bktbl="lib_cd_det b";
			$d="b.rack";
			$mname="CD/DVD";
		}
		elseif($r[media_type]==1)
		{
			$acctbl="lib_acc_details a";
			$bktbl="lib_book_details b";
			$d="b.publisher";
			$mname="Book";
		}
		elseif($r[media_type]==5)
		{
			$acctbl="lib_proj_acc_det a";
			$bktbl="lib_project_report_det b";
			$d="b.guide_name";
			$mname="Proj";
		}
		$rr1=fetcharray(execute("select a.acc_no,b.title,b.author,$d from $acctbl,$bktbl where a.acc_no='$r[acc_id]' and a.master_id=b.id "));
		echo "<td align='center'>$mname</td>";
		echo "<td nowrap>&nbsp;&nbsp;$rr1[0]</td>";
		echo "<td>&nbsp;&nbsp;$rr1[1]</td>";
		echo "<td>&nbsp;&nbsp;$rr1[2]</td>";
		echo "<td>&nbsp;&nbsp;$rr1[3]</td>";
		echo "<td align='center' nowrap>Returned</td></tr>";
		$sno++;
	}
	echo "</table></td></tr>";
}
elseif($rtp==2)
{  
    /****************************************  RETURNED  ***********************************/
	if($media==0)
	{
			
		$sql="select cno,acc_id,due_date,media_type from lib_circulation_r where return_date between '$adate' and '$bdate' and library='$library' order by return_date";
		
	}
	else
	{
		$sql="select cno,acc_id,due_date,media_type from lib_circulation_r where return_date between '$adate' and '$bdate' and library='$library' and media_type='$media' order by return_date";
				
	}
	?>
	<table class='forumline' align='center' cellpadding='0' cellspacing='0' border='1' width='100%'>
    <tr><td align='center' class='rowpic'>Issued Media Report From &nbsp;<? print( date("d-M-Y", strtotime($from_date)) ); ?> &nbsp; &nbsp;    To &nbsp; &nbsp;<? print( date("d-M-Y", strtotime($to_date)) );?></td></tr>
	<tr><td><table class='forumline' width='100%' align='center' cellpadding='0' cellspacing='0' border='1'>
	<tr><td align='center' class='head' colspan='11'><?=$rr[name]?></td></tr>
	<tr><td align='center' rowspan='2' class='rowpic' nowrap>Sl No.</td><td align='center' colspan='4' class='rowpic' nowrap>Member Details</td>
	<td align='center' colspan='5' class='rowpic' nowrap>Media Details</td><td align='center' rowspan='2' class='rowpic' nowrap>Fine</td></tr>
	<tr><td align='center' class='rowpic' nowrap>Card No.</td><td align='center' class='rowpic' nowrap>Name</td><td align='center' class='rowpic' nowrap>Details</td>
	<td align='center' class='rowpic' nowrap>Type</td><td align='center' class='rowpic' nowrap>Media</td><td align='center' class='rowpic' nowrap>Acc No.</td><td align='center' class='rowpic' nowrap>Title</td>	<td align='center' class='rowpic' nowrap>Author</td><td align='center' class='rowpic' nowrap>Publisher</td></tr>
	<?php
	$rs=execute($sql);
	$sno=1;
	while($r=fetcharray($rs))
	{
		if($sno<10)
			$sno="0".$sno;
		echo "<tr><td align='center'>$sno</td>";
		echo "<td nowrap>&nbsp;&nbsp;$r[cno]</td>";
		$memname="";
		$memdet="";
		$mtyp="";
		$rr1=fetcharray(execute("select s_id,type from lib_membership_m where m_no='$r[cno]'"));
		if($rr1[1]==1)
		{
			$rr2=fetcharray(execute("select first_name,last_name,course_admitted,course_yearsem from student_m where id='$rr1[s_id]'"));
			$rr3=fetcharray(execute("select course_abbr from course_m where course_id='$rr2[course_admitted]'"));
			$rr4=fetcharray(execute("select year_name from course_year where year_id='$rr2[course_yearsem]'"));
			$memname=$rr2[first_name]." ".$rr2[last_name];
			$memdet=$rr3[0].",".$rr4[0];
			$mtyp="Student";
		}
		elseif($rr1[1]==2)
		{
			$rr2=fetcharray(execute("select f_name,s_name,subj from staff_det where id='$rr1[s_id]'"));
			$rr3=fetcharray(execute("select dept_code from dept_no where dpt_id='$rr2[subj]'"));
			$memname=$rr2[f_name]." ".$rr2[s_name];
			$memdet=$rr3[0];
			$mtyp="Staff";
		}
		else
		{
			$rr3=fetcharray(execute("select Dept,dept_code from dept_no where dpt_id='$rr1[s_id]'"));
			$memname=$rr3[Dept];
			$memdet=$rr3[dept_code];
			$mtyp="Dept";
		}
		echo "<td>&nbsp;&nbsp;$memname</td>";
		echo "<td nowrap>&nbsp;&nbsp;$memdet</td>";
		echo "<td nowrap>&nbsp;&nbsp;$mtyp</td>";
		if($r[media_type]==2 || $r[media_type]==4)
		{
			$acctbl="lib_cd_acc_det a";
			$bktbl="lib_cd_det b";
			$d="b.rack";
			$mname="CD/DVD";
		}
		elseif($r[media_type]==1)
		{
			$acctbl="lib_acc_details a";
			$bktbl="lib_book_details b";
			$d="b.publisher";
			$mname="Book";
		}
		elseif($r[media_type]==5)
		{
			$acctbl="lib_proj_acc_det a";
			$bktbl="lib_project_report_det b";
			$d="b.guide_name";
			$mname="Proj";
		}
		$rr1=fetcharray(execute("select a.acc_no,b.title,b.author,$d from $acctbl,$bktbl where a.acc_no='$r[acc_id]' and a.master_id=b.id "));
		echo "<td align='center'>$mname</td>";
		echo "<td nowrap>&nbsp;&nbsp;$rr1[0]</td>";
		echo "<td>&nbsp;&nbsp;$rr1[1]</td>";
		echo "<td>&nbsp;&nbsp;$rr1[2]</td>";
		echo "<td>&nbsp;&nbsp;$rr1[3]</td>";
		echo "<td align='right' nowrap>$r[fineamt]&nbsp;&nbsp;</td></tr>";
		$sno++;
	}
	echo "</table></td></tr>";
}
elseif($rtp==3)
{
	/*********************************  RENEWED  *********************************/
	if($media==0)
	{
		
		$sql="select cno,acc_id,due_date,media_type from lib_circulation_m where issue_date between '$adate' and '$bdate' and library='$library' and renews!=0 ORDER BY acc_id";
		
		$sql1="select cno,acc_id,due_date,media_type from lib_circulation_r where issue_date between '$adate' and '$bdate' and library='$library' and renews!=0 ORDER BY acc_id";
	}
	else
	{
		$sql="select cno,acc_id,due_date,media_type from lib_circulation_m where issue_date between '$adate' and '$bdate' and library='$library' and renews!=0 and media_type='$media' ORDER BY acc_id";
				
		$sql1="select cno,acc_id,due_date,media_type from lib_circulation_r where issue_date between '$adate' and '$bdate' and library='$library' and renews!=0 and media_type='$media' ORDER BY acc_id";
	}
	?>
	<table class='forumline' align='center' cellpadding='0' cellspacing='0' border='1' width='100%'>
    <tr><td align='center' class='rowpic'>Issued Media Report From &nbsp;<? print( date("d-M-Y", strtotime($from_date)) ); ?> &nbsp; &nbsp;    To &nbsp; &nbsp;<? print( date("d-M-Y", strtotime($to_date)) );?></td></tr>
	<tr><td><table class='forumline' width='100%' align='center' cellpadding='0' cellspacing='0' border='1'>
	<tr><td align='center' class='head' colspan='11'><?=$rr[name]?></td></tr>
	<tr><td align='center' rowspan='2' class='rowpic' nowrap>Sl No.</td><td align='center' colspan='4' class='rowpic' nowrap>Member Details</td>
	<td align='center' colspan='5' class='rowpic' nowrap>Media Details</td><td align='center' rowspan='2' class='rowpic' nowrap>Due Date</td></tr>
	<tr><td align='center' class='rowpic' nowrap>Card No.</td><td align='center' class='rowpic' nowrap>Name</td><td align='center' class='rowpic' nowrap>Details</td>
	<td align='center' class='rowpic' nowrap>Type</td><td align='center' class='rowpic' nowrap>Media</td><td align='center' class='rowpic' nowrap>Acc No.</td><td align='center' class='rowpic' nowrap>Title</td>	<td align='center' class='rowpic' nowrap>Author</td><td align='center' class='rowpic' nowrap>Publisher</td></tr>
	<?php
	$rs=execute($sql);
	$sno=1;
	while($r=fetcharray($rs))
	{
		if($sno<10)
			$sno="0".$sno;
		echo "<tr><td align='center'>$sno</td>";
		echo "<td nowrap>&nbsp;&nbsp;$r[cno]</td>";
		$memname="";
		$memdet="";
		$mtyp="";
		$rr1=fetcharray(execute("select s_id,type from lib_membership_m where m_no='$r[cno]'"));
		if($rr1[1]==1)
		{
			$rr2=fetcharray(execute("select first_name,last_name,course_admitted,course_yearsem from student_m where id='$rr1[s_id]'"));
			$rr3=fetcharray(execute("select course_abbr from course_m where course_id='$rr2[course_admitted]'"));
			$rr4=fetcharray(execute("select year_name from course_year where year_id='$rr2[course_yearsem]'"));
			$memname=$rr2[first_name]." ".$rr2[last_name];
			$memdet=$rr3[0].",".$rr4[0];
			$mtyp="Student";
		}
		elseif($rr1[1]==2)
		{
			$rr2=fetcharray(execute("select f_name,s_name,subj from staff_det where id='$rr1[s_id]'"));
			$rr3=fetcharray(execute("select dept_code from dept_no where dpt_id='$rr2[subj]'"));
			$memname=$rr2[f_name]." ".$rr2[s_name];
			$memdet=$rr3[0];
			$mtyp="Staff";
		}
		else
		{
			$rr3=fetcharray(execute("select Dept,dept_code from dept_no where dpt_id='$rr1[s_id]'"));
			$memname=$rr3[Dept];
			$memdet=$rr3[dept_code];
			$mtyp="Dept";
		}
		echo "<td>&nbsp;&nbsp;$memname</td>";
		echo "<td nowrap>&nbsp;&nbsp;$memdet</td>";
		echo "<td nowrap>&nbsp;&nbsp;$mtyp</td>";
		if($r[media_type]==2 || $r[media_type]==4)
		{
			$acctbl="lib_cd_acc_det a";
			$bktbl="lib_cd_det b";
			$d="b.rack";
			$mname="CD/DVD";
		}
		elseif($r[media_type]==1)
		{
			$acctbl="lib_acc_details a";
			$bktbl="lib_book_details b";
			$d="b.publisher";
			$mname="Book";
		}
		elseif($r[media_type]==5)
		{
			$acctbl="lib_proj_acc_det a";
			$bktbl="lib_project_report_det b";
			$d="b.guide_name";
			$mname="Proj";
		}
		$rr1=fetcharray(execute("select a.acc_no,b.title,b.author,$d from $acctbl,$bktbl where a.acc_no='$r[acc_id]' and a.master_id=b.id "));
		echo "<td align='center'>$mname</td>";
		echo "<td nowrap>&nbsp;&nbsp;$rr1[0]</td>";
		echo "<td>&nbsp;&nbsp;$rr1[1]</td>";
		echo "<td>&nbsp;&nbsp;$rr1[2]</td>";
		echo "<td>&nbsp;&nbsp;$rr1[3]</td>";
		echo "<td nowrap>&nbsp;&nbsp;".date('d-m-Y',strtotime($r[due_date]))."</td></tr>";
		$sno++;
	}
	$rs=execute($sql1);
	while($r=fetcharray($rs))
	{
		if($sno<10)
			$sno="0".$sno;
		echo "<tr><td align='center'>$sno</td>";
		echo "<td nowrap>&nbsp;&nbsp;$r[cno]</td>";
		$memname="";
		$memdet="";
		$mtyp="";
		$rr1=fetcharray(execute("select s_id,type from lib_membership_m where m_no='$r[cno]'"));
		if($rr1[1]==1)
		{
			$rr2=fetcharray(execute("select first_name,last_name,course_admitted,course_yearsem from student_m where id='$rr1[s_id]'"));
			$rr3=fetcharray(execute("select course_abbr from course_m where course_id='$rr2[course_admitted]'"));
			$rr4=fetcharray(execute("select year_name from course_year where year_id='$rr2[course_yearsem]'"));
			$memname=$rr2[first_name]." ".$rr2[last_name];
			$memdet=$rr3[0].",".$rr4[0];
			$mtyp="Student";
		}
		elseif($rr1[1]==2)
		{
			$rr2=fetcharray(execute("select f_name,s_name,subj from staff_det where id='$rr1[s_id]'"));
			$rr3=fetcharray(execute("select dept_code from dept_no where dpt_id='$rr2[subj]'"));
			$memname=$rr2[f_name]." ".$rr2[s_name];
			$memdet=$rr3[0];
			$mtyp="Staff";
		}
		else
		{
			$rr3=fetcharray(execute("select Dept,dept_code from dept_no where dpt_id='$rr1[s_id]'"));
			$memname=$rr3[Dept];
			$memdet=$rr3[dept_code];
			$mtyp="Dept";
		}
		echo "<td>&nbsp;&nbsp;$memname</td>";
		echo "<td nowrap>&nbsp;&nbsp;$memdet</td>";
		echo "<td nowrap>&nbsp;&nbsp;$mtyp</td>";
		if($r[media_type]==2 || $r[media_type]==4)
		{
			$acctbl="lib_cd_acc_det a";
			$bktbl="lib_cd_det b";
			$d="b.rack";
			$mname="CD/DVD";
		}
		elseif($r[media_type]==1)
		{
			$acctbl="lib_acc_details a";
			$bktbl="lib_book_details b";
			$d="b.publisher";
			$mname="Book";
		}
		elseif($r[media_type]==5)
		{
			$acctbl="lib_proj_acc_det a";
			$bktbl="lib_project_report_det b";
			$d="b.guide_name";
			$mname="Proj";
		}
		$rr1=fetcharray(execute("select a.acc_no,b.title,b.author,$d from $acctbl,$bktbl where a.acc_no='$r[acc_id]' and a.master_id=b.id "));
		echo "<td align='center'>$mname</td>";
		echo "<td nowrap>&nbsp;&nbsp;$rr1[0]</td>";
		echo "<td>&nbsp;&nbsp;$rr1[1]</td>";
		echo "<td>&nbsp;&nbsp;$rr1[2]</td>";
		echo "<td>&nbsp;&nbsp;$rr1[3]</td>";
		echo "<td align='center' nowrap>Returned</td></tr>";
		$sno++;
	}
	echo "</table></td></tr>";
}
elseif($rtp==4)
{
	/*****************************  RESERVED  **************************/
	if($media==0)
	{
		$sql="select m_id,accno,media_type,resdate from lib_reservation_temp where resdate between '$adate' and '$bdate' and l_id='$library' order by resdate";
	}
	else
	{
		$sql="select m_id,accno,media_type,resdate from lib_reservation_temp where resdate between '$adate' and '$bdate' and l_id='$library' and media_type='$media' order by resdate";
	}
	?>
	<table class='forumline' align='center' cellpadding='0' cellspacing='0' border='1' width='100%'>
    <tr><td align='center' class='rowpic'>Issued Media Report From &nbsp;<? print( date("d-M-Y", strtotime($from_date)) ); ?> &nbsp; &nbsp;    To &nbsp; &nbsp;<? print( date("d-M-Y", strtotime($to_date)) );?></td></tr>
	<tr><td><table class='forumline' width='100%' align='center' cellpadding='0' cellspacing='0' border='1'>
	<tr><td align='center' class='head' colspan='11'><?=$rr[name]?></td></tr>
	<tr><td align='center' rowspan='2' class='rowpic' nowrap>Sl No.</td><td align='center' colspan='4' class='rowpic' nowrap>Member Details</td>
	<td align='center' colspan='5' class='rowpic' nowrap>Media Details</td><td align='center' rowspan='2' class='rowpic' nowrap>Reserved Date</td></tr>
	<tr><td align='center' class='rowpic' nowrap>Card No.</td><td align='center' class='rowpic' nowrap>Name</td><td align='center' class='rowpic' nowrap>Details</td>
	<td align='center' class='rowpic' nowrap>Type</td><td align='center' class='rowpic' nowrap>Media</td><td align='center' class='rowpic' nowrap>Acc No.</td><td align='center' class='rowpic' nowrap>Title</td>	<td align='center' class='rowpic' nowrap>Author</td><td align='center' class='rowpic' nowrap>Publisher</td></tr>
	<?php
	$rs=execute($sql);
	$sno=1;
	while($r=fetcharray($rs))
	{
		if($sno<10)
			$sno="0".$sno;
		echo "<tr><td align='center'>$sno</td>";
		echo "<td nowrap>&nbsp;&nbsp;$r[m_id]</td>";
		$memname="";
		$memdet="";
		$mtyp="";
		$rr1=fetcharray(execute("select s_id,type from lib_membership_m where m_no='$r[m_id]'"));
		if($rr1[1]==1)
		{
			$rr2=fetcharray(execute("select first_name,last_name,course_admitted,course_yearsem from student_m where id='$rr1[s_id]'"));
			$rr3=fetcharray(execute("select course_abbr from course_m where course_id='$rr2[course_admitted]'"));
			$rr4=fetcharray(execute("select year_name from course_year where year_id='$rr2[course_yearsem]'"));
			$memname=$rr2[first_name]." ".$rr2[last_name];
			$memdet=$rr3[0].",".$rr4[0];
			$mtyp="Student";
		}
		elseif($rr1[1]==2)
		{
			$rr2=fetcharray(execute("select f_name,s_name,subj from staff_det where id='$rr1[s_id]'"));
			$rr3=fetcharray(execute("select dept_code from dept_no where dpt_id='$rr2[subj]'"));
			$memname=$rr2[f_name]." ".$rr2[s_name];
			$memdet=$rr3[0];
			$mtyp="Staff";
		}
		else
		{
			$rr3=fetcharray(execute("select Dept,dept_code from dept_no where dpt_id='$rr1[s_id]'"));
			$memname=$rr3[Dept];
			$memdet=$rr3[dept_code];
			$mtyp="Dept";
		}
		echo "<td>&nbsp;&nbsp;$memname</td>";
		echo "<td nowrap>&nbsp;&nbsp;$memdet</td>";
		echo "<td nowrap>&nbsp;&nbsp;$mtyp</td>";
		if($r[media_type]==2 || $r[media_type]==4)
		{
			$acctbl="lib_cd_acc_det a";
			$bktbl="lib_cd_det b";
			$d="b.rack";
			$mname="CD/DVD";
		}
		elseif($r[media_type]==1)
		{
			$acctbl="lib_acc_details a";
			$bktbl="lib_book_details b";
			$d="b.publisher";
			$mname="Book";
		}
		elseif($r[media_type]==5)
		{
			$acctbl="lib_proj_acc_det a";
			$bktbl="lib_project_report_det b";
			$d="b.guide_name";
			$mname="Proj";
		}
		$rr1=fetcharray(execute("select a.acc_no,b.title,b.author,$d from $acctbl,$bktbl where a.acc_no='$r[accno]' and a.master_id=b.id "));
		echo "<td align='center'>$mname</td>";
		echo "<td nowrap>&nbsp;&nbsp;$rr1[0]</td>";
		echo "<td>&nbsp;&nbsp;$rr1[1]</td>";
		echo "<td>&nbsp;&nbsp;$rr1[2]</td>";
		echo "<td>&nbsp;&nbsp;$rr1[3]</td>";
		echo "<td nowrap>&nbsp;&nbsp;".date('d-m-Y',strtotime($r[resdate]))."</td></tr>";
		$sno++;
	}
	echo "</table></td></tr>";
}
echo "</table><br>";
echo "<div id='prn' align='center'><input type='button' name='prnfeest' value='<< Print >>' onclick='prnfee()' class='bgbutton'></div>";
?>
</body>
</html>