<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
$ins=$_SESSION['ins'];
$org=$_SESSION['org'];
$tp=$_SESSION['type'];
include("../db.php");
$msg=$_REQUEST['msg'];
$qry1=execute("Select * from ac_vouchermaster where iparentid=0");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<title>Account Management</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" charset="utf-8" />
<script type="text/javascript" src="scripts/jquery.min.js"></script> 
<script type="text/javascript" src="scripts/jquery.hoveraccordion.min.js"></script> 
	<script>
	$(document).ready(function(){
	$('#identifier').hoverAccordion();
	});
	function showhelp(str)
{
var url="ajaxhelp.php";
url=url+"?q="+str;
url=url+"&sid="+Math.random();

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	if(str==1)
	{
    document.getElementById("txtHint1").innerHTML=xmlhttp.responseText;
	}
	if(str==2)
	{
    document.getElementById("txtHint2").innerHTML=xmlhttp.responseText;
	}
	if(str==3)
	{
    document.getElementById("txtHint3").innerHTML=xmlhttp.responseText;
	}
	if(str==4)
	{
    document.getElementById("txtHint4").innerHTML=xmlhttp.responseText;
	}
	if(str==5)
	{
    document.getElementById("txtHint5").innerHTML=xmlhttp.responseText;
	}
	if(str==6)
	{
    document.getElementById("txtHint6").innerHTML=xmlhttp.responseText;
	}
	if(str==7)
	{
    document.getElementById("txtHint7").innerHTML=xmlhttp.responseText;
	}
	if(str==8)
	{
    document.getElementById("txtHint8").innerHTML=xmlhttp.responseText;
	}
	if(str==9)
	{
    document.getElementById("txtHint9").innerHTML=xmlhttp.responseText;
	}
	if(str==10)
	{
    document.getElementById("txtHint10").innerHTML=xmlhttp.responseText;
	}
	if(str==11)
	{
    document.getElementById("txtHint11").innerHTML=xmlhttp.responseText;
	}
	if(str==12)
	{
    document.getElementById("txtHint12").innerHTML=xmlhttp.responseText;
	}
	if(str==13)
	{
    document.getElementById("txtHint13").innerHTML=xmlhttp.responseText;
	}
	if(str==14)
	{
    document.getElementById("txtHint14").innerHTML=xmlhttp.responseText;
	}
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
	</script>
    <style type="text/css">
<!--
.style2 {color: #CC6600}
.style8 {
	font-size: 14px;
	font-weight: bold;
}
.style9 {
	color: #990000;
	font-weight: bold;
	font-size: 14px;
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
        <div class="inner"><br /><br />
          <?php
			  if($tp=='a')
			  {
			  ?>
          <a href="help.php" class="style8" onmouseover="showhelp(14)">How to Create Organization and institution?</a><br /><br /><div id="txtHint14"></div><br />
          
          <?php
			  }
			  ?>
          <a href="help.php" class="style8" onmouseover="showhelp(1)">How to create a group?</a><br /><br />
          <div id="txtHint1"></div><br />
          <a href="help.php" class="style8" onmouseover="showhelp(2)">How to create a Ledger?</a><br />
          <br /><div id="txtHint2"></div><br />
          
          <a href="help.php" class="style8" onmouseover="showhelp(3)">How to create a Voucher Type?</a><br /><br /><div id="txtHint3"></div><br />
          
          <a href="help.php" class="style8" onmouseover="showhelp(4)">How to enter a new transaction?</a><br /><br /><div id="txtHint4"></div>
			  <p><br />
			    <span class="style9">Account Books</span></p>
			  <p> <br />
			    &nbsp;&nbsp;&nbsp;&nbsp;<a href="help.php" class="style8" onmouseover="showhelp(5)">Day book</a><br /><br /><div id="txtHint5"></div><br />
          <br />
          &nbsp;&nbsp;&nbsp;&nbsp;<a href="help.php" class="style8" onmouseover="showhelp(6)">Bank book</a><br /><br /><div id="txtHint6"></div><br />
          <br />
          &nbsp;&nbsp;&nbsp;&nbsp;<a href="help.php" class="style8" onmouseover="showhelp(7)">Cash book</a><br /><br /><div id="txtHint7"></div><br />
          <br />
          &nbsp;&nbsp;&nbsp;&nbsp;<a href="help.php" class="style8" onmouseover="showhelp(8)">Ledger book</a><br /><br /><div id="txtHint8"></div><br />
          <br />
          <a href="help.php" class="style8" onmouseover="showhelp(9)">Trial Balance</a><br /><br /><div id="txtHint9"></div><br />
          <br />
          <a href="help.php" class="style8" onmouseover="showhelp(10)">Profit & Loss Account</a><br /><br /><div id="txtHint10"></div><br />
          <br />
          <a href="help.php" class="style8" onmouseover="showhelp(11)">Balance Sheet</a><br /><br /><div id="txtHint11"></div><br />
          <br />
          <a href="help.php" class="style8" onmouseover="showhelp(12)">How to Change Your Password?</a><br /><br /><div id="txtHint12"></div><br />
          <br />
          <?php
			  if($tp=='a')
			  {
			  ?>
          <a href="help.php" class="style8" onmouseover="showhelp(13)">How to Create New User?</a><br /><br /><div id="txtHint13"></div><br />
          <br />
          <?php
			  }
			  ?>
          </p>
          <div id="txtHint5"></div><br /><br />
          
          
          
          
          
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

