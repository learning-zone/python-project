<?php
session_start();
include("../connection.php");
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
	<link rel="stylesheet" href="../css/style.css" type="text/css" charset="utf-8" />
<script type="text/javascript" src="../scripts/jquery.min.js"></script> 
<script type="text/javascript" src="../scripts/jquery.hoveraccordion.min.js"></script> 
	<script>
	$(document).ready(function(){
	$('#identifier').hoverAccordion();
	});
	</script>
	<script language="javascript">
	function validate()
	{
	if(document.form1.txtdepartment.value=="")
	{
	window.alert("Enter Department");
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
              <p align="left">Welcome <?php echo $name."   "?>, <a href="../logout.php">Logout</a></p>
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
          <form id="form1" name="form1" method="post" action="adddeptaction.php" onsubmit="return validate();">
          <table width="359" border="0" align="center">
            <tr>
              <th height="26" colspan="4" scope="row"><div align="center" id="hd"></a>ADD DEPARTMENT </div></th>
            </tr>
            <tr>
              <th height="21" colspan="4" scope="row"><div align="right"></div></th>
            </tr>
            
            <tr>
              <th height="33" scope="row">Department</th>
              <td><?php 
	  if($type=='a')
	  {
	  ?>
                   <select name="comboin">
        <option value="select">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -SELECT-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
        <?php
		$qry2=mysql_query("select * from ac_institution");  
	  while ($row = mysql_fetch_assoc($qry2))
      {
	  ?>
        <option value="<?php echo $row[iIdx_institution]; ?>"><?php echo $row[vinstitution]; ?></option>
        <?php } ?>
      </select>      &nbsp;
	  <?php
	  }
	  else
	  {
	  ?>
	 <input type="txt" name="txtins" value="<?php echo $ins;?>" readonly="true" />
	  <?php
	  }
	  ?></td>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <th width="129" height="33" scope="row"><strong>Department Name  </strong></th>
              <td width="185"><input type="text" name="txtdepartment" /></td>
              <td width="31" colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <th scope="row">&nbsp;</th>
              <th scope="row"><input name="submit" type="submit" value="Save" align="middle"/>
                <label>
                <input type="Reset" name="Submit" value="Reset" /><input name="button" type='button' onclick='javascript:window.location.href=&quot;viewdepartments.php&quot;' value='View' />
              </label></th>
              <td colspan="2">&nbsp;</td>
            </tr>
          </table>
		  </form>
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
    </div>
    <div id="copyright">
      <p></p>
    </div>
  </div>
</body>
</html>

