<?php
session_start();
include("../db.php");
$ins=$_SESSION['ins'];
$ledger=$_SESSION['ld'];
$bd1=$_SESSION['bdt1'];
$bd2=$_SESSION['bdt2'];
$dt11=date('d-m-Y',strtotime($bd1));
$dt22=date('d-m-Y',strtotime($bd2));
//$ins=$_SESSION['ins'];
$org=$_SESSION['org'];
$tp=$_SESSION['type'];
//$sql = "select iIdx_ledger as \"sln\",vledger,vcode,vdescription from ac_ledger";
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=bankbook.doc");
header("Pragma: no-cache");
header("Expires: 0");
echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
echo "<body>";
echo "<b><table border=1>";
echo "<tr><td colspan=7>Institution: $ins</td><tr>";
echo "<tr><td colspan=7>Group: Bank Accounts</td><tr>";
echo "<tr><td colspan=7>Ledger :$ledger</td><tr>";
echo "<tr><td colspan=7><div align=center> From $dt11 To  $dt22 </div></td><tr>";
echo "<b><tr><td>DATE</td><td>VOUCHER NO:</td><td>PARTICULAR</td><td>CHEQUE/DD NO:</td><td>DEPOSIT</td><td>WITHDRAW</td><td>BALANCE</td></tr></b>";
$q=execute("select * from ac_institution where vinstitution=\"$ins\"");
$b1=mysql_fetch_object($q);
$qry21=execute("select max(opdate) from ac_opbal where vledger=\"$ledger\" and opdate<\"$bd1\" and vins=\"$ins\" order by iIdx_op");
$ab=fetchrow($qry21);
$qry22=execute("select fopbal from ac_opbal where vledger=\"$ledger\" and opdate=\"$ab[0]\" and vins=\"$ins\" order by iIdx_op");
 $bal=fetchrow($qry22);
 $b=$bal[0];
 if(!$ab[0]){echo "<tr><td colspan=7><div align=left> To Balance Brought Down=>$bal[0]=0.00</div></td><tr>";}
 else{echo "<tr><td colspan=7><div align=center> To Balance Brought Down=>$bal[0]</div></td><tr>";} 
	$s=0;$td=0;$tw=0;
	$sq1=execute("select * from ac_voucher where ddate between \"$bd1\" and \"$bd2\" and acc=\"$ledger\" and iIdx_institution=\"$b1->iIdx_institution\" order by(ddate)");
	while($row1=mysql_fetch_assoc($sq1))
	{
	$ids=$row1[vvoucherno];
	$sq2=execute("select * from ac_voucher where ddate between \"$bd1\" and \"$bd2\" and acc<>\"$ledger\" and vvoucherno=\"$ids\" and iIdx_institution=\"$b1->iIdx_institution\" order by(ddate)");
	while($row2=mysql_fetch_assoc($sq2))
	{
	if($row2[Dr_Cr]=="Cr"){$s=$s+$row2[fcredit]+$b;}if($row2[Dr_Cr]=="Dr"){$s=$s-$row2[fdebit]+$b;}
	  $dtd=date('d-m-Y',strtotime( $row2[ddate]));
   echo "<tr><td width=100>$dtd</td>";
      echo "<td>$row2[vvoucherno]</td><td width=200>";
      if($row2[Dr_Cr]=="Cr"){echo "$row2[particulars][$row1[vnarration]]";}else{echo "$row2[particulars][$row2[vnarration]]";}
      echo "</td><td>$row2[chequedd_no]</td><td>";
	  if($row2[Dr_Cr]=="Cr"){
      echo "$row2[fcredit]";} else { echo "";}echo "</td><td>";
	  if($row2[Dr_Cr]=="Dr"){
	 echo $row2[fdebit];} else {echo "";}echo "</td><td>";
    if($row2[Dr_Cr]=="Cr"){echo "$s";$td=$td+$row2[fcredit];}if($row2[Dr_Cr]=="Dr"){echo "$s";$tw=$tw+$row2[fdebit];}
	$s=$s-$b;
	}
	}
	            echo "</td></tr><tr><td colspan=2>Total Deposit:$td</td>";
                  
              echo "<td colspan=2>Total Withdrawal:$tw</td>";
              
              $tb=$bal[0]+$td-$tw;echo "<td colspan=3>Balance:$tb</td></tr>";







/*$q=execute("select * from ac_institution where vinstitution=\"$ins\"");
$b1=mysql_fetch_object($q);
echo "To Balance Brought Down=>";
$qry21=execute("select max(opdate) from ac_opbal where vledger=\"$ledger\" and opdate<\"$bd1\" and vins=\"$ins\" order by iIdx_op");
$ab=fetchrow($qry21);
$qry22=execute("select fopbal from ac_opbal where vledger=\"$ledger\" and opdate=\"$ab[0]\" and vins=\"$ins\" order by iIdx_op");
 $bal=fetchrow($qry22);
 $b=$bal[0];
 if(!$ab[0]){echo $bal[0]=0.00."\n";}
 else{echo $bal[0]."\n";} 
	$s=0;$td=0;$tw=0;
	$sq1=execute("select * from ac_voucher where ddate between \"$bd1\" and \"$bd2\" and acc=\"$ledger\" and iIdx_institution=\"$b1->iIdx_institution\" order by(ddate)");
	while($row1=mysql_fetch_assoc($sq1))
	{
	$ids=$row1[vvoucherno];
	$sq2=execute("select * from ac_voucher where ddate between \"$bd1\" and \"$bd2\" and acc<>\"$ledger\" and vvoucherno=\"$ids\" and iIdx_institution=\"$b1->iIdx_institution\" order by(ddate)");
	while($row2=mysql_fetch_assoc($sq2))
	{
	if($row2[Dr_Cr]=="Cr"){$s=$s+$row2[fcredit]+$b;}if($row2[Dr_Cr]=="Dr"){$s=$s-$row2[fdebit]+$b;}
	  $dtd=date('d-m-Y',strtotime( $row2[ddate]));
   echo $dtd;
      echo $row2[vvoucherno];
      if($row2[Dr_Cr]=="Cr"){echo $row2[particulars]."[".$row1[vnarration]."]";}else{echo $row2[particulars]."[".$row2[vnarration]."]";}
      echo $row2[chequedd_no];
	  if($row2[Dr_Cr]=="Cr"){
      echo $row2[fcredit];} else { echo "";}
	  if($row2[Dr_Cr]=="Dr"){
	 echo $row2[fdebit];} else {echo "";}
    if($row2[Dr_Cr]=="Cr"){echo $s;$td=$td+$row2[fcredit];}if($row2[Dr_Cr]=="Dr"){echo $s."\n";$tw=$tw+$row2[fdebit];}
	$s=$s-$b;
	}
	}
	            echo "Total Deposit: ".$td;
                  
              echo "Total Withdrawal: ".$tw;
              
              $tb=$bal[0]+$td-$tw;echo "Balance:".$tb;*/
			  echo "</body>";
echo "</html>";
              //To print out the record without column heading and all values are NOT quoted
//print CreateCSV::create($sql, false, false);

//To print out the record with column heading and all values are quoted
//echo CreateCSV::create($sql, true);

//To print out the record with column heading and all values are NOT quoted
//print CreateCSV::create($sql, true, false);

?>