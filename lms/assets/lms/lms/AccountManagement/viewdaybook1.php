<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
include("../db.php");
require_once('classes/tc_calendar.php');
require_once('classes1/tc_calendar1.php');
$dt1 = isset($_REQUEST["date7"]) ? $_REQUEST["date7"] : "";
$org=$_SESSION['org'];
$tp=$_SESSION['type'];
$ins=$_SESSION['ins'];
if($tp=='a')
{
$ins=$_POST['cmbin'];
}
if($dt1=="")
{
 $ins=$_REQUEST['ins'];
 $dt1=$_REQUEST['dt1'];
/* if($dt1=="")
 {
 $dt1=$_POST['h3'];
  $ins=$_POST['h1'];
 }*/
}

//echo $ins.$dt1;
//$ins=$_SESSION['ins'];


//echo $dt1;
/*if($tp=='a')
{
$_SESSION['dtt']=$dt1;
$ins=$_POST['cmbin'];
if($dt1=="")
{
$dt1=$_REQUEST['dt1'];
$ins=$_REQUEST['ins'];
}
$_SESSION['ins']=$ins;
}*/
//echo $ins.$dt1;;
$q=execute("select * from ac_institution where vinstitution=\"$ins\"");
$b1=mysql_fetch_object($q);
/*$dt=explode("/",$dt1);
$d=$dt[0];
$m=$dt[1];
$y=$dt[2];
$date1=$y."-".$m."-".$d;*/
$qry=execute("select * from ac_voucher where ddate=\"$dt1\" and iIdx_institution=\"$b1->iIdx_institution\""); 
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
.style2 {color: #CC6600}
.style3 {
	font-size: 13px;
	font-weight: bold;
}
.style4 {
	color: #0066FF;
	font-weight: bold;
}
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
          <form id="form1" name="form1" method="post" action="audit.php" onsubmit="return validate();">
            <table width="200" border="1" style="position:absolute; left: 240px; top: 112px; width: 803px; height: 178px;" id="tbl">
              <tr id="th">
                <td colspan="10"><div align="center" class="style7 style8 style3">DAY BOOK </div></td>
      </tr>
              
              
              <tr id="td1">
                <td colspan="10"><div align="center" ><div align="left"><?php echo $ins;?></div>       
            <span class="style4">DAY BOOK AS ON</span> <?php echo date('d-m-Y',strtotime($dt1));?></div></td>
        </tr>
              <tr id="th1">
                <td width="137" ><strong>Date</strong></td>
        <td width="337"><strong>Particulars</strong></td>
        <td width="156"><strong>Voucher Type </strong></td>
        <td width="141"><strong>Voucher Number </strong></td>
        <td width="119"><strong>Debit</strong></td>
        <td width="133"><strong>Credit</strong></td><td></td> <?php
		if($tp=='a')
		{
		?><td>Status</td>
      </tr>
              <?php
	}
	while($row1=mysql_fetch_assoc($qry))
	{
	?>
              <tr id="td1">
                <?php if($row1[vvoucherno]==$v1) {?><td></td><?php } else {?>
                <td><?php echo date('d-m-Y',strtotime($row1[ddate])); ?>&nbsp;</td><?php } ?>
                <td><?php echo $row1[acc]; ?>&nbsp;</td>
	    <?php
	  $qryy=execute("select * from ac_vouchermaster where iIdx_vouchermaster=\"$row1[iIdx_vouchermaster]\"");
	  $o=mysql_fetch_object($qryy);
	  ?>
                <?php if($row1[vvoucherno]==$v1) {?><td></td><?php } else {?>
                <td><?php echo $o->vvouchertype; ?>&nbsp;</td><?php } ?>
                <?php if($row1[vvoucherno]==$v1) {?><td></td><?php } else {?>
                <td><?php echo $row1[vvoucherno]; ?>&nbsp;</td><?php } ?>
                <td><?php echo $row1[fdebit]; ?>&nbsp;</td>
        <td><?php if($row1[fcredit]<0){ ?><font color="#FF0000"><?php echo $row1[fcredit]; ?></font><?php } else {echo $row1[fcredit]; }?>&nbsp;</td>
	  	    <?php if($row1[vvoucherno]==$v1) {?><td></td><?php } else {?><td>    <strong><b><?php echo "<a href='updatedeletedaybook.php?id=$row1[vvoucherno]&ins=$ins&vtype=$o->vvouchertype' id=new><font size=2 >View</a>"?></b></strong>   </td>
	     <?php
	   }
		if($tp=='a')
		{
		if($row1[vvoucherno]==$v1) {
		?>
                <td></td><?php } else {?>
                <?php
	 
	  if($row1[istatus]==1)
 echo "<td width=150><b><a href='audit.php?id= $row1[vvoucherno]&ins=$ins&dt1=$dt1'><font size=2 color=#CC3300>Audited</font></a></b></td>";
 else
 echo "<td width=150><b><a href='audit.php?id= $row1[vvoucherno]&ins=$ins&dt1=$dt1'><font size=2 color=#CC3300>Not Audited</font></a></b></td>";
 }}
  ?>
              </tr>
              <?php
	$v1=$row1[vvoucherno];
	}
	?>
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

