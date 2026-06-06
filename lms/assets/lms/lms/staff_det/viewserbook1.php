<html>
<head>
<title>Service Book Information</title>
<?php 
session_start();
include("../db.php");
?>
<script language="JavaScript">
function Print1()
{
	prn.style.display="none";
	window.print();
	prn.style.display="";
}
</script>
</head>
<body>
<?php 
$qry=execute("select f_name,s_name,subj,slno,type_id from staff_det where id=$id");
$ff=fetcharray($qry);

$C_qry=execute("select d_name from staff_des where d_id=$ff[type_id]");
$C_des=fetcharray($C_qry);

$dqry=execute("select Dept from dept_no where dpt_id=$ff[subj]");
$d_name=fetcharray($dqry);

$rsql=execute("select * from staff_termination where id=$mdel");
$rsl=fetcharray($rsql);
?>
<table class="forumline" align="center">
<tr><td colspan="4" class="head" align="center"><font face='Lucida Sans' size='3'>Service Book Entry</font></td></tr>
<tr><td><font face='Lucida Sans' size='1.8'>&nbsp;&nbsp;&nbsp;Staff ID </font></td>
<td nowrap>&nbsp;&nbsp;&nbsp;<?php echo $ff[slno]?></td>
<td><font face='Lucida Sans' size='1.8'>&nbsp;&nbsp;&nbsp;Staff Name </font></td>
<td nowrap>&nbsp;&nbsp;&nbsp;<?php echo $ff[f_name]?>&nbsp;<?php echo $ff[s_name]?></td></tr>
<tr><td><font face='Lucida Sans' size='1.8'>&nbsp;&nbsp;&nbsp;Designation </font></td>
<td nowrap>&nbsp;&nbsp;&nbsp;<?php echo $C_des[0]?></td>
<td><font face='Lucida Sans' size='1.8'>&nbsp;&nbsp;&nbsp;Department </font></td>
<td nowrap>&nbsp;&nbsp;&nbsp;<?php echo $d_name[0]?></td></tr>
<tr><td><font face='Lucida Sans' size='1.8'>&nbsp;&nbsp;&nbsp;Heading </font></td>
<td colspan="3">&nbsp;&nbsp;&nbsp;<?=stripslashes($rsl[7])?></td></tr>  
<tr><td><font face='Lucida Sans' size='1.8'>&nbsp;&nbsp;&nbsp;Sanction Authority </font></td>
<td>&nbsp;&nbsp;&nbsp;<?=stripslashes($rsl[4])?></td>
<td><font face='Lucida Sans' size='1.8'>&nbsp;&nbsp;&nbsp;Sanction No </font></td>
<td>&nbsp;&nbsp;&nbsp;<?=stripslashes($rsl[3])?></td></tr>
<tr><td><font face='Lucida Sans' size='1.8'>&nbsp;&nbsp;&nbsp;Sanctioned Date </font></td>
<td>&nbsp;&nbsp;&nbsp;<?=date("d-m-Y",strtotime($rsl[2]))?></td>
<td>&nbsp;&nbsp;&nbsp;Efective Date </td>
<td>&nbsp;&nbsp;&nbsp;<?=date("d-m-Y",strtotime($rsl[6]))?></td></tr>
<tr><td><font face='Lucida Sans' size='1.8'>&nbsp;&nbsp;&nbsp;Description </font></td>
<td colspan="3"><textarea name="remarks" cols="80" rows="10" style='background:#D1D7DC; border:0;' readonly><?=stripslashes($rsl[5])?></textarea></td></tr>
</table><br>
<div id="prn" align="center">
<input type="button" class=bgbutton value="<< PRINT >>" onClick="Print1()"></div>
</form>
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
</body>
</html>