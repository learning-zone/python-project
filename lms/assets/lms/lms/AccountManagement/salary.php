<?php
session_start();
$msg1=$_REQUEST['msg1'];
$msg2=$_REQUEST['msg2'];
$msg3=$_REQUEST['msg3'];
$name=$_SESSION['name'];
 
$ins=$_SESSION['ins'];
$type=$_SESSION['type'];
$org=$_SESSION['org'];
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
	if($type=='u')
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
          <h2>&nbsp;</h2>
            <form id="form1" method="post" action="">
              <table width="98%" height="222" border="1" id="tbl">
                <tr id="th">
                  <td colspan="4"><div align="center"><strong>FEE ENTRY </strong></div></td>
                </tr>
                <tr id="td1">
                  <td height="31" colspan="4"><div align="right"><strong>Date:</strong></div></td>
                </tr>
                <tr id="td1">
                  <td width="18%" height="31"><div align="center"><strong>ID</strong></div></td>
                  <td width="26%"><label>
                    <input type="text" name="textfield11" />
                    </label></td>
                  <td width="15%">Photo</td>
                  <td width="41%">&nbsp;</td>
                </tr>
                <tr id="td1">
                  <td><div align="center"><strong>Joining Date </strong></div></td>
                  <td><label></label></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                
                <tr id="td1">
                  <td><div align="center"><strong>Name</strong></div></td>
                  <td><label>
                    <input type="text" name="textfield2" />
                    </label></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr id="td1">
                  <td height="33"><div align="center"><strong>Address</strong></div></td>
                  <td><input type="text" name="textfield3" /></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr id="td1">
                  <td><div align="center"><strong>Contact No: </strong></div></td>
                  <td><label>
                    <input type="text" name="textfield4" />
                    </label></td>
                  <td><div align="center"><strong>Email</strong></div></td>
                  <td>&nbsp;</td>
                </tr>
                <tr id="td1">
                  <td><div align="center"><strong>DOB</strong></div></td>
                  <td>&nbsp;</td>
                  <td><div align="center"><strong>Gender</strong></div></td>
                  <td>&nbsp;</td>
                </tr>
                <tr id="td1">
                  <td><div align="center"><strong>Age</strong></div></td>
                  <td><label></label></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr id="td1">
                  <td><div align="center"><strong>Religion</strong></div></td>
                  <td><label>
                    <input type="text" name="textfield6" />
                    </label></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr id="td1">
                  <td><div align="center"><strong>Cast</strong></div></td>
                  <td><input type="text" name="textfield7" /></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr id="td1">
                  <td><div align="center"><strong>Remarks</strong></div></td>
                  <td><label>
                    <textarea name="textarea"></textarea>
                    </label></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr id="td1">
                  <td><div align="center"><strong>Designation</strong></div></td>
                  <td><label>
                    <input type="text" name="textfield8" />
                    </label></td>
                  <td><div align="center"><strong>Job Position</strong></div></td>
                  <td>&nbsp;</td>
                </tr>
                <tr id="td1">
                  <td><div align="center"><strong>Basic Pay </strong></div></td>
                  <td><label>
                    <input type="text" name="textfield9" />
                    </label></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr id="td1">
                  <td><div align="center"><strong>TA</strong></div></td>
                  <td><label>
                    <input type="text" name="textfield10" />
                    </label></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr id="td1">
                  <td><div align="center"><strong>DA</strong></div></td>
                  <td><label></label></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr id="td1">
                  <td><div align="center"><strong>HRA</strong></div></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr id="td1">
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr id="td1">
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
            </form>
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

