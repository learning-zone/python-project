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
	<link href="calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="calendar.js"></script>
<script language="javascript" src="calendar1.js"></script>
<script language="javascript">
function validate()
{
if(document.form1.lisled.value=="select")
{
window.alert("Select Institution and Ledger");
return false;
}
if(document.form1.cmbin.value=="SELECT")
{
window.alert("Select Institution and Ledger");
return false;
}
}
function showledgers(str)
{
var url="ajaxcashledger.php";
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
    document.getElementById("txtHint9").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
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
.style1 {font-weight: bold}
.style2 {font-weight: bold}
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
          <form id="form1" name="form1" method="post" action="viewcashbook1.php" onsubmit="return validate();">
  <table width="972" border="0" style="position:absolute; left: 291px; top: 142px; width: 511px; height: 153px;" cellspacing="0">
    <tr>
      <td height="29" colspan="2"><a href="index.html"></a><div align="center" id="hd"><span class="style1 style3 style11"><strong>CASH BOOK </strong></span></div></td>
    </tr>
	<?php
		if($tp=='a')
		{
		?>
    <tr>
      <td width="122" height="29"><div align="right" class="style4 style9 style1">
        <div align="center"><strong>Organization:</strong></div>
      </div></td>
	   
      <td><label>
        <select name="cmbin" onchange="showledgers(this.value)">
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
      </tr> <?php }?>
    <tr>
      <td height="23"><div align="right" class="style4 style10 style2">
        <div align="center">From</div>
      </div></td>
      <td width="123"><?php
		$yr=date('Y');
		$yr1=$yr-1;
		$yr2=$yr+1;
		$mon=date('m');
		$dat=date('d');
		if($mon>3)
		{
	  $myCalendar = new tc_calendar("date13", true, false);
	  $myCalendar->setIcon("images1/iconCalendar.gif");
	 // $myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setDate('1', '04', $yr);
	  $myCalendar->setPath("./");
	  $myCalendar->setYearInterval($yr3, $yr2);
	  $myCalendar->dateAllow($yr3.'-04-01', $yr2.'-03-31');
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  }
	  else
	  {
	   $myCalendar = new tc_calendar("date13", true, false);
	  $myCalendar->setIcon("images1/iconCalendar.gif");
	   $myCalendar->setDate('1', '04', $yr1);
	 // $myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setPath("./");
	  $myCalendar->setYearInterval($yr3, $yr2);
	  $myCalendar->dateAllow($yr3.'-04-01', $yr2.'-03-31');
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  }
	  ?>&nbsp;</td>
      </tr>
    <tr>
      <td height="23"><div align="center"><strong><span class="style4">To</span></strong></div></td>
      <td><?php
		$yr=date('Y');
		$yr1=$yr-1;
		$yr2=$yr+1;
		$mon=date('m');
		$dat=date('d');
		if($mon>3)
		{
	  $myCalendar = new tc_calendar("date14", true, false);
	  $myCalendar->setIcon("images1/iconCalendar.gif");
	 // $myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setPath("./");
	  $myCalendar->setYearInterval($yr3, $yr2);
	  $myCalendar->dateAllow($yr3.'-04-01', $yr2.'-03-31');
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  }
	  else
	  {
	   $myCalendar = new tc_calendar("date14", true, false);
	  $myCalendar->setIcon("images1/iconCalendar.gif");
	 // $myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setPath("./");
	  $myCalendar->setYearInterval($yr3, $yr2);
	  $myCalendar->dateAllow($yr3.'-04-01', $yr2.'-03-31');
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  }
	  ?></td>
       </tr>
    
    <tr>
      <td height="26"><label>
        <div></div><div align="center" class="style9 style5"><strong>Ledger      </strong></div>
      </label></td>
      <td height="26"><?php if($tp=='a')
		{
		?><div id="txtHint9"><select name="lisled"><option value="select">-SELECT-</option></select></div><?php } else{?><?php
$b="Cash-in-hand";
$qryy=execute("select * from ac_allgroup where vgroupname=\"$b\"");
$ob1=mysql_fetch_object($qryy);
$i1=$ob1->iIdx_grp;
$qryy1="select * from ac_ledger where iIdx_group=\"$i1\" and iIdx_organization=\"$or1\"";
$result = execute($qryy1);
$r=fetchrow(execute("select * from ac_ledger where iIdx_group=\"$i1\" and iIdx_organization=\"$or1\""));
if($r<=0)
{
echo "<select name=lisled><option value=0>EMPTY</option></select>";
}
else
{
 echo "<select name='lisled'><option value='select'>-SELECT-</option>";
while($row = fetcharray($result))
  {
 echo "<option value='".$row['vledger']."'>".$row[vledger]."</option>";
  }
  echo "</select>";
}
}
?>
        
        <div align="justify">       </div>          </td>
      </tr> 
    
    <tr>
      <td colspan="2">&nbsp;</td>
      </tr>
    <tr>
      <td colspan="2"><div align="center"><input name="submit" type="submit" value="   VIEW   " /></div></td>
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

