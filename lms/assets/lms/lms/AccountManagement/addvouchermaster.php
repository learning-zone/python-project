<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
$ins=$_SESSION['ins'];
$tp=$_SESSION['type'];
$type=$_SESSION['type'];
$org=$_SESSION['org'];
include("../db.php");
$msg=$_REQUEST['msg'];
$qry=execute("select vledger from ac_ledger");
$qry1=execute("select * from ac_vouchermaster where iparentid=0");
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<title>Account Management</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" charset="utf-8" />
<script type="text/javascript" src="scripts/jquery.min.js"></script> 
<script type="text/javascript" src="scripts/jquery.hoveraccordion.min.js"></script> 
<script language="javascript">
	function validate()
	{
		if(document.form1.txtvtype.value=="")
		{
			window.alert("Enter Voucher Type");
			document.form1.txtvtype.focus();
			return false;
		}		
	}
</script>

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
          <form id="form1" name="form1" method="post" action="addvouchermasteraction.php" onsubmit="return validate();">
            <table width="200" border="0" style="position:absolute; left: 268px; top: 177px; width: 576px; height: 123px; layer-background-color: #CCCCCC; border: 1px none #000000;" cellspacing="0">
              <tr>
                <th colspan="2" scope="row"><p align="left"><a href="index.html"></a></p>
        <p>&nbsp;</p>      <div align="left" id="hd">
          <div align="center">VOUCHER MASTER</div>
        </div></th>
        </tr>
              <tr>
                <th colspan="2" scope="row"><?php echo $msg;?>&nbsp;</th>
      </tr>
              
              <tr>
                <th width="171" scope="row"><div align="right"><span class="style7">Voucher Type </span></div></th>
        <td width="276"><label>
          <input type="text" name="txtvtype" />
          </label></td>
      </tr>
              
              <tr>
                <th scope="row">&nbsp;</th>
        <td>&nbsp;</td>
      </tr>
              <tr>
                <th scope="row">&nbsp;</th>
        <td><input type="submit" value=" Save " />&nbsp;<input name="button" type='button' onclick='javascript:window.location.href=&quot;viewvouchermaster.php&quot;' value='View' /></td>
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

