<?php
session_start();
$name=$_SESSION['name'];

$tp=$_SESSION['type'];
include("../db.php");
$dt1 = isset($_REQUEST["date7"]) ? $_REQUEST["date7"] : "";
$dt2 = isset($_REQUEST["date7"]) ? $_REQUEST["date8"] : "";
$ins=$_SESSION['ins'];
$org=$_SESSION['org'];
$_SESSION['bdt1']=$dt1;
$_SESSION['bdt2']=$dt2;
if($tp=='a')
{
$or1=$_POST['cmbin'];
$_SESSION['or11']=$or1;
}
else
{
$or1=$_SESSION['ior'];
}
$_SESSION['ins']=$ins;
//$ins=$_POST['cmbin'];
$ledger=$_POST['lisled'];
$_SESSION['ld']=$ledger;
$q=execute("select * from ac_institution where vinstitution=\"$ins\"");
$b1=mysql_fetch_object($q);
$qry=execute("select * from ac_voucher where ddate between \"$dt1\" and \"$dt2\" and acc<>\"$ledger\" and iIdx_organization=\"$or1\"");
$dt11=date('d-m-Y',strtotime($dt1));
$dt22=date('d-m-Y',strtotime($dt2));
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
		$y34=$yr3.'-03-31';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<title>Account Management</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" charset="utf-8" />
	<link href="calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="calendar.js"></script>
<script language="javascript" src="calendar1.js"></script>
<script language="javascript">
function validate()
{
if(document.form1.cmbin.value=="select")
{
window.alert("Select Institution");
return false;
}
}
</script>
<script type="text/javascript" src="scripts/jquery.min.js"></script> 
<script type="text/javascript" src="scripts/jquery.hoveraccordion.min.js"></script> 
	<script>
	$(document).ready(function(){
	$('#identifier').hoverAccordion();
	});
	</script>
</head>

<body>
  <div id="wrapper">
    
    <div id="header">
     
      <div id="cart">
        
           
              <p align="left">&nbsp;</p>
              <p align="left">Welcome <?php echo $name."   "?>, <a href="logout.php">Logout</a></p>
      </div>
	  <div id="logo">
      <h1 >Account Management</h1>
     </div>
    </div>
    <div id="body">
      <?php
	if($tp=='u')
	{
	include("usermenu.php");
	  }
	  else
	  {
	 include("adminmenu.html");
	  }
	  ?>
      <div id="seasonal">
        <div class="inner">
          <form id="form1" name="form1" method="post" action="exportbankbook1.php">
            <table width="200" border="1" style="position:absolute; left: 245px; top: 119px; width: 720px; height: 91px;" id="tbl">
              <tr id="th">
                <td colspan="8"><a href="index.html"></a>
                  <div align="center" class="style1 style4"><strong>BANK BOOK </strong></div></td>
      </tr>
              
              <tr id="td1">
                <td><span ><strong>Date From </strong></span></td>
        <td colspan="7"><b><?php echo $dt11;?></b></td>
      </tr>
              <tr id="td1">
                <td><span ><strong>Date To </strong></span></td>
        <td colspan="7"><b><?php echo $dt22;?></b></td>
      </tr>
              <tr id="td1">
                <td><span ><strong>Group</strong></span></td>
        <td colspan="7"><strong>Bank Account </strong></td>
      </tr>
              <tr id="td1">
                <td><span ><strong>Ledger</strong></span></td>
        <td colspan="7"><b><?php echo $ledger;?></b></td>
      </tr>
              <tr id="th1">
                <td><span >Date</span></td>
        <td width="120"><strong>Voucher No: </strong></td>
        <td width="184"><strong>Particular</strong></td>
        <td width="140"><strong>Cheque/DD No: </strong></td>
        <td width="89"><strong>Deposit</strong></td>
        <td width="114"><strong>Withdraw</strong></td>
        <td width="123"><strong>Balance</strong></td>
      </tr>
              <tr id="td1">
                <td height="38" colspan="7"><div align="right"><strong>To Balance Brought Down=&gt;<?php /*?> <?php $qry21=execute("select max(opdate) from ac_opbal where vledger=\"$ledger\" and opdate<\"$dt1\" and vins=\"$ins\" order by iIdx_op");$ab=fetchrow($qry21);$qry22=execute("select fopbal from ac_opbal where vledger=\"$ledger\" and opdate=\"$ab[0]\" and vins=\"$ins\" order by iIdx_op"); $bal=fetchrow($qry22);$b=$bal[0];if(!$ab[0]){echo $bal[0]=0.00;}else{echo $bal[0];} ?><?php */?> 
				<?php
				
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
				?>
				
				
				
				</strong></div></td>
      </tr>
              <?php
	$s=0;$td=0;$tw=0;
	$sq1=execute("select * from ac_voucher where ddate>=\"$dt1\" and ddate<=\"$dt2\" and acc=\"$ledger\" and iIdx_organization=\"$or1\" order by(ddate)");
	while($row1=mysql_fetch_assoc($sq1))
	{
	$ids=$row1[vvoucherno];
	$ivch=$row1[iIdx_vouchermaster];
	$sq2=execute("select * from ac_voucher where ddate>=\"$dt1\" and ddate<=\"$dt2\" and acc<>\"$ledger\" and iIdx_vouchermaster=\"$ivch\" and vvoucherno=\"$ids\" and iIdx_organization=\"$or1\" order by(ddate)");
	while($row2=mysql_fetch_assoc($sq2))
	{
	if($row2[Dr_Cr]=="Cr"){$s=$s+$row2[fcredit]+$b;}if($row2[Dr_Cr]=="Dr"){$s=$s-$row2[fdebit]+$b;}
	  $dtd=date('d-m-Y',strtotime( $row2[ddate]));
	?>
              <tr id="td1">
                <td height="38"><?php echo $dtd;?></td>
        <td width="120"><?php echo $row2[vvoucherno];?></td>
        <td width="184"><?php if($row2[Dr_Cr]=="Cr"){echo $row2[particulars]."[".$row1[vnarration]."]";}else{echo $row2[particulars]."[".$row2[vnarration]."]";}?></td>
        <td width="140"><?php echo $row2[chequedd_no];?></td>
	    <?php
	  if($row2[Dr_Cr]=="Cr"){
	  ?>
                <td width="89"><?php echo $row2[fcredit];?></td><?php } else { ?>  <td width="114"><?php echo "";?></td><?php } ?>
                <?php
	  if($row2[Dr_Cr]=="Dr"){
	  ?>
                <td width="123"><?php echo $row2[fdebit];?></td><?php } else { ?>  <td width="114"><?php echo "";?></td><?php } ?>
                <td width="123"><?php if($row2[Dr_Cr]=="Cr"){echo number_format($s,2);$td=$td+$row2[fcredit];}if($row2[Dr_Cr]=="Dr"){echo number_format($s,2);$tw=$tw+$row2[fdebit];}?></td>
      </tr>
              <?php
	$s=$s-$b;
	}
	}
	?>
              <tr>
                <td colspan="8"><label>
                  <div align="left">
                    <p><strong>Total Deposit: 
                      </strong>
                      <input type="text" name="txttd" value="<?php echo number_format($td,2);?>" readonly/>
                      <strong>Total Withdrawal:          </strong>
                      <input type="text" name="txttw" value="<?php echo number_format($tw,2);;?>" readonly/> 
                      <strong>Balance:
                        <input type="text" name="txttb" value="<?php $tb=$b+$td-$tw;if($tb>0) {echo number_format($tb,2)."Dr";}else { if($tb<0){ echo number_format(($tb*-1),2)."Cr"; }else{ echo number_format($tb,2);}}?>" readonly="readonly"/>
                      </strong> </p>
            <p>&nbsp;</p>
          </div>
          </label></td>
      </tr>
              <tr>
                <td colspan="8"><div align="right"><input name="button" type='button' onclick='javascript:window.location.href=&quot;exportbankbook1.php&quot;' value='Export' /></div> </td>
      </tr>
            </table>
  </form>
            <h2>&nbsp;</h2>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
		    <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
		    <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
		    <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p><strong> </strong></p>
            <p></p><br/><br/><br/><br/><br/><br/><br/>
          <p></p>
			  
                    
        </div>
      </div>
        
      <div class="clear"> </div>
        <div id="seas">
          
          <div class="clear"> </div>
        </div>
    </div><div id="copyright">
      <p>All rights reserved</p>
    </div>
  </div>
</body>
</html>
