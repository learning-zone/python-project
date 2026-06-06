<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
$tp=$_SESSION['type'];
$org=$_SESSION['org'];
require_once('classes/tc_calendar.php');
require_once('classes1/tc_calendar1.php');
include("../db.php");
$qry2=execute("select * from ac_institution");
$ins=$_SESSION['ins'];
if($tp=='a')
{
$ins=$_POST['comboin'];
}
$_SESSION['ins']=$ins;
$dt1 = isset($_REQUEST["date41"]) ? $_REQUEST["date41"] : "";
$dt2 = isset($_REQUEST["date42"]) ? $_REQUEST["date42"] : "";
$_SESSION['bdt9']=$dt1;
$_SESSION['bdt10']=$dt2;
 $dtd1=date('d-m-Y',strtotime( $dt1));
  $dtd2=date('d-m-Y',strtotime( $dt2));
$qry1=execute("select * from ac_institution  where vinstitution=\"$ins\"");
$w1=mysql_fetch_object($qry1);
$t1=$w1->iIdx_institution;
//echo $t1;
$qry2=execute("select * from ac_ledger where iIdx_grp=5");
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
if(document.form1.comboin.value=="select")
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
.style2 {color: #CC6600}
.style5 {font-size: 13px}
.style7 {font-size: 13px; font-weight: bold; }
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
          <form id="form1" name="form1" method="post" action="exportprofitloss.php" onsubmit="return validate();">
            <table width="200" border="1" style="position:absolute; left: 216px; top: 111px; width: 702px; height: 114px;" cellspacing="0" bgcolor="#FFFFCC" id="tbl">
              <tr id="th">
                <td colspan="3"><div align="center" class="style3 style5"><strong>PROFIT AND LOSS ACCOUNT </strong></div></td>
              </tr>
              <tr id="td1">
                <td width="360" height="51"><center><b><?php echo $ins."<br>".$dtd1." To "."$dtd2";?></b></center> </td>
                        <td width="360" colspan="2"><center><b><?php echo $ins."<br>".$dtd1." To "."$dtd2";?></b></center> </td>
              </tr>
              <tr id="td1">
                <td height="17"><span class="style7">INCOME</span></td>
                        <td colspan="2"><span class="style7">EXPENSE</span></td>
              </tr>
              <tr id="td1">
                <td height="17"> <?php
					   $sum=0;
					    $qry4=execute("select * from ac_ledger where vins=\"$ins\" and date='$y11';");
			while($r9=mysql_fetch_assoc($qry4))
			{
			$dd=$r9[iIdx_group];
			   $qry5=execute("select * from ac_allgroup where iIdx_grp=\"$dd\"");
			   $b9=mysql_fetch_object($qry5);
			   //echo "hgai";
			  
			   if($b9->vgroupname=="Direct Income" || $b9->vgroupname=="Indirect Income" || $b9->vgroupname=="Income")
			   {
			   $sum=$sum+$r9[fdebit];
			?>
                  <?php echo "<div align=left>$r9[acc]</div><div align=right>$r9[fopbal]</div>";?>
                  
                  
                  <?php
			  }
			}
?><?php
			echo "<b><div align=right>TOTAL:$sum</div></b>";
			  ?>&nbsp;</td>
                        <td colspan="2"> <?php
					  
					   $sum=0;
	        $qry4=execute("select * from ac_voucher where iIdx_institution=\"$t1\" and ddate between \"$dt1\" and \"$dt2\"");
			while($r9=mysql_fetch_assoc($qry4))
			{
			   $qry5=execute("select * from ac_allgroup where iIdx_grp=\"$r9[iIdx_group]\"");
			   $b9=mysql_fetch_object($qry5);
			  
			   if($b9->vgroupname=="Indirect Expense" || $b9->vgroupname=="Direct Expense" || $b9->vgroupname=="Expense")
			   {
			   $sum=$sum+$r9[fcredit];
			?>
                          <?php echo "<div align=left>$r9[acc]<div align=right> $r9[fcredit]</div></div>";?>
                          <?php
			  }
			}?>
                          
                          <?php echo "<b><div align=right>TOTAL:$sum</div></b>";
			  ?>&nbsp;</td>
                      
              <tr>
                      <td height="17" colspan="3"><div align="right"><?php /*?><input name="button" type='button' onclick='javascript:window.location.href=&quot;exportprofitloss.php&quot;' value='Export' /><?php */?></div>&nbsp;</td>
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

