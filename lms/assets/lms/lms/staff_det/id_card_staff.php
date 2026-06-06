<?php
session_start();	
include("../db1.php");
$staffid=$_GET['staffid'];
$accyeardet=$_SESSION['AcademicYear'];

?>
<html>
<head>
<script language="JavaScript">
function prn()
		{
			pr1.style.display = "none";
			window.print();
		}
</script>
<style type="text/css">
table.curvedEdges 
{ 
  font-family: Arial;
  border-radius:13px;
}
</style>

<style type="text/css">
table tr.curved 
{ 
  font-family: Arial;
  font-size:14px;
}
</style>

<style type="text/css">
table td.ftsize 
{ 
  font-family: Arial;
  font-size:12px;
}
</style>

<style type="text/css">
	p.vertical
	 {
		   writing-mode:tb-lr;
		   -webkit-transform:rotate(270deg);
		   -moz-transform:rotate(270deg);
		   -o-transform: rotate(270deg);
		   white-space:nowrap;
		   display:block;
		   bottom:0;
		   width:10px;
		   height:40px; 
		   position:relative;
		   left:24px;
		   top:40px;
		   
	}
</style>
</head>
<body >
<form name='frm' method='post'>
<table border="0" width='403px' height="245px" align="center"  cellpadding="0" cellspacing="0" class="curvedEdges">
<tr>
<td align="left" nowrap colspan="4">
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr><td width="4%"></td><td>
<b><font  style="font-size:16px">
Sample International School<br>
<font  style="font-size:12px">
P-26 MIDC PHASE 1,<BR>
ADDRESS DETAILS,<BR>
STATE NAME, COUNTRY NAME - 12345. 
</font></font>
</b></td>
</tr></table>
</td>
<td align="center" rowspan="2" colspan="3" width="10%"><img src="logo.png"  height='100'></td>

</tr>
<tr height="40">
<?php

$dstuds=fetchrow(execute("select f_name,s_name from staff_det where id='$staffid'"));
$dgrdes=fetchrow(execute("select img_col from staff_det where id='$staffid'"));
$fullnamess=fetchrow(execute("select slno,mobileno from staff_det where id='$staffid'"));
?>
<td align="left" style="font-size:17px" colspan="4"  background="teach.PNG"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FFFFFF"><?=$dstuds[0]?>&nbsp;<?=$dstuds[1]?></font></b></td>

</tr>
<tr height="12%">
<td align="center" rowspan="7" width="10px"></td>

<td align="center" rowspan="7" background="teach.PNG" width="125">
<table border="0" align="center"  cellpadding="0" cellspacing="0" width="100%"  height="100%">
<tr>
<td align="center" valign="top">
<!--<img src="<?php echo $dgrdes[0]?>" height="136">-->
<img src="teacherPic.jpg"  height="136">
</td>
</tr>
</table>
</td>
<td align="left" width="70px" style="border-bottom-right-radius:20px" background="teach.PNG" class="ftsize" ><font color="#FFFFFF">&nbsp;<strong><?=$fullnamess[0]?></strong></font></td>
<td>&nbsp;</td>
<td align="center" colspan="3"><font color="#5A1C71" size="3" style="font-family:'Arial Black', Gadget, sans-serif"><strong>TEACHER</strong></font></td>
</tr>

<td align="center" nowrap colspan="5" valign="top">
<table border="0" align="center"  cellpadding="0" cellspacing="0" width="100%"  height="100%">
<tr height="10%">
<td colspan="5"></td>
</tr>
<tr>
<td width="3%"><b>&nbsp;</b></td>
<td align="left" colspan="3"  height="30px" valign="top" rowspan="4">
<br>
<font  style="font-size:14px"><b><u>
Emergency Contact</u>
</b>
<br>
<b>
<?=$fullnamess[1]?>
</b>
</font>
</td>
<td rowspan="4" class="ftsize"  background="buledark.PNG" width="12%"><p class="vertical"  style="width:4px"><font color="#FFFFFF" size="3"><b><?=$accyeardet?>&nbsp;-&nbsp;<?=$accyeardet+1?></b></font></p></td>
</tr>
<tr class="curved">
<td><b>&nbsp;</b></td>
</tr>
<tr class="curved">
<td><b>&nbsp;</b></td>
</tr>
<tr class="curved">
<td><b>&nbsp;</b></td>
</tr>
</table>
</td>
</tr>
</table>
</form>
<div id=pr1 align=center><INPUT TYPE="button" class=bgbutton NAME="print" VALUE="PRINT " onclick='prn()'>
</div>
</body>
</html>