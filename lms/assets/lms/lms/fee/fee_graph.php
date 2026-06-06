<html>
<head>
<?php
session_start();
include("../db1.php");
$per00=$_SESSION['per00'];
$user=$_SESSION['user'];
//header("Refresh: 5");
?>
<script LANGUAGE="JavaScript">
<!--
function timedRefresh(timeoutPeriod) {
	setTimeout("location.reload(true);",timeoutPeriod);
}
//   -->
function setPageBreak()
{
document.getElementById("footer").style.pageBreakAfter="always";
}
function prn()
		{
			pr1.style.display = "none";
			window.print();
		}
</script>
</head>
<body  onload="JavaScript:timedRefresh(5000);">
<?php
		$sqlt=execute("select * from college");
		while($r=fetcharray($sqlt))
		{
			
			$col_name=$r[col_name];
			$col_code=$r[col_code];
			$col_addr=$r[col_addr];
			$col_pin=$r[col_pin];
			$col_phone=$r[col_phone];
			$col_fax=$r[col_fax];
			$email=$r[email];
		}
if(date("Y")>5)
$accyr=date("Y");
else
$accyr=date("Y")-1;
$rs=fetcharray(execute("select count(id) from student_m where  archive='N'"));
$rb=fetcharray(execute("select count(id) from fee_payment where  accyr='$accyr'"));	

$stucount=$rs[0];
$paidstu=$rb[0];
$temtrec=($paidstu*100)/$stucount;
$balstu1=$stucount-$paidstu;
$dueamts=($balstu1*100)/$stucount;
$balstu=$temtrec*2;
$dueamts=$dueamts*2;
?>

	<table background="bang.png" width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td colspan="6" align="center" class="head"><font size="+" color="#000066"><strong>No. of Students Fees Charged , Received, Due for Q1</strong></font></td>
    </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="center" valign="bottom">
    <img src="c.png" height="200" width=40 ></td>
    <td align="center" valign="bottom">
	<img src="a.png" height="200" width=40></td>
<td align="center" valign="bottom">
	<img src="b.png" height="<?=$balstu?>" title="<?php echo $paidstu;?>" width=40></td>
    <td align="center" valign="bottom">
	<img src="d.png" height="<?=$dueamts?>"  title="<?php echo $balstu1;?> students need to  pay the fees " width=40></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" width="17%" valign="top">&nbsp;</td>
    <td align="center" width="15%"  valign="top"><font color="#000066" size="-1">( <?php echo $stucount;?> )<br>Student<br>&nbsp;</font></td>
    <td align="center" width="15%"  valign="top"><font color="#000066" size="-1">( <?php echo $stucount;?> )<br>Charged<br>&nbsp;</font></td>
    <td align="center" width="15%"  valign="top"><font color="#000066" size="-1">( <?php echo $paidstu;?> )<br>Received<br>&nbsp;</font></td>
    <td align="center" width="15%" valign="top" ><font color="#000066" size="-1">( <?php echo $balstu1;?> )<br>Due<br>&nbsp;</font></td>
    <td align="center" width="23%" valign="top">&nbsp;<br>&nbsp;<br>&nbsp;</td>
  </tr>
</table>
<br>       
<div id=pr1 align=center><INPUT TYPE="SUBMIT" class=bgbutton NAME="print" VALUE="PRINT " onclick='prn()'>

</div>
</body>
</html>

