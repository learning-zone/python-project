<?php
session_start();
$name=$_SESSION['name'];
//$or1=$_SESSION['ior'];
$tp=$_SESSION['type'];
$org=$_SESSION['org'];
include("../db.php");
$ins=$_SESSION['ins'];
$msg=$_REQUEST['msg'];
$qry1=execute("Select * from ac_user_details");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<title>Account Management</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" charset="utf-8" />
	<link href="calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="calendar.js"></script>
<script language="javascript" src="calendar1.js"></script>
<script language="javascript">
function validate()
{
if(document.form1.comboin.value=="select")
{
window.alert("Select Institution");
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
.style7 {
	font-size: 13px;
	font-weight: bold;
	color: #330000;
}
.style8 {font-size: 13px}
.style9 {
	font-size: 14px;
	color: #0000CC;
	font-weight: bold;
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
          <table border="0" id="tbl">
            <tr>
              <td colspan="12"> <div align="right"><a href="adduserdetails.php" id="new">Add New</a></div>        
          <span class="style8"> </span></td>
      </tr>
            <tr id="th">
              <td height="18"><span ><strong>NAME&nbsp;</strong></span></td>
        <td><span ><strong>USERNAME&nbsp;</strong></span></td>
	    <td><span ><strong>ORGANIZATION&nbsp;</strong></span></td>
       <td><span ><strong>DEPARTMENT&nbsp;</strong></span></td>
	          <td><span ><strong>REG.DATE</strong></span></td>
			  <td><strong>STATUS</strong></td><td><strong>EDIT</strong></td>
      </tr>
            <?php
	  while ($row = mysql_fetch_assoc($qry1))
      {
	  //$i=$row[iIdx_ledger];
	 // $j=$row[iIdx_group];
	  ?>
            <?php
	 
	  ?>
            <tr height="5" style="border-color:#FFFFFF" id="td1">
              <td><b><?php echo $row[vname]; ?></b></td>
        <td><b><?php echo $row[vusername]; ?></b></td>
	    <?php
	  $k1=execute("select vorgname from ac_organization where iIdx_organization=\"$row[iorg]\"");
	  $kk=fetchrow($k1);
	  $i=$row[iuserid];
	  $n=$row[vusername];
	  ?>
              <td><b><?php echo $kk[0]; ?></b></td>
	    <td><b><?php echo $row[vins]; ?></b></td>
	     <td><b><?php $dtd=date('d-m-Y',strtotime($row[dregdate]));echo $dtd; ?></b></td>
		    <b><?php $sq=execute("select * from ac_login where vusername=\"$row[vusername]\"");
			 $obj=mysql_fetch_object($sq);
			 if($obj->vstatus=='yes')
echo "<td><b><a href='status.php?id=$obj->iuserid&name=$row[vusername]'><font size=2 color=maroon>Enable</font></a></b></td>";
else
echo "<td><b><a href='status.php?id=$obj->iuserid&name=$row[vusername]'><font size=2 color=#CC3300>Disable</font></a></b></td>";?></b> 

   <td> <input type="hidden" name="id" value="<?php echo $n; ?>" /> <input type="hidden" name="n" value="<?php echo $i=$row[vusername]; ?>" /><b><?php echo "<a href='deleteuser.php?i=$i&n=$n'><font size=2 color=maroon>Delete</font></a>";?></td>
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
		    <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
		    <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
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