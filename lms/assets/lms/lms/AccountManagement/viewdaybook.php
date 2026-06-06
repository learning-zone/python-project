<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
$ins=$_SESSION['ins'];
$org=$_SESSION['org'];
$tp=$_SESSION['type'];
include("../db.php");
require_once('classes/tc_calendar.php');
require_once('classes1/tc_calendar1.php');
$dt1 = isset($_REQUEST["date7"]) ? $_REQUEST["date7"] : "";
$dt2 = isset($_REQUEST["date8"]) ? $_REQUEST["date8"] : "";
//echo $dt1;
if($tp=='a')
{
$or1=$_POST['cmbin'];
$_SESSION['bdtr']=$or1;
//echo $or1;
}
//echo $ins;
$q=execute("select * from ac_institution where vinstitution=\"$ins\"");
$b1=mysql_fetch_object($q);
$_SESSION['bdt1']=$dt1;
$_SESSION['bdt2']=$dt2;

/*$dt=explode("/",$dt1);
$d=$dt[0];
$m=$dt[1];
$y=$dt[2];
$date1=$y."-".$m."-".$d;*/
$qqr=execute("select vorgname from ac_organization where iIdx_organization='$or1'");
$qqr1=fetchrow($qqr);
$qry=execute("select * from ac_voucher where iIdx_organization=\"$or1\" and ddate between \"$dt1\" and \"$dt2\""); 
$dt11=date('d-m-Y',strtotime($dt1));
$dt22=date('d-m-Y',strtotime($dt2));
$yr=date('Y');
//$yr=substr($dt1,0,strpos($dt1,'-'));
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
          <form id="form1" name="form1" method="post" action="viewdaybook.php" onsubmit="return validate();">
            <table width="200" border="1" style="position:absolute; left: 240px; top: 112px; width: 803px; height: 178px;" id="tbl">
              <tr id="th">
                <td colspan="12"><div align="center" class="style7 style8 style3">DAY BOOK </div></td>
      </tr>
	  
              <tr id="td1">
                
                <td colspan="12"> <?php
		if($tp=='a')
		{
		?><strong>Organization:</strong> 
                 
                  <select name="cmbin">
                    <option value="select">-SELECT-</option>
                    <?php
	$qryy=execute("select * from ac_organization");
	while($row3=mysql_fetch_assoc($qryy))
	{
	?> 
                    <option value="<?php echo $row3[iIdx_organization];?>"><?php echo $row3[vorgname];?></option>
                    <?php
	  }
	  ?>
                  </select> 
                  
                  <?php }?>
                  <p><span ><strong>From</strong></span><strong>
                    <?php
		//$yr=substr($dt1,0,strpos($dt1,'-'));
		$yr1=$yr-1;
		$yr2=$yr+1;
		$mon=date('m');
		$dat=date('d');
		if($mon>3)
		{
	  $myCalendar = new tc_calendar("date7", true, false);
	  $myCalendar->setIcon("images1/iconCalendar.gif");
	 // $myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setPath("./");
	  $myCalendar->setYearInterval($yr3, $yr2);
	  $myCalendar->dateAllow($yr3.'-04-01', $yr2.'-03-31');
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  }
	  else
	  {
	   $myCalendar = new tc_calendar("date7", true, false);
	  $myCalendar->setIcon("images1/iconCalendar.gif");
	 // $myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setPath("./");
	  $myCalendar->setYearInterval($yr3, $yr2);
	  $myCalendar->dateAllow($yr3.'-04-01', $yr2.'-03-31');
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  }
	  ?>	        </strong>          
         <p><span ><strong>To</strong></span><strong>
		 &nbsp;&nbsp;&nbsp;&nbsp;
         <?php
		//$yr=substr($dt1,0,strpos($dt1,'-'));
		$yr1=$yr-1;
		$yr2=$yr+1;
		$mon=date('m');
		$dat=date('d');
		if($mon>3)
		{
	  $myCalendar = new tc_calendar("date8", true, false);
	  $myCalendar->setIcon("images1/iconCalendar.gif");
	 // $myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setPath("./");
	  $myCalendar->setYearInterval($yr3, $yr2);
	  $myCalendar->dateAllow($yr3.'-04-01', $yr2.'-03-31');
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  }
	  else
	  {
	   $myCalendar = new tc_calendar("date8", true, false);
	  $myCalendar->setIcon("images1/iconCalendar.gif");
	 // $myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setPath("./");
	  $myCalendar->setYearInterval($yr3, $yr2);
	  $myCalendar->dateAllow($yr3.'-04-01', $yr2.'-03-31');
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  }
	  ?> 
			 
			        </strong>          
                    <input type="submit" name="b1" value="View" />
                </p></td></tr>
              
              <tr id="td1">
                <td colspan="12"><div align="center" ><div align=left><?php echo "$qqr1[0]";?></div>    
				<?php if(isset($_POST['b1']))  
				{?>				
            <span class="style4">DAY BOOK FROM</span> <?php echo $dt11." ";?><span class="style4">TO</span><?php echo " ".$dt22;?></div>
			<?php }
			else
			{?><span class="style4">DAY BOOK</span><?php }?></td>
        </tr>
              <tr id="th1">
                <td width="137" ><strong>Date</strong></td>
				  <td width="137" ><strong>Bill No:</strong></td>
				    <td width="137" ><strong>Bill Date</strong></td>
        <td width="337"><strong>Particulars</strong></td>
        <td width="156"><strong>Voucher Type </strong></td>
        <td width="141"><strong>Voucher Number </strong></td>
		<td width="119"><strong>Cheque/DD No:</strong></td>
        <td width="133"><strong>Cheque/DD Date:</strong></td>
        <td width="119"><strong>Debit</strong></td>
        <td width="133"><strong>Credit</strong></td>
		 <td width="133"><strong></strong></td>
      </tr>
              <?php
	
	while($row1=mysql_fetch_assoc($qry))
	{
	?>
              <tr id="td1">
                <?php if($row1[vvoucherno]==$v1 && $row1[iIdx_vouchermaster]==$v2) {?><td></td><?php } else {?>
                <td><?php echo date('d-m-Y',strtotime($row1[ddate])); ?>&nbsp;</td><?php } ?>
				
				  <?php if($row1[vvoucherno]==$v1 && $row1[iIdx_vouchermaster]==$v2) {?><td></td><?php } else {?>
                <td><?php echo $row1[vbillno]; ?>&nbsp;</td><?php } ?>
				
				  <?php if($row1[vvoucherno]==$v1 && $row1[iIdx_vouchermaster]==$v2) {?><td></td><?php } else {?>
                <td><?php echo $row1[dbilldate]; ?>&nbsp;</td><?php } ?>
				
				
                <td><?php echo $row1[acc]; ?>&nbsp;</td>
	    <?php
	  $qryy=execute("select * from ac_vouchermaster where iIdx_vouchermaster=\"$row1[iIdx_vouchermaster]\"");
	  $o=mysql_fetch_object($qryy);
	  ?>
                <?php if($row1[vvoucherno]==$v1 && $row1[iIdx_vouchermaster]==$v2) {?><td></td><?php } else {?>
                <td><?php echo $o->vvouchertype; ?>&nbsp;</td><?php } ?>
				
                <?php if($row1[vvoucherno]==$v1 && $row1[iIdx_vouchermaster]==$v2) {?><td></td><?php } else {?>
                <td><?php echo $row1[vvoucherno]; ?>&nbsp;</td><?php } ?>
				
				<?php if($row1[vvoucherno]==$v1 && $row1[iIdx_vouchermaster]==$v2) {?><td><?php echo $row1[chequedd_no]; ?></td><?php } else {?>
                <td><?php echo $row1[chequedd_no]; ?>&nbsp;</td><?php } ?>
				
				<?php if($row1[vvoucherno]==$v1 && $row1[iIdx_vouchermaster]==$v2) {?><td><?php echo $row1[chequedd_date]; ?></td><?php } else {?>
                <td><?php echo $row1[chequedd_date]; ?>&nbsp;</td><?php } ?>
				
                <td><?php echo $row1[fdebit]; ?>&nbsp;</td>
        <td><?php if($row1[fcredit]<0){ ?><font color="#FF0000"><?php echo $row1[fcredit]; ?></font><?php } else {echo $row1[fcredit]; }?>&nbsp;</td>
		<?php if($row1[vvoucherno]==$v1 && $row1[iIdx_vouchermaster]==$v2) {?><td></td> <?php } else {?><td><strong><b><?php echo "<a href='updatedeletedaybook1.php?id=$row1[vvoucherno]&ivn=$row1[iIdx_vouchermaster]&or1=$row1[iIdx_organization]&vtype=$o->vvouchertype&dep=$row1[iIdx_institution] id=new'><font size=2 >View</a> ";$_SESSION['id2']=$row1[vvoucherno];
$_SESSION['ivn2']=$row1[iIdx_vouchermaster];?></b></strong></td><?php } ?>
	   <?php
		if($tp=='a')
		{
	?>
                
                
              </tr>
              <?php
	$v1=$row1[vvoucherno];
	$v2=$row1[iIdx_vouchermaster];
	}
	}
	?>
	<td colspan="12"><div align="right"><input name="button" type='button' onclick='javascript:window.location.href=&quot;exportvoucher.php&quot;' value='Export' /></div> </td>
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
            <p><strong> </strong></p>
            <p></p><br/><br/><br/><br/><br/><br/><br/>
          <p></p> <p>&nbsp;</p>
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
          <p></p> <p>&nbsp;</p>
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
          <p></p> <p>&nbsp;</p>
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
          <p></p> <p>&nbsp;</p>
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
          <p></p> <p>&nbsp;</p>
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

