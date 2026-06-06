<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
$ins=$_SESSION['ins'];
$org=$_SESSION['org'];
$tp=$_SESSION['type'];
include("../db.php");
$msg=$_REQUEST['msg'];
$qry1=execute("Select * from ac_organization");
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
<script language="javascript">
function validate()
{
if(document.form1.txtorg.value=="")
{
window.alert("Enter Organization Name");
document.form1.txtorg.focus();
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
.style3 {font-size: 13px}
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
          <form id="form1" name="form1" method="post" action="addorgaction.php" onsubmit="return validate();">
            <table width="200" border="0" style="position:absolute; left: 230px; top: 109px; width: 826px; height: 200px; layer-background-color: #CCCCCC; border: 1px none #000000;" cellspacing="0">
              <tr>
                <td height="23" colspan="2" scope="row"><div align="center" id="hd"><span class="style1 style7 style3"><strong>CREATE ORGANIZATION </strong></span></div></td>
      </tr>
              <tr>
                <th height="21" colspan="2" scope="row"><?php echo $msg;?>&nbsp;</th>
      </tr>
              <tr>
                <th width="231" height="27" scope="row"><span class="style9">Name</span></th>
        <td width="437"><label>
          <input type="text" name="txtorg" />
          </label></td>
      </tr>
              <tr>
                <th height="88" class="style10" scope="row">Description</th>
        <td><label>
          <textarea name="txtdes" rows="5" cols="70"></textarea>
          </label></td>
      </tr>
              <tr>
                <!--<th height="26" scope="row">Opening Balance </th>
      <td><label>
        <input type="text" name="txtopbal" />
      </label></td>-->
              </tr>
              <tr>
                <th height="37" scope="row">TIN Reg.No: </th>
        <td><input type="text" name="txttin" />&nbsp;</td>
      </tr>
              <tr>
                <th height="40" scope="row">CST Reg.No: </th>
        <td><input type="text" name="txtcst" />&nbsp;</td>
      </tr>
              <tr>
                <th height="40" scope="row">Reg.No</th>
        <td><input type="text" name="txtsta" /></td>
      </tr>
              
              <tr>
                <th height="26" scope="row">&nbsp;</th>
        <td><input type="submit" value="Save" />&nbsp;<input name="button" type='button' onclick='javascript:window.location.href=&quot;vieworganizations.php&quot;' value='View' /></td>
      </tr>
              <tr>
                <th colspan="2" scope="row">
                  <div id=""></div></th>
      </tr>
            </table>
    <div align="center"></div>
  </form>
            <h2>&nbsp;</h2>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p></p>
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
