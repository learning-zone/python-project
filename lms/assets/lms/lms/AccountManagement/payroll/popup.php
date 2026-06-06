<?php
require_once('../classes/tc_calendar.php');
require_once('../classes1/tc_calendar1.php');
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>LOAN</title>
<link href="calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../calendar.js"></script>
<script language="javascript" src="../calendar1.js"></script>
<script type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<style type="text/css">
<!--
.style1 {
	color: #000099;
	font-weight: bold;
}
.style2 {color: #0000FF}
-->
</style>
</head>

<body bgcolor="#CCFFFF">
<form id="form1" name="form1" method="post" action="">
  <div align="center">
    <table width="40%" height="221" border="0">
      
      <tr>
        <td width="59%" height="38" id="td1">
		<div align="right" class="style1" >Loan Amount: </div></td>
        <td width="41%"><span class="style2">
          <label>
          <input name="txtlamount" type="text" />
          </label>
        </span></td>
      </tr>
      <tr id="td1">
        <td height="21">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr id="td1">
        <td><div align="right" class="style1">Monthly Installment: </div></td>
        <td><input name="textfield" type="text" /></td>
      </tr>
      <tr  id="td1">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr  id="td1">
        <td><div align="right" class="style1">From: </div></td>
        <td><span class="style2">
          <label></label>
       <?php
	  $myCalendar = new tc_calendar("datefrom", true, false);
	  $myCalendar->setIcon("../images1/iconCalendar.gif");
	 $myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setPath("../");
	   $myCalendar->setYearInterval(1910, 2037);
	  $myCalendar->dateAllow('1910-01-01', '2038-01-01');
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  ?></span></td>
      </tr>
      <tr  id="td1">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr  id="td1">
        <td><div align="right" class="style1">To:</div></td>
        <td><span class="style2">  <?php
	  $myCalendar = new tc_calendar("dateto", true, false);
	  $myCalendar->setIcon("../images1/iconCalendar.gif");
	 $myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setPath("../");
	   $myCalendar->setYearInterval(1910, 2037);
	  $myCalendar->dateAllow('1910-01-01', '2038-01-01');
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  ?></span></td>
      </tr>
      <tr  id="td1">
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr  id="td1">
        <td colspan="2"><div align="center" class="style2">
            <input type="submit" name="Submit" value="Submit" />
          </div>
          <span class="style2">
          </label>
        </span></td>
      </tr>
    </table>
  </div>
</form>
</body>
</html>
