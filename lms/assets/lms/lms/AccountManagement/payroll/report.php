<?php
session_start();
include("../connection.php");
$name=$_SESSION['name'];
$msg1=$_REQUEST['msg1'];
$msg2=$_REQUEST['msg2'];
$msg3=$_REQUEST['msg3'];
 $or1=$_SESSION['ior'];
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
.style3 {font-weight: bold}
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
      <h1 class="style2">Account Management</h1>
     </div>
    </div>
    <div id="body">
	<?php
	if($type=='u')
	{
	include("pusermenu.php");
	  }
	  else
	  {
	 include("padminmenu.html");
	  }
	  ?>
      <div id="seasonal">
        <div class="inner">
          <h2>&nbsp;</h2>
          <p><span class="style3"><a href="payroll/attendance.php"></a></span></p>
          <p><strong><a href="payroll/viewdepartments.php"></a></strong></p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p><p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p><p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
		     <form id="form1" method="post" action="reportaction.php">
          <table width="30%" border="0" style="position:absolute; left: 324px; top: 170px; width: 549px; height: 233px;">
            <tr>
              <td height="25" colspan="4" id="hd"><div align="center">REPORTS</div></td>
            </tr>
            <tr>
              <td width="158" height="50">&nbsp;</td>
              <td colspan="2"><strong>
                <label>
  <div align="left">
    <input name="radiobutton" type="radio" value="1" />
    Salary Slip </div>
                  </label>
              </strong></td><td width="1">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2"><div align="left"><strong>
              </strong></div>
                <strong><label>
                <div align="left">
                  <input name="radiobutton" type="radio" value="2" />
                  Employee wise <strong>Salary Statement </strong></div>
                </label>
                </strong>
                    <label> </label>
                    <div align="left"></div></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="51">&nbsp;</td>
              <td colspan="2"><div align="left"><strong>
              </strong></div>
                <strong><label>
                <div align="left">
                  <input name="radiobutton" type="radio" value="3" />
                  Bank Transfer for the <strong>month</strong></div>
                </label>
                </strong>
                    <label> </label>
                    <div align="left"></div></td>
              <td>&nbsp;</td>
            </tr>
            
            
            <tr>
              <td height="48">&nbsp;</td>
              <td colspan="2"><strong>
                <label>
  <div align="left">
    <input name="radiobutton" type="radio" value="4" />
    Individual Cash Statement </div>
                  </label>
              </strong></td><td>&nbsp;</td>
            </tr>
            <tr>
              <td height="36">&nbsp;</td>
              <td colspan="2"><strong>
                <div align="left"><strong>
                  <input name="radiobutton" type="radio" value="5" />
                </strong>Individual Cheque Statement</div>
              </strong><strong><label></label>
              <label></label>
                              </strong></td><td>&nbsp;</td>
            </tr>
            <tr>
              <td height="48">&nbsp;</td>
              <td colspan="2"><strong>
                <div align="left">
                  <input name="radiobutton" type="radio" value="6" />
                  Consolidated Salary Statement (Voucher) </div>
              </strong></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="22">&nbsp;</td>
              <td colspan="2"><strong>
                <div align="left">
                  <input name="radiobutton" type="radio" value="7" />
                  <strong> Consolidated Salary Statement </strong>(all department)</div>
              </strong></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="59">&nbsp;</td>
              <td colspan="2"><strong><label>
              <div align="left">
                <input name="radiobutton" type="radio" value="8" />
                <strong> Consolidated Salary Statement </strong>(detailed)</div>
                </label>
                              </strong></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td width="38"><label></label></td>
              <td width="334"><input type="submit" name="Submit" value="VIEW" /></td>
              <td>&nbsp;</td>
            </tr>
          </table>
       
          </form>
          <p>&nbsp;</p><p>&nbsp;</p>
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
    </div>
    <div id="copyright">
      <p></p>
    </div>
  </div>
</body>
</html>
