<?php
session_start();
$name=$_SESSION['name'];
$ins=$_SESSION['ins'];
$org=$_SESSION['org'];
$tp=$_SESSION['type'];
include("../db.php");
$msg=$_REQUEST['msg'];
$or1=$_SESSION['ior'];
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
.style3 {
	font-size: 13px;
	font-weight: bold;
}
.style5 {color: #000066}
.style6 {color: #660000}
.style7 {font-size: 13px; font-weight: bold; color: #000066; }
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
          
          <div align="center">
            <table width="507" border="0">
              <tr>
                <td width="501"><div align="right" class="style5"><a href="addusertype.php" id="new">Add New</a></div></td>
             </tr>
            </table>
		   
            <table width="513" height="76" border="0" id="tb1" >
              
              <tr id="th">
                <td><div align="center">USER TYPES </div></td>
      </tr>
              <?php
	$qry1=execute("Select * from ac_usertype");
	  while ($row = mysql_fetch_assoc($qry1))
      {
	  $i=$row[iIdx_usertype];
	  ?>
              <tr id="td1">
                <td><input type="hidden" name="id" value="<?php echo $row[iIdx_usertype]; ?>" /><div align="center"><b><?php echo $row[vusertype]; ?></b></div></td>
	      <?php /*?><td><b><?php echo "<a href='updatedeletevmaster.php?i=$i'><font size=2 color=#0066FF>Edit</font></a>"?></td><?php */?>
              </tr>
              <?php
		}
		?>
            </table>
          </div>
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