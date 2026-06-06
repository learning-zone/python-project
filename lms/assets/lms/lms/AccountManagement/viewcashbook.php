<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
$tp=$_SESSION['type'];
include("../db.php");
$dt1 = isset($_REQUEST["date13"]) ? $_REQUEST["date13"] : "";
$dt2 = isset($_REQUEST["date14"]) ? $_REQUEST["date14"] : "";
$_SESSION['bdt3']=$dt1;
$_SESSION['bdt4']=$dt2;
$ins=$_SESSION['ins'];
$org=$_SESSION['org'];
if($tp=='a')
{
$ins=$_POST['cmbin'];
}
$_SESSION['ins']=$ins;
//$ins=$_POST['cmbin'];
$ledger=$_POST['lisled'];
$_SESSION['ld']=$ledger;
$q=execute("select * from ac_institution where vinstitution=\"$ins\"");
$b1=mysql_fetch_object($q);
$qry=execute("select * from ac_voucher where ddate between \"$dt1\" and \"$dt2\" and acc<>\"$ledger\" and iIdx_institution=\"$b1->iIdx_institution\"");
$dt11=date('d-m-Y',strtotime($dt1));
$dt22=date('d-m-Y',strtotime($dt2));
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
    <style type="text/css">
<!--
.style1 {font-weight: bold}
.style2 {font-weight: bold}
.style3 {font-weight: bold}
-->
    </style>
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
          <form id="form1" name="form1" method="post" action="exportcashbook.php">
            <table width="200" border="1" style="position:absolute; left: 212px; top: 117px; width: 711px; height: 91px;" id="tbl">
              <tr id="th">
                <td colspan="8"><a href="index.html"></a>
                  <div align="center" class="style1 style3 style7"><strong>CASH BOOK </strong></div></td>
      </tr>
              <tr id="td1">
                <td width="112"><strong>DEPARTMENT</strong></td>
        <td colspan="7"><b><?php echo $ins;?></b></td>
      </tr>
              <tr id="td1">
                <td><span class="style9"><strong>Date From </strong></span></td>
        <td colspan="7"><b><?php echo $dt11;?></b></td>
      </tr>
              <tr id="td1">
                <td><span class="style9"><strong>Date To </strong></span></td>
        <td colspan="7"><b><?php echo $dt22;?></b></td>
      </tr>
              <tr id="td1">
                <td><span class="style9"><strong>Group</strong></span></td>
        <td colspan="7"><strong>Cash-in-hand </strong></td>
      </tr>
              <tr id="td1">
                <td><span class="style9"><strong>Ledger</strong></span></td>
        <td colspan="7"><b><?php echo $ledger;?></b></td>
      </tr>
              <tr id="th1">
                <td><strong>Date</strong></td>
        <td width="120"><strong>Voucher No: </strong></td>
        <td width="184"><strong>Particular</strong></td>
        <td width="89"><strong>Debit</strong></td>
        <td width="114"><strong>Credit</strong></td>
        <td width="123"><strong>Balance</strong></td>
      </tr>
              <tr>
                <td height="38" colspan="7"><div align="right"><strong>To Balance Brought Down=&gt; <?php $qry21=execute("select max(opdate) from ac_opbal where vledger=\"$ledger\" and opdate<\"$dt1\" and vins=\"$ins\"");$ab=fetchrow($qry21);$qry22=execute("select fopbal from ac_opbal where vledger=\"$ledger\" and opdate=\"$ab[0]\" and vins=\"$ins\" order by iIdx_op"); $bal=fetchrow($qry22);$b=$bal[0];if(!$ab[0]){echo $bal[0]=0.00;}else{echo $bal[0];} ?> </strong></div></td>
      </tr>
              <?php
	$s=0;$td=0;$tw=0;
	$sq1=execute("select * from ac_voucher where ddate between \"$dt1\" and \"$dt2\" and acc=\"$ledger\" and iIdx_institution=\"$b1->iIdx_institution\" order by(ddate)");
	while($row1=mysql_fetch_assoc($sq1))
	{
	$ids=$row1[vvoucherno];
	$ivch=$row1[iIdx_vouchermaster];
	$sq2=execute("select * from ac_voucher where ddate between \"$dt1\" and \"$dt2\" and acc<>\"$ledger\" and iIdx_vouchermaster=\"$ivch\"  and vvoucherno=\"$ids\" and iIdx_institution=\"$b1->iIdx_institution\" order by(ddate)");
	while($row2=mysql_fetch_assoc($sq2))
	{
	if($row2[Dr_Cr]=="Cr"){$s=$s+$row2[fcredit]+$b;}if($row2[Dr_Cr]=="Dr"){$s=$s-$row2[fdebit]+$b;}
	 $dtd=date('d-m-Y',strtotime( $row2[ddate]));
	?>
              <tr id="td1">
                <td height="38"><?php echo $dtd;?></td>
        <td width="120"><?php echo $row2[vvoucherno];?></td>
        <td width="184"><?php if($row2[Dr_Cr]=="Cr"){echo $row2[particulars]."[".$row1[vnarration]."]";}else{echo $row2[particulars]."[".$row2[vnarration]."]";}?></td>
	    <?php
	  if($row2[Dr_Cr]=="Cr"){
	  ?>
                <td width="89"><?php echo $row2[fcredit];?></td><?php } else { ?>  <td width="114"><?php echo "";?></td><?php } ?>
                <?php
	  if($row2[Dr_Cr]=="Dr"){
	  ?>
                <td width="123"><?php echo $row2[fdebit];?></td><?php } else { ?>  <td width="114"><?php echo "";?></td><?php } ?>
                <td width="123"><?php if($row2[Dr_Cr]=="Cr"){echo $s;$td=$td+$row2[fcredit];}if($row2[Dr_Cr]=="Dr"){echo $s;$tw=$tw+$row2[fdebit];}?></td>
      </tr>
              <?php
	$s=$s-$b;
	}
	}
	?>
              <tr>
                <td colspan="8"><label>
                  <div align="right"><strong>Total Debit</strong>
                    <input type="text" name="txttd" value="<?php echo $td;?>" readonly/>
                    <strong>Total Credit          </strong>
                    <input type="text" name="txttw" value="<?php echo $tw;?>" readonly/> 
                    <strong>Balance
                      <input type="text" name="txttb" value="<?php $tb=$bal[0]+$td-$tw;echo $tb;?>" readonly/>
                    </strong> </div>
        </label></td>
      </tr>
              <tr>
                <td colspan="8"><div align="right"><?php /*?><input name="button" type='button' onclick='javascript:window.location.href=&quot;exportcashbook.php&quot;' value='Export' /><?php */?></div> </td>
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
