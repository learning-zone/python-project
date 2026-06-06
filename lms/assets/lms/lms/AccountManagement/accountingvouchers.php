<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
$ins=$_SESSION['ins'];
$tp=$_SESSION['type'];
$type=$_SESSION['type'];
$org=$_SESSION['org'];
require_once('classes/tc_calendar.php');
require_once('classes1/tc_calendar1.php');
include("../db.php");
$date=date("d/m/Y");
$qry=execute("select * from ac_vouchermaster");
$qry1=execute("select * from ac_voucher");
$num=rowcount($qry1);
//echo $num;
$num=$num/2;
$vno=$num+1;
$qry2=execute("select * from ac_organization");
$qry11=execute("select max(vvoucherno) from ac_voucher");
$r=fetchrow($qry11); 
//echo $r[0];
$qry3=execute("select * from ac_voucher where vvoucherno=\"$r[0]\"");
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
<script type="text/javascript">
function validate()
{
	
	if(document.form1.combovtype.value=="select")
	{
		window.alert("Select Voucher Type");
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
	
	 include("adminmenu.html");
	
	  ?>
      <div id="seasonal">
        <div class="inner">
          <form id="form1" name="form1" method="post" action="createvoucher2.php" onsubmit="return validate();">
            <table width="965" border="0" style="position:absolute; width: 454px; height: 169px; left: 359px; top: 156px;">
              <tr>
                <th height="26" colspan="4" scope="row"><div align="center" id="hd"><a href="index.html"></a>VOUCHER</div>        </th>
        </tr>
              <tr>
                <th height="21" colspan="4" scope="row"><div align="right"></div></th>
      </tr>
              <tr>
                <th width="167" height="33" scope="row"><span class="style18">Select Organization &nbsp;</span></th>
	            <?php 
	  
	  ?>
                <td width="145"><select name="comboin"><option value="select">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -SELECT-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option> 
                  <?php
	  
	  while ($row = mysql_fetch_assoc($qry2))
      {
	  ?>
                  <option value="<?php echo $row[iIdx_organization]; ?>"><?php echo $row[vorgname]; ?></option>
                  <?php } ?>
                  </select>&nbsp;</td>
	
		
                <td width="56" colspan="2">&nbsp;</td>
      </tr>
              
              
              <tr>
                <th scope="row">&nbsp;</th>
        <th scope="row"><input name="submit" type="submit" value="     Go&gt;     " align="middle"/></th>
        <td colspan="2">&nbsp;</td>
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
            <p></p>
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

