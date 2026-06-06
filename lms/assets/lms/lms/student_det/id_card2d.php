<?php
session_start();	
include("../db1.php");
$stid=$_POST['stid'];
$branch=$_POST['branch'];
$sem=$_POST['sem'];
$app_no=$_POST['app_no'];
$accyeardet=$_SESSION['AcademicYear'];
$un=$_POST['un'];
$studfname=$_POST['studfname'];
$id=$_GET['id'];
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
  font-family: Calibri;
  border-radius:13px;
}
</style>

<style type="text/css">
table tr.curved 
{ 
  font-family: Calibri;
  font-size:14px;
}
</style>

<style type="text/css">
table td.ftsize 
{ 
  font-family: Calibri;
  font-size:14px;
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
<b><font style="font-family:'Times New Roman', Times, serif">
Mercedes-Benz International School<br>
<font size="-2">
P-26 MIDC PHASE 1,<BR>
RAJEEV GANDHI INFOTECH PARK,<BR>
HINJEWADI, PUNE - 411057 
</font></font>
</b></td>
</tr></table>
</td>
<td align="center" rowspan="2" colspan="3" width="10%"><img src="logo.PNG"  height='100'></td>

</tr>
<tr height="40">
<?php
$stafffsid=mysql_fetch_row(mysql_query("select f_id from additional_info2 where student_id='$id'"));

$dstuds=mysql_fetch_row(mysql_query("select parent_name,parent_username from student_m where id='$id'"));
$dgrdes=mysql_fetch_row(mysql_query("select f_photo from student_photo where studid='$id'"));
$fullnamess=mysql_fetch_row(mysql_query("select first_name,last_name,student_id from student_m where id='$id'"));

	$name=$fullnamess[2];
	$var=substr($name,1);
	$mids="F".$var;
?>
<td align="left" style="font-size:17px" colspan="4"  background="green.png"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FFFFFF"><?=$dstuds[0]?></font></b></td>

</tr>
<tr height="12%">
<td align="center" rowspan="7" width="10px"></td>

<td align="center" rowspan="7" background="green.png" width="125">
<table border="0" align="center"  cellpadding="0" cellspacing="0" width="100%"  height="100%">
<tr>
<td align="center" valign="top">
<img src="<?php echo $dgrdes[0]?>" height="138">
</td>
</tr>
</table>
</td>
<td align="left" width="70px" style="border-bottom-right-radius:20px" background="green.png" class="ftsize" ><font color="#FFFFFF">&nbsp;<strong><?=$mids?></strong></font></td>
<td>&nbsp;</td>
<td align="center" colspan="3"><font color="#007236" size="3" style="font-family:'Arial Black', Gadget, sans-serif"><strong>PARENT</strong></font></td>
</tr>

<td align="center" nowrap colspan="5" valign="top">
<table border="0" align="center"  cellpadding="0" cellspacing="0" width="100%"  height="100%">
<tr height="10%">
<td colspan="5"></td>
</tr>

<?
$fmcode2=mysql_query("SELECT family_code FROM `stud_sibling` where `stud`='$id' and `status`=1");
if(mysql_num_rows($fmcode2)>0)
{
?>    
<tr>
<td width="3%"><b>&nbsp;</b></td>
<td align="left" colspan="3" height="30px"  valign="top" rowspan="4">
<font  style="font-size:15px"><b>
<?
}
else
{
?>
<tr>
<td width="3%"><b>&nbsp;</b></td>
<td align="left" colspan="3"  height="30px" valign="top" rowspan="4"><font  style="font-size:15px"><b><?=$fullnamess[0]?>&nbsp;&nbsp;<?=$fullnamess[1]?>
<?
}
?>
<?php
$i=0;
$count=0;
$fmcodes=mysql_fetch_array(mysql_query("SELECT family_code FROM `stud_sibling` where `stud`='$id' and `status`=1"));
$fanilyname=mysql_query("SELECT b.first_name,b.last_name FROM stud_sibling a,student_m b where a.family_code='$fmcodes[0]' and a.status=1 and b.id=a.stud order by b.course_yearsem");
$count=rowcount($fanilyname);
$n=$count;
$flag=0;

while($familnms=mysql_fetch_array($fanilyname))
{
		if($flag)
		echo "<br>".$familnms[0]."&nbsp;&nbsp;".$familnms[1];
		else
		echo $familnms[0]."&nbsp;&nbsp;".$familnms[1];
		$flag=1;
}
?>
</b>
</font>
</td>
<td rowspan="4" class="ftsize"  background="buledark.PNG" width="12%"><p class="vertical"  style="width:4px"><font color="#FFFFFF" size="4"><b><?=$accyeardet?>&nbsp;-&nbsp;<?=$accyeardet+1?></b></font></p></td>
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