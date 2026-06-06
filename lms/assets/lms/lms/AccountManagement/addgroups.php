<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
$ins=$_SESSION['ins'];
$tp=$_SESSION['type'];
$type=$_SESSION['type'];
$org=$_SESSION['org'];
include("../db.php");
$result=$_REQUEST['result'];
$msg=$_REQUEST['msg'];
$qry = execute("select vgrouptype from ac_groupmaster");
$qry3=execute("select * from ac_allgroup");
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
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
	<script language="javascript">
function validate()
{
if(document.form1.comtype.value=="select")
{
window.alert("Please Select a Group");
return false;
}
if(document.form1.txtgname.value=="")
{
window.alert("Please Enter Group name");
document.form1.txtgname.focus();
return false;
}
}
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
          <form id="form1" name="form1" method="post" action="addgroupaction.php" onsubmit="return validate();">
            <table width="200" border="0" style="position:absolute; left: 312px; top: 199px; width: 443px; height: 158px;  layer-background-color: #CCCCCC; border: 1px none #000000;" cellspacing="0">
              <tr>
                <th width="10" scope="row"><p align="left"></p>
        <p>&nbsp;</p></th>
        <th colspan="2" scope="row"><div align="center" id="hd">ADD GROUPS</div></th>
        </tr>
              <tr>
                <th colspan="3" scope="row"><?php echo $msg; ?>&nbsp;</th>
      </tr>   
              <tr>
                <th colspan="2" scope="row"><div align="right"><span class="style4">Group Name </span></div></th>
        <td><label>
          <input type="text" name="txtgname" />
          </label></td>
      </tr>
              <tr>
                <th colspan="2" scope="row">&nbsp;</th>
	     <td>&nbsp;</td>
	     </tr>
              <tr>
                <th colspan="2" scope="row"> <div align="right"><span class="style4">Group Type </span></div></th>
        <td width="289">
          <select  name="comtype"><option value="select">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -SELECT-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
            <?php
	  $qry4=execute("select * from ac_allgroup");
	  while ($row1 = mysql_fetch_assoc($qry4))
      {
	  ?>
            <option value="<?php echo $row1[vgroupname]; ?>">  <?php echo $row1[vgroupname]; ?>	  </option>
            <?php }  ?>
  </select>	  
          &nbsp;</td>
      </tr>
              <tr>
                <th colspan="2" scope="row">&nbsp;</th>
         <td>&nbsp;</td>
       </tr>
              <tr>
                <th colspan="2" scope="row">&nbsp;</th>
        <td><input type="submit" name="sub" value="   Save   "/>&nbsp;<input name="button" type='button' onclick='javascript:window.location.href=&quot;viewgroups.php&quot;' value='View' /></td>
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

