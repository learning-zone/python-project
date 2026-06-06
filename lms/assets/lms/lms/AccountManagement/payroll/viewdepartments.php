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
		  <table width="802" border="0">
		  <tr><td width="420"> <div align="right"><a href="adddepartment.php" id="new"><strong>Add New</strong></a> </div>
              <?php /*?><input name="button" type='button' onclick='javascript:window.location.href=&quot;addledger.php&quot;' value='Add New' /><?php */?>
       </td></tr></table>
          <table width="359" border="0" align="center" id="tbl">
            <tr id="th">
              <th height="26" colspan="2" scope="row">DEPARTMENTS</th>
            </tr>
            
            
            <tr id="th1">
              <th width="377" height="21" scope="row">Department Name </th>
              <th width="411" height="21" scope="row">Institution</th>
            </tr>
			<?php
	if($type=='u')
	{
	?>
			<?php
			
			 $qq=mysql_query("select * from ac_institution where vinstitution='".$ins."'");
	  		$obj=mysql_fetch_object($qq);
	  		$inn=$obj->iIdx_institution;
				$q1=mysql_query("select * from emp_department where iIdx_institution='".$inn."'");
				while($r1=mysql_fetch_assoc($q1))
				{
				?>
            <tr id="td1">
              <td id="td1"><div align="center"><?php echo $r1[vdepartmentname];?></div></td><td><?php echo $ins;?></td>
            </tr>
			<?php
				}
				}
				else
				{
				$q1=mysql_query("select * from emp_department");
				while($r1=mysql_fetch_assoc($q1))
				{
				 $qq=mysql_query("select * from ac_institution where iIdx_institution='".$r1[iIdx_institution]."'");
	  		$obj=mysql_fetch_object($qq);
				?>
				 <tr id="td1">
              <td id="td1"><div align="center"><?php echo $r1[vdepartmentname];?></div></td><td><?php echo $obj->vinstitution;?></td>
            </tr>
				<?php
				}
				}
				?>
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

