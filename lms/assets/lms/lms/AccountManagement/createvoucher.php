<?php
session_start();
$name=$_SESSION['name'];
$tp=$_SESSION['type'];
$type=$_SESSION['type'];
$org=$_SESSION['org'];
$or1=$_SESSION['ior'];
$ins=$_SESSION['ins'];
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
$ins=$_SESSION['ins'];
}
$vt=$_POST['combovtype'];
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
$_SESSION['ins']=$ins;
$_SESSION['vtp']=$vt;
//echo $ins1.$vt;
$num=$num/2;
$vno=$num+1;
$q3=execute("select iIdx_vouchermaster from ac_vouchermaster where vvouchertype=\"$vt\"");
$rr=fetchrow($q3);
$qry2=execute("select iIdx_institution from ac_institution where vinstitution='".$ins."'");
$d1=fetchrow($qry2);
$qry11=execute("select max(vvoucherno) from ac_voucher where iIdx_institution='".$d1[0]."'");
$r=fetchrow($qry11); 
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
<script type="text/javascript">
function showBybal(str)
{
var url="ajaxcombo.php";
var str1=document.form1.ins3.value;
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
var str1=document.form1.ins3.value;
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
	if(document.form1.ins3.value=="")
	{
		window.alert("Select Institution and Voucher Type");
		return false;
	}
	if(isNaN(document.form1.txtamt.value))
	{
		window.alert("Enter a Valid Amount");
		document.form1.txtamt.focus();
		return false;
	}
	
	if(document.form1.combobc.value=="select")
	{
		window.alert("Select Bank/Cash");
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
		window.alert("Select Account Name");
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
        <div class="inner" style="height:auto">
          <form id="form1" name="form1" method="post" action="cvoucheraction.php" onsubmit="return validate();" >
            <table width="965" border="1" style="position:absolute; width: 736px; height: 286px; left: 236px; top: 116px;" cellspacing="0" id="tb1" <?php echo "if($vnv==1){bgcolor=#FFFF99 }if($vnv==2){ bgcolor=#8bf7dc }if($vnv==3){  bgcolor=#CCCCCC   }if($vnv==6){bgcolor=#66CCFF }";?>>
              <tr id="th">
                <th height="26" colspan="5" scope="row">
                  <div align="center"><span class="style8">VOUCHER</span></div></th>
      </tr>
              
              <tr>
                <th height="33" scope="row"><div align="center"><span class="style19"><strong>DEPARTMENT</strong>:</span></div></th>
        <td><b><font color="#000000"><?php echo $ins;?></font></b>&nbsp;</td>
        <td colspan="2">
          <div align="center">
            <table width="770" height="174" border="1" bgcolor="#FFFFFF" style="position:absolute; left: 0px; top: 515px; width: 737px; height: 42px;"  id="tbl">
              <tr id="th1">
                <th width="68" height="25" scope="row"><div align="center">Date</div></th>
		        <th width="87" height="25" scope="row"><div align="center">Voucher Type</div></th>
                  <th width="32" scope="row">Dr/Cr</th>
                  <td width="167"><div align="center"><strong>Account Name </strong></div></td>
                  <td width="106"><div align="center"><strong>Dr</strong></div></td>
                  <td width="109"><div align="center"><strong>Cr</strong></div></td>
                  <td width="113"><strong>Narration</strong></td>
                </tr>
              <?php
	
	  while ($row = mysql_fetch_assoc($qry3))
      {
	  $qq=execute("select vvouchertype from ac_vouchermaster where iIdx_vouchermaster='".$row[iIdx_vouchermaster]."'");
	  $e=fetchrow($qq);
	  $vn=$row[vvoucherno];
	  $dtd=date('d-m-Y',strtotime($row[ddate]));
	  if($vn!=$vn1)
		{
	  ?>
              <tr height="25"><td class="style21"><?php echo $dtd; ?></td>
		       <td class="style21"><?php echo $e[0]; ?></td>
	              <td class="style21"><?php echo $row[Dr_Cr]; ?></td>
	              <td class="style21"><?php echo $row[particulars]; ?></td>
			      <td class="style21"><?php echo $row[fdebit]; ?></td>
			      <td class="style21"><?php if($row[fcredit]<0){ ?><font color="#FF0000"><?php echo $row[fcredit]; ?></font><?php } else {echo $row[fcredit]; }?></td>
	              <td class="style21"><?php echo $row[vnarration]; ?></td>
	            </tr>
              <?php
		}
		else
		{
		?>
              <tr height="25"><td class="style21"></td>
		       <td class="style21"></td>
	              <td class="style21"><?php echo $row[Dr_Cr]; ?></td>
	              <td class="style21"><?php echo $row[particulars]; ?></td>
			      <td class="style21"><?php echo $row[fdebit]; ?></td>
			      <td class="style21"><?php if($row[fcredit]<0){ ?><font color="#FF0000"><?php echo $row[fcredit]; ?></font><?php } else {echo $row[fcredit]; }?></td>
	              <td class="style21"><?php echo $row[vnarration]; ?></td>
	            </tr>
              <?php
		}
		if($vn==$vn1)
		{
		?>
              <?php
		}
		$vn1=$vn=$row[vvoucherno];
		}
		?>
              </table> 
            <span class="style4 style11 style22"><strong>Voucher Type</strong></span><span class="style22">:</span></div></td>
        <td width="292"><span class="style4 style11 style22"><b><font color="#000000"><?php echo $vt;?></font></b></span></td>
      </tr>
              <tr>
                <th width="97" height="33" scope="row"><div align="center">Voucher No: </div></th>
        <td width="177"><input type="text" name="txtvno" size="35" value="<?php echo $n2;?>" readonly="true"></td>
        <td colspan="2"><div align="center"><strong>Date:</strong></div></td>
        <td><b>
          <?php
		$yr=date('Y');
		$yr1=$yr-1;
		$yr2=$yr+1;
		$mon=date('m');
		$dat=date('d');
		if($mon>3)
		{
	  $myCalendar = new tc_calendar("date5", true, false);
	  $myCalendar->setIcon("images1/iconCalendar.gif");
	 $myCalendar->setDate(date('d'), date('m'), date('Y'));
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
	   $myCalendar = new tc_calendar("date5", true, false);
	  $myCalendar->setIcon("images1/iconCalendar.gif");
	 $myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setPath("./");
	  $myCalendar->setYearInterval($yr3, $yr);
	  $myCalendar->dateAllow($yr1.'-04-01', $yr.'-03-31');
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  }
	  ?>
          </b>
          </span></td>
      </tr>
              <tr>
                <th height="37" scope="row"><?php $qry3=execute("select * from ac_vouchermaster where vvouchertype=\"$vt\"");
$obj3=mysql_fetch_object($qry3);
$vn3=$obj3->iIdx_vouchermaster;
if($vn3==2){?><div align="center">Bank/Cash</div><?php } else {?><div align="center">By</div><?php }?>
                  
                  
                  
  </th>
        <td>
          <!-- PAYMENT-->
          <?php
	  if($vn3==1)
	  {
	  if($mon>3)
		{
		?>
          
          <select name="combobc" onchange="showBybal(this.value)">
            <option value="select">-SELECT-</option>
            <?php
	    $qry1=execute("select * from ac_ledger where vins=\"$ins\" and date between '".$y21."' and '".$y32."'");
	    while ($row = mysql_fetch_assoc($qry1))
      {
	  $a=$row[vledger];
	  ?>
            <option value="<?php echo $row[vledger]; ?>"> <?php echo $row[vledger]; ?> </option>
            <?php }  ?>
            </select>
          <?php
	   }
	   else
	   {
	   ?>
          <select name="combobc" onchange="showBybal(this.value)">
            <option value="select">-SELECT-</option>
            <?php
	   $qry1=execute("select * from ac_ledger where vins=\"$ins\" and date between '".$y33."' and '".$y11."'");
	    while ($row = mysql_fetch_assoc($qry1))
      {
	  $a=$row[vledger];
	   ?>
            <option value="<?php echo $row[vledger]; ?>"> <?php echo $row[vledger]; ?> </option>
            
            <?Php
	   }   ?></select>
          <?php
	   }
	   }
	   ?>
          <!--RECEIPT-->
          
          
          
          
          
          <?php
	  if($vn3==2 || $vn3==3)
	  {
	   if($mon>3)
		{
		?>
          <select name="combobc" onchange="showBybal(this.value)">
            <option value="select">-SELECT-</option>
            <?php
	$qry1=execute("select * from ac_ledger where  iIdx_group=21 or iIdx_group=20 and date between '".$y21."' and '".$y32."' and vins=\"$ins\"");
	    while ($row = mysql_fetch_assoc($qry1))
      {
	  $a=$row[vledger];
	  ?>
            <option value="<?php echo $row[vledger]; ?>"> <?php echo $row[vledger]; ?> </option>
            <?php }  ?>
            </select>
          <?php } 
		else
		{
		?>
          <select name="combobc" onchange="showBybal(this.value)">
            <option value="select">-SELECT-</option>
            <?php
	$qry1=execute("select * from ac_ledger where iIdx_group=21 or iIdx_group=20 date between '".$y33."' and '".$y11."' and vins=\"$ins\"");
	    while ($row = mysql_fetch_assoc($qry1))
      {
	  $a=$row[vledger];
	  ?>
            <option value="<?php echo $row[vledger]; ?>"> <?php echo $row[vledger]; ?> </option>
            <?Php
	   }   ?></select>
          <?php
	   }
	   }
	   ?>
          
          
          
          
          <?php
	  if($vn3==6){
	  if($mon>3)
		{
		?>
          
          <select name="combobc" onchange="showBybal(this.value)">
            <option value="select">-SELECT-</option>
            <?php
	$qry1=execute("select * from ac_ledger where vins=\"$ins\" and iIdx_group!=21 and iIdx_group!=20 and date between '".$y21."' and '".$y32."' ");
	    while ($row = mysql_fetch_assoc($qry1))
      {
	  $a=$row[vledger];
	  ?>
            <option value="<?php echo $row[vledger]; ?>"> <?php echo $row[vledger]; ?> </option>
            <?php }  ?>
            </select><?php } else { ?>  
          <select name="combobc" onchange="showBybal(this.value)">
            <option value="select">-SELECT-</option>
            <?php
	$qry1=execute("select * from ac_ledger where vins=\"$ins\" and iIdx_group!=21 and iIdx_group!=20 date between '".$y33."' and '".$y11."'");
	    while ($row = mysql_fetch_assoc($qry1))
      {
	  $a=$row[vledger];
	  ?>
            <option value="<?php echo $row[vledger]; ?>"> <?php echo $row[vledger]; ?> </option>
            <?Php
	   }   ?></select>
          <?php
	   }
	   }
	   ?>
          
          
          </td>
        <td colspan="3"><span class="style21"><strong>Current Balance:
          </strong>
          </span>
          <b> <div class="style21" id="txtHint"></div></b></td>
        </tr>
              
              <tr>
                <th height="26" scope="row">
                  
                  <?php if($vn3==1){?><div align="center">Bank/Cash</div><?php } else {?><div align="center"><span class="style4 style11 style20">To:</span></div><?php }?></th>
        <td>
          
          
          
          <?php
	  if($vn3==1 || $vn3==3)
	  {
	  if($mon>3)
		{
	  ?> <select name="comboacname" onchange="showTobal(this.value)">
            <option value="select">-SELECT-</option><?php $qry1=execute("select * from ac_ledger where iIdx_group=21 or iIdx_group=20  and date between '".$y21."' and '".$y32."' and vins=\"$ins\"");
	  while ($row = mysql_fetch_assoc($qry1))
      {
	  ?>
            <option value="<?php echo $row[vledger]; ?>"> <?php echo $row[vledger]; ?> </option>
            <?php }  ?>
            </select><?php } else { ?>  
          <select name="comboacname" onchange="showTobal(this.value)">
            <option value="select">-SELECT-</option><?php $qry1=execute("select * from ac_ledger where  iIdx_group=21 or iIdx_group=20 and date between '".$y33."' and '".$y11."' and vins=\"$ins\"");
	  while ($row = mysql_fetch_assoc($qry1))
      {
	  ?>
            <option value="<?php echo $row[vledger]; ?>"> <?php echo $row[vledger]; ?> </option>
            <?php }  ?>
            </select>
          <?php } }?>
          
          
          
          
          
          <?php
	  if($vn3==2){
	  if($mon>3)
		{
	  ?>
          <select name="comboacname" onchange="showTobal(this.value)">
            <option value="select">-SELECT-</option>
            <?php
		 $qry1=execute("select * from ac_ledger where vins=\"$ins\" and date between '".$y21."' and '".$y32."'");
	  while ($row = mysql_fetch_assoc($qry1))
      {
	  ?>
            <option value="<?php echo $row[vledger]; ?>"> <?php echo $row[vledger]; ?> </option>
            <?php }  ?>
            </select><?php } else { ?>  
          <select name="comboacname" onchange="showTobal(this.value)">
            <option value="select">-SELECT-</option>
            <?php
		 $qry1=execute("select * from ac_ledger where vins=\"$ins\" and date between '".$y33."' and '".$y11."'");
	  while ($row = mysql_fetch_assoc($qry1))
      {
	  ?>
            <option value="<?php echo $row[vledger]; ?>"> <?php echo $row[vledger]; ?> </option>
            <?php }  ?>
            </select>
          <?php } }?>
          
          
          
          
          
          <?php
	  if($vn3==6){
	   if($mon>3)
		{
	  ?> <select name="comboacname" onchange="showTobal(this.value)">
            <option value="select">-SELECT-</option><?php $qry1=execute("select * from ac_ledger where vins=\"$ins\" and iIdx_group!=21 and iIdx_group!=20  and date between '".$y21."' and '".$y32."'");
	  while ($row = mysql_fetch_assoc($qry1))
      {
	  ?>
            <option value="<?php echo $row[vledger]; ?>"> <?php echo $row[vledger]; ?> </option>
            <?php }  ?>
            </select><?php } else { ?>  
          <select name="comboacname" onchange="showTobal(this.value)">
            <option value="select">-SELECT-</option><?php $qry1=execute("select * from ac_ledger where vins=\"$ins\" and iIdx_group!=21 and iIdx_group!=20 and date between '".$y33."' and '".$y11."'");
	  while ($row = mysql_fetch_assoc($qry1))
      {
	  ?>
            <option value="<?php echo $row[vledger]; ?>"> <?php echo $row[vledger]; ?> </option>
            <?php }  ?>
            </select>
          <?php } }?>
          
          
          
          </td>
        <td colspan="3"><span class="style21"><strong>Current Balance:
          </strong>
          </span>
          <b> <div class="style21" id="txtHint1"></div></b></td>
        </tr>
              <tr>
                <th height="43" scope="row">&nbsp;</th>
	    
      <td colspan="4"><p><span class="style4">
        <input name="rd" type="radio" value="1" onclick="txtcno.disabled=true" checked="checked"/>
        <strong>Cash</strong></span></p>
          <p><span class="style4 style11 style20">
            <input name="rd" type="radio" value="0" onclick="txtcno.disabled=false,date6.disabled=false"/>
            <strong>Cheque/DD</strong></span><span class="style22"></span></p></td>
        </tr>
              
              
              <tr>
                <th height="43" scope="row"><div align="center"><span class="style4 style11 style20">Cheque/DD No: </span></div></th>
        <td><input type="text" name="txtcno" size="35" disabled="disabled"/>
          <strong>      </strong></td>
        <td colspan="2"><div align="center"><span class="style21"><strong>Cheque/DD Date:
          
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
                <th height="34" scope="row"><div align="center"><span class="style19"><strong>Amount:</strong></span></div></th>
        <td colspan="4"><input type="text" name="txtamt" size="35" onkeypress=""/>
          <input type="hidden" name="ins3" value="<?php echo $ins;?>">        &nbsp;</td>
        </tr>
              
              <tr>
                <th scope="row"><div align="center"><span class="style4 style11 style20">Narration:</span></div></th>
        <td colspan="4"><textarea name="txtnarr" rows="5" cols="32"></textarea></td>
        </tr>
              <tr>
                <th height="29" colspan="2" scope="row">&nbsp;</th>
        <td width="68"> <input name="submit" type="submit" value="   Save   " align="middle"/></td>
        <td width="60"><input name="button" type='button' onclick='javascript:window.location.href=&quot;accountingvouchers.php&quot;' value='  Back   ' /></td>
        <td><input type="hidden" name="h1" value="<?php $ins;?>" />
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
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p></p>
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

