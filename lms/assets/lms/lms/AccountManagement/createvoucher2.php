<?php
session_start();
$name=$_SESSION['name'];
$tp=$_SESSION['type'];
$type=$_SESSION['type'];
$org=$_SESSION['org'];
//$or1=$_SESSION['ior'];
$ins=$_SESSION['ins'];
if($tp=='a')
{
$or1=$_POST['comboin'];
if($or1=="")
{
$or1=$_SESSION['orr'];
}
}

if($tp=='a')
{
$ins=$_POST['comboin'];
if($ins=="")
{
$ins=$_SESSION['ins'];
}
}
if($tp=='u')
{
$or1=$_SESSION['ior'];

}
require_once('classes/tc_calendar.php');
require_once('classes1/tc_calendar1.php');
include("../db.php");
$date=date("Y/m/d");
$y=date("Y");
//echo $ins.','.$ins1;
$qry=execute("select * from ac_vouchermaster");
$qry1=execute("select * from ac_voucher");
$num=rowcount($qry1);
if($vt=="")
{
//$ins=$_REQUEST['ins'];
$vt=$_SESSION['vtp'];
}
$vv=$_POST['vtv'];
//echo $ins1.$vt;
$num=$num/2;
$vno=$num+1;
$q3=execute("select iIdx_vouchermaster from ac_vouchermaster where vvouchertype=\"$vt\"");
$rr=fetchrow($q3);
//echo $r[0];
$qry32=execute("select * from ac_vouchermaster where vvouchertype=\"$vt\"");
$obj3=mysql_fetch_object($qry32);
$vnv=$obj3->iIdx_vouchermaster;
$qry3=execute("select * from ac_voucher where iIdx_institution='".$d1[0]."' and iIdx_vouchermaster='".$rr[0]."' and YEAR(ddate)='".$y."' order by ddate");
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
		$u1=execute("select count(*) from ac_voucher where iIdx_vouchermaster='$vnv'");
		$ru1=fetchrow($u1);
		if($ru1[0]!=0)
		{
			$n1=$ru1[0]/2;
			if($n1>9)
			{
				$n2='00'.($n1+1);
			}
			else
			{
				$n2='000'.($n1+1);
			}
		}
		else
		{
		$n2='0001';
		}
		
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
<link rel="stylesheet" href="css/print.css" type="text/css" media="print" /> 
<script type="text/javascript">
function showbyto(str)
{
var url="ajaxbyto2.php";
var str1=document.form1.oh1.value;
url=url+"?q="+str;
url=url+"&p="+str1;
url=url+"&sid="+Math.random();
if(str==1)
{
document.getElementById("bdd").style.background="#f6e8b5";
}
if(str==2)
{
document.getElementById("bdd").style.background="#c9f8d2";
}
if(str==3)
{
document.getElementById("bdd").style.background="#e5e1e4";
}
if(str==6)
{
document.getElementById("bdd").style.background="#afc3c5";
}
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
    document.getElementById("txtHint11").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
function showBybal(str)
{
var url="ajaxcombo.php";
var str1=document.form1.oh1.value;
url=url+"?q="+str;
url=url+"&p="+str1;
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
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
function showTobal(str)
{
var url="ajaxcombo1.php";
var str1=document.form1.oh1.value;
url=url+"?q="+str;
url=url+"&p="+str1;
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
    document.getElementById("txtHint1").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
function showledgers(str)
{
var url="ajaxcombo3.php";
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
    document.getElementById("txtHint2").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}

function validate()
{
	
	if(isNaN(document.form1.txtamt.value))
	{
		window.alert("Enter a Valid Amount");
		document.form1.txtamt.focus();
		return false;
	}
	
	if(document.form1.combobc.value=="select")
	{
		window.alert("Select Ledger");
		return false;
	}
	if(document.form1.txtamt.value=="")
	{
		window.alert("Enter Amount");
		document.form1.txtamt.focus();
		return false;
	}
	
	if(document.form1.comboacname.value=="select")
	{
		window.alert("Select Ledger");
		return false;
	}
	if(document.form1.combobc.value==document.form1.comboacname.value)
	{
		window.alert("Error!!Same Ledgers");
		//document.form1.date.focus();
		return false;
	}
	if(document.form1.date.value=="")
	{
		window.alert("Enter Date");
		document.form1.date.focus();
		return false;
	}
	
	
	function viewcalendar()
	{
 		 kalendarik = window.open("calendar.php", "kalendarik" , "location=0, menubar=0, scrollbars=0, status=0, titlebar=0, toolbar=0, directories=0, resizable=1, width=200, height=240, top=50, left=250");
  		 kalendarik.resizeTo(200, 240);
  		 kalendarik.moveTo(535, 393);
	}
//=========================================================================================================================================
	
//==========================================================================================================================================
	function insertdate(d)
	{
 		 window.close();
 		 window.opener.document.getElementById('date').value = d;
	}
	jQuery(document).ready(function () 
	{
    $('input.calendar1').simpleDatepicker();
    $('input.calendar2').simpleDatepicker();
    });
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
.style2 {color: #0033CC}
.style3 {color: #CC6600; }
.style4 {font-weight: bold}
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
      <h1 class="style3">Account Management</h1>
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
        <div class="inner" style="height:auto">
          <form id="form1" name="form1" method="post" action="cvoucheraction.php" onsubmit="return validate();" >
             <table width="965" border="1" style="position:absolute; width: 736px; height: 286px; left: 236px; top: 138px;" cellspacing="1" id="bdd" bgcolor="#99CCFF" >
              <tr id="th">
                <th height="26" colspan="5" scope="row">
                  <div align="center"><span class="style8">VOUCHER</span></div></th>
      </tr>
              
              <tr>
                <th height="33" scope="row"><div align="center" ><span class="style19"><strong>DEPARTMENT</strong>:</span></div></th>
        <td><span ><b>
          <select name="comboin">
            <option value="select">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -SELECT-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
            <?php
	  $qry2=execute("select * from ac_institution where iIdx_organization='$or1'");
	  while ($row = mysql_fetch_assoc($qry2))
      {
	  ?>
            <option value="<?php echo $row[vinstitution]; ?>"><?php echo $row[vinstitution]; ?></option>
            <?php } ?>
          </select>
        </b>&nbsp;</span></td>
        <td colspan="2">
          <div align="center" > 
            <span class="style4 style11 style22"><strong>Voucher Type</strong></span><span class="style22">:</span></div></td>
        <td width="292"><span class="style4 style11 style22"><b><font color="#000000">
		<select name="combovtype" onchange="showbyto(this.value)">
            <option value="select">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -SELECT-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
            <?php
	  $qry=execute("select * from ac_vouchermaster");
	  while ($row = mysql_fetch_assoc($qry))
      {
	  ?>
            <option value="<?php echo $row[iIdx_vouchermaster]; ?>"> <?php echo $row[vvouchertype]; ?> </option>
            <?php }  ?>
            </select></font></b></span></td>
      </tr>
              <tr>
                <th height="33" scope="row">Bill No: </th>
                <td><label>
                  <input type="text" name="txtbillno" />
                </label></td>
                <td colspan="2"><div align="center"><strong>Bill Date:</strong></div></td>
                <td>
				<strong>
          <?php
	  $myCalendar = new tc_calendar("datebill", true, false);
	  $myCalendar->setIcon("images/iconCalendar.gif");
	  //$myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setPath("./");
	   $myCalendar->setYearInterval(1910, 2037);
	  $myCalendar->dateAllow('1910-01-01', '2038-01-01');
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  ?>
          </strong>
				&nbsp;</td>
              </tr>
               <td colspan="5">
	   <div id="txtHint11">		</div></td>
              <tr>
                <th height="43" scope="row">&nbsp;</th>
	    
      <td colspan="4"><p ><span class="style4">
        <input name="rd" type="radio" value="1" onclick="txtcno.disabled=true" checked="checked"/>
        <strong>Cash</strong></span></p>
          <p ><span class="style4 style11 style20">
            <input name="rd" type="radio" value="0" onclick="txtcno.disabled=false,date6.disabled=false"/>
            <strong>Cheque/DD</strong></span></p></td>
        </tr>
              
              
              <tr>
                <th height="43" scope="row"><div align="center" ><span class="style4 style11 style20">Cheque/DD No: </span></div></th>
        <td><input type="text" name="txtcno" size="35" disabled="disabled"/>
          <strong>      </strong></td>
        <td colspan="2"><div align="center" ><span class="style21"><strong>Cheque/DD Date:
          
          </strong></span></div></td>
        <td><strong>
          <?php
	  $myCalendar = new tc_calendar("date6", true, false);
	  $myCalendar->setIcon("images/iconCalendar.gif");
	  //$myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setPath("./");
	   $myCalendar->setYearInterval(1910, 2037);
	  $myCalendar->dateAllow('1910-01-01', '2038-01-01');
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  ?>
          </strong></td>
      </tr>
              <tr>
                <th height="34" scope="row"><div align="center" ><span class="style19"><strong>Amount:</strong></span></div></th>
        <td colspan="4"><input type="text" name="txtamt" size="35" onkeypress=""/>
          <input type="hidden" name="ins3" value="<?php echo $ins;?>">        &nbsp;</td>
        </tr>
              
              <tr>
                <th scope="row"><div align="center" ><span class="style4 style11 style20">Narration:</span></div></th>
        <td colspan="4"><textarea name="txtnarr" rows="5" cols="32"></textarea></td>
        </tr>
              <tr>
                <th height="29" colspan="2" scope="row">&nbsp;</th>
        <td width="68"> <input name="submit" type="submit" value="   Save   " align="middle"/></td>
     <td width="60"><input  name="submit"type="submit" value="Save & Print"  onclick="window.print();return false;"/></td>
        <td><input type="hidden" name="oh1" value="<?php echo $or1;?>" /><input type="hidden" name="h1" value="<?php $ins;?>" />
          <input type="hidden" name="h2" value="<?php $vt;?>" /></td>
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
            <p>&nbsp;</p> <h2>&nbsp;</h2>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p> <h2>&nbsp;</h2>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p> <h2>&nbsp;</h2>
           
			  
                    
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

