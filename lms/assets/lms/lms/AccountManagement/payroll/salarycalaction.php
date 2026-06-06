<?php 
session_start();
include("../connection.php");
$id=$_POST['comboid'];
$date=date("Y/m/d");
 //$dt=date('d-m-Y',strtotime( $date);
 $type=$_SESSION['type'];
  if($type=='a')
 {
 $or1=$_POST['comboin'];
 }
 else
 {
$or1=$_SESSION['ior'];
 }
 $qp1=mysql_query("select * from emp_details1 where iIdx_institution='$or1'");
 while($k1=mysql_fetch_assoc($qp1))
 {
 
 
 $lon=$k1->;
$mi=$_POST['txtmi'];
$fdate=isset($_REQUEST["datefrom"]) ? $_REQUEST["datefrom"] : "";
$tdate=isset($_REQUEST["dateto"]) ? $_REQUEST["dateto"] : "";
 $desig=$_POST['txtdesig'];
$bc=$_POST['combobank'];
$q11=mysql_query("select * from ac_ledger where iIdx_group=20");
$b=mysql_fetch_object($q11);
$bank=$b->vledger;
$month=$_POST['combomonth'];
$year=$_POST['comboyr'];
$wdays=$_POST['txtwdays'];
$present=$_POST['txtpdays'];
$bp=$_POST['txtbpay'];
$da=$_POST['txtda'];$hra=$_POST['txthra'];$cca=$_POST['txtcca'];$oth1=$_POST['txtoth1'];
$lop=$_POST['txtlop'];$pf=$_POST['txtpf'];$pt=$_POST['txtpt'];$loans=$_POST['txtloans'];$oth2=$_POST['txtoth2'];
$gsalary=$_POST['txtgsalary'];
$tded=$_POST['txttotal'];
$nsalary=$_POST['txtnetsal'];
$gg=mysql_query("select * from emp_details1 where vemp_id='$id'");
$rr=mysql_fetch_object($gg);
$wer=mysql_query("select count(*) from emp_salary where vId_emp='$id' and vmonth='$month' and iyear='$year'");
$tt=mysql_fetch_row($wer);
$in=$rr->iIdx_department;
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
if($tt[0]==0)
{
if($lon!="" && $mi!="")
{
mysql_query("insert into emp_loan(iIdx_organization,iIdx_department,emp_id,floantamount,finstallment,dfdate,dtdate) values('$or1','$in','$id','$lon','$mi','$fdate','$tdate')");
}
mysql_query("insert into emp_salary(iIdx_organization,iIdx_department,vId_emp,ddate,iyear,vmonth,iwordays,ipresent,fda,fhra,fcca,fotherear,flop,fpf,fpt,floans,fotherded,fgrosssal,ftotded,fnetsal,ptype) values('".$or1."','$in','".$id."','".$date."','".$year."','".$month."','".$wdays."','".$present."','".$da."','".$hra."','".$cca."','".$oth1."','".$lop."','".$pf."','".$pt."','".$mi."','".$oth2."','".$gsalary."','".$tded."','".$nsalary."','$rr->ptype')");
$qry1=mysql_query("select max(vvoucherno) from ac_voucher where iIdx_vouchermaster=1");
$vno=mysql_fetch_row($qry1);
$n1=$vno[0]+1;
if($n1>9)
			{
				$vno1='00'.($n1);
			}
			else
			{
				$vno1='000'.($n1);
			}

//echo $in;
$tyu=mysql_query("select vinstitution from ac_institution where iIdx_institution='$in'");
$v=mysql_fetch_row($tyu);
//$ins=$v[0];
$nm=$_POST['txtename'];
$ledger="Salary(".$nm.")";
$qq33=mysql_query("select max(iIdx_ledger) from ac_ledger where vledger='$bank' and iIdx_organization=\"$or1\"");
$rr3=mysql_fetch_row($qq33);
$qq44=mysql_query("select fopbal from ac_ledger where iIdx_ledger='$rr3[0]'");
$r3=mysql_fetch_row($qq44);
$qq55=mysql_query("select iIdx_ledger from ac_ledger where vledger='$ledger' and iIdx_organization=\"$or1\"");
$rr5=mysql_fetch_row($qq55);
$bybal=$nsalary;
$tobal=$r3[0]-$nsalary;
$par1="By ".$ledger;
$par2="To ".$bank;
//$vno1=$vno+1;
$narr=$_POST['txtnarration'];
$dr="Dr";
mysql_query("insert into ac_opbal(opdate,vledger,fopbal,iId_grp,vins,Dr_Cr,iIdx_organization) values(\"$date\",\"$ledger\",'$bybal',5,\"$v[0]\",'Dr',\"$or1\")");
mysql_query("insert into ac_opbal(opdate,vledger,fopbal,iId_grp,vins,Dr_Cr,iIdx_organization) values(\"$date\",\"$bank\",'$tobal',20,\"$v[0]\",'Dr',\"$or1\")");
mysql_query("update ac_ledger set fopbal=\"$bybal\" where vledger=\"$ledger\" and iIdx_organization=\"$or1\"");
mysql_query("update ac_ledger set fopbal=\"$tobal\" where vledger=\"$bank\" and iIdx_organization=\"$or1\"");


mysql_query("insert into ac_voucher(iIdx_ledger,iIdx_vouchermaster,iIdx_institution,ddate,Dr_Cr,particulars,chequedd_no,chequedd_date,fdebit,fcredit,vvoucherno,vnarration,acc,iIdx_group,istatus,iIdx_organization,vbillno,dbilldate) values('$rr3[0]','1','$in','$date','$dr','$par1','0','0000-00-00','$nsalary','0','$vno1','$narr','$ledger','5','0','$or1','0','0000-00-00')");

mysql_query("insert into ac_voucher(iIdx_ledger,iIdx_vouchermaster,iIdx_institution,ddate,Dr_Cr,particulars,chequedd_no,chequedd_date,fdebit,fcredit,vvoucherno,vnarration,acc,iIdx_group,istatus,iIdx_organization,vbillno,dbilldate) values('$rr5[0]','1','$in','$date','$dr','$par2','0','0000-00-00','0','$nsalary','$vno1','$narr','$bank','20','0','$or1','0','0000-00-00')");


header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=salaryslip.doc");
header("Pragma: no-cache");
header("Expires: 0");
echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
echo "<body>";
echo "<center><table border=0 bordercolor=black cellspacing=0 width=500><tr><td><b><div align=center>SALARY SLIP FOR $m-$year</div><b><br><br><br></td></tr></table>";
echo "<center><table border=1 bordercolor=black cellspacing=0 width=500 id=c1>
  <tr>
    <td height=66 colspan=2><div align=center><b>BANGALORE SCHOOL</b><br>SARJAPUR MAIN ROAD,KORAMANGALA,BANGALORE-34</div></td>
  </tr>
  <tr  bordercolor=#FFFFFF cellspacing=0>
  <td><div align=left>Name:$nm<br>Dept:$v[0]</div></td>
    <td><div align=right>No: Of Days Present:$present<br>Designation:$desig</div></td>
   
  </tr>
  <tr cellspacing=0>
    <td><b>EARNINGS</b></td>
    <td><b>DEDUCTIONS</b></td>
  </tr>
  <tr cellspacing=0>
    <td>Basic:$bp<br>DA:$da<br>HRA:$hra<br>CCA:$cca<br>Others:$oth1</td>
    <td>Loss Of Pay:$lop<br>PF:$pf<br>PT:$pt<br>Loans:$loans<br>Others:$oth2<br></td>
  </tr>
  <tr cellspacing=0>
    <td><b>TOTAL:$gsalary</b></td>
    <td><b>TOTAL:$tded</b></td>
  </tr>
  <tr cellspacing=0>
    <td><div align=left>Employees Signature:</div></td>
    <td><b>NET PAY:$nsalary</b></td>
  </tr>
</table>";
echo "<center><table border=0 bordercolor=black cellspacing=0 width=500 HEIGHT=300><tr><td><br><br><br><div align=center>SIGNATURE OF THE ACCOUNT OFFICER:</div></td></tr></table></body></html>";

}
else
{
if($lon!="" && $mi!="")
{
mysql_query("insert into emp_loan(iIdx_organization,iIdx_department,emp_id,floantamount,finstallment,dfdate,dtdate) values('$or1','$in','$id','$lon','$mi','$fdate','$tdate')");
}
$q11=mysql_query("select * from emp_salary where vId_emp='$id' and vmonth='$month' and iyear='$year'");
$ra2=mysql_fetch_object($q11);




mysql_query("update emp_salary set iIdx_organization='$or1',iIdx_department='$in',ddate='$date',iyear='$year',vmonth='$month',iwordays='$wdays',ipresent='$present',fda='$da',fhra='$hra',fcca='$cca',fotherear='$oth1',flop='$lop',fpf='$pf',fpt='$pt',floans='$mi',fotherded='$oth2',fgrosssal='$gsalary',ftotded='$tded',fnetsal='$nsalary',ptype='$rr->ptype' where vId_emp='$id'");



//echo $in;
$tyu=mysql_query("select vinstitution from ac_institution where iIdx_institution='$in'");
$v=mysql_fetch_row($tyu);
//$ins=$v[0];
$nm=$_POST['txtename'];
$ledger="Salary(".$nm.")";
$qq33=mysql_query("select max(iIdx_ledger) from ac_ledger where vledger='$bank' and iIdx_organization=\"$or1\"");
$rr3=mysql_fetch_row($qq33);

$qq44=mysql_query("select fopbal from ac_ledger where iIdx_ledger='$rr3[0]'");
$r3=mysql_fetch_row($qq44);
$qq55=mysql_query("select iIdx_ledger from ac_ledger where vledger='$ledger' and iIdx_organization=\"$or1\"");
$rr5=mysql_fetch_row($qq55);
$bybal=$nsalary;
$tobal=$r3[0]-$nsalary-($ra2->fopbal);
$par1="By ".$ledger;
$par2="To ".$bank;
//$vno1=$vno+1;
$narr=$_POST['txtnarration'];
$dr="Dr";
mysql_query("update ac_opbal set fopbal='$bybal' where vledger='$ledger' and month(opdate)='$month'");
mysql_query("update ac_opbal set fopbal='$tobal' where vledger='$bank' and month(opdate)='$month'");

mysql_query("update ac_ledger set fopbal=\"$bybal\" where vledger=\"$ledger\" and iIdx_organization=\"$or1\"");
mysql_query("update ac_ledger set fopbal=\"$tobal\" where vledger=\"$bank\" and iIdx_organization=\"$or1\"");




mysql_query("update ac_voucher set fdebit='$nsalary' where particulars='$par1' and month(ddate)='$month'");
mysql_query("update ac_voucher set fcredit='$nsalary' where particulars='$par2' and month(ddate)='$month'");









header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=salaryslip.doc");
header("Pragma: no-cache");
header("Expires: 0");
echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
echo "<body>";
echo "<center><table border=0 bordercolor=black cellspacing=0 width=500><tr><td><b><div align=center>SALARY SLIP FOR $m-$year</div><b><br><br><br></td></tr></table>";
echo "<center><table border=1 bordercolor=black cellspacing=0 width=500 id=c1>
  <tr>
    <td height=66 colspan=2><div align=center><b>BANGALORE SCHOOL</b><br>SARJAPUR MAIN ROAD,KORAMANGALA,BANGALORE-34</div></td>
  </tr>
  <tr  bordercolor=#FFFFFF cellspacing=0>
  <td><div align=left>Name:$nm<br>Dept:$v[0]</div></td>
    <td><div align=right>No: Of Days Present:$present<br>Designation:$desig</div></td>
   
  </tr>
  <tr cellspacing=0>
    <td><b>EARNINGS</b></td>
    <td><b>DEDUCTIONS</b></td>
  </tr>
  <tr cellspacing=0>
    <td>Basic:$bp<br>DA:$da<br>HRA:$hra<br>CCA:$cca<br>Others:$oth1</td>
    <td>Loss Of Pay:$lop<br>PF:$pf<br>PT:$pt<br>Loans:$loans<br>Others:$oth2<br></td>
  </tr>
  <tr cellspacing=0>
    <td><b>TOTAL:$gsalary</b></td>
    <td><b>TOTAL:$tded</b></td>
  </tr>
  <tr cellspacing=0>
    <td><div align=left>Employees Signature:</div></td>
    <td><b>NET PAY:$nsalary</b></td>
  </tr>
</table>";
echo "<center><table border=0 bordercolor=black cellspacing=0 width=500 HEIGHT=300><tr><td><br><br><br><div align=center>SIGNATURE OF THE ACCOUNT OFFICER:</div></td></tr></table></body></html>";




















}

}
echo "<script>alert('Data Added');window.location.href='salarypayment1.php';</script>";
?>
