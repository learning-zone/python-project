<html>
<head>
<title>Fee Due Intimation</title>
<?php
session_start();
include("../db.php");
include("numbers-words.php");
?>
<script language="javascript" type="text/javascript">
function dataprint()
{
	prn.style.display = "none";
	window.print(this.form);
}
function OpenWind(k)
{
	var finalVar;
	finalVar=k;
	window.open(finalVar,'Stud','height=700,width=800,status=no,toolbar=no,scrollbars=yes,menubar=no,location=no');
}

</script>
</head>
<!-- <body oncontextmenu="return false;" onkeydown='showKeyCode(event.keyCode)'> -->
<body>
<?php

$sql=fetcharray(execute("select first_name,last_name,student_id,class_section_id,course_yearsem,admission_id from student_m where id=$stud_id"));
$sql1=("insert into fee_payment(duedate) values ('$duedate')");
$insidd=fetchInsertId();
?>
<form name="frm" method='post'>
<input type="hidden" name="cmt1" value="<?=$mon?>">
<input type="hidden" name="cyr1" value="<?=$year?>">

<table align='center' width='100%' border='1' cellspacing='0' cellpadding='0'>
<tr><td width='45%'>
<table align='center' width='100%' border='0' cellspacing='0' cellpadding='0'>
<tr><td colspan='6'>
<table align='center' width='100%'cellspacing='0' cellpadding='0' border='1'>
<tr><td align='left' width='85'><img src="../images/logo.jpg" width='85' height='100' border='0'></img></td>
<td align='center'colspan='6' ><table border='0' align='center' width='100%' cellspacing='0' cellpadding='0' >
<tr><td align='center' style='font-size:20px;' nowrap><b><?php echo collegename(); ?></td></tr>
<tr><td align='center' style='font-size:10px;' nowrap>(Recognised by Govt. of Karnataka)</td></tr>
<tr><td align='center' style='font-size:10px;' nowrap>M.E.S. Road, Bangalore - 560013</b></td></tr>
</table></td></tr>
</table></td></tr>
<tr><td colspan='6' valign='top' align='right' style='font-size:10px;'><u>Office Copy</u>&nbsp;&nbsp;</td></tr>
<tr height='25'><td colspan='6' align='center'><font size='2.5'><u>Fee Due Intimation  <?=$tmprd?></u></font></td></tr>
<tr><td align='left'>&nbsp;&nbsp;&nbsp;Dear Parent </td></tr>
<tr><td align='left' colspan="6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You are requsted to pay the following fee dues of your child on or before : &nbsp;&nbsp;<?php echo $_GET['day'].'/'.date('M',mktime(0,0,0,$_GET['mon'])).'/'.$_GET['year'];?></td></tr>
<tr><td style="width:400px;">&nbsp;&nbsp;Name :&nbsp;&nbsp;&nbsp;<?=$sql[0]?> <?=$sql[1]?></td><td align="right" colspan="4">Date&nbsp; :&nbsp;  </td><td align="left">&nbsp;&nbsp;<?php echo date("d/m/Y"); ?></td></tr>
<?php
$vv1=fetchrow(execute("select balamt from fee_payment where studid=$_GET[stud_id]"));
$cname=fetcharray(execute("select year_name from course_year where year_id='$sql[course_yearsem]'"));
$secname=fetcharray(execute("select section_name from class_section where id='$sql[class_section_id]'"));
?>
<tr><td style="width:300px;">&nbsp;&nbsp;Class :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$cname[year_name]?></td><td align='right' colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Admn&nbsp;No&nbsp;:&nbsp;</td><td>&nbsp;&nbsp;&nbsp;<?=$sql[admission_id]?></td></tr>
<tr><td style="width:300px;">&nbsp;&nbsp;Roll No :&nbsp;&nbsp;&nbsp;<?=$sql[student_id]?></td><td align='right' colspan="4">Section&nbsp;:&nbsp;</td><td>&nbsp;&nbsp;<?=$secname[section_name]?></td></tr>
<tr><td colspan='6'>
<table border='1' align='center' width='100%' cellspacing='0' cellpadding='0'>
<tr><td align='center' width='18%' rowspan='2'>Particulars</td><td align='center' rowspan='2' width="30%">
From&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;To</td><td align='center' colspan="2"  width='20%'>Amount</td></tr>

<tr><td align='center' width='8%'>Rs.</td><td align='center'  width='2%'>&nbsp;&nbsp;Ps.</td></tr>
<tr><td align='center' width='15%' row span='2'>Previous Dues</td><td align="center"> <?php  if($_GET['tmid']==1){ echo 'June-September/'.$_GET['year'] ;} if($_GET['tmid']=='2'){ echo 'October/'.$_GET['year'] . '-' . 'January/'.($_GET['year']+1);} if($_GET['tmid']=='3'){ echo 'Febrauary-May/'.$_GET['year'] ;}?>&nbsp;
 </td><td align="center"> <?php if ($_GET['tmid']==1) echo $vv1[0] ?>&nbsp;</td><td align="center"> &nbsp;00&nbsp;</td></tr>
<tr><td align='center' width='15%' row span='2' nowrap>Current Month Dues</td><td align="center"><?php echo date('M',mktime(0,0,$_GET['mon'])).'/'.$year?> &nbsp; </td><td align="center">&nbsp; </td><td align="center">  00</td></tr>
<tr><td align='center' width='15%' row span='2' nowrap>Total Amt Due</td><td>&nbsp;</td><td align="center"> <?php if ($_GET['tmid']==1) echo $vv1[0] ?> &nbsp;</td><td align="center">00</td></tr>		
</td></tr></table>

</td></tr>
<tr><td colspan='6'><div id='a1' align='left'>&nbsp;&nbsp;&nbsp;If you have already cleared the above due amount,Please Ignore this intimation.</div></td></tr>

<tr><td colspan='5'><br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;Accountant</td><td valign='bottom'>Principal/HM&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
</table></td>
<td width='5%' nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td width='45%'>
<table align='center' width='100%' border='0' cellspacing='0' cellpadding='0' >
<tr><td width='45%'>
<table align='center' width='100%' border='0' cellspacing='0' cellpadding='0'>
<tr><td colspan='6'>
<table align='center' width='100%'cellspacing='0' cellpadding='0' border='1'>
<tr><td align='left' width='85'><img src="../images/logo.jpg" width='85' height='100' border='0'></img></td>
<td align='center'colspan='6' ><table border='0' align='center' width='100%' cellspacing='0' cellpadding='0' >
<tr><td align='center' style='font-size:20px;' nowrap><b><?php echo collegename(); ?></td></tr>
<tr><td align='center' style='font-size:10px;' nowrap>(Recognised by Govt. of Karnataka)</td></tr>
<tr><td align='center' style='font-size:10px;' nowrap>M.E.S. Road, Bangalore - 560013</b></td></tr>
</table></td></tr>
</table></td></tr>
<tr><td colspan='6' valign='top' align='right' style='font-size:10px;'><u>Student Copy</u>&nbsp;&nbsp;</td></tr>
<tr height='25'><td colspan='6' align='center'><font size='2.5'><u>Fee Due Intimation <?=$tmprd?></u></font></td></tr>
<tr><td align='left'>&nbsp;&nbsp;&nbsp;Dear Parent </td></tr>
<tr><td align='left' colspan="6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You are requsted to pay the following fee dues of your child on or before :&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_GET['day'].'/'.date('M',mktime(0,0,0,$_GET['mon'])).'/'.$_GET['year']; ?></td></tr>
<tr><td style="width:400px;">&nbsp;&nbsp;Name :&nbsp;&nbsp;&nbsp;&nbsp;<?=$sql[0]?> <?=$sql[1]?></td><td align="right" colspan="4" > Date&nbsp; :&nbsp; </td><td align="left">&nbsp;&nbsp;<?php echo date("d/m/Y"); ?></td></tr>
<tr><td style=" width:300px;">&nbsp;&nbsp;Class : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$cname[year_name]?></td><td align='left' colspan="5">&nbsp;Admn&nbsp;No&nbsp;:&nbsp;&nbsp;&nbsp;<?=$sql[admission_id]?></td></tr>
<tr><td style ="width:300px;">&nbsp;&nbsp;Roll No :&nbsp;&nbsp;&nbsp;&nbsp;<?=$sql[student_id]?></td><td align='right' colspan="4">Section&nbsp;:&nbsp;&nbsp;&nbsp;</td><td><?=$secname[section_name]?></td></tr>
<tr><td colspan='6'>
<table border='1' align='center' width='100%' cellspacing='0' cellpadding='0'>
<tr><td align='center' width='18%' rowspan='2'>Particulars</td></td><td align='center' rowspan='2' width="25%">
From&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;To</td><td align='center' colspan='2' width='25%'>Amount</td></tr>

<tr><td align='center' width='8%'>Rs.</td><td align='center' width='7%'>&nbsp;&nbsp;Ps.</td></tr>
<tr><td align='center' width='15%' row span='2'>Previous Dues</td><td align="center"><?php  if($_GET['tmid']==1){ echo 'June-September/'.$_GET['year'] ;} if($_GET['tmid']=='2'){ echo 'October/'.$_GET['year'] . '-' . 'January/'.($_GET['year']+1);} if($_GET['tmid']=='3'){ echo 'Febrauary-May/'.$_GET['year'] ;}?>&nbsp;
 &nbsp;</td><td align="center"><?php if($_GET['tmid']==1){ echo $vv1[0];}  ?>&nbsp;</td><td align="center"> 00 </td></tr>
<tr><td align='center' width='15%' row span='2' nowrap>Current Month Dues</td><td align="center"><?php echo date('M',mktime(0,0,$_GET['mon'])).'/'.$year?>&nbsp;</td><td>&nbsp;</td><td align="center">00</td></tr>
<tr><td align='center' width='15%' row span='2'>Total Amt Due</td><td align="center">&nbsp;</td><td align="center"><?php if($_GET['tmid']==1) echo $vv1[0];?>  &nbsp;</td><td align="center">00</td></tr>		
</td></tr></table>

</td></tr>
<tr><td colspan='6'><div id='a1' align='left'>&nbsp;&nbsp;&nbsp;If you have already cleared the above due amount,Please Ignore this intimation.</div></td></tr>


<tr><td colspan='5'><br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;Accountant</td><td valign="bottom">Principal/HM&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>

</table>
</td></tr></table></td></tr></table>
</form>
<div id="prn" align='center'><Input Type="button" Value="<< Print >>" class='bgbutton' onClick="dataprint()"></div>
</body>
</html>
