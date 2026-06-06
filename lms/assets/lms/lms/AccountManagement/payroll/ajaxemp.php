<?php
include("../connection.php");
$q=$_GET["q"];
$qryy=mysql_query("select * from emp_details1 where vemp_id=\"$q\"");
$res=mysql_fetch_object($qryy);
$q4=mysql_query("select * from ac_institution where iIdx_institution=\"$res->iIdx_institution\"");
$qw=mysql_fetch_object($q4);
$q2=mysql_query("select vdepartmentname from emp_department where iId_department='".$res->iemp_department."'");
$r2=mysql_fetch_row($q2);
$q1=mysql_query("select vjob from emp_job where iId_job='".$res->iemp_designation."'");
$r1=mysql_fetch_row($q1);
$pda=$res->pda;
$da=($res->femp_bpay*$pda)/100;
$phra=$res->phra;
$hra=($res->femp_bpay*$phra)/100;
$pcca=$res->pcca;
$cca=($res->femp_bpay*$pcca)/100;
$oth1=$res->potherear;
$oth2=$res->otherded;
$pf=$res->pf;
//$loans=$res->loans;
$gs=$res->femp_bpay+$da+$hra+$cca+$oth1;
if($gs<9999)
{
$a1=0.00;
}
if($gs>10000 && $gs<14999)
{
$a1=150;
}
if($gs>=15000)
{
$a1=200;
}
//$da=number_format($da,2);
$ddp=mysql_query("select count(*) from emp_salary where vId_emp=\"$q\"");
$cntt=mysql_fetch_row($ddp);
if($cntt[0]>0)
{
$a="Paid";
}
else
{
$a="Unpaid";
}
$acc=$res->vaccount;
if($res->ptype=="sb")
{
$ptype="SB A/c";
}
if($res->ptype=="cheque")
{
$ptype="Cheque";
}
if($res->ptype=="cash")
{
$ptype="Cash";
}
$dt=date("Y/m/d");
$qq8=mysql_query("select max(iIdx_loan) from emp_loan where emp_id='$q' and dfdate<='$dt' and dtdate>='$dt'");
$l1=mysql_fetch_row($qq8);
$qq9=mysql_query("select * from emp_loan where iIdx_loan='$l1[0]'");
$l2=mysql_fetch_object($qq9);
$loans=$l2-> finstallment;
if($loans=="")
{
$loans=0;
}
$lamt=$l2->floantamount;
$df=$l2->dfdate;
$dt1=$l2->dtdate;
				$y1=substr($df,0,strpos($df,'-'));
				$m1=substr($df,5,2);
				$d1=substr($df,8,2);
				$y2=substr($dt1,0,strpos($dt1,'-'));
				$m2=substr($dt1,5,2);
				$d2=substr($dt1,8,2);
echo " <input type=text name=txtename value='$res->vemp_name' readonly/>".','."<input type=text name=txtjtype value='$r2[0]' readonly/>".','."<input type=text name=txtdesig value='$r1[0]' readonly/>".','."<input type=text name=txtbpay value='$res->femp_bpay' readonly/>".','."<input type=text name=txtins value='$qw->vinstitution' readonly/>".','."<input type=text name=txtda value='$da' readonly/>".','."<input name=txthra type=text value='$hra' readonly=true/>".','."<input name=txtcca type=text value='$cca' readonly=true/>".','."<input name=txtoth1 type=text value='$oth1' onkeyup='showgross(this.value)'/>".','."<input name=txtpf type=text value='$pf' readonly=true/>".','."<input name=txtloans type=text value='$loans' readonly />".','."<input name=txtoth2 type=text value='$oth2' />".','."<input type=text name=txtgsalary value='$gs' readonly=true/>".','."<input name=txtpt type=text value='$a1' readonly/>".','."<input type=text value=$a>".','."<input type=text name=txtaccount value=$acc disabled=disabled>".','."<input type=text name=combobank value=$ptype disabled=disabled>".','."<input name=txtlamount type=text disabled=disabled value=$lamt >".','."<input name=txtmi type=text disabled=disabled  value=$loans>".','."$y1-$m1-$d1".','."$y2-$m2-$d2";


?>
