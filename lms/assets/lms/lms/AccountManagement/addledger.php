<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
require_once('classes/tc_calendar.php');
require_once('classes1/tc_calendar1.php');
$ins=$_SESSION['ins'];
$tp=$_SESSION['type'];
$type=$_SESSION['type'];
$org=$_SESSION['org'];
include("../db.php");
$msg=$_REQUEST['msg'];
$msg1=$_REQUEST['msg1'];
$qry = execute("select vgroupname from ac_allgroup");
$qry1=execute("select * from ac_ledger");
$yr=date('Y');
		$yr1=$yr-1;
		$yr2=$yr+1;
		$yr3=$yr-2;
		$mon=date('m');
		$dat=date('d');
		$y11=$yr.'-04-01';
		$y12=$yr.'-03-31';
		$y21=$yr1.'-04-01';
		$y22=$yr1.'-03-31';
		$y31=$yr2.'-04-01';
		$y32=$yr2.'-03-31';
		$y33=$yr3.'-04-01';
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
<script language="javascript" src="calendar.js"></script>
<script language="javascript" src="calendar1.js"></script>
<script language="javascript">
function validate()
{
	
	if(document.form1.txtledger.value=="")
	{
		window.alert("Enter Ledger");
		document.form1.txtledger.focus();
		return false;
	}
	if(document.form1.combogp.value=="select")
	{
		window.alert("Please Select Group");
		return false;
	}
	

/*	if(document.form1.txtladdress.value=="")
	{
		window.alert("Enter Your Address");
		document.form1.txtladdress.focus();
		return false;
	}
	if(document.form1.txtlmail.value=="" && document.form1.txtlmobile.value=="")
	{
		window.alert("Enter Your Email Or Mobile");
		
		return false;
	}*/
	
	if(document.form1.combodc.value=="select")
	{
		window.alert("Please Select Debit/Credit");
		return false;
	}
	if(isNaN(document.form1.txtopbal.value))
	{
		window.alert("Enter a valid Opening Balance");
		document.form1.txtopbal.focus();
		return false;
	}
	if(document.form1.cmbin.value=="select")
	{
		window.alert("Select Organization");
		return false;
	}
}
</script>
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
          <form id="form1" name="form1" method="post" action="addledgeraction.php" onsubmit="return validate();">
            <table width="800px" border="0" cellpadding="2"><tr>
              <th  scope="row"><p align="center" id="hd">ADD LEDGER </p></th>
	    <th>&nbsp;</th>
				  </tr></table>
    <table width="519" border="0" style="layer-background-color: #CCCCCC; position:absolute; left: 315px; width: 668px;">
      
      <tr>
        <th colspan="2" scope="row"> <font color="#FF0000"><b><?php echo $msg1;?></b></font><font color="#330000"><?php echo $msg;?></font>&nbsp;</th>
      </tr>
      
      <tr>
        <th height="23" align="left" scope="row">Date</th>
        <td>
		 <?php
		$yr=date('Y');
		$yr1=$yr-1;
		$yr2=$yr+1;
		$mon=date('m');
		$dat=date('d');
		if($mon>3)
		{
	  $myCalendar = new tc_calendar("datet", true, false);
	  $myCalendar->setIcon("images1/iconCalendar.gif");
	 // $myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setDate('1', '04', $yr);
	  $myCalendar->setPath("./");
	  $myCalendar->setYearInterval($yr3, $yr2);
	  $myCalendar->dateAllow($yr.'-04-01', $yr2.'-03-31');
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  }
	  else
	  {
	   $myCalendar = new tc_calendar("datet", true, false);
	  $myCalendar->setIcon("images1/iconCalendar.gif");
	 // $myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setDate('1', '04', $yr1);
	  $myCalendar->setPath("./");
	  $myCalendar->setYearInterval($yr3, $yr);
	  $myCalendar->dateAllow($yr1.'-04-01', $yr.'-03-31');
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  }
	  ?>
		&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
	   <?php 
	  if($tp=='a')
	  {
	  ?>
      <tr>
        <th scope="row" align="left"><strong>ORGANIZATION</strong></th>
	   
        
        <td><label>
          
          <select name="cmbin"> <option value="select">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -SELECT-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
            <?php
	$qryy=execute("select * from ac_organization");
	while($row3=mysql_fetch_assoc($qryy))
	{
	?> 
            
            
            
            <option value="<?php echo $row3[iIdx_organization];?>"><?php echo $row3[vorgname];?></option>
            <?php
	  }
	  ?>
            </select>
          </label></td>
        </tr><?php }?>
      <tr>
        <th scope="row" align="left"><span class="style14 style7">Ledger</span></th>
        <td><label>
          <input type="text" name="txtledger" />
          </label></td>
      </tr>
      <tr>
        <th scope="row" align="left"><span class="style14 style7">Group Type </span></th>
        <td><select name="combogp"><option value="select">-SELECT-</option>
          
          <?php
	  while ($row = mysql_fetch_assoc($qry))
      {
	  ?>
          <option value="<?php echo $row[vgroupname]; ?>">  <?php echo $row[vgroupname]; ?>	  </option>
          <?php }  ?>
          
          </select>&nbsp;</td>
      </tr>
      <tr>
        <th scope="row" align="left"><span class="style14 style7">Code </span></th>
        <td><label>
          <input type="text" name="txtlcode" />
          </label></td>
      </tr>
      <tr>
        <th height="26" scope="row" align="left"><span class="style14 style7">Description</span></th>
        <td><label>
          <textarea name="txtldesc"></textarea>
          </label></td>
      </tr>
      <tr>
        <th height="26" scope="row" align="left"><span class="style14 style7">Contact Person </span></th>
        <td><label>
          <input type="text" name="txtlcontact" />
          </label></td>
      </tr>
      <tr>
        <th height="26" scope="row" align="left"><span class="style14 style7">Designation</span></th>
        <td><label>
          <input type="text" name="txtldesig" />
          </label></td>
      </tr>
      <tr>
        <th height="26" align="left" scope="row"><span class="style14 style7">Mobile</span></th>
        <td><label>
          <input type="text" name="txtlmobile" />
          </label></td>
      </tr>
      <tr>
        <th height="26" align="left" scope="row"><span class="style14 style7">Debit/Credit</span></th>
        <td><select name="combodc">
          <option value="select">-SELECT-</option>
          <option value="Dr">Dr</option>
          <option value="Cr">Cr</option>
          </select>        &nbsp;</td>
      </tr>
      <tr>
        <th scope="row" align="left"><span class="style14 style7">Opening Balance </span></th>
        <td><label>
          <input type="text" name="txtopbal" />
          </label></td>
      </tr>
      <tr>
        <th scope="row" align="left"><span class="style15"></span></th>
        <td><input type="submit" name="sub" value="Save"/>&nbsp;<input type="reset" value="Reset" />
          <input name="button" type='button' onclick='javascript:window.location.href=&quot;viewledgers.php&quot;' value='View' /><input type="hidden" name="in" value="<?php echo $org;?>"></td>
      </tr>
      </table>
    <div align="center"></div>
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

