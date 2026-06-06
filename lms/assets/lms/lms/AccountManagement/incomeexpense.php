<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
$ins=$_SESSION['ins'];
$org=$_SESSION['org'];
$tp=$_SESSION['type'];
require_once('classes/tc_calendar.php');
require_once('classes1/tc_calendar1.php');
include("../db.php");
$qry2=execute("select * from ac_institution");
$e1=execute("select * from ac_allgroup where iIdx_grp=5");

while($re1=mysql_fetch_assoc($e1))
{
	//echo $re1[vgroupname];
	$e2=execute("select * from ac_allgroup where iparentid='$re1[iIdx_grp]'");
	$re5=mysql_fetch_object($e2);
	
	for($i=0;$i<20;$i++)
	{
	$aaa=$re1[iIdx_grp];
	while($re2=mysql_fetch_assoc($e2))
	{
		$e3=execute("select * from ac_allgroup where iparentid='$aaa'");
		$re3=mysql_fetch_object($e3);
		//echo $re2[vgroupname];
		
		
		$aaa=$re6->iIdx_grp;
	}

	}
}

$yr=date('Y');
		$yr1=$yr-1;
		$yr2=$yr+1;
		$yr3=$yr-2;
		$yr4=$yr+2;
		$mon=date('m');
		$dat=date('d');
		$y11=$yr.'-04-01';
		$y12=$yr.'-03-31';
		$y21=$yr1.'-04-01';
		$y22=$yr1.'-03-31';
		$y31=$yr2.'-04-01';
		$y32=$yr2.'-03-31';
		$y33=$yr3.'-04-01';
	$y44=$y4.'-03-31';
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
	function showdep(str)
{
var url="ajaxdept.php";
url=url+"?q="+str;
url=url+"&sid="+Math.random();

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint10").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
	</script>
    <style type="text/css">
<!--
.style2 {color: #CC6600}
.style5 {
	font-size: 13px;
	font-weight: bold;
}
.style14 {font-size: 13px}
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
          <form id="form1" name="form1" method="post" action="viewincomeexp.php" onsubmit="return validate();">
            <table width="200" border="0" style="position:absolute; left: 364px; top: 159px; width: 385px;">
              <tr>
                <td colspan="3"><div align="center" id="hd"><strong>INCOME/EXPENSE ACCOUNT </strong></div></td>
      </tr>
             <tr>
      <td height="53"><div align="left"><strong>Select</strong>:</div></td>
      <td colspan="4"><p align="justify">
        <label>
          <input type="radio" name="ordep" value="1" onclick="cmbdep.disabled=true,cmbin.disabled=false"/>
          <strong>          Organization</strong></label>
        <strong><br />
        <label>
          <input type="radio" name="ordep" value="2" onclick="cmbdep.disabled=false,cmbin.disabled=false"/>
          Department</label>
        </strong><br />
      </p></td>
      <td width="60">&nbsp;</td>
    </tr>
	<?php
		if($tp=='a')
		{
		?>
	  <tr>
      <td width="99" height="29"><div align="right" class="style5">
        <div align="left"><strong>Organization</strong>:</div>
      </div></td>
	  
      <td colspan="4"><label>
        <select name="cmbin" onchange="showdep(this.value)" disabled="disabled">
          <option value="SELECT">-SELECT-</option>
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
      <td width="99" height="29"><div align="right" class="style5">
        <div align="left"><strong>Department:</strong></div>
      </div></td>
	  
      <td colspan="4">
	  <?php
		if($tp=='a')
		{
		?>
		<div id="txtHint10"><select name="cmbdep" disabled="disabled">
          <option value="SELECT">-SELECT-</option>
		  </select></div>
		<?php
		}
		else
		{
		?>
	  <label>
        <select name="cmbdep" disabled="disabled">
          <option value="SELECT">-SELECT-</option>
          <?php
	$qryy=execute("select * from ac_institution where iIdx_organization='$or1'");
	while($row3=mysql_fetch_assoc($qryy))
	{
	?> 
          <option value="<?php echo $row3[vinstitution];?>"><?php echo $row3[vinstitution];?></option>
          <?php
	  }
	  ?>
          </select>
        </label> <?php
	  }
	  ?></td> 
      </tr>
              <tr>
                <td><div align="right" class="style5">
                  <div align="left">Date From: </div>
                </div></td>
        <td><?php
		$yr=date('Y');
		$yr1=$yr-1;
		$yr2=$yr+1;
		$mon=date('m');
		$dat=date('d');
		if($mon>3)
		{
	  $myCalendar = new tc_calendar("date41", true, false);
	  $myCalendar->setIcon("images1/iconCalendar.gif");
	  $myCalendar->setDate('1', '04', $yr);
	  $myCalendar->setPath("./");
	  $myCalendar->setYearInterval($yr3, $yr4);
	  $myCalendar->dateAllow($yr3.'-04-01', $yr4.'-03-31');
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  }
	  else
	  {
	   $myCalendar = new tc_calendar("date41", true, false);
	  $myCalendar->setIcon("images1/iconCalendar.gif");
	 // $myCalendar->setDate(date('d'), date('m'), date('Y'));
	   $myCalendar->setDate('1', '04', $yr1);
	  $myCalendar->setPath("./");
	  $myCalendar->setYearInterval($yr3, $yr4);
	  $myCalendar->dateAllow($yr3.'-04-01', $yr4.'-03-31');
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  }
	  ?>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
              <tr>
                <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
              <tr>
                <td><div align="right" class="style5">
                  <div align="left">Date To: </div>
                </div></td>
        <td><?php
		$yr=date('Y');
		$yr1=$yr-1;
		$yr2=$yr+1;
		$mon=date('m');
		$dat=date('d');
		if($mon>3)
		{
	  $myCalendar = new tc_calendar("date42", true, false);
	  $myCalendar->setIcon("images1/iconCalendar.gif");
	 // $myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setPath("./");
	  $myCalendar->setYearInterval($yr3, $yr4);
	  $myCalendar->dateAllow($yr3.'-04-01', $yr4.'-03-31');
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  }
	  else
	  {
	   $myCalendar = new tc_calendar("date42", true, false);
	  $myCalendar->setIcon("images1/iconCalendar.gif");
	 // $myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setPath("./");
	  $myCalendar->setYearInterval($yr3, $yr4);
	  $myCalendar->dateAllow($yr3.'-04-01', $yr4.'-03-31');
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  }
	  ?>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
              <tr>
                <td>&nbsp;</td>
        <td><input type="submit" value="   VIEW   " name="bt2" /></td>
        <td>&nbsp;</td>
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
