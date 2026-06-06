<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
$ins=$_SESSION['ins'];
$org=$_SESSION['org'];
$tp=$_SESSION['type'];
include("../db.php");
$id=$_REQUEST['i'];
//echo $id;
$qry1=execute("Select vgroupname from ac_allgroup where iIdx_grp='".$id."'");
$ob11=fetchrow($qry1);
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
            <form id="form1" name="form1" method="post" action="editgroupaction.php">
             
                  <?php
	  while ($row = mysql_fetch_assoc($qry1))
      {	
	   $i=$row[iIdx_organization];
	   //echo $i; 
	   $orgname=$row[vorgname];
	   $orgdesc=$row[vorgdescription]; 
	   }
	  ?>
	  
	  
	 <table width="200" border="0" style="position:absolute; left: 312px; top: 199px; width: 443px; height: 158px;  layer-background-color: #CCCCCC; border: 1px none #000000;" cellspacing="0">
              <tr>
                <th width="10" scope="row"><p align="left"></p>
        <p>&nbsp;</p></th>
        <th colspan="2" scope="row"><div align="center" id="hd">EDIT GROUP</div></th>
        </tr>
              <tr>
                <th colspan="2" scope="row"><div align="right"><span class="style4">Group Name </span></div></th>
        <td width="289"><label>
          <input type="text" name="txtgname" value="<?php echo $ob11[0];?>" />
          </label></td>
      </tr>
              <tr>
                <th colspan="2" scope="row">&nbsp;</th>
	     <td>&nbsp;</td>
	     </tr>
              
              <tr>
                <th colspan="2" scope="row">&nbsp;</th>
         <td>&nbsp;<input type="submit" name="b1" value="Update" /><input type="hidden" name="id" value="<?php echo $id;?>" />
		  <?php /*?> "<a href='editorgaction.php?i=$i&a=0'>Update</a>";<?php */?>
                  
                 <input type="submit" name="b1" value="Delete" />
		  <?php /*?> echo "<a href='editorgaction.php?i=$i&a=1'>Delete</a>"; <?php */?>
                  <input name="button" type='button' onclick='javascript:window.location.href=&quot;viewgroups.php&quot;' value='Exit' /></td>
       </tr>
              
            </table> 
    </form>
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

