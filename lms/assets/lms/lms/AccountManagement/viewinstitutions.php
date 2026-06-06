<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
$ins=$_SESSION['ins'];
$org=$_SESSION['org'];
$tp=$_SESSION['type'];
include("../db.php");
$msg=$_REQUEST['msg'];
$qry=execute("Select * from ac_organization");
$qry1=execute("Select * from ac_institution");
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
	font-size: 12px;
	color: #000066;
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
        <div class="inner">
          <div align="center">
            <table width="800"  border="0"  >
              
              <tr>
                <td colspan="2"><div align="right"><a href="addinstitution.php" id="new">Add New</a></div> </td>
              </tr>
              <tr>      </tr></table>
		     <table width="513" height="76" border="0"  id="tbl">
		       
		       <tr id="th">
		         <td ><strong>DEPARTMENTS</strong></td>
                 <td><span ><strong>ORGANIZATIONS</strong></span></td> <td id="th"><div align="center" ><span >TIN NO:</span></div></td>
		  <td id="th"><div align="center" ><span >CST NO:</span></div></td>
		  <td id="th"><div align="center" ><span >REG NO:</span></div></td><td>EDIT</td>
				 
      </tr>
		       <?php
	  while ($row = mysql_fetch_assoc($qry1))
      {
	  $i=$row[iIdx_institution];
	  $j=$row[iIdx_organization];
	  $qry2=execute("Select * from ac_organization where iIdx_organization=\"$j\"");
	  $obj=mysql_fetch_object($qry2);
	  ?>
		       <tr height="5" id="td1">
		         <td><input type="hidden" name="id" value="<?php echo $row[iIdx_institution]; ?>" /><b><?php echo $row[vinstitution]; ?></b></td>
          <td><b><?php echo $obj->vorgname; ?></b></td>
		   <td><b><?php echo $row[vtin];?> </b></td>
			  <td><b><?php echo $row[vcst];?> </b></td>
			    <td><b><?php echo $row[vreg];?> </b></td>
	      <td><b><?php echo "<a href='updatedeleteins.php?i=$i'><font size=2 color=#0066FF>Edit</font></a>"?></td>
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
