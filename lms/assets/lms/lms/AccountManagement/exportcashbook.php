<?php
session_start();
include("../db.php");
$ins=$_SESSION['ins'];
$ledger=$_SESSION['ld'];
$bd1=$_SESSION['bdt3'];
$bd2=$_SESSION['bdt4'];
$dt11=date('d-m-Y',strtotime($bd1));
$dt22=date('d-m-Y',strtotime($bd2));
//$ins=$_SESSION['ins'];
$tp=$_SESSION['type'];
if($tp=='a')
{
$or1=$_SESSION['or11'];
}
else
{
$or1=$_SESSION['ior'];
}
$kkl=execute("select vorgname from ac_organization where iIdx_organization='$or1'");
$cc=fetchrow($kkl);
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=cashbook.doc");
header("Pragma: no-cache");
header("Expires: 0");
echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
echo "<body>";
echo "<b><table border=1>";
echo "<tr><td colspan=7>$cc[0]</td><tr>";
echo "<tr><td colspan=7>Account :$ledger</td><tr>";
echo "<tr><td colspan=7><div align=center> From $dt11 To  $dt22 </div></td><tr>";
echo "<b><tr><td>DATE</td><td>VOUCHER NO:</td><td>PARTICULAR</td><td>DEBIT</td><td>CREDIT</td><td>BALANCE</td></tr></b>";
$yr=date('Y');
		$yr1=$yr-1;
		$yr2=$yr+1;
		$yr3=$yr-2;
		$mon=date('m');
		$dat=date('d');
		$y11=$yr.'-04-01';
		$y12=$yr.'-03-31';
		$y21=$yr1.'-04-01';
		$y22=$yr1.'-03-31';
		$y31=$yr2.'-04-01';
		$y32=$yr2.'-03-31';
		$y33=$yr3.'-04-01';











 echo "<tr>
                <td  colspan=7><div align=right><strong>To Balance Brought Down=&gt; ";
				 $qry21=execute("select max(opdate) from ac_opbal where vledger=\"$ledger\" and opdate<\"$dt1\" and vins=\"$ins\"");
				 $ab=fetchrow($qry21);
				 $qry22=execute("select fopbal from ac_opbal where vledger=\"$ledger\" and opdate=\"$ab[0]\" and vins=\"$ins\" order by iIdx_op");
				  $bal=fetchrow($qry22);$b=$bal[0];if(!$ab[0]){echo $bal[0]=0.00;}else{echo $bal[0];} 
					
				 if($mon>3)
				{
				
				$qcnt=execute("select * from ac_opbal where iIdx_organization=\"$or1\" and Vledger=\"$ledger\" and opdate between \"$y21\" and \"$y12\"");
				$ct=rowcount($qcnt);
				if($ct>0)
				{
				$qw=execute("select max(iIdx_op) from ac_opbal where opdate<\"$y11\" and iIdx_organization=\"$or1\" and Vledger=\"$ledger\"");
	 		    $r0=fetchrow($qw);
				}
				else
				{
				$qw=execute("select min(iIdx_op) from ac_opbal where opdate=\"$y11\" and iIdx_organization=\"$or1\" and Vledger=\"$ledger\"");
	  			$r0=fetchrow($qw);
	 			 }
	  }
	  else
	  {
	  $qcnt=execute("select * from ac_opbal where iIdx_organization=\"$or1\" and Vledger=\"$ledger\" and opdate between \"$y33\" and \"$y22\"");
	  $ct=rowcount($qcnt);
	  if($ct>0)
	  {
	  $qw=execute("select max(iIdx_op) from ac_opbal where opdate<\"$y21\" and iIdx_organization=\"$or1\" and Vledger=\"$ledger\"");
	  $r0=fetchrow($qw);
	  }
	  else
	  {
	  $qw=execute("select min(iIdx_op) from ac_opbal where opdate=\"$y21\" and iIdx_organization=\"$or1\" and Vledger=\"$ledger\"");
	  $r0=fetchrow($qw);
	  }
	  }
	   $q2=execute("select * from ac_opbal where iIdx_organization=\"$or1\" and Vledger=\"$ledger\" and iIdx_op=\"$r0[0]\"");
	   $rr=mysql_fetch_object($q2);
	   $typ=$rr->Dr_Cr;
	   $q1=execute("select fopbal from ac_opbal where iIdx_organization=\"$or1\" and Vledger=\"$ledger\" and iIdx_op=\"$r0[0]\"");
	  $bal=fetchrow($q1);
	  $b=$bal[0];
	  if($b<0)
	  {
	  //$b=$bal[0]*-1;
	    $amm=($bal[0]*-1)."Cr";
	  }
	 if($b>0)
	  {
	  $amm=$bal[0]."Dr";
	  }
	
	  if(!$b)
	  {$amm=0.00;	}	
	  echo $amm;
			
	$s=0;$td=0;$tw=0;
	$sq1=execute("select * from ac_voucher where ddate>=\"$bd1\" and ddate<=\"$bd2\" and acc=\"$ledger\" and iIdx_organization=\"$or1\" order by(ddate)");
	while($row1=mysql_fetch_assoc($sq1))
	{
	$ids=$row1[vvoucherno];
	$ivch=$row1[iIdx_vouchermaster];
	$sq2=execute("select * from ac_voucher where ddate>=\"$bd1\" and ddate<=\"$bd2\" and acc<>\"$ledger\" and iIdx_vouchermaster=\"$ivch\" and vvoucherno=\"$ids\" and iIdx_organization=\"$or1\" order by(ddate)");
	while($row2=mysql_fetch_assoc($sq2))
	{
	if($row2[Dr_Cr]=="Cr"){$s=$s+$row2[fcredit]+$b;}if($row2[Dr_Cr]=="Dr"){$s=$s-$row2[fdebit]+$b;}
	 $dtd=date('d-m-Y',strtotime( $row2[ddate]));
	
            echo "  <tr>
                <td>$dtd</td>
        <td>$row2[vvoucherno]</td>
        <td>";
		if($row2[Dr_Cr]=="Cr"){echo $row2[particulars]."[".$row1[vnarration]."]";}else{echo $row2[particulars]."[".$row2[vnarration]."]";}
		echo "</td>";
	 
	  if($row2[Dr_Cr]=="Cr"){
	
                echo "<td>$row2[fcredit]</td>";
				 } else { 
				 echo "<td></td>"; } 
                
	  if($row2[Dr_Cr]=="Dr"){
	
                echo "<td>$row2[fdebit]</td>";
				 } else { 
				 echo " <td></td> ";} 
                echo "<td >";
				 if($row2[Dr_Cr]=="Cr"){echo number_format($s,2);$td=$td+$row2[fcredit];}if($row2[Dr_Cr]=="Dr"){echo number_format($s,2);$tw=$tw+$row2[fdebit];}
				 echo "</td>
      </tr>";
            
	$s=$s-$b;
	}
	}
	
              echo "<tr>
                <td colspan=8><label>
                  <div align=right><strong>Total Debit</strong>";
                   echo number_format($td,2)."<br>";
                   echo " <strong>Total Credit          </strong>";
                    echo number_format($tw,2)."<br>";
                   echo " <strong>Balance";
                       $tb=$b+$td-$tw;if($tb>0) {echo number_format($tb,2)."Dr"."<br>";}else { if($tb<0){ echo number_format(($tb*-1),2)."Cr"."<br>"; }else{ echo number_format($tb,2)."<br>";}} 
                    echo "</strong> </div>
        </label></td>
      </tr>  </table>";
              
          





















echo "</body>";
echo "</html>";
?>