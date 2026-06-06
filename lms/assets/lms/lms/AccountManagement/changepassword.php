<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
$ins=$_SESSION['ins'];
$org=$_SESSION['org'];
$tp=$_SESSION['type'];
include("../db.php");
$date=date("d/m/Y");
$msg3=$_REQUEST['msg3'];
$msg4=$_REQUEST['msg4'];
/*$tomorrow = mktime(0,0,0,date("m"),date("d")+1,date("Y"));
echo "tomorrow is :".date("d/m/y",$tomorrow);*/
$array=array('01','02','03','04','05','06','07','08','09','10','11','12');
try
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<title>Account Management</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" charset="utf-8" />
	<script language="javascript">
function validate()
{
	if(document.form1.t3.value!=document.form1.t4.value)
	{
		window.alert("Password Mismatch");
		document.form1.t4.focus();
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
	font-weight: bold;
	font-size: 13px;
}
.style4 {font-weight: bold}
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
          <form id="form1" name="form1" method="post" action="changepassaction.php" onsubmit="return validate();">
            <table width="200" border="0" style="position:absolute; left: 291px; top: 162px; width: 525px; height: 137px;">
              <tr>
                <td colspan="3"><div align="center" id="hd">CHANGE PASSWORD </div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><font color="#0066FF"><?php echo $msg4;?></font>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="207"><div align="center"><strong><span class="style4">Username</span></strong></div></td>
                <td width="150"><label>
                  <input type="text" name="tname" value="<?php echo $name;?>" readonly/>
                  </label></td>
                <td width="154">&nbsp;</td>
              </tr>
              <tr>
                <td><div align="center"><strong><span class="style4">Old Password</span></strong></div></td>
                <td><input type="password" name="t2" /></td>
                <td><font color="#CC0000"><?php echo $msg3;?></font>&nbsp;</td>
              </tr>
              <tr>
                <td><div align="center"><strong>New Password </strong></div></td>
                <td><label>
                  <input type="password" name="t3" />
                  </label></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><div align="center"><strong>Confirm Password </strong></div></td>
                <td><label>
                  <input type="password" name="t4" />
                  </label></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="bt1" value="Submit" />&nbsp;</td>
                <td>&nbsp;</td>
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
<?php
}
catch(Exception $ex)
{
echo $ex->getMessage();
}

?>