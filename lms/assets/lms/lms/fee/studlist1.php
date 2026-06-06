<html>
<head>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
<?php
	session_start();
	include("../db.php");
?>
<SCRIPT LANGUAGE="JavaScript">
function findttl()
{
	var cnt=document.getElementById("rcnt1").value;
	var ttlamt=0;
	for(i=0;i<cnt;i++)
	{
		var ckfg=document.getElementById("c"+i).checked;
		if(ckfg==true)
		{
			var amt=document.getElementById("s"+i).value;
			if(isNaN(amt) || amt=="")
			{
				amt=0;
			}
			else
			{
				amt=parseInt(document.getElementById("s"+i).value);
			}
			ttlamt+=amt;
		}
	}
	document.getElementById("tamt").value=ttlamt;
}
function checkdata()
{
	if(document.frm.sclag.value=="")
	{
		alert("Enter Scholarship Agency");
		return false;
	}
	if(document.frm.ddno.value=="")
	{
		alert("Enter DD/Cheque Number");
		return false;
	}
	var cnt=document.getElementById("rcnt1").value;
	var ckvalue=0;
	for(i=0;i<cnt;i++)
	{
		var ckfg=document.getElementById("c"+i).checked;
		if(ckfg==true)
		{
			var amt=document.getElementById("s"+i).value;
			if(isNaN(amt) || amt=="")
			{
				alert("Please Enter Scholarship Amount");
				return false;
			}
			else
			{
				ckvalue=1;
			}
		}
	}
	if(ckvalue==0)
	{
		alert("Please select checkbox");
		return false;
	}
	else
	{
		document.frm.action="updtscl.php";
		document.frm.submit();
	}
}
</SCRIPT>
<style>
	.text{text-align:right;}
</style>
</head>
<body>
<?php
$cyr=$curyr1;
	$sql="select id,student_id,first_name,last_name,admission_id,course_admitted,course_yearsem from student_m where archive='N'";
	if($branch!=0)
	{
	$sql.=" and course_admitted=$branch";
	}
	if($sem!=0)
	{
	$sql.=" and course_yearsem=$sem";
	}
	if($studfname!='')
	{
	 $sql.=" and first_name like '$studfname%'";
	}
	if($student_id!='')
	{
		$sql.=" and student_id='$student_id'";
	}
	$sql.=" order by first_name";
	//echo $sql;
	$rs=execute($sql) or die(mysql_error());
	$rcnt=rowcount($rs);
	if($rcnt==0)
	{
		echo "<font color=brown><b>No Records Found !!</b></font>";
		die();
	}

?>
<form name="frm" method="post">
<table border=1 class=forumline align=center width='60%' cellspacing='0' cellpadding='1'>
<tr><td align='center' class='head' colspan='5'><font size="4"><b>Scholarship Update</b></font></td>
</tr>
<tr height='30'><td colspan='2'><font color='brown'><b>&nbsp;&nbsp;Scholarship Agency</b></font></td><td colspan='3' align='center'><input type='text' name='sclag' size='70'></td><tr>
<tr height='30'><td colspan='2'><font color='brown'><b>&nbsp;&nbsp;DD / Cheque No</b></font></td><td align='center'><input type='text' name='ddno'></td>
<td nowrap><font color='brown'><b>&nbsp;&nbsp;DD / Cheque Date</b></font></td><td align='center' nowrap>
<select name='pdt'>
<?php
if($pdt=='')
	$pdt=date("d");;
for($i=1;$i<=31;$i++)
{
	if($i<10)
		$i="0".$i;
	if($i==$pdt)
		echo "<option value=$i selected>$i</option>";
	else
		echo "<option value=$i>$i</option>";
}
?>
</select><select name='pmt'>
<?php
if($pmt=='')
	$pmt=date("m");
for($i=1;$i<=12;$i++)
{
	if($i<10)
		$i="0".$i;
	if($i==$pmt)
		echo "<option value=$i selected>" . MonthName($i) . "</option>";
	else
		echo "<option value=$i>" . MonthName($i) . "</option>";
}
?>
</select><select name='pyr'>
<?php
if($pyr=='')
	$pyr=date("Y");
for($i=$cyr-1;$i<=$cyr+1;$i++)
{
	if($i==$pyr)
		echo "<option value=$i selected>$i</option>";
	else
		echo "<option value=$i>$i</option>";
}
?>
</select></td></tr>
<tr height='30'>
<td Class="rowpic" nowrap align='center'>Select</td>
<td Class="rowpic" nowrap align='center'>Student Reg No</td>
<td Class="rowpic" nowrap align='center'>Student Name</td>
<td Class="rowpic" nowrap align='center'>Scholarship<br>Already Received</td>
<td Class="rowpic" nowrap align='center'>Scholarship Amount<br>Now Received in Rs.</td></tr>
<input type='hidden' name='rcnt' id='rcnt1' value='<?=$rcnt?>'>
<?php

	for($i=0;$i<$rcnt;$i++)
	{
	 $r=fetcharray($rs);
	 $rsclamt=fetcharray(execute("select sclamt from fee_master where studid=$r[0] and status=0 and accyr='$cyr'"));
	?>
	<tr height='25'><td align='center'><input type='checkbox' name='sid[]' id='c<?=$i?>' value='<?=$r[0]?>' onclick='findttl()'></td>
		<td>&nbsp;&nbsp;&nbsp;
		   <?php echo $r[student_id] ?>		
		  </td>
		<td>&nbsp;&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?php echo $r[last_name]?></td>
		<td align='right'><?=number_format($rsclamt[0],0)?>&nbsp;&nbsp;&nbsp;</td>
		<td align='center'><input type='text' class='text' name='samt<?=$r[0]?>' id='s<?=$i?>' value="" size='10' onchange='findttl()'></td>
	</tr>
	<?php
	}
	echo "<tr height='30'><td colspan='4' align='right'>Total Amount&nbsp;&nbsp;</td><td align='center'><input type='text' class='text' name='ttlsamt' id='tamt' value='0' size='10' readonly></td></tr>";
?>
</table><br>
<div align='center'><input type="button" name='app' value="<< Update >>" class='bgbutton' onclick="checkdata()"></div>
<?php
function MonthName($mon)
{
        if($mon == 1) return("Jan");
        if($mon == 2) return("Feb");
        if($mon == 3) return("Mar");
        if($mon == 4) return("Apr");
        if($mon == 5) return("May");
        if($mon == 6) return("Jun");
        if($mon == 7) return("Jul");
        if($mon == 8) return("Aug");
        if($mon == 9) return("Sep");
        if($mon == 10) return("Oct");
        if($mon == 11) return("Nov");
        if($mon == 12) return("Dec");
}
?>
</form>
</body>
</html>