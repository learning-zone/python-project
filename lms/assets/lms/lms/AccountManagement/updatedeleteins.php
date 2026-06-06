<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
$ins=$_SESSION['ins'];
$org=$_SESSION['org'];
$tp=$_SESSION['type'];
include("../db.php");
session_start();
$id=$_REQUEST['i'];
//echo $id;
$qry1=execute("Select * from ac_institution where iIdx_institution='".$id."'");
  $obj=mysql_fetch_object($qry1);
  $inname=$obj->vinstitution;
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
            <form id="form1" name="form1" method="post" action="editinsaction.php">
			<table width="200" border="0" style="position:absolute; left: 282px; top: 139px; width: 597px; height: 214px; layer-background-color: #CCCCCC; border: 1px none #000000;" cellspacing="0">
			
              <tr>
                <td height="21" colspan="2" align="center"  id="hd" scope="row">
                  <span>EDIT DEPARTMENT </span> 
              </tr>
             
              <tr>
                <th width="219" height="41" scope="row"><span class="style7">Name Of Department </span></th>
                <td width="368"><label>
        <input type="text" name="txteins"  value="<?php echo $obj->vinstitution; ?>"  />
		<input type="hidden" name="in" value="<?php echo $inname;?>" />
          </label></td>
      </tr>
	     <tr>
                <th height="35" scope="row"><span class="style8">Select Organization </span></th>
        <td>
          <select name="comboorg">
            <?php
			$qry=execute("select * from ac_organization where iIdx_organization<>'$obj->iIdx_organization'");
			$qry3=execute("select * from ac_organization where iIdx_organization='$obj->iIdx_organization'");
			$obj2=mysql_fetch_object($qry3);
			?>
			
			
			
			 <option value="<?php echo $obj2->iIdx_organization; ?>">  <?php echo $obj2->vorgname; ?>	  </option><?php
	  while ($row = mysql_fetch_assoc($qry))
      {
	  ?>
            <option value="<?php echo $row[iIdx_organization]; ?>">  <?php echo $row[vorgname]; ?>	  </option>
            <?php }  ?>
            </select>&nbsp;</td>
			
      </tr>
	
              <tr>
                <th height="37" scope="row">TIN Reg.No: </th>
        <td><input type="text" name="txttin" value="<?php echo $obj->vtin; ?>" /></td>
      </tr>
              <tr>
                <th height="37" scope="row">CST Reg.No: </th>
        <td><input type="text" name="txtcst" value="<?php echo $obj->vcst; ?>" /></td>
      </tr>
              <tr>
                <th height="42" scope="row">Reg.No</th>
        <td><input type="text" name="txtsta" value="<?php echo $obj->vreg; ?>" /></td>
      </tr>
              <tr>
                <th height="22" scope="row">&nbsp;</th>
        <td>&nbsp;</td>
      </tr>
              <tr>
			  <td></td>
                <td><input type="submit" name="b1" value="Update" /><input type="hidden" name="id" value="<?php echo $id;?>" />
		  <?php /*?> "<a href='editorgaction.php?i=$i&a=0'>Update</a>";<?php */?>
                  
                 <input type="submit" name="b1" value="Delete" />
		  <?php /*?> echo "<a href='editorgaction.php?i=$i&a=1'>Delete</a>"; <?php */?>
                  <input name="button" type='button' onclick='javascript:window.location.href=&quot;viewinstitutions.php&quot;' value='Exit' /></td>
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
