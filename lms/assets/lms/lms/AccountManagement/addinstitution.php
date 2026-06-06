<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
$ins=$_SESSION['ins'];
$org=$_SESSION['org'];
$tp=$_SESSION['type'];
include("../db.php");
$qry=execute("select * from ac_organization");
$msg=$_REQUEST['msg'];
$qry1=execute("select * from ac_institution");
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
		if(document.form1.txtinst.value=="")
		{
			window.alert("Enter Institution Name");
			document.form1.txtinst.focus();
			return false;
		}	
		if(document.form1.comboorg.value=="select")
		{
			window.alert("Select Organization");
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
          <form id="form1" name="form1" method="post" action="addinstaction.php" onsubmit="return validate();">
            <table width="200" border="0" style="position:absolute; left: 282px; top: 139px; width: 597px; height: 214px; layer-background-color: #CCCCCC; border: 1px none #000000;" cellspacing="0">
              <tr>
                <td height="21" colspan="2" align="center"  id="hd" scope="row">
                  <span>CREATE DEPARTMENT </span>
              </tr>
              <tr>
                <th height="21" colspan="2" scope="row"><?php echo $msg;?>&nbsp;</th>
      </tr>
              <tr>
                <th width="219" height="41" scope="row"><span class="style7">Name Of Department </span></th>
                <td width="368"><label>
          <input type="text" name="txtinst" />
          </label></td>
      </tr>
	  <?php
	  if($tp=='a')
	  {
	  ?>
              <tr>
                <th height="35" scope="row"><span class="style8">Select Organization </span></th>
        <td>
          <select name="comboorg"><option value="select">-SELECT-</option>
            <?php
	  while ($row = mysql_fetch_assoc($qry))
      {
	  ?>
            <option value="<?php echo $row[vorgname]; ?>">  <?php echo $row[vorgname]; ?>	  </option>
            <?php }  ?>
            </select>&nbsp;</td>
      </tr>
	  <?php
	  }
	  ?>
              <tr>
                <th height="37" scope="row">TIN Reg.No: </th>
        <td><input type="text" name="txttin" /></td>
      </tr>
              <tr>
                <th height="37" scope="row">CST Reg.No: </th>
        <td><input type="text" name="txtcst" /></td>
      </tr>
              <tr>
                <th height="42" scope="row">Reg.No</th>
        <td><input type="text" name="txtsta" /></td>
      </tr>
              <tr>
                <th height="22" scope="row">&nbsp;</th>
        <td>&nbsp;</td>
      </tr>
              <tr>
                <th scope="row">&nbsp;</th>
        <td><input type="submit" value=" Save " /><input name="button" type='button' onclick='javascript:window.location.href=&quot;viewinstitutions.php&quot;' value='View' /></td>
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
            <p></p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p><strong> </strong></p>
            <p></p><br/><br/><br/><br/><br/><br/><br/><p></p>
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

