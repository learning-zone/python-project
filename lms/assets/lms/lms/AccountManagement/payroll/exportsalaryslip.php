<?php
session_start();
include("../connection.php");
$name=$_SESSION['name'];

$or1=$_SESSION['ior'];
$type=$_SESSION['type'];
$org=$_SESSION['org'];

$array=array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
$id=$_SESSION['vid'];
$month=$_SESSION['vm'];
$year=$_SESSION['vy'];
$qry1=mysql_query("select * from emp_salary where vId_emp='$id' and vmonth='$month' and iyear='$year'");
$r2=mysql_fetch_object($qry1);
$qry=mysql_query("select * from emp_details1 where vemp_id='$id'");
$r1=mysql_fetch_object($qry);
$qry3=mysql_query("select vjob from emp_job where iId_job='$r1->iemp_designation'");
$d=mysql_fetch_row($qry3);
$qry31=mysql_query("select vinstitution from ac_institution where iIdx_institution='$r1->iIdx_institution'");
$d1=mysql_fetch_row($qry31);
if($month==1)
{
$m="JANUARY";
}
if($month==2)
{
$m="FEBRUARY";
}
if($month==3)
{
$m="MARCH";
}
if($month==4)
{
$m="APRIL";
}
if($month==5)
{
$m="MAY";
}
if($month==6)
{
$m="JUNE";
}
if($month==7)
{
$m="JULY";
}
if($month==8)
{
$m="AUGUST";
}
if($month==9)
{
$m="SEPTEMBER";
}
if($month==10)
{
$m="OCTOBER";
}
if($month==11)
{
$m="NOVEMBER";
}
if($month==12)
{
$m="DECEMBER";
}
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=salaryslip.doc");
header("Pragma: no-cache");
header("Expires: 0");
echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
echo "<body>";
echo "<center><table border=0 bordercolor=black cellspacing=0 width=700><tr><td><b><div align=center>SALARY SLIP FOR $m-$year</div><b><br><br><br></td></tr></table>";
echo "<center><table border=1 bordercolor=black cellspacing=0 width=700 id=c1>
  <tr>
    <td height=66 colspan=2><div align=center><b>BANGALORE SCHOOL</b><br>SARJAPUR MAIN ROAD,KORAMANGALA,BANGALORE-34</div></td>
  </tr>
  <tr  bordercolor=#FFFFFF cellspacing=0>
  <td><div align=left>Name:$r1->vemp_name<br>Dept:$d1[0]</div></td>
    <td><div align=right>No: Of Days Present:$r2->ipresent<br>Designation:$d[0]</div></td>
   
  </tr>
  <tr cellspacing=0>
    <td><b>EARNINGS</b></td>
    <td><b>DEDUCTIONS</b></td>
  </tr>
  <tr cellspacing=0>
    <td>Basic:$r1->femp_bpay<br>DA:$r2->fda<br>HRA:$r2->fhra<br>CCA:$r2->fcca<br>Others:$r2->fotherear</td>
    <td>Loss Of Pay:$r2->flop<br>PF:$r2->fpf<br>PT:$r2->fpt<br>Loans:$r2->floans<br>Others:$r2->fotherded<br></td>
  </tr>
  <tr cellspacing=0>
    <td><b>TOTAL:$r2->fgrosssal;</b></td>
    <td><b>TOTAL:$r2->ftotded</b></td>
  </tr>
  <tr cellspacing=0>
    <td><div align=left>Employees Signature:</div></td>
    <td><b>NET PAY:$r2->fnetsal</b></td>
  </tr>
</table>";
echo "<center><table border=0 bordercolor=black cellspacing=0 width=500 HEIGHT=300><tr><td><br><br><br><div align=center>SIGNATURE OF THE ACCOUNT OFFICER:</div></td></tr></table></body></html>";
?>
