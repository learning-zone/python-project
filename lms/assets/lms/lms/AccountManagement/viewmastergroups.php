<?php
session_start();
$or1=$_SESSION['ior'];
$ins=$_SESSION['ins'];
$org=$_SESSION['org'];
$tp=$_SESSION['type'];
$name=$_SESSION['name'];
include("../db.php");
$msg=$_REQUEST['msg'];
$qry1=execute("Select * from ac_allgroup where iparentid=0");
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
          <table width="513" height="76" border="1" cellspacing="0" style="position:absolute; left: 219px; top: 111px;" id="tbl">
            
            <tr>
              <td id="th"><div align="center" class="style7 style6 style3"><strong>MASTER GROUPS&nbsp;</strong></div></td>
            </tr>
            <?php
	  while ($row = mysql_fetch_assoc($qry1))
      {
	  $i=$row[iIdx_grp];
	  ?>
            <tr height="5" style="border-color:#FFFFFF" id="td1">
              <td><div align="center"><b><?php echo $row[vgroupname]; ?></b>
                <input type="hidden" name="id" value="<?php echo $row[iIdx_grp]; ?>" />
                </div></td>
                  <?php /*?> <td><b><?php echo "<a href='updatedeletegmaster.php?i=$i'><font size=2>Edit</font></a>"?></td><?php */?>
            </tr>
            <?php
		}
		?>
          </table>
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

