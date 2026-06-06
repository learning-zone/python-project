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
		if(document.form1.txtutype.value=="")
		{
			window.alert("Enter Voucher Type");
			document.form1.txtutype.focus();
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
          <form id="form1" name="form1" method="post" action="usertypeaction.php" onsubmit="return validate();">
            <table width="200" border="0" style="position:absolute; left: 264px; top: 136px; width: 576px; height: 123px; layer-background-color: #CCCCCC; border: 1px none #000000;" cellspacing="0">
              <tr>
                <th colspan="3" scope="row"><p align="left"><a href="index.html"></a></p>
        <p>&nbsp;</p>      <div align="left" id="hd">
          <div align="center">CREATE USER TYPE </div>
        </div></th>
        </tr>
              <tr>
                <th colspan="3" scope="row"><?php echo $msg;?>&nbsp;</th>
      </tr>
              
              <tr>
                <th width="171" height="32" scope="row"><div align="right"><span class="style7">User Type: </span></div></th>
        <td width="186"><label>
          <input type="text" name="txtutype" />
          </label></td>
      </tr>
              
				 <tr>
                <th height="21" scope="row"><div align="right">Select Tasks: </div></th>
        <th width="186" height="15" scope="row"><label>
          <div align="left">
            <input type="checkbox" name="tr" />
            Transactions  </div>
        </label></th>
        <th width="213" scope="row"><div align="left">
          <input type="checkbox" name="mgs" />
          View Master Groups </div></th>
      </tr>
              <tr>
                <th height="15" scope="row">&nbsp;</th>
        <th height="15" scope="row"><div align="left">
          <input type="checkbox" name="db" />
          View Day Book </div></th>
        <th height="15" scope="row"><div align="left">
          <input type="checkbox" name="gp" value="a" />
          Create Groups </div></th>
      </tr>
              <tr>
                <th height="15" scope="row">&nbsp;</th>
        <th height="15" scope="row"><div align="left">
          <input type="checkbox" name="bb" value="a" />
          View Bank Book </div></th>
        <th height="15" scope="row"><div align="left">
          <input type="checkbox" name="vtp" value="a" />
          Create Voucher Types </div></th>
      </tr>
              <tr>
                <th height="15" scope="row">&nbsp;</th>
        <th height="15" scope="row"><div align="left">
          <input type="checkbox" name="cb" value="a" />
          View Cah Book </div></th>
        <th height="15" scope="row"><div align="left">
          <input type="checkbox" name="cled" value="a" />
          Create Ledgers </div></th>
      </tr>
              <tr>
                <th height="15" scope="row">&nbsp;</th>
        <th height="15" scope="row"><div align="left">
          <input type="checkbox" name="vlb" value="a" />
          View Ledger Book </div></th>
        <th height="15" scope="row"><div align="left">
          <input type="checkbox" name="cdep" value="a" />
          Create Departments </div></th>
      </tr>
              <tr>
                <th height="15" scope="row">&nbsp;</th>
        <th height="15" scope="row"><div align="left">
          <input type="checkbox" name="vtb" value="a" />
          View Trial Balance</div></th>
        <th height="15" scope="row"><div align="left">
          <input type="checkbox" name="cjob" value="a" />
          Create Jobs </div></th>
      </tr>
              <tr>
                <th height="15" scope="row">&nbsp;</th>
        <th height="15" scope="row"><div align="left">
          <input type="checkbox" name="vpl" value="a" />
          View Profit and Loss </div></th>
        <th height="15" scope="row"><div align="left">
          <input name="aep" type="checkbox" value="a" />
          Add Employees </div></th>
      </tr>
              <tr>
                <th height="19" scope="row">&nbsp;</th>
        <th height="19" scope="row"><div align="left">
          <input type="checkbox" name="vbs" value="a" />
          View Balance Sheet </div></th>
        <th height="19" scope="row"><div align="left">
          <input type="checkbox" name="att" value="a" />
          Add Attendance </div></th>
      </tr>
              <tr>
                <th height="15" scope="row">&nbsp;</th>
        <th height="15" scope="row"><label>
          <div align="left">
            <input type="checkbox" name="inex" value="a" />
            View Income/Expense 
          </div>
        </label></th>
        <th height="15" scope="row"><div align="left">
          <input type="checkbox" name="asal" value="a" />
          Add Salary </div></th>
      </tr>
              <tr>
                <th height="15" scope="row">&nbsp;</th>
                <th height="15" scope="row"><div align="left">
                  <input type="checkbox" name="cpas" value="a" />
                Change Password </div></th>
                <th height="15" scope="row">&nbsp;</th>
              </tr>
              <tr>
                <th scope="row">&nbsp;</th>
        <td><input type="submit" value=" Save " />&nbsp;<input name="button" type='button' onclick='javascript:window.location.href=&quot;viewusertypes.php&quot;' value='View' /></td>
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

